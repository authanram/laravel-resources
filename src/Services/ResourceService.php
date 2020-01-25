<?php

namespace Authanram\Resources\Services;

use Authanram\Resources\Contracts\ResourceServiceContract;
use Authanram\Resources\Helpers\NameResolver;
use Authanram\Resources\Helpers\ResourceResolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ResourceService implements ResourceServiceContract
{
    public static function getModel(Request $request): Model
    {
        $segments = collect($request->segments());

        $offset = \count(config('authanram-resources.routes.prefixes'));

        $segment = $segments->offsetGet($offset);

        $className = NameResolver::makeModelClassNameFromKebabName($segment);

        return new $className;
    }

    public static function getResourceByTableName(string $snake): \stdClass
    {
        return ResourceResolver::makeResourceBySnakeName($snake);
    }

    public static function getResources(): array
    {
        return ResourceResolver::makeResources();
    }
}
