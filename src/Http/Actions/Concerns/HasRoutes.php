<?php

namespace Authanram\Resources\Http\Actions\Concerns;

use Illuminate\Http\Request;
use Authanram\Resources\Entities\Routes;
use Illuminate\Support\Str;
use Authanram\Resources\Entities;

trait HasRoutes
{
    protected Routes $routes;

    public function getRoutes(): Routes
    {
        return $this->routes;
    }

    private function makeRoutes(Request $request): Routes
    {
        $route = $request->route();

        $indexRouteName = Str::beforeLast($route->getName(), '.');

        $actions = Entities\Action::getActions();

        $fn = fn (string $action) => [$action => $indexRouteName . '.' . $action];

        $routesArray = collect($actions)->mapWithKeys($fn)->toArray();

        $routes = new Entities\Routes($routesArray, $this->getModel());

        return static::setPreviousUrl($this->getAction(), $routes, $request);
    }

    private static function setPreviousUrl(string $action, Entities\Routes $routes, Request $request): Entities\Routes
    {
        $relevantActions = [Entities\Action::INDEX, Entities\Action::SHOW];

        if (\in_array($action, $relevantActions, true)) {

            $request->session()->put('previousUrl', url()->current());

        }

        if ($request->session()->get('previousUrl')) {

            $routes->setPreviousUrl($request->session()->get('previousUrl'));

        }

        return $routes;
    }
}
