<?php

namespace Authanram\Resources\Services;

use Authanram\Resources\Helpers\NameResolver;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Authanram\Resources\Contracts\RouteServiceContract;
use Authanram\Resources\Entities\Action;

class RouteService implements RouteServiceContract
{
    public function bootResourceRouteBindings(): void
    {
        $prefixes = collect(config('authanram-resources.routes.prefixes'));

        $segments = collect(request()->segments());

        $isResourceRoute = static::isResourceRoute($prefixes, $segments);

        if (! $isResourceRoute) {

            return;

        }

        $modelName = static::makeModelName($prefixes, $segments);

        $isValidModel = static::isValidModel($modelName);

        if (! static::isValidAction($prefixes, $segments, $isValidModel)) {

            abort(404);

        }

        static::bind($modelName);
    }

    private static function makeModelName(Collection $prefixes, Collection $segments): string
    {
        $segment = $segments->offsetGet($prefixes->count());

        return NameResolver::makeModelClassNameFromKebabName($segment);
    }

    private static function isResourceRoute(Collection $prefixes, Collection $segments): bool
    {
        $condition = fn(string $prefix, int $index) => $segments->offsetGet($index) !== $prefix;

        return $prefixes->filter($condition)->isEmpty();
    }

    private static function isValidAction(Collection $prefixes, Collection $segments, bool $isValidModel): bool
    {
        $segmentsCount = $segments->count();

        $prefixesCount = $prefixes->count();

        $hasId = $segmentsCount >= $prefixesCount + 2 && \is_numeric($segments->offsetGet($prefixesCount + 1));

        $lastSegment = $segments->last();

        $isIndexAction = $segmentsCount === $prefixesCount + 1;

        $isCreateAction = $segmentsCount === $prefixesCount + 2 && $lastSegment === Action::CREATE;

        $isShowAction = $hasId && $segmentsCount === $prefixesCount + 2;

        $isOther = $hasId && Action::getActions()->contains($lastSegment);

        return $isValidModel && ($isIndexAction || $isCreateAction || $isShowAction || $isOther);
    }

    private static function isValidModel(string $modelName): bool
    {
        $ignoredClasses = config('authanram-resources.routes.bindings.models.ignored');

        return class_exists($modelName)

            && ! \in_array($modelName, $ignoredClasses, true);
    }

    private static function bind(string $modelName): void
    {
        $baseName = class_basename($modelName);

        $kebab = Str::kebab($baseName);

        Route::bind($kebab, static function ($value) use ($modelName) {

            return \is_numeric($value)

                ? $modelName::find($value) ?? abort(404)

                : $value;
        });
    }
}
