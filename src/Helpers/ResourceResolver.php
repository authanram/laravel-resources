<?php

namespace Authanram\Resources\Helpers;

use Authanram\Resources\Contracts\RawPluginContract;
use Authanram\Resources\Entities\Association;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class ResourceResolver
{
    public static function getConfiguration(string $path = null)
    {
        $configuration = config(config('authanram-resources.config_path')) ?? static::makeConfiguration();

        return !$path ? $configuration : data_get($configuration, $path);
    }

    public static function makeResourceBySnakeName(string $snake, bool $withAssociations = true): \stdClass
    {
        $resourceName = NameResolver::makeResourceFileNameFromSnakeName($snake);

        /** @var \stdClass $resource */
        $resource = static::getConfiguration($resourceName);

        $resource->asscociations = new Fluent();

        return $withAssociations ? static::makeResourceAssociations($resource) : $resource;
    }


    public static function makeModelClassNameFromCamelName(string $camel): string
    {
        $singular = Str::singular($camel);

        $kebab = Str::kebab($singular);

        return static::makeModelClassNameFromKebabName($kebab);
    }

    public static function makeModelClassNameFromKebabName(string $kebab): string
    {
        $singular = Str::singular($kebab);

        return static::getConfiguration("$singular.model");
    }

    private static function makeConfiguration(): array
    {
        $resources = static::makeResources();

        $path = config('authanram-resources.config_path');

        data_get(app(), 'config')->set($path, $resources);

        return $resources;
    }

    private static function makeResources(): array
    {
        $files = File::allFiles(config('authanram-resources.path'));

        $fn = static function (SplFileInfo $fileInfo) {

            $filename = pathinfo($fileInfo->getFilename(), PATHINFO_FILENAME);

            $resource = Yaml::parseFile($fileInfo->getPathname(), Yaml::PARSE_OBJECT_FOR_MAP);

            return [$filename => static::applyRawPlugins($resource)];

        };

        return collect($files)->mapWithKeys($fn)->toArray();
    }

    private static function makeResourceAssociations(\stdClass $resource): \stdClass
    {
        $fn = fn (\stdClass $field) => \in_array($field->type, Association::TYPES_PIVOT, true);

        $associations = collect($resource->fields)->filter($fn)->keys();

        foreach ($associations as $association) {

            $snakeAssociation = Str::snake($association);

            $associationResource = static::makeResourceBySnakeName($snakeAssociation, false);

            $resource->asscociations->{$association} = $associationResource;

        }

        return $resource;
    }

    private static function applyRawPlugins(\stdClass $resource): \stdClass
    {
        foreach (config('authanram-resources-plugins.raw', []) as $rawPlugin) {

            $resource = static::applyRawPlugin(new $rawPlugin, $resource);

        }

        return $resource;
    }

    private static function applyRawPlugin(RawPluginContract $plugin, \stdClass $resource): \stdClass
    {
        return $plugin->handle($resource);
    }
}
