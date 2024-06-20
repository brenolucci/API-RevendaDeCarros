<?php

define('DS', DIRECTORY_SEPARATOR);

$nomeServidor = "localhost";
$nomeUsuario = "root";
$senha = "";
$nomeBanco = "revendacarros_db";

$conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
if ($conn->connect_error) {
    die("Conexão Falhou: " . $conn->connect_error);
}

// require_once (realpath(dirname(__FILE__) . '/') . DS . 'functions.php')
