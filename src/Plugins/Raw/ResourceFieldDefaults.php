<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;

final class ResourceFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $resource = data_set($resource, 'fields.id', (object)['type' => 'id']);

        return $resource;
    }
}
