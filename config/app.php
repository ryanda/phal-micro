<?php

return [
    'application' => [
        'name' => getenv('APP_NAME'),
        'baseUri' => getenv('APP_URL') . '/',
        'cache' => getenv('CACHE_DRIVER') ?? 'file',
    ],
    'cache' => [
        'driver' => getenv('CACHE_DRIVER') ?: 'stream',
        'lifetime' => 1 * 60 * 5, // seconds
        'serializer' => 'Json',
        'redis' => [
            'host' => getenv('REDIS_HOST') ?: '127.0.0.1',
            'port' => getenv('REDIS_PORT') ?: '6379',
            'auth' => getenv('REDIS_PASSWORD') ?: null,
            'prefix' => 'ph-rds-',
        ],
        'stream' => [
            'storageDir' => APP_PATH . '/../storages/caches/',
            'prefix' => 'ph-strm-',
        ],
    ],
    'jwt' => [
        'secret' => getenv('JWT_SECRET') ?: 'defaultjwtsecret',
        'ttl' => 60 * 24 * 30 * 12,
        'refresh_limit' => 7200,
    ],
    'log' => APP_PATH . '/../storages/logs/' . 'applog_' . date('Ymd') . '.log',
];
