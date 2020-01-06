<?php

namespace Authanram\Resources\Services;

use Authanram\Resources\Contracts\RawPluginContract;
use Authanram\Resources\Contracts\ResourceServiceContract;
use Authanram\Resources\Entities\Association;
use Authanram\Resources\Helpers\NameResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class ResourceService implements ResourceServiceContract
{
    public static function getModel(?Model $model, ?Request $request): Model
    {
        if (! $model && $request) {

            $segments = collect($request->segments());

            $offset = \count(config('authanram-resources.routes.prefixes'));

            $segment = $segments->offsetGet($offset);

            $className = NameResolver::makeModelClassNameFromKebabName($segment);

            return new $className;

        }

        return $model;
    }

    public static function getResourceBySnakeName(string $snake, bool $withAssociations = true): \stdClass
    {
        $resourceName = NameResolver::makeResourceFileNameFromSnakeName($snake);

        $resource = config("authanram-resources.resources.$resourceName");

        $resource->asscociations = new Fluent();

        return $withAssociations ? static::makeResourceAssociations($resource) : $resource;
    }

    public static function getResources(): array
    {
        $files = File::allFiles(config('authanram-resources.path'));

        $fn = static function (SplFileInfo $fileInfo) {

            $filename = pathinfo($fileInfo->getFilename(), PATHINFO_FILENAME);

            $resource = Yaml::parseFile($fileInfo->getPathname(), Yaml::PARSE_OBJECT_FOR_MAP);

            return [$filename => static::applyRawPlugins($resource)];

        };

        return collect($files)->mapWithKeys($fn)->toArray();
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

    private static function makeResourceAssociations(\stdClass $resource): \stdClass
    {
        $fn = fn (\stdClass $field) => \in_array($field->type, Association::TYPES_PIVOT, true);

        $associations = collect($resource->fields)->filter($fn)->keys();

        foreach ($associations as $association) {

            $snakeAssociation = Str::snake($association);

            $associationResource = static::getResourceBySnakeName($snakeAssociation, false);

            $resource->asscociations->{$association} = $associationResource;

        }

        return $resource;
    }
}
