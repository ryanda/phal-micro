<?php

namespace App\Micro;

use App\Services\Auth;

class HomeEndpoint extends Controller
{
    public function index()
    {
        if (! $this->cacheHas('appname'))
            $this->cacheSet('appname', $this->config->application->name);
        $name = $this->cacheGet('appname');

        $response = sprintf('%s at %s', $name, date('Y-m-d H:i:s'));

        $this->logger->info('Hit at '.date('Y-m-d H:i:s'));

        $this->buildResponse($response, Controller::SUCCESS_TRUE);
    }

    public function user()
    {
        if (! $this->cacheHas('user'))
            $this->cacheSet('user', Auth::getUser());
        $response = $this->cacheGet('user');

        $this->buildResponse($response, Controller::SUCCESS_TRUE);
    }
}
