<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Combustivel;
use \RevendaTeste\ORM\Database;

class Combustiveis
{

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaPorId($id)
    {
        $sql = 'SELECT id, nome FROM combustiveis WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaCombustiveis(
            $result->fetch_assoc()
        );

    }

    public function buscaCombustiveis(): array
    {
        $sql = 'SELECT id, nome FROM combustiveis';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $combustiveis[] = $this->montaCombustiveis($row);
        }

        return $combustiveis;
    }

    public function montaCombustiveis(array $dados): Combustivel
    {
        $combustivel = new Combustivel;

        if (!empty($dados['id'])) {
            $combustivel->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $combustivel->setNome((int) $dados['nome']);
        }

        return $combustivel;
    }
}
