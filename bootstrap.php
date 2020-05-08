<?php

use Phalcon\Mvc\Micro;

/*
 * Read the configuration
 */
$config = include __DIR__ . '/config.php';

/**
 * Include Autoloader.
 */
include __DIR__ . '/loader.php';

include __DIR__ . '/service.php';

/*
 * Starting the application
 * Assign service locator to the application
 */
$app = new Micro($di);

return $app;
