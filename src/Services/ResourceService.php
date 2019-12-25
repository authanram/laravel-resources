<?php

namespace Resources\Services;

use App\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Resources\Contracts\ResourceServiceContract;

class ResourceService implements ResourceServiceContract
{
    public static function getModel(?Model $model, ?Request $request): Model
    {
        return $model || ! $request ? $model : static::getModelFromRequestPathSegment($request);
    }

    private static function getModelFromRequestPathSegment(Request $request): Model
    {
        $prefixes = config('resources.routes.prefixes');

        $segments = collect($request->segments());

        $segment = $segments->offsetGet(\count($prefixes));

        $singularSegment = Str::singular($segment);

        $shortName = Str::studly($singularSegment);

        $className = config('resources.namespaces.models') . "\\$shortName";

        return new $className;
    }
}
