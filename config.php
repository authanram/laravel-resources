<?php

return [

    'cache' => [
        'enabled' => env('RESOURCES_CACHE_ENABLED', true),
        'key' => env('RESOURCES_CACHE_KEY', 'authanram-resources'),
    ],

//    'callbacks' => [
//        'breadcrumbs' => static function (string $text, string $url, string $target = null) {
//            app()->make(\App\Contracts\BreadcrumbsService::class)->addBreadcrumb($text, $url, $target);
//        },
//        'can' => static function (string $permission) {
//            return can('backend.resource.' . $permission);
//        },
//    ],

    'development' => [
        'dump' => [
            'parameter' => 'dump',
            'section' => 'dump',
        ]
    ],

    'format_timestamp' => 'd.m.Y, H:i',

    'icon' => [
        'parameter' => 'icon',
        'view' => 'components.icon',
    ],

    'namespaces' => [
        'models' => 'App',
    ],

    'path' => resource_path('resources'),

    'routes' => [
        'bindings' => [
            'models' => [
                'ignored' => [
                    App\Model::class,
                ],
            ],
        ],
        'prefixes' => [
            'backend',
            'resources',
        ],
    ],

];
