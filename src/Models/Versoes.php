<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Versao;
use RevendaTeste\ORM\Database;
use RevendaTeste\Entity\Combustivel;
use RevendaTeste\Entity\Modelo;

class Versoes
{

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaVersoes(): array
    {
        $sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $versoes[] = $this->montaVersao($row);
        }

        return $versoes;
    }

    public function montaVersao(array $dados): Versao
    {
        $versao = new Versao();

        if (!empty($dados['id'])) {
            $versao->setId((int) $dados['id']);
        }
        if (!empty($dados['modelo_id'])) {
            $versao->setId((int) $dados['modelo_id']);
        }
        if (!empty($dados['combustivel_id'])) {
            $versao->setId((int) $dados['combustivel_id']);
        }
        if (!empty($dados['nome'])) {
            $versao->setNome((string) $dados['nome']);
        }
        if (!empty($dados['preco'])) {
            $versao->setPreco((int) $dados['preco']);
        }
        if (!empty($dados['ano'])) {
            $versao->setAno((int) $dados['ano']);
        }
        if (!empty($dados['ano_modelo'])) {
            $versao->setAnoModelo((int) $dados['ano_modelo']);
        }
        if (!empty($dados['quilometragem'])) {
            $versao->setQuilometragem((string) $dados['quilometragem']);
        }
        if (!empty($dados['localizacao'])) {
            $versao->setLocalizacao((string) $dados['localizacao']);
        }

        return $versao;

    }
}