<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;
use Illuminate\Support\Facades\DB;
use Authanram\Resources\Helpers\NameResolver;

final class ResourceFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $basename = class_basename($resource->model);

        $table = NameResolver::makeTableNameFromStudlyModelBasename($basename);

        // dd($table);

        return $resource;
    }

    private static function getColumnDefinitions(string $table): array
    {
        return DB::select(DB::raw("SHOW KEYS FROM $table"));
    }

    private static function makeFieldType(string $databaseType): string
    {
        return config("authanram-resources.fields.$databaseType", 'text');
    }
}
