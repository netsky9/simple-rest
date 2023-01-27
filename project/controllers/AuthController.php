<?php

namespace app\controllers;

use DateTimeImmutable;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Configuration;

class AuthController extends AbstractController
{
    public function login()
    {
        //todo Тут логика авторизации пользователя

        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('secret_key')
        );

        $now = new DateTimeImmutable();
        $token = $config->builder()
            ->issuedBy('http://rest-api.test')
            ->permittedFor('http://rest-api.test')
            ->identifiedBy('4f1g23a12aa')
            ->issuedAt($now)
            ->expiresAt($now->modify('+50 minutes'))
            ->withClaim('uid', 1)
            ->getToken($config->signer(), $config->signingKey());

        return $this->response->json([
            'accessToken' => $token->toString()
        ]);
    }
}