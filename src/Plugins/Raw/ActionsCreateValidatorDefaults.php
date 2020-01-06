<?php

namespace Authanram\Resources\Plugins\Raw;

use Authanram\Resources\Contracts\RawPluginContract;

final class ActionsCreateValidatorDefaults implements RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass
    {
        return $resource;
    }
}
