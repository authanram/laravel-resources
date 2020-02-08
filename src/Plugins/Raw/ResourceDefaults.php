<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;

final class ResourceDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $model = $resource->model;

        if ($model === 'App\Event') {

            // dd($model::describeTable());

        }

        // $resource->rawResource = (object)[];

        return $resource;
    }

    private static function makeFieldType(string $databaseType): string
    {
        return config("authanram-resources.fields.$databaseType", 'text');
    }
}
