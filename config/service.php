<?php

use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();

$di->setShared(
    'config',
    function () use ($config) {
        return $config;
    }
);

$di->setShared('auth_user', null);

