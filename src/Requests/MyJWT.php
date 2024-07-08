<?php

namespace RevendaTeste\Requests;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class MyJWT
{
    /**
     * Chave de codificação e decodificação
     *
     * @var string
     */
    private string $key = 'CodeFuse';

    /**
     * Parametros a serem transformados em token
     *
     * @var array
     */
    private array $payload;

    /**
     * Codifica o payload e retorna um token JWT
     *
     * @param array $payload
     * @return string
     */
    public function encodeJWT(array $payload): string
    {
        $token = JWT::encode($payload, $this->key, 'HS256');
        return $token;

    }

    /**
     * Decodifica o Token JWT e retorna o objeto decodificado
     *
     * @param string $token
     * @return void
     */
    public function decodeJWT(string $token)
    {
        $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
        return;
    }
}
