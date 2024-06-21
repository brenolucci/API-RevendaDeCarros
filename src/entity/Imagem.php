<?php

namespace RevendaTeste\Entity;

use \RevendaTeste\Entity\Versao;

class Imagem
{
    /**
     * Id da imagem
     *
     * @var int
     */
    private int $id;

    /**
     * Url da imagem
     *
     * @var string
     */
    private string $img_url;

    /**
     * Data de criação da imagem
     *
     * @var \DateTime
     */
    private \DateTime $criado_em;

    /**
     * Versao da imagem
     *
     * @var Versao
     */
    private Versao $versao;

    /**
     * Define o id da imagem
     *
     * @param int $id
     * @return \RevendaTeste\Entity\Imagem
     */
    public function setId(int $id): \RevendaTeste\Entity\Imagem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id da imagem
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define a url da imagem
     *
     * @param string $img_url
     * @return \RevendaTeste\Entity\Imagem
     */
    public function setImg(string $img_url): \RevendaTeste\Entity\Imagem
    {
        $this->img_url = $img_url;

        return $this;
    }

    /**
     * Retorna a url da imagem
     *
     * @return string
     */
    public function getImg(): string
    {
        return $this->img_url;
    }

    /**
     * Define a data de criação da imagem no banco de dados
     *
     * @param \DateTime $criado_em
     * @return \RevendaTeste\Entity\Imagem
     */
    public function setCriadoem(\DateTime $criado_em): \RevendaTeste\Entity\Imagem
    {
        $this->criado_em = $criado_em;

        return $this;
    }

    /**
     * Retorna a data de criação da imagem no banco de dados
     *
     * @return \DateTime
     */
    public function getCriadoem(): \DateTime
    {
        return $this->criado_em;
    }

    /**
     * Define a versao da imagem
     *
     * @param Versao $versao
     * @return Versao
     */
    public function setVersao(Versao $versao): Versao
    {
        $this->versao = $versao;

        return $this->versao;
    }

    /**
     * Retorna a versao da imagem
     *
     * @return Versao
     */
    public function getVersao(): Versao
    {
        return (is_null($this->versao)) ? new Versao() : $this->versao;
    }
}
