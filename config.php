<?php

return [

    'config_path' => 'authanram-resources.resources',

    'development' => [
        'dump' => [
            'parameter' => 'dump',
            'section' => 'dump',
        ]
    ],

    'fields' => [
        'bigint' => 'text',
        'boolean' => 'boolean',
        'datetime' => 'timestamp',
        'integer' => 'text',
        'json' => 'json',
        'smallint' => 'text',
        'string' => 'text',
        'text' => 'text',
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
