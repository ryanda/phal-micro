<?php

namespace App\Services;

class Common {
    public static function hashMake($value)
    {
        $hash = password_hash($value, PASSWORD_BCRYPT, [ 'cost' => 10 ]);

        if ($hash === false)
            throw new \RuntimeException('Bcrypt hashing not supported.');

        return $hash;
    }

    public static function hashCheck($value, $hashedValue)
    {
        if (password_get_info($hashedValue)['algoName'] !== 'bcrypt')
            throw new \RuntimeException('This password does not use the Bcrypt algorithm.');

        if (strlen($hashedValue) === 0)
            return false;

        return password_verify($value, $hashedValue);
    }
}