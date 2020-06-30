<?php

namespace App\Micro;

use Phalcon\Mvc\Controller as BaseController;

class Controller extends BaseController
{
    const SUCCESS_TRUE = true;
    const SUCCESS_FALSE = false;

    protected function cacheHas($key)
    {
        return $this->cache->has($key);
    }

    protected function cacheGet($key, $default = null)
    {
        return $this->cache->get($key, $default);
    }

    protected function cacheSet($key, $data)
    {
        return $this->cache->set($key, $data);
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
            ->setStatusCode((int) $response['code'], $response['message'])
            ->setJsonContent($response);
        return $json->send();
    }
}
