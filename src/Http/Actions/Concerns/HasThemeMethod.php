<?php

namespace Authanram\Resources\Http\Actions\Concerns;

trait HasThemeMethod
{
    /**
     * @param string[]|string $keys
     *
     * @param string[]|string|null $default
     *
     * @param bool $throw
     *
     * @return string
     *
     * @throws \Authanram\Theme\Exceptions\ThemeException
     */
    public function theme($keys, $default = null, bool $throw = true): string
    {
        return theme($keys, $default, $throw);
    }
}
