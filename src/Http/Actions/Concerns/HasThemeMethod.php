<?php

namespace Resources\Http\Actions\Concerns;

use Resources\Theme;

trait HasThemeMethod
{
    public function theme(): string
    {
        $args = \func_get_args();

        return trim(Theme::getValue(...$args));
    }
}
