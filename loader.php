<?php

use Phalcon\Loader;

$loader = new Loader();
$loader->registerNamespaces([
        'App' => __DIR__ . '/app/',
]);
$loader->register();
