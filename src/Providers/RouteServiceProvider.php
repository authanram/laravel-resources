<?php

namespace Authanram\Resources\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Authanram\Resources\Contracts;
use Authanram\Resources\Services;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');

        if ($this->app->runningInConsole()) {
            return;
        }

        /** @var Services\RouteService $routeService */
        $routeService = $this->app->make(Contracts\RouteServiceContract::class);

        $routeService->bootResourceRouteBindings();
    }
}
