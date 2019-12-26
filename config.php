<?php

use Resources\Theme;

return [

    'acl' => [
        'can_bypass' => [
            'administrator',
        ],
        'roles' => [
            'administrator',
            'moderator',
            'user',
        ],
    ],

    'cache' => [
        'enabled' => env('RESOURCES_CACHE_ENABLED', true),
        'key' => env('RESOURCES_CACHE_KEY', 'resources'),
    ],

    'format_timestamp' => 'd.m.Y, H:i',

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

    'theme' => Theme::get(resource_path('theme.yaml')),

    'views' => [
        'extends' => 'welcome',
        'sections' => [
            'breadcrumbs' => 'breadcrumbs',
            'content' => 'content',
        ],
    ],

];
