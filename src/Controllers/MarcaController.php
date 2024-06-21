<?php

include '../core/Database.php';

use \RevendaTeste\Entity\Marca;

function getMarcas(mysqli $conn): Marca
{
    try {
        $sql = 'SELECT * from marcas';

        $result = $conn->query($sql);
        return $result;

    } catch (\InvalidArgumentException $e) {
        echo 'Erro no seu endpoint';
    }
}