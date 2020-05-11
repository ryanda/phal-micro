<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Cache\CacheFactory;
use Phalcon\Cache\AdapterFactory;
use Phalcon\Storage\SerializerFactory;
use Rakit\Validation\Validator;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

$di = new FactoryDefault();

$di->setShared(
    'config',
    function () use ($config) {
        return $config;
    }
);

$di->setShared('auth_user', null);

$di->setShared(
    'cache',
    function () use ($config) {
        $cacheConfig = $config->cache->toArray();

        $options = [
            'defaultSerializer' => $cacheConfig['serializer'],
            'lifetime' => $cacheConfig['lifetime'],
        ];

        $serializerFactory = new SerializerFactory();
        $adapterFactory    = new AdapterFactory(
            $serializerFactory,
            $options
        );

        $cacheFactory = new CacheFactory($adapterFactory);


        if ($cacheConfig['driver'] == 'redis') {
            $cacheOptions = [
                'adapter' => 'redis',
                'options' => $cacheConfig['redis'],
            ];
        } else {
            $cacheOptions = [
                'adapter' => 'stream',
                'options' => $cacheConfig['stream'],
            ];
        }

        $cache = $cacheFactory->load($cacheOptions);

        return $cache;
    }
);

$di->setShared(
    'validation',
    function () {
        return new Validator;
    }
);

$di->setShared(
    'logger',
    function () use ($config) {
        $logConfig = $config->log;

        if(!file_exists($logConfig))
            touch($logConfig);

        $adapter = new Stream($logConfig);
        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        return $logger;
    }
);
