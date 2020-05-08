<?php

header('Content-Type: application/json');

try {

    $app = include __DIR__ . '/bootstrap.php';

    $app->get(
        '/',
        function () {
            echo "Hello world!";
        }
    );

    /*
     * Handle the request
     */
    $app->handle(
        $_SERVER["REQUEST_URI"]
    );

} catch (\Throwable $e) {
    echo json_encode($e->getMessage());
}
