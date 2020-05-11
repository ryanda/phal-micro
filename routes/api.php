<?php

use Phalcon\Mvc\Micro\Collection;
use App\Middlewares\Authentication;

//Allowed token
const GUEST_ROUTE = [
    '/',
    '/auth',
];
$app->before(new Authentication(GUEST_ROUTE));

/**
 * Insert your Routes below
 */
$index = new Collection();
$index->setHandler(\App\Micro\HomeEndpoint::class, true);
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

    if (APPLICATION_ENV === 'development') {
        $response['payload'] = [
            'uri' => $app['request']->getURI(),
            'query_param' => $_GET,
            'form_data' => $_POST,
        ];
    }

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

        if (APPLICATION_ENV === 'development') {
            $response['payload'] = [
                'file' => basename($e->getFile()),
                'path' => $e->getFile(),
                'line' => $e->getLine(),
                'query_param' => $_GET,
                'form_data' => $_POST,
                // 'trace' => $e->getTrace(),
            ];
        }

        $json = $app->response
            ->setStatusCode($code, $response['message'])
            ->setJsonContent($response);
        return $json->send();
    }
);
