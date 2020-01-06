<?php

namespace Authanram\Resources\Contracts;

interface RawPluginContract
{
    public function handle(\stdClass $resource): \stdClass;
}
