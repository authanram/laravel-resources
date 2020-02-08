<?php

namespace Authanram\Resources\Helpers;

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

    public static function makeModelClassNameFromKebabName(string $kebab): string
    {
        $singular = Str::singular($kebab);

        $configuration = ResourceResolver::makeResources();

        return data_get($configuration, "$singular.model");
    }

    public static function makeModelClassNameFromCamelName(string $camel): string
    {
        $singular = Str::singular($camel);

        $kebab = Str::kebab($singular);

        return static::makeModelClassNameFromKebabName($kebab);
    }
}
