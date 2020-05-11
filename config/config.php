<?php

use Phalcon\Config;

date_default_timezone_set('Asia/Jakarta');
define('APP_PATH', realpath('.'));
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'development');

if (APPLICATION_ENV === 'development') {
    function exception_error_handler($severity, $message, $file, $line)
    {
        if (!(error_reporting() & $severity)) {
            // This error code is not included in error_reporting
            return;
        }
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    set_error_handler("exception_error_handler");

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}

$config = new Config();

$configOverride = new Config(include_once __DIR__ . '/app.php');
$config = $config->merge($configOverride);

$configOverride = new Config(['database' => include_once __DIR__ . '/database.php']);
$config = $config->merge($configOverride);

return $config;
