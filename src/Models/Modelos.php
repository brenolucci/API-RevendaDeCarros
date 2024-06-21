<?php

namespace RevendaTeste\Models;

use \RevendaTeste\ORM\Database;
use RevendaTeste\Entity\Modelo;
use RevendaTeste\Entity\Marca;
use RevendaTeste\Models\Marcas;

class Modelos
{

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscarModelos(): array
    {
        $sql = 'SELECT id, nome, marca_id FROM modelos';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $modelos[] = $this->montaModelos($row);
        }
        return $modelos;
    }

    public function montaModelos(array $dados): Modelo
    {
        $modelo = new Modelo();
        $marca = new Marca();
        $propsMarca = get_class_vars(get_class($marca));

        if (!empty($dados['id'])) {
            $modelo->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $modelo->setNome($dados['nome']);
        }
        if (!empty($dados['marca_id'])) {
            $marca = new Marcas();
            $modelo->setMarca($marca->buscarPorId($dados['marca_id']));
        }

        return $modelo;
    }
}
