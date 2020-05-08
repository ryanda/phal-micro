<?php

use Phalcon\Config;

date_default_timezone_set('Asia/Jakarta');
define('APP_PATH', realpath('.'));
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'development');

$config = new Config();

$configOverride = new Config(include_once __DIR__ . '/app.php');
$config = $config->merge($configOverride);

return $config;
