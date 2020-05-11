<?php

try {

    $app = include __DIR__ . '/../bootstrap/app.php';

    /*
     * Handle the request
     */
    $app->handle(
        $_SERVER["REQUEST_URI"]
    );

} catch (\Throwable $e) {
    $code = 500;

    $message = sprintf('An error has occurred: %s', $e->getMessage());

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

    header('Content-Type: application/json');
    echo json_encode($response);
    die();
}
