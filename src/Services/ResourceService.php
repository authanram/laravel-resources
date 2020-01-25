<?php

namespace Authanram\Resources\Services;

use Authanram\Resources\Contracts\ResourceServiceContract;
use Authanram\Resources\Helpers\ResourceResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ResourceService implements ResourceServiceContract
{
    public static function getModel(?Model $model, ?Request $request): Model
    {
        if (! $model && $request) {

            $segments = collect($request->segments());

            $offset = \count(config('authanram-resources.routes.prefixes'));

            $segment = $segments->offsetGet($offset);

            $className = ResourceResolver::makeModelClassNameFromKebabName($segment);

            return new $className;

        }

        return $model;
    }

    public static function getResourceBySnakeName(string $snake): \stdClass
    {
        return ResourceResolver::makeResourceBySnakeName($snake);
    }

    public static function getResources(): array
    {
        return config(config('authanram-resources.config_path'));
    }
}
