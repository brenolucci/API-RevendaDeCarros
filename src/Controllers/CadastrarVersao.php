<?php

namespace RevendaTeste\Controllers;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Versoes;

$data = json_decode(file_get_contents('php://input'), true);

if ($versoes = (new Versoes)->cadastraVersao($data))
    return true;

// echo json_encode($versoes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
