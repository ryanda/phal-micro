<?php

use Phalcon\Loader;
use Illuminate\Database\Capsule\Manager as Capsule;

$loader = new Loader();
$loader->register();

$capsule = new Capsule;

$dbConfig = $config->database->toArray();
$capsule->addConnection($dbConfig);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();
