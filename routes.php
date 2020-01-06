<?php

use Authanram\Resources\Contracts\ResourceServiceContract;
use Authanram\Resources\Http\Controllers\ResourceController;
use Authanram\Resources\Http\Controllers\ResourcesController;

Route::middleware([

    'web',

    //'auth',

    //'route_permission:backend.resource'

])->group(static function () {

    $resourceService = app()->make(ResourceServiceContract::class);

    $prefixes = config('authanram-resources.routes.prefixes');

    $uriPrefix = implode('/', $prefixes);

    $namePrefix = implode('.', $prefixes);

    Route::get($uriPrefix, ResourcesController::class . '@index')

        ->name($namePrefix);

    $resourceNames = array_keys($resourceService::getResources());

    foreach ($resourceNames as $resource) {

        Route::resource(

            $uriPrefix . '/' . Str::plural($resource),

            ResourceController::class,

            ['as' => $namePrefix]

        );

    }

});
