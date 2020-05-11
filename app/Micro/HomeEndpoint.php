<?php

namespace App\Micro;

class HomeEndpoint extends Controller
{
    public function index()
    {
        if (! $this->cacheHas('appname'))
            $this->cacheSet('appname', $this->config->application->name);
        $name = $this->cacheGet('appname');

        $response = sprintf('%s at %s', $name, date('Y-m-d H:i:s'));

        $this->buildResponse($response, Controller::SUCCESS_TRUE);
    }
}
