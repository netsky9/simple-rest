<?php

namespace app\middlewares;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Authenticate implements IMiddleware
{
    /**
     * @param Request $request
     * @throws \Exception
     */
    public function handle(Request $request): void
    {
        $headers = getallheaders();
        $tokenString = substr($headers['Authorization'] ?? '', 7);

        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('secret_key')
        );

        $token = $config->parser()->parse($tokenString);

        if (!$config->validator()->validate(
            $token,
            new SignedWith(
                new Sha256(),
                InMemory::plainText('secret_key')
            ),
            new ValidAt(new FrozenClock(new DateTimeImmutable()))
            )
        ) {
            throw new \Exception('Access token not valid or expired');
        }

        $userId = $token->claims()->get('uid');
        $request->uid = $userId;
    }
}
