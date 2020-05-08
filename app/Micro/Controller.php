<?php

namespace App\Micro;

use Phalcon\Mvc\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $name = 'Hello world';
        $response = sprintf('%s at %s', $name, date('Y-m-d H:i:s'));

        echo json_encode($response);
    }
}
