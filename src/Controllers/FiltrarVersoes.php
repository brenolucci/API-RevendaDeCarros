<?php
namespace RevendaTeste\Controllers;


require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use RevendaTeste\Models\Modelos;
use RevendaTeste\Models\Marcas;
use RevendaTeste\Models\Versoes;
use RevendaTeste\Models\Combustiveis;
use RevendaTeste\Models\Opcionais;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

use InvalidArgumentException;
use \RevendaTeste\Traits\Functions;
use \RevendaTeste\Traits\Validations;

$filtrosPermitidos = ['marca', 'modelo', 'ano', 'preco', 'quilometragem', 'combustivel', 'opcionais', 'versao'];

$filtrosValidos = array_intersect($filtrosPermitidos, array_keys($_GET));
$condicoes = montarCondicoes($filtrosValidos, $_GET);
var_dump($condicoes);

$sqlConditions = (empty($condicoes)) ? '' : 'WHERE ' . implode(' AND ', $condicoes);

var_dump($sqlConditions);

$versao = (new Versoes())->buscaFiltrada($sqlConditions, true);
echo json_encode($versao, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

// if (in_array('marca_id', $condicoes)) {
//     $marca = (new Marcas())->buscaPorNome(trim($dados['marca']));
//     if (!is_null($marca)) {
//         $marcaId = $marca->getId();
//     }
//     $sql = 'SELECT id, marca_id, nome FROM modelos WHERE marca_id = ' . $marcaId;
//     print_r($sql);
// }

// $sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes ' . $sqlConditions;
// $sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes ' . $sqlConditions;



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
    if (in_array('marca', $filtros)) {
        $marca = (new Marcas())->buscaPorNome(trim($dados['marca']));
        if (!is_null($marca)) {
            $condicoes[] = "marca_id = {$marca->getId()}";
        }
    }
    if (in_array('ano', $filtros)) {
        $ano = (new Versoes())->buscaPorAno(trim($dados['ano']));
        if (!is_null($ano)) {
            $condicoes[] = "ano = {$ano->getAno()}";
        }
    }
    if (in_array('preco', $filtros)) {
        $preco = (new Versoes())->buscaPorPreco(trim($dados['preco']));
        if (!is_null($preco)) {
            $condicoes[] = "preco = {$preco->getPreco()}";
        }
    }
    if (in_array('quilometragem', $filtros)) {
        $quilometragem = (new Versoes())->buscaPorKm(trim($dados['quilometragem']));
        if (!is_null($quilometragem)) {
            $condicoes[] = "quilometragem = {$quilometragem->getQuilometragem()}";
        }
    }
    if (in_array('combustivel', $filtros)) {
        $combustivel = (new Combustiveis())->buscaPorNome(explode(',', $dados['combustivel']));
        if (!is_null($combustivel)) {
            $condicoes[] = "combustivel_id = {$combustivel->getId()}";
        }
    }
    if (in_array('opcionais', $filtros)) {
        foreach (explode(',', $dados['opcionais']) as $opcional) {
            # code...
            $opcionais = (new Opcionais())->buscaPorId($opcional);
            if (!is_null($opcionais)) {
                $condicoes[] = "INNER JOIN opcionais_versoes ON id = Versao_id INNER JOIN opcionais ON opcional_versao = {$opcionais->getId()}";
            }
        }
    }

    return $condicoes;
}
