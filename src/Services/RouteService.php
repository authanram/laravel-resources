<?php

namespace Authanram\Resources\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Authanram\Resources\Contracts\RouteServiceContract;
use Authanram\Resources\Entities\Action;

class RouteService implements RouteServiceContract
{
    private string $modelName;

    private string $modelNamespace;

    private string $singularModelName;

    private array $ignoredClasses;

    private Collection $prefixes;

    private Collection $segments;

    public function bootResourceRouteBindings(): void
    {
        $this->setResourceConfiguration()->setSegments();

        $this->setSingularModelName()->setModelName();

        if (! $this->isValidAction()) {

            abort(404);

        }

        if (! $this->canBind() || ! $this->isApplicableModel()) {

            return;

        }

        $this->bind();
    }

    private function bind(): void
    {
        Route::bind($this->singularModelName, function ($value) {

            return \is_numeric($value)

                ? $this->modelName::find($value) ?? abort(404)

                : $value;
        });
    }

    private function setResourceConfiguration(): self
    {
        $this->modelNamespace = (string)config('authanram-resources.namespaces.models');

        $this->prefixes = collect(config('authanram-resources.routes.prefixes'));

        $this->ignoredClasses = config('authanram-resources.routes.bindings.models.ignored');

        return $this;
    }

    private function setSegments(): self
    {
        $this->segments = collect(request()->segments());

        return $this;
    }

    private function setSingularModelName(): self
    {
        $prefixesCount = $this->prefixes->count();

        $pluralName = $this->segments->offsetGet($prefixesCount);

        $this->singularModelName = Str::singular($pluralName);

        return $this;
    }

    private function setModelName(): self
    {
        $this->modelName = $this->modelNamespace

            . '\\'

            . Str::studly($this->singularModelName);

        return $this;
    }

    private function isValidAction(): bool
    {
        $lastSegment = $this->segments->last();

        if (\is_numeric($lastSegment)) {

            return true;

        }

        $actions = Action::getActions()->toArray();

        return \in_array($lastSegment, $actions, true)
            || ($this->isApplicableModel() && $this->segments->count() === $this->prefixes->count() + 1);
    }

    private function canBind(): bool
    {
        return $this->segments->count() -1 >= $this->prefixes->count()

            && $this->containsAllPrefixes();
    }

    private function isApplicableModel(): bool
    {
        return class_exists($this->modelName)

            && ! \in_array($this->modelName, $this->ignoredClasses, true);
    }

    private function containsAllPrefixes(): bool
    {
        $condition = fn(string $prefix, int $index) => $this->segments->offsetGet($index) !== $prefix;

        return $this->prefixes->filter($condition)->isEmpty();
    }
}
