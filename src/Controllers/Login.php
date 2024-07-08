<?php

namespace RevendaTeste\Controllers;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Users;
use RevendaTeste\Requests\MyJWT;


try {
    $data = json_decode(file_get_contents('php://input'), true);

    $users = new Users();
    $validaEmail = $users->buscaPorEmail($data['email']);
    if ($validaEmail === false) {
        throw new \InvalidArgumentException('Email não cadastrado!', 400);
    }
    $user = $users->buscaLogin($data['email']);
    $userArray = $users->toArray($user);

    $validaSenha = password_verify($data['senha'], $userArray['senha']);
    if ($validaSenha !== true) {
        throw new \InvalidArgumentException('Senha incorreta!', 400);
    }

    $jwt = new MyJWT;
    $token = $jwt->encodeJWT($userArray);

    if ($token) {
        $user->setToken($token);
    }

    $statusCode = 200;
    $result = [
        'message' => 'Login bem sucedido!',
        'accessToken' => $token
    ];

} catch (\Exception $e) {
    $statusCode = $e->getCode();
    $result = [
        'error' => true,
        'message' => $e->getMessage(),
    ];
}

http_response_code($statusCode);
echo json_encode($result, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
