<?php

namespace Resources\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ResourcesInstall extends Command
{
    protected $signature = 'authanram:resources:install';

    protected $description = 'Install.';

    public function handle(): void
    {
        $this->publishTheme();

        $this->publishServiceProvider();

        $this->info("\nDone.\n");
    }

    private function publishTheme(): void
    {
        $sourcePath = __DIR__ . '/../../../resources/theme.yaml';

        $destinationPath = resource_path('theme.yaml');

        if (file_exists($destinationPath)) {

            $this->warn("\n$sourcePath has not been published.\n");

            return;

        }

        File::copy($sourcePath, $destinationPath);
    }

    private function publishServiceProvider(): void
    {
        Artisan::call('vendor:publish', [

            '--provider' => 'Resources\\Providers\\ServiceProvider',

        ]);
    }
}
