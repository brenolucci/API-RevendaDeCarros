<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Opcional;
use \RevendaTeste\ORM\Database;
use \RevendaTeste\Traits\ObjectToArray;

class Opcionais
{
    use ObjectToArray;

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

    public function buscaOpcionais(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome FROM opcionais';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $opcionais[] = ($asArray) ? $this->toArray($this->montaOpcionais($row)) : $this->montaOpcionais($row);
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
            $opcional->setNome($dados['nome']);
        }

        return $opcional;
    }
}
