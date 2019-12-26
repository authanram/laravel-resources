<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Authanram\Resources\Theme;

trait HasThemeMethod
{
    public function theme(): string
    {
        $args = \func_get_args();

        return trim(Theme::getValue(...$args));
    }
}
