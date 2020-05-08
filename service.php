<?php

use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();

$di->setShared(
    'config',
    function () use ($config) {
        return $config;
    }
);
