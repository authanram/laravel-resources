<?php

namespace Authanram\Resources\Http\Actions\Concerns;

trait CanDump
{
    public function dump(string $property)
    {
        return $this->{$property} ?? $this;
    }
}
