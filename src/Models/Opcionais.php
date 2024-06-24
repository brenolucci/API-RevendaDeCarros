<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Opcional;
use \RevendaTeste\ORM\Database;

class Opcionais
{

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaPorId($id)
    {
        $sql = 'SELECT id, nome FROM opcionais WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaOpcionais(
            $result->fetch_assoc()
        );

    }

    public function buscaOpcionais(): array
    {
        $sql = 'SELECT id, nome FROM opcionais';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $opcionais[] = $this->montaOpcionais($row);
        }

        return $opcionais;
    }

    public function montaOpcionais(array $dados): Opcional
    {
        $opcional = new Opcional;

        if (!empty($dados['id'])) {
            $opcional->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $opcional->setNome((int) $dados['nome']);
        }

        return $opcional;
    }
}
