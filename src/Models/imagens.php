<?php

namespace RevendaTeste\Models;

use \RevendaTeste\ORM\Database;
use RevendaTeste\Entity\Imagem;
use RevendaTeste\Models\Versoes;

class Imagens
{

    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    public function buscaPorId($id)
    {
        $sql = 'SELECT id, img_url, criado_em, versao_id FROM imagens WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaImagens(
            $result->fetch_assoc()
        );
    }

    public function buscarImagens(): array
    {
        $sql = 'SELECT id, img_url, criado_em, versao_id FROM imagens';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $imagens[] = $this->montaImagens($row);
        }
        return $imagens;
    }

    public function montaImagens(array $dados): Imagem
    {
        $imagem = new Imagem();

        if (!empty($dados['id'])) {
            $imagem->setId((int) $dados['id']);
        }
        if (!empty($dados['img_url'])) {
            $imagem->setImg($dados['img_url']);
        }
        if (!empty($dados['criado_em'])) {
            $imagem->setCriadoem($dados['criado_em']);
        }
        if (!empty($dados['versao_id'])) {
            $versao = new Versoes();
            $imagem->setVersao($versao->buscaPorId($dados['versao_id']));
        }

        return $imagem;
    }
}
