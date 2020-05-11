<?php

return [
    'driver' => getenv('DB_CONNECTION') ?: 'mysql',
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'username' => getenv('DB_USERNAME') ?: 'user',
    'password' => getenv('DB_PASSWORD') ?: '123123',
    'database' => getenv('DB_DATABASE') ?: 'db',
    'port' => getenv('DB_PORT') ?: 3306,
    'charset' => 'utf8mb4',
];
