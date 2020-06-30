<?php

namespace App\Middlewares;

use App\Exceptions\JwtHeaderInvalidException;
use App\Services\Auth;
use Exception;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class Authentication implements MiddlewareInterface
{
    const PREFIX_API = '/api';

    // ignored urls
    protected $ignoreUri = [];

    public function __construct(array $ignore_url = [])
    {
        // Set guest endpoint
        if(count($ignore_url)) {
            $this->ignoreUri = $ignore_url;
        }
    }

    public function call(Micro $app)
    {
        $currentEndpoint = $app['request']->getURI(true);
        if (self::PREFIX_API)
            $currentEndpoint = str_replace(self::PREFIX_API, '', $currentEndpoint);

        // Bypass on guest endpoint
        if (in_array($currentEndpoint, $this->ignoreUri))
            return true;

        // Verifies Token exists and is not empty
        $token = $app['request']->getHeader('Authorization');
        if (empty($token) || $token == '') {
            $msg = 'EMPTY_TOKEN_OR_NOT_RECEIVED';
            throw new JwtHeaderInvalidException($msg);
            return false;
        }

        // Parse token
        $token = explode('Bearer ', $token);
        if (count($token) < 2) {
            $msg = 'TOKEN_INVALID';
            throw new JwtHeaderInvalidException($msg);
            return false;
        }

        // Real one
        $token = $token[1];

        // Verifies Token
        try {
            Auth::validateToken($token);
        } catch (Exception $e) {
            $msg = 'BAD_TOKEN_GET_A_NEW_ONE';
            throw new JwtHeaderInvalidException($msg);
            return false;
        }

        // Save user
        Auth::setUser($token);

        return true;
    }
}
