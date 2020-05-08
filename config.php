<?php

use Phalcon\Config;

date_default_timezone_set('Asia/Jakarta');
define('APP_PATH', realpath('.'));
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'development');

$config = new Config([
    'application' => [
        'name' => getenv('APP_NAME'),
        'baseUri' => getenv('APP_URL') . '/',
    ],
]);

return $config;
