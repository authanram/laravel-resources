<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;

final class ActionsIndexFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $rawFields = get_object_vars($resource->fields);

//        $resource->actions = (object)[
//
//            'index' => [
//
//                'fields' => static::makeIndexFields($rawFields),
//
//            ]
//
//        ];

        return $resource;
    }

    private static function makeIndexFields(array $fields): array
    {


        return $fields;
    }
}
