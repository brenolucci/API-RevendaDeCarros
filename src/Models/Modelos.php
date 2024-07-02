<?php

namespace RevendaTeste\Models;

use \RevendaTeste\ORM\Database;
use RevendaTeste\Entity\Modelo;
use RevendaTeste\Entity\Marca;
use RevendaTeste\Models\Marcas;
use RevendaTeste\Traits\ObjectToArray;

class Modelos
{
    use ObjectToArray;

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaPorId(int $id): Modelo
    {
        $sql = 'SELECT id, nome, marca_id FROM modelos WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaModelos(
            $result->fetch_assoc()
        );
    }

    /**
     * Retorna o modelo a partir do nome enviado
     *
     * @param string $nome
     * @return Modelo|null
     */
    public function buscaPorNome(string $nome): Modelo|null
    {
        $sql = 'SELECT id, nome, marca_id FROM modelos WHERE nome = "' . $nome . '" LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaModelos(
            $result->fetch_assoc()
        );
    }

    public function buscarPorMarca($marca_id, bool $asArray = false)
    {
        $sql = 'SELECT id, nome, marca_id FROM modelos WHERE marca_id = ' . $marca_id;
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $marcas[] = ($asArray) ? $this->toArray($this->montaModelos($row)) : $this->montaModelos($row);
        }
        return $marcas;
    }

    public function buscarModelos(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome, marca_id FROM modelos';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $modelos[] = ($asArray) ? $this->toArray($this->montaModelos($row)) : $this->montaModelos($row);
        }
        return $modelos;
    }

    /**
     * Monta o modelo a partir dos dados enviados ou retorna null caso os dados estejam vazios
     *
     * @param array $dados
     * @return Modelo|null
     */
    public function montaModelos(array|null $dados): Modelo|null
    {
        if (is_null($dados)) {
            return $dados;
        }

        $modelo = new Modelo();

        if (!empty($dados['id'])) {
            $modelo->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $modelo->setNome($dados['nome']);
        }
        if (!empty($dados['marca_id'])) {
            $marca = new Marcas();
            $modelo->setMarca($marca->buscarPorId($dados['marca_id']));
        }

        return $modelo;
    }
}
