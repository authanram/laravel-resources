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
    public static function makeResources(): array
    {
        if (config(config('authanram-resources.config_path'))) {

            return config(config('authanram-resources.config_path'));

        }

        $files = File::allFiles(config('authanram-resources.path'));

        $fn = static function (SplFileInfo $fileInfo) {

            $filename = pathinfo($fileInfo->getFilename(), PATHINFO_FILENAME);

            $resource = Yaml::parseFile($fileInfo->getPathname(), Yaml::PARSE_OBJECT_FOR_MAP);

            return [$filename => static::applyRawPlugins($resource)];

        };

        return collect($files)->mapWithKeys($fn)->toArray();
    }

    public static function makeResourceBySnakeName(string $snake, bool $withAssociations = true): \stdClass
    {
        $resourceName = NameResolver::makeResourceFileNameFromSnakeName($snake);

        $resource = static::makeRawResource($resourceName);

        $resource->asscociations = new Fluent();

        return $withAssociations ? static::makeResourceAssociations($resource) : $resource;
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

    private static function makeRawResource(string $resourceName): \stdClass
    {
        $configuration = static::makeResources();

        /** @var \stdClass $resource */
        $resourceConfiguration = (array)data_get($configuration, $resourceName);

        $rawResource = (array)static::applyRawPlugins((object)[
            'model' => $resourceConfiguration['model'],
            'resource' => $resourceName,
        ]);

        return (object)array_merge_recursive_distinct($rawResource, $resourceConfiguration);
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
