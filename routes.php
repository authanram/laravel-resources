<?php

use Resources\Contracts\ReaderServiceContract;
use Resources\Http\Controllers\ResourceController;
use Resources\Http\Controllers\ResourcesController;

Route::middleware([

    'web',

    //'auth',

    //'route_permission:backend.resource'

])->group(static function () {

    $prefixes = config('resources.routes.prefixes');

    $uriPrefix = implode('/', $prefixes);

    $namePrefix = implode('.', $prefixes);

    Route::get($uriPrefix, ResourcesController::class . '@index')

        ->name($namePrefix);

    $resourceNames = app()->make(ReaderServiceContract::class)::getResourceNames();

    foreach ($resourceNames as $resource) {

        Route::resource(

            $uriPrefix . '/' . Str::plural($resource),

            ResourceController::class,

            ['as' => $namePrefix]

        );

    }

});
