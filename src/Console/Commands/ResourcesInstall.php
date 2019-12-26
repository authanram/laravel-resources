<?php

namespace Authanram\Resources\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Authanram\Resources\Providers\ServiceProvider;

class ResourcesInstall extends Command
{
    protected $signature = 'authanram:resources:install';

    protected $description = 'Install authanram/laravel-resources.';

    public function handle(): void
    {
        $this->line("\nInstall \"authanram/laravel-Authanram\Resources\"\n");

        $this->publishTheme();

        $this->publishServiceProvider();

        $this->info("\nDone.\n");
    }

    private function publishTheme(): void
    {
        $sourcePath = __DIR__ . '/../../../resources/theme.yaml';

        $destinationPath = resource_path('theme.yaml');

        if (file_exists($destinationPath)) {

            $this->warn('"theme.yaml" has not been published.');

            return;

        }

        File::copy($sourcePath, $destinationPath);
    }

    private function publishServiceProvider(): void
    {
        Artisan::call('vendor:publish', [

            '--provider' => ServiceProvider::class,

        ]);
    }
}
