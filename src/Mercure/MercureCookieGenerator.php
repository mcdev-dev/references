<?php

namespace App\Mercure;

use App\Entity\User;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class MercureCookieGenerator 
{
    private $secret;

    public function __construct(string $secret) 
    {
        $this->secret = $secret;
    }

    public function generate(User $user) 
    {
        $token = (new Builder())
        // set other appropriate JWT claims, such as an expiration date
        ->set('mercure', ['subscribe' => ["http://lescityzens.net/user/{$user->getId()}"]]) // could also include the security roles, or anything else
        ->sign(new Sha256(), $this->secret) // don't forget to set this parameter! Test value: aVerySecretKey
        ->getToken();
    
        return "mercureAuthorization={$token}; path=/.well-known/mercure; secure; httponly";
    }
}