<?php

namespace Resources\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Resources\Contracts\ReaderServiceContract;
use Resources\Entities\Association;
use Resources\Yaml;
use Symfony\Component\Finder\SplFileInfo;

class ReaderService implements ReaderServiceContract
{
    public static function getResource(string $tableName, bool $withAssociations = true): \stdClass
    {
        $resourceName = static::makeResourceFileName($tableName);

        $filePath = config('resources.path') . '/' . $resourceName;

        $resource = Yaml::parseFile($filePath);

        $resource->asscociations = new Fluent();

        return $withAssociations ? static::makeResourceAssociations($resource) : $resource;
    }

    public static function getResourceNames(): array
    {
        $cacheKey = config('resources.cache.key');

        return Cache::rememberForever(":$cacheKey:resources", static function () {

            $path = config('resources.path');

            $files = File::allFiles($path);

            return collect($files)

                ->map(fn(SplFileInfo $file) => pathinfo($file->getFilename(), PATHINFO_FILENAME))

                ->unique()

                ->sort()

                ->toArray();

        });
    }

    private static function makeResourceFileName(string $table): string
    {
        $singularTable = Str::slug($table, '-');

        $resourceName = Str::singular($singularTable);

        return $resourceName . '.yaml';
    }

    private static function makeResourceAssociations(\stdClass $resource): \stdClass
    {
        $fn = fn (\stdClass $field) => \in_array($field->type, Association::TYPES_PIVOT, true);

        $associations = collect($resource->fields)->filter($fn)->keys();

        foreach ($associations as $association) {

            $snakeAssociation = Str::snake($association);

            $associationResource = static::getResource($snakeAssociation, false);

            $resource->asscociations->{$association} = $associationResource;

        }

        return $resource;
    }
}
