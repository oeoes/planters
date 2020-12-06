<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'assistants',
        ],

        'superadmin' => [
            'driver' => 'session',
            'provider' => 'superadmin',
        ],

        'farmmanager' => [
            'driver' => 'session',
            'provider' => 'farmmanager',
        ],

        'assistant' => [
            'driver' => 'session',
            'provider' => 'assistants',
        ],

        'foreman' => [
            'driver' => 'jwt',
            'provider' => 'foreman',
            'hash' => false,
        ],

        'subforeman' => [
            'driver' => 'jwt',
            'provider' => 'subforeman',
            'hash' => false,
        ],

    ],


    'providers' => [

        'superadmin' => [
            'driver' => 'eloquent',
            'model' => App\Models\SuperAdmin::class,
        ],

        'farmmanager' => [
            'driver' => 'eloquent',
            'model' => App\Models\FarmManager::class,
        ],

        'assistants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Assistant::class,
        ],

        'foreman' => [
            'driver' => 'eloquent',
            'model' => App\Models\Foreman::class,
        ],

        'subforeman' => [
            'driver' => 'eloquent',
            'model' => App\Models\Subforeman::class,
        ]

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],


    'passwords' => [
        'assistants' => [
            'provider' => 'assistants',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],


    'password_timeout' => 10800,

];
