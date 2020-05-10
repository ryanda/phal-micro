<?php

namespace App\Services;

use App\Exceptions\JwtHeaderInvalidException;
use Illuminate\Database\Eloquent\Model;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\ValidationData as JwtValidation;
use Phalcon\Di;
use Phalcon\Helper\Str;

class Auth
{
    public static function issueToken($userID)
    {
        $app = self::getDI();
        $config = $app['config']->jwt->toArray();

        $time = time();

        $token = (new Builder())
            ->issuedBy($_SERVER['HTTP_HOST'])// Configures the issuer (iss claim)
            ->identifiedBy(Str::random(Str::RANDOM_ALPHA, 16), true)// Configures the id (jti claim), replicating as a header item
            ->issuedAt($time)// Configures the time that the token was issue (iat claim)
            ->canOnlyBeUsedAfter($time)// Configures the time that the token can be used (nbf claim)
            ->expiresAt($time + $config['ttl'])// Configures the expiration time of the token (exp claim)
            ->withClaim('sub', $userID)// Configures a new claim, called "sub"
            ->withClaim('rli', $time + $config['refresh_limit'])// Configures a new claim, informs the limit time for the token to be renewed. the refresh limit is based on ttl + limit (grace period)
            ->getToken(new Sha256(), new Key($config['secret'])); // Retrieves the generated token

        return (string)$token;
    }

    public static function parseToken($token)
    {
        $token = self::parse($token);
        return $token->getClaims(); // Retrieves the token claims
    }

    public static function setUser($token)
    {
        $token = self::parse($token);
        $id = $token->getClaim('sub') ?? null; // get user id

        $user = $id;
        if (is_null($user))
            throw new JwtHeaderInvalidException('User not found!');

        $app = self::getDI();
        $app->setShared('auth_user', $user);
    }

    public static function getUser()
    {
        $app = self::getDI();
        $user = $app->getService('auth_user')->getDefinition();

        return $user;
    }

    public static function validateToken($token)
    {
        $token = self::parse($token);

        $data = new JwtValidation(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer($_SERVER['HTTP_HOST']);

        if (!$token->validate($data))
            throw new JwtHeaderInvalidException('Invalid JWT');
    }

    private static function getDI()
    {
        return Di::getDefault();
    }

    // Parses from a string
    private static function parse($token)
    {
        return (new Parser())->parse((string)$token);
    }
}
