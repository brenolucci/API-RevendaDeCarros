<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Combustivel;
use \RevendaTeste\ORM\Database;
use \RevendaTeste\Traits\ObjectToArray;

class Combustiveis
{
    use ObjectToArray;

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    /**
     * Retorna os dados de combustivel através do id fornecido
     *
     * @param int $id
     * @return Combustivel
     */
    public function buscaPorId(int $id): Combustivel
    {
        $sql = 'SELECT id, nome FROM combustiveis WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaCombustiveis(
            $result->fetch_assoc()
        );

    }

    /**
     * Retorna os dados de combustível através do nome fornecido.
     *
     * @param string $nome
     * @return Combustivel
     */
    public function buscaPorNome(string $nome): Combustivel
    {
        $sql = 'SELECT id, nome FROM combustiveis WHERE nome = ' . "'{$nome}'" . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaCombustiveis(
            $result->fetch_assoc()
        );

    }

    /**
     * Retorna lista de combustíveis
     *
     * @param boolean $asArray
     * @return array
     */
    public function buscaCombustiveis(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome FROM combustiveis';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $combustiveis[] = ($asArray) ? $this->toArray($this->montaCombustiveis($row)) : $this->montaCombustiveis($row);
        }

        return $combustiveis;
    }

    /**
     * Retorna um objeto contruído do tipo Combustível
     *
     * @param array $dados
     * @return Combustivel
     */
    public function montaCombustiveis(array $dados): Combustivel
    {
        $combustivel = new Combustivel;

        if (!empty($dados['id'])) {
            $combustivel->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $combustivel->setNome($dados['nome']);
        }

        return $combustivel;
    }
}
