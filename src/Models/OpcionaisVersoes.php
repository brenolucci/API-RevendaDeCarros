<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\OpcionalVersao;
use RevendaTeste\ORM\Database;
use RevendaTeste\Models\{Versoes, Opcionais};

class OpcionaisVersoes
{

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaPorId($id)
    {
        $sql = 'SELECT id, versao_id, opcional_id FROM opcionais_versoes WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaOpcionalVersao(
            $result->fetch_assoc()
        );
    }

    public function buscaOpcionaisVersoes(): array
    {
        $sql = 'SELECT id, versao_id, opcional_id FROM opcionais_versoes';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $opcionaisVersoes[] = $this->montaOpcionalVersao($row);
        }

        return $opcionaisVersoes;
    }

    public function montaOpcionalVersao(array $dados): OpcionalVersao
    {
        $opcionalVersao = new OpcionalVersao();


        if (!empty($dados['id'])) {
            $opcionalVersao->setId((int) $dados['id']);
        }
        if (!empty($dados['modelo_id'])) {
            $versao = new Versoes();
            $opcionalVersao->setVersao($versao->buscaPorId($dados['versao_id']));
        }
        if (!empty($dados['combustivel_id'])) {
            $opcional = new Opcionais();
            $opcionalVersao->setOpcional($opcional->buscaPorId($dados['opcional_id']));
        }

        return $opcionalVersao;

    }
}