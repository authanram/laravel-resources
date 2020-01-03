<?php

return [

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

    'theme' => __DIR__ . '/resources/theme.yaml',

];
