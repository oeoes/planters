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

        'foreman1' => [
            'driver' => 'jwt',
            'provider' => 'foremans1',
            'hash' => false,
        ],

        'foreman2' => [
            'driver' => 'jwt',
            'provider' => 'foremans2',
            'hash' => false,
        ],

    ],


    'providers' => [
        'assistants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Assistant::class,
        ],

        'foremans1' => [
            'driver' => 'eloquent',
            'model' => App\Models\Foreman1::class,
        ],

        'foremans1' => [
            'driver' => 'eloquent',
            'model' => App\Models\Foreman2::class,
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
