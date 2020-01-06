<?php

namespace Authanram\Resources\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NameResolver
{
    public static function makeResourceNameFromStudlyName(string $studly): string
    {
        $snake = Str::snake($studly);

        $title = Str::title($snake);

        return str_replace('_', ' ', $title);
    }

    public static function makeResourceFileNameFromSnakeName(string $snake): string
    {
        $singular = Str::slug($snake, '-');

        return Str::singular($singular);
    }
}
