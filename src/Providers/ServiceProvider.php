<?php

namespace Resources\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Illuminate\Support\Str;
use Resources\Contracts;
use Resources\Services;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config.php', 'resources');

        $this->mergeConfigFrom(__DIR__ . '/../../plugins.php', 'resources::plugins');

        //

        $this->app->bind(Contracts\ReaderServiceContract::class, Services\ReaderService::class);

        $this->app->bind(Contracts\ResourceServiceContract::class, Services\ResourceService::class);

        //

        $this->app->singleton(Contracts\RouteServiceContract::class, Services\RouteService::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'resources');
    }
}
