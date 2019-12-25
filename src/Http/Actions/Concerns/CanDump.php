<?php

namespace Resources\Http\Actions\Concerns;

trait CanDump
{
    public function dump(string $property)
    {
        return $this->{$property} ?? $this;
    }
}
