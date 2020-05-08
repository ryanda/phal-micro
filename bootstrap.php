<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;

date_default_timezone_set('Asia/Jakarta');

$loader = new Loader();
$loader->registerNamespaces(
    [
        'App' => __DIR__ . '/../app/',
    ]
);
$loader->register();

include __DIR__ . '/service.php';

/*
 * Starting the application
 * Assign service locator to the application
 */
$app = new Micro($di);

return $app;
