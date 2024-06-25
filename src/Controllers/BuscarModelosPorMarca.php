<?php

namespace RevendaTeste\Controllers;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Modelos;

$marca_id = $_GET['marca_id'];

$modelos = (new Modelos)->buscarPorMarca($marca_id, true);

echo json_encode($modelos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
