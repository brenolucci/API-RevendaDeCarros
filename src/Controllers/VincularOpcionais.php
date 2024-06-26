<?php

namespace RevendaTeste\Controllers;

use RevendaTeste\Entity\Versao;
use RevendaTeste\Models\Opcionais;
use RevendaTeste\Models\OpcionaisVersoes;
use RevendaTeste\Requests\VersaoOpcionaisRequest;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Versoes;

try {

    $data = json_decode(file_get_contents('php://input'), true);

    $validatedData = (new VersaoOpcionaisRequest($data));

    $opcionais = new OpcionaisVersoes();
    $versaoOpcional = $opcionais->cadastraOpcionalVersao($validatedData);

    // Converter os objetos internos da collection para array
    foreach ($versaoOpcional as $umOpcional => $opcional) {
        $versaoOpcional[$umOpcional] = $opcionais->toArray($opcional);
    }

    $statusCode = 201;
    $result = [
        'message' => 'Dados Cadastrados com sucesso!',
        'data' => $versaoOpcional,
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