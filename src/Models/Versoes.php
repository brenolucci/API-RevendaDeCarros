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

    /**
     * Retorna os dados de uma versão através do seu Id
     *
     * @param int $id
     * @return Versao
     */
    public function buscaPorId(int $id): Versao
    {
        $sql = 'SELECT id, nome, modelo_id, combustivel_id, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);
        $dados = $result->fetch_assoc();

        if (is_null($dados)) {
            throw new \InvalidArgumentException('Versão não encontrada ou inexistente!', 422);
        }

        return $this->montaVersao($dados);
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

        $modelo = new Modelos();
        $combustivel = new Combustiveis();

        $versao->setId((int) $dados['id'])
            ->setNome((string) $dados['nome'])
            ->setPreco((int) $dados['preco'])
            ->setAno((int) $dados['ano'])
            ->setAnoModelo((int) $dados['ano_modelo'])
            ->setQuilometragem((string) $dados['quilometragem'])
            ->setLocalizacao((string) $dados['localizacao']);

        $versao->setModelo($modelo->buscaPorId($dados['modelo_id']));
        $versao->setCombustivel($combustivel->buscaPorId($dados['combustivel_id']));

        return $versao;
    }
}
