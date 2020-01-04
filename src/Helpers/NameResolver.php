<?php

namespace Authanram\Resources\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NameResolver
{
    public static function makeResourceName(Model $model): string
    {
        $snake = Str::snake(class_basename($model));

        $title = Str::title($snake);

        return str_replace('_', ' ', $title);
    }

    public static function makeModelNameFromRequest(Request $request): string
    {
        $segments = collect($request->segments());

        $offset = \count(config('authanram-resources.routes.prefixes'));

        $segment = $segments->offsetGet($offset);

        return static::makeModelNameFromRequestPathSegment($segment);
    }

    public static function makeModelNameFromRequestPathSegment(string $segment): string
    {
        $singular = Str::singular($segment);

        $basename = Str::studly($singular);

        $namespace = config('authanram-resources.namespaces.models');

        return "$namespace\\$basename";
    }

    public static function makeResourceFileNameFromTableName(string $table): string
    {
        $singular = Str::slug($table, '-');

        return Str::singular($singular);
    }
}
