<?php

namespace RevendaTeste\Models;

use RevendaTeste\ORM\Database;
use RevendaTeste\Entity\OpcionalVersao;
use RevendaTeste\Models\{Versoes, Opcionais};
use RevendaTeste\Requests\VersaoOpcionaisRequest;
use RevendaTeste\Traits\{ObjectToArray, Validations};

class OpcionaisVersoes
{
    use ObjectToArray;

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    /**
     * Retorna o OpcionvalVersao ou null para o caso de não existir
     *
     * @param int $id
     * @return OpcionalVersao|null
     */
    public function buscaPorId($id): OpcionalVersao|null
    {
        $sql = 'SELECT id, versao_id, opcional_id FROM opcionais_versoes WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);
        $dados = $result->fetch_assoc();

        return $this->montaOpcionalVersao($dados);
    }

    /**
     * Retorna o objeto OpcionalVersão através do código da versão e opcional
     *
     * @param int $versaoId
     * @param int $opcionalId
     * @return OpcionalVersao|null
     */
    public function buscarPorVersaoIdEOpcionalId(int $versaoId, int $opcionalId): OpcionalVersao|null
    {
        $sql = 'SELECT id, versao_id, opcional_id FROM opcionais_versoes WHERE versao_id = ' . $versaoId . ' AND opcional_id = ' . $opcionalId;
        $result = $this->conn->query($sql);
        $dados = $result->fetch_assoc();

        return $this->montaOpcionalVersao($dados);
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

    /**
     * Vincula a versão à lista de opcionais informados e retorna um array de objeto OpcionalVersao
     *
     * @param array $data
     * @return OpcionalVersao[]
     */
    use Validations;
    function cadastraOpcionalVersao(VersaoOpcionaisRequest $data): array
    {

        $retorno = [];

        foreach ($data->getListaOpcional() as $opcional) {

            $opcionalVersao = $this->buscarPorVersaoIdEOpcionalId($data->getVersao()->getId(), $opcional->getId());
            if (!is_null($opcionalVersao)) {
                $retorno[] = $opcionalVersao;
                continue;
            }

            // Grava
            $sql = "INSERT INTO opcionais_versoes (versao_id, opcional_id) VALUES ({$data->getVersao()->getId()}, {$opcional->getId()})";
            $result = $this->conn->query($sql);

            // Obtém o ID recém inserido
            $sql = 'SELECT LAST_INSERT_ID() AS last_id FROM opcionais_versoes';
            $result = mysqli_fetch_assoc($this->conn->query($sql));

            // Empilha no retorno o objeto gravado
            $retorno[] = (new OpcionalVersao())->setId($result['last_id'])
                ->setVersao($data->getVersao())
                ->setOpcional($opcional);
        }

        return $retorno;
    }

    /**
     * Monta os dados do OpcionalVersao
     *
     * @param array|null $dados
     * @return OpcionalVersao|null
     */
    public function montaOpcionalVersao(array|null $dados): OpcionalVersao|null
    {
        if (is_null($dados)) {
            return $dados;
        }

        $opcionalVersao = new OpcionalVersao();

        if (!empty($dados['id'])) {
            $opcionalVersao->setId((int) $dados['id']);
        }
        if (!empty($dados['versao_id'])) {
            $versao = new Versoes();
            $opcionalVersao->setVersao($versao->buscaPorId($dados['versao_id']));
        }
        if (!empty($dados['opcional_id'])) {
            $opcional = new Opcionais();
            $opcionalVersao->setOpcional($opcional->buscaPorId($dados['opcional_id']));
        }

        return $opcionalVersao;

    }
}