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
        $sql = 'SELECT id, img_url, criado_em FROM imagens WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaImagens(
            $result->fetch_assoc()
        );
    }

    public function cadastraImagem(int $versao, string $url)
    {
        $data = [];

        $str = str_replace(FILES_DIR, 'http://localhost/revendaCarro/hmtl/files/', $url);
        $newUrl = str_replace(DS, '/', $str);
        $sql = "INSERT INTO imagens (versao_id, img_url) VALUES ({$versao}, '{$newUrl}')";

        $result = ($this->conn->query($sql));


        $sql = 'SELECT LAST_INSERT_ID() AS last_id FROM versoes';
        $result = mysqli_fetch_assoc($this->conn->query($sql));

        $imagem = $this->buscaPorId($result['last_id']);



        return $this->montaImagens($result);
    }

    public function buscarImagens(): array
    {
        $sql = 'SELECT id, img_url, criado_em FROM imagens';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $imagens[] = $this->montaImagens($row);
        }
        return $imagens;
    }

    public function buscarImagensPorVersao(int $versaoId): array
    {
        $imagens = [];
        $sql = 'SELECT id, img_url, criado_em FROM imagens WHERE versao_id = ' . $versaoId;
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
        return $imagem;
    }
}
