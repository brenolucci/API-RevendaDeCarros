<?php

namespace RevendaTeste\Controllers;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Versoes;

try {

    $data = json_decode(file_get_contents('php://input'), true);

    $versoes = new Versoes();
    $versao = $versoes->cadastraVersao($data);

    $statusCode = 201;
    $result = [
        'message' => 'Dados Cadastrados com sucesso!',
        'data' => $versoes->toArray($versao),
    ];

} catch (\Exception $e) {
    $statusCode = $e->getCode();
    $result = [
        'error' => true,
        'message' => $e->getMessage(),
    ];
}

http_response_code($statusCode);
echo json_encode($result);
