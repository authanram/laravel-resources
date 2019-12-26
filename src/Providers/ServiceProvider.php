<?php

namespace Resources\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Resources\Console\Commands\ResourcesInstall;
use Resources\Contracts;
use Resources\Services;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $path = config_path('authanram-resources.php');

        if (file_exists($path)) {

            $this->mergeConfigFrom(config_path('authanram-resources.php'), 'resources');

            $this->mergeConfigFrom(__DIR__ . '/../../plugins.php', 'resources::plugins');

            //

            $this->app->bind(Contracts\ReaderServiceContract::class, Services\ReaderService::class);

            $this->app->bind(Contracts\ResourceServiceContract::class, Services\ResourceService::class);

            //

            $this->app->singleton(Contracts\RouteServiceContract::class, Services\RouteService::class);

        }
    }

    public function boot(): void
    {
        if (config('resources')) {

            $this->loadRoutesFrom(__DIR__.'/../../routes.php');

            $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'resources');

        }

        if ($this->app->runningInConsole()) {

            $this->commands([

                ResourcesInstall::class,

            ]);

        }

        $this->publishes([

            __DIR__ . '/../../config.php' => config_path('authanram-resources.php'),

            __DIR__ . '/../../resources/theme.yaml' => resource_path('theme.yaml'),

        ]);
    }
}
