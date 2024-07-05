<?php

namespace RevendaTeste\Controllers;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Users;
use RevendaTeste\Traits\ObjectToArray;


try {
    $data = json_decode(file_get_contents('php://input'), true);

    $users = new Users();
    $user = $users->login($data);

    $generatesToken = 'dsadgadasdgfas';

    if ($generatesToken) {
        $user->setToken($generatesToken);
    }

    $statusCode = 200;
    $result = [
        'message' => 'Login bem sucedido!',
        'data' => $users->toArray($user)
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