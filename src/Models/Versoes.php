<?php

namespace RevendaTeste\Models;

use RevendaTeste\ORM\Database;
use RevendaTeste\Entity\Modelo;
use RevendaTeste\Entity\Versao;
use RevendaTeste\Models\Modelos;
use RevendaTeste\Models\Combustiveis;
use RevendaTeste\Traits\ObjectToArray;

class Versoes extends Database
{
    use ObjectToArray;

    /**
     * Retorna os dados de uma versão através do seu Id
     *
     * @param int $id
     * @return Versao
     */
    public function buscaPorId(int $id): Versao
    {
        $sql = 'SELECT id, nome, modelo_id, combustivel_id, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->getConnection()->query($sql);
        $dados = $result->fetch_assoc();

        if (is_null($dados)) {
            throw new \InvalidArgumentException('Versão não encontrada ou inexistente!', 422);
        }

        return $this->montaVersao($dados);
    }

    public function buscaFiltrada(string $sqlFiltro, bool $asArray = false): array
    {
        $sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes ' . $sqlFiltro;
        var_dump($sql);
        die;
        $result = $this->getConnection()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $versoes[] = ($asArray) ? $this->toArray($this->montaVersao($row)) : $this->montaVersao($row);
        }

        return $versoes;

    }

    /**
     * Retorna os dados de uma versão através do ano
     *
     * @param integer $ano
     * @return Versao
     */
    public function buscaPorAno(int $ano): Versao
    {

        $sql = 'SELECT id, nome, modelo_id, combustivel_id, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes WHERE ano = ' . $ano . ' LIMIT 1';
        $result = $this->getConnection()->query($sql);
        $dados = $result->fetch_assoc();

        if (is_null($dados)) {
            throw new \InvalidArgumentException('Versão não encontrada ou inexistente!', 422);
        }

        return $this->montaVersao($dados);
    }


    public function buscaPorPreco(int $preco): Versao
    {

        $sql = 'SELECT id, nome, modelo_id, combustivel_id, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes WHERE preco = ' . $preco . ' LIMIT 1';
        $result = $this->getConnection()->query($sql);
        $dados = $result->fetch_assoc();

        if (is_null($dados)) {
            throw new \InvalidArgumentException('Versão não encontrada ou inexistente!', 422);
        }


        return $this->montaVersao($dados);
    }


    public function buscaPorKm(string $km): Versao
    {

        $sql = 'SELECT id, nome, modelo_id, combustivel_id, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes WHERE quilometragem = ' . "'{$km}'" . ' LIMIT 1';
        $result = $this->getConnection()->query($sql);
        $dados = $result->fetch_assoc();
        if (is_null($dados)) {
            throw new \InvalidArgumentException('Versão não encontrada ou inexistente!', 422);
        }


        return $this->montaVersao($dados);
    }

    public function filtraVersoes($conditions)
    {
        $sql = 'SELECT id, modelo_id, combustivel_id, nome, km, ano, ano_modelo, quilometragem, localizacao FROM versoes';


        if (!empty($conditions)) {
            $sql .= $conditions;
        }

        return $sql;
    }

    public function buscaVersoes(bool $asArray = false): array
    {
        $sql = 'SELECT id, modelo_id, combustivel_id, nome, preco, ano, ano_modelo, quilometragem, localizacao FROM versoes';
        $result = $this->getConnection()->query($sql);
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
        $result = $this->getConnection()->query($sql);

        // Obtém o ID recém inserido
        $sql = 'SELECT LAST_INSERT_ID() AS last_id FROM versoes';
        $result = mysqli_fetch_assoc($this->getConnection()->query($sql));
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
