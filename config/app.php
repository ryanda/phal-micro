<?php

return [
    'application' => [
        'name' => getenv('APP_NAME'),
        'baseUri' => getenv('APP_URL') . '/',
        'cache' => getenv('CACHE_DRIVER') ?? 'file',
    ],
];
