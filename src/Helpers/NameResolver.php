<?php

namespace Authanram\Resources\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NameResolver
{
    public static function makeModelClassNameFromCamelName(string $camel): string
    {
        $singular = Str::singular($camel);

        $kebab = Str::kebab($singular);

        return static::makeModelClassNameFromKebabName($kebab);
    }

    public static function makeModelClassNameFromKebabName(string $kebab): string
    {
        $singular = Str::singular($kebab);

        $configuration = config("authanram-resources.resources.$singular");

        return data_get($configuration, 'model');
    }

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
