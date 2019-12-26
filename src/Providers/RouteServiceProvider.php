<?php

namespace Resources\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Resources\Contracts;
use Resources\Services;

class RouteServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        /** @var Services\RouteService $routeService */
        $routeService = $this->app->make(Contracts\RouteServiceContract::class);

        $routeService->bootResourceRouteBindings();
    }
}
