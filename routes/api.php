<?php

use Phalcon\Mvc\Micro\Collection;

/**
 * Insert your Routes below
 */
$index = new Collection();
$index->setHandler(\App\Micro\Controller::class, true);
$index->get('/', 'index');
$app->mount($index);
