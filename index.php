<?php

header('Content-Type: application/json');

try {

    $app = include __DIR__ . '/bootstrap.php';

    /**
     * Include Application.
     */
    include __DIR__ . '/routes/api.php';

    /*
     * Handle the request
     */
    $app->handle(
        $_SERVER["REQUEST_URI"]
    );

} catch (\Throwable $e) {
    echo json_encode($e->getMessage());
}
