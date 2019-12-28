<?php

namespace Authanram\Resources\Http\Actions\Concerns;

trait HasThemeMethod
{
    public function theme(): string
    {
        $args = \func_get_args();

        return theme(...$args);
    }
}
