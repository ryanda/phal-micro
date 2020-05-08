<?php

use Phalcon\Mvc\Micro;

/**
 * Include Autoloader.
 */
include __DIR__ . '/../config/loader.php';

include __DIR__ . '/service.php';

/*
 * Starting the application
 * Assign service locator to the application
 */
$app = new Micro($di);

return $app;
