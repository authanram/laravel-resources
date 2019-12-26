<?php

namespace Resources\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ResourcesInstall extends Command
{
    protected $signature = 'authanram:resources:install';

    protected $description = 'Install the package.';

    public function handle(): void
    {
        File::copy(__DIR__ . '/../../../resources/theme.yaml', resource_path('theme.yaml'));

        Artisan::call('vendor:publish', [

            '--provider' => 'Resources\\Providers\\ServiceProvider',

        ]);

        $this->info("\nDone.\n");
    }
}
