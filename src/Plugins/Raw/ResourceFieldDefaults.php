<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;
use Illuminate\Database\Eloquent\Model;

final class ResourceFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $resource = data_set($resource, 'fields.id', (object)['type' => 'id']);

//        /** @var Model $first */
//        $first = $resource->model::all()->first();
//
//        dump($first->toArray());

        return $resource;
    }
}
