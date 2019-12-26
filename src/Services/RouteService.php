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

        if (! $this->isValidAction() || ! $this->canBind()) {

            return;

        }

        $this->setSingularModelName()->setModelName();

        if (! $this->isApplicableModel()) {

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
        $config = take(config('authanram-resources'));

        $this->modelNamespace = (string)$config->get('namespaces.models');

        $this->prefixes = $config->toCollection('routes.prefixes');

        $this->ignoredClasses = $config->get('routes.bindings.models.ignored');

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

        return \in_array($lastSegment, $actions, true);
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
