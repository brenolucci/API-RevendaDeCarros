<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Marca;
use RevendaTeste\ORM\Database;
use RevendaTeste\Traits\ObjectToArray;

class Marcas
{
    use ObjectToArray;
    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function save(Marca $marca): Marca
    {
        // SQL To insert data

        return $marca;
    }

    /**
     * Retorna a marca através do id inserido
     *
     * @param integer $id
     * @return Marca
     */
    public function buscarPorId(int $id): Marca
    {
        $sql = 'SELECT id, nome, logo_url, criado_em, atualizado_em FROM marcas WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaMarca(
            $result->fetch_assoc()
        );
    }

    /**
     * Retorna a marca através do nome fornecido
     *
     * @param string $nome
     * @return Marca
     */
    public function buscaPorNome(string $nome): Marca
    {
        $sql = 'SELECT id, nome, logo_url, criado_em, atualizado_em FROM marcas WHERE nome = ' . "'{$nome}'" . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaMarca(
            $result->fetch_assoc()
        );
    }

    /**
     * Undocumented function
     *
     * @return Marca[]
     */
    public function buscarLista(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome, logo_url, criado_em, atualizado_em FROM marcas';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $marcas[] = ($asArray) ? $this->toArray($this->montaMarca($row)) : $this->montaMarca($row);
        }

        return $marcas;
    }

    public function montaMarca(array $dados): Marca
    {
        $marca = new Marca();

        if (!empty($dados['id'])) {
            $marca->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $marca->setNome($dados['nome']);
        }
        if (!empty($dados['criado_em'])) {
            $marca->setCriadoem(new \DateTime($dados['criado_em']));
        }
        if (!empty($dados['atualizado_em'])) {
            $marca->setAtualizadoem(new \DateTime($dados['atualizado_em']));
        }

        return $marca;
    }
}
