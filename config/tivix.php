<?php

return [
    'auth' => [
        'token' => [
            'device_name' => env('TOKEN_DEVICE_NAME'),
        ]
    ],
    'integrations' => [
        'omdb' => [
            'base_url' => env('OMDB_API_BASE_URL'),
            'api_key' => env('OMDB_API_KEY'),
        ],
    ],
];
