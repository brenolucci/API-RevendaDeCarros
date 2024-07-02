<?php
namespace RevendaTeste\Controllers;

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use RevendaTeste\Models\Modelos;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

use InvalidArgumentException;
use \RevendaTeste\Traits\Functions;
use \RevendaTeste\Traits\Validations;

$filtrosPermitidos = ['modelo', 'combustivel', 'opcionais', 'versao',];

$filtrosValidos = array_intersect($filtrosPermitidos, array_keys($_GET));
$condicoes = montarCondicoes($filtrosValidos, $_GET);
print_r($condicoes);
$sqlConditions = (empty($condicoes)) ? '' : 'WHERE ' . implode(' AND ', $condicoes);

$sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes ' . $sqlConditions;

print_r($sql);
die;

/**
 * Monta as condições de pesquisa
 *
 * @param array $filtros
 * @param array $dados
 * @return array
 */
function montarCondicoes(array $filtros, array $dados): array
{
    $condicoes = [];
    if (in_array('modelo', $filtros)) {
        $modelo = (new Modelos())->buscaPorNome(trim($dados['modelo']));
        if (!is_null($modelo)) {
            $condicoes[] = "modelo_id = {$modelo->getId()}";
        }
    }

    return $condicoes;
}


var_dump($data);
die;
