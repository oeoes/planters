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

        'assistant' => [
            'driver' => 'session',
            'provider' => 'assistants',
        ],

        'foreman' => [
            'driver' => 'jwt',
            'provider' => 'foremans',
            'hash' => false,
        ],

        'subforeman' => [
            'driver' => 'jwt',
            'provider' => 'subforemans',
            'hash' => false,
        ],

    ],


    'providers' => [
        'assistants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Assistant::class,
        ],

        'foremans' => [
            'driver' => 'eloquent',
            'model' => App\Models\Foreman::class,
        ],

        'subforemans' => [
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
