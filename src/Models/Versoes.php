<?php

namespace RevendaTeste\Models;

use RevendaTeste\ORM\Database;
use RevendaTeste\Entity\Modelo;
use RevendaTeste\Entity\Versao;
use RevendaTeste\Models\Modelos;
use RevendaTeste\Models\Combustiveis;
use RevendaTeste\Traits\ObjectToArray;

class Versoes
{
    use ObjectToArray;

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaPorId($id)
    {
        $sql = 'SELECT id, nome, modelo_id, combustivel_id, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaVersao(
            $result->fetch_assoc()
        );
    }

    public function buscaVersoes(bool $asArray = false): array
    {
        $sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $versoes[] = ($asArray) ? $this->toArray($this->montaVersao($row)) : $this->montaVersao($row);
        }

        return $versoes;
    }

    function cadastraVersao(array $data): Versao
    {
        $sql = "INSERT INTO versoes (
            modelo_id, 
            combustivel_id, 
            nome, 
            preco, 
            ano, 
            ano_modelo, 
            quilometragem, 
            localizacao
        ) 
        VALUES (
            {$data['modelo_id']}, 
            {$data['combustivel_id']}, 
            '{$data['nome']}', 
            {$data['preco']}, 
            {$data['ano']}, 
            {$data['ano_modelo']}, 
            '{$data['quilometragem']}', 
            '{$data['localizacao']}'
        )";
        $result = $this->conn->query($sql);

        // Obtém o ID recém inserido
        $sql = 'SELECT LAST_INSERT_ID() AS last_id FROM versoes';
        $result = mysqli_fetch_assoc($this->conn->query($sql));
        $data['id'] = $result['last_id'];

        return $this->montaVersao($data);
    }

    public function montaVersao(array $dados): Versao
    {
        $versao = new Versao();


        if (!empty($dados['id'])) {
            $versao->setId((int) $dados['id']);
        }
        if (!empty($dados['modelo_id'])) {
            $modelo = new Modelos();
            $versao->setModelo($modelo->buscaPorId($dados['modelo_id']));
        }
        if (!empty($dados['combustivel_id'])) {
            $combustivel = new Combustiveis();
            $versao->setCombustivel($combustivel->buscaPorId($dados['combustivel_id']));
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
