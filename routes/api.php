<?php

use Phalcon\Mvc\Micro\Collection;

/**
 * Insert your Routes below
 */
$index = new Collection();
$index->setHandler(\App\Micro\Controller::class, true);
$index->get('/', 'index');
$app->mount($index);

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $code = 404;

    $response = [
        'success' => false,
        'code' => $code,
        'message' => 'Service not found',
        'data' => [],
    ];

    $json = $app->response
        ->setStatusCode($code, $response['message'])
        ->setJsonContent($response);
    return $json->send();
});

/**
 * Error handler
 */
$app->error(
    function (\Throwable $e) use ($app) {
        $code = 500;

        if ($e instanceof \Error) {
            $message = sprintf('An error has occurred: %s', $e->getMessage());
        } else {
            $message = $e->getMessage();
        }

        $response = [
            'success' => false,
            'code' => $code,
            'message' => $message,
            'data' => [],
        ];

        $json = $app->response
            ->setStatusCode($code, $response['message'])
            ->setJsonContent($response);
        return $json->send();
    }
);
