<?php

namespace Authanram\Resources\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Authanram\Resources\Console\Commands\ResourcesInstall;
use Authanram\Resources\Contracts;
use Authanram\Resources\Services;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config.php', 'authanram-resources');

        $this->mergeConfigFrom(__DIR__ . '/../../plugins.php', 'authanram-resources-plugins');

        $this->app->bind(Contracts\ReaderServiceContract::class, Services\ReaderService::class);

        $this->app->bind(Contracts\ResourceServiceContract::class, Services\ResourceService::class);

        $this->app->singleton(Contracts\RouteServiceContract::class, Services\RouteService::class);

        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'authanram-resources');

        if ($this->app->runningInConsole()) {

            $this->commands([

                ResourcesInstall::class,

            ]);

        }

        $this->publishes([

            __DIR__ . '/../../config.php' => config_path('authanram-resources.php'),

        ]);
    }
}
