<?php

namespace Authanram\Resources\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Fluent;

class Routes extends Fluent
{
    protected array $routes;

    protected ?int $id;

    public function __construct(array $routes, Model $model)
    {
        if ($model->id) {

            $this->id = $model->id;

        }

        $this->routes = $routes;
    }

    public function getCreateUrl(): string
    {
        return $this->makeRoute(Action::CREATE);
    }

    public function getIndexUrl(): string
    {
        return $this->makeRoute(Action::INDEX);
    }

    public function getStoreUrl(): string
    {
        return $this->makeRoute(Action::STORE);
    }

    public function getDestroyUrl(): string
    {
        return $this->makeRoute(Action::DESTROY, $this->id);
    }

    public function getEditUrl(): string
    {
        return $this->makeRoute(Action::EDIT, $this->id);
    }

    public function getRestoreUrl(): string
    {
        return $this->makeRoute(Action::RESTORE, $this->id);
    }

    public function getShowUrl(): string
    {
        return $this->makeRoute(Action::SHOW, $this->id);
    }

    public function getUpdateUrl(): string
    {
        return $this->makeRoute(Action::UPDATE, $this->id);
    }

    //

    public function getPreviousUrl(): ?string
    {
        return $this->routes['previous'] ?? null;
    }

    public function setPreviousUrl(?string $url): self
    {
        $this->routes['previous'] = $url;

        return $this;
    }

    //

    public function getResourcesUrl(): string
    {
        return route(implode('.', config('authanram-resources.routes.prefixes')));
    }

    //

    public function makeRoute(string $action, int $id = null): string
    {
        if ($id) {

            return route($this->routes[$action], $id);

        }

        return route($this->routes[$action]);
    }
}
