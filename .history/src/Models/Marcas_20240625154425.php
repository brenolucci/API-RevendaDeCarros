<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Marca;
use RevendaTeste\ORM\Database;

class Marcas
{
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

    public function buscarPorId(int $id): Marca
    {
        $sql = 'SELECT id, nome, logo_url, criado_em, atualizado_em FROM marcas WHERE id = ' . $id . ' LIMIT 1';
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
            $marcas[] = ($asArray) ? $this-> :$this->montaMarca($row);
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
