<?php

namespace App\Micro;

use Phalcon\Mvc\Controller as BaseController;

class Controller extends BaseController
{
    const SUCCESS_TRUE = true;
    const SUCCESS_FALSE = false;

    public function index()
    {
        $name = 'Hello world';
        $response = sprintf('%s at %s', $name, date('Y-m-d H:i:s'));

        $this->buildResponse($response, Controller::SUCCESS_TRUE);
    }

    public function buildResponse($data = [], $success = false, $code = 400)
    {
        $response = [
            'success' => $success,
            'code' => $code,
            'message' => "",
            'data' => $data,
        ];

        if ($success) {
            $response['code'] = 200;
            $response['data'] = $data;
        } else {
            $response['message'] = $data;
        }

        $json = $this->response
            ->setStatusCode($code, $response['message'])
            ->setJsonContent($response);
        return $json->send();
    }
}
