<?php

require __DIR__ . '/../vendor/autoload.php';

use Phalcon\Mvc\Micro;

/*
 * Load .env file
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

/*
 * Read the configuration
 */
$config = include __DIR__ . '/config/config.php';

/**
 * Include Autoloader.
 */
include __DIR__ . '/config/loader.php';

include __DIR__ . '/config/service.php';

/*
 * Starting the application
 * Assign service locator to the application
 */
$app = new Micro($di);

/**
 * Include Application.
 */
include __DIR__ . '/../routes/api.php';

return $app;
