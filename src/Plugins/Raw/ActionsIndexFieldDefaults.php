<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;

final class ActionsIndexFieldDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        $fields = data_get($resource, 'fields');

        if (empty ($fields)) {

            $resource->fields = (object)[];

        }

        return $resource;
    }
}
