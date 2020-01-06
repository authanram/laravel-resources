<?php

return [

    'config_path' => 'authanram-resources.resources',

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
