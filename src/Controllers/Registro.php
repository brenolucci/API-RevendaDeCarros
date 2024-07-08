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
    $token = new MyJWT();

    $emailExiste = $users->buscaPorEmail($data['email']);
    if ($emailExiste === true) {
        throw new \InvalidArgumentException('Email já cadastrado!', 400);
    }
    $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);

    $registro = $users->registrar($data);


    $statusCode = 200;
    $result = [
        'message' => 'Usuário cadastrado com sucesso!',
        'data' => $users->toArray($registro)
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