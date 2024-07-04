<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\Opcional;
use \RevendaTeste\ORM\Database;
use \RevendaTeste\Traits\ObjectToArray;

class Opcionais
{
    use ObjectToArray;

    private \mysqli $conn;

    /**
     * Construtor de Opcionais
     */
    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    /**
     * Retorna Opcionais através do id fornecido
     *
     * @param int $id
     * @return Opcional
     */
    public function buscaPorId(int $id): Opcional
    {
        $sql = 'SELECT id, nome FROM opcionais WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);
        $dados = $result->fetch_assoc();

        if (is_null($dados)) {
            throw new \InvalidArgumentException('Opcional não encontrado ou inexistente!', 422);
        }

        return $this->montaOpcionais($dados);
    }

    /**
     * Retorna Opcionais através do nome fornecido
     *
     * @param string $nome
     * @return Opcional
     */
    public function buscaPorNome(string $nome): Opcional
    {
        $sql = 'SELECT id, nome FROM opcionais WHERE nome = "' . $nome . '" LIMIT 1';
        $result = $this->conn->query($sql);
        $dados = $result->fetch_assoc();

        if (is_null($dados)) {
            throw new \InvalidArgumentException('Opcional não encontrado ou inexistente!', 422);
        }

        return $this->montaOpcionais($dados);
    }

    /**
     * Retona um array list com os Opcionais através do array de Ids informados
     *
     * @param array $listaId
     * @return Opcional[]
     */
    public function buscarPorListaDeId(array $listaId): array
    {
        $data = [];
        foreach ($listaId as $id) {
            $data[] = $this->buscaPorId($id);
        }

        return $data;
    }

    /**
     * Retorna lista de todos os opcionais
     *
     * @param boolean $asArray
     * @return array
     */
    public function buscaOpcionais(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome FROM opcionais';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $opcionais[] = ($asArray) ? $this->toArray($this->montaOpcionais($row)) : $this->montaOpcionais($row);
        }

        return $opcionais;
    }

    /**
     * Monta objeto Opcionais
     *
     * @param array $dados
     * @return Opcional
     */
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
