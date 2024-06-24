<?php

namespace RevendaTeste\Entity;

class Marca
{
    /**
     * Id da marca
     * 
     * @var int
     */
    private int $id;

    /**
     * Nome da marca
     *
     * @var string
     */
    private string $nome;

    /**
     * Url da logo_urlmarca da marca
     *
     * @var string
     */
    private string $logo_url = '';

    /**
     * Data de criação da marca
     *
     * @var \DateTime
     */
    private \DateTime $criado_em;

    /**
     * Data da última atualização da marca
     *
     * @var \DateTime
     */
    private \DateTime $atualizado_em;

    /**
     * Define o Id da marca
     * 
     * @param int $id
     * @return \RevendaTeste\Entity\Marca
     */
    public function setId(int $id): \RevendaTeste\Entity\Marca
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id marca
     *
     * @return int 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o nome da marca
     *
     * @param string $nome
     * @return \RevendaTeste\Entity\Marca
     */
    public function setNome(string $nome): \RevendaTeste\Entity\Marca
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Retorna o nome da marca
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define a data que a logo_url foi registrada
     *
     * @param \DateTime $criado_em
     * @return \RevendaTeste\Entity\Marca
     */
    public function setCriadoem(\DateTime $criado_em): \RevendaTeste\Entity\Marca
    {
        $this->criado_em = $criado_em;

        return $this;
    }

    /**
     * Retorna a data que a logo_url foi registrada
     *
     * @return \DateTime
     */
    public function getCriadoem(): \DateTime
    {
        return $this->criado_em;
    }

    /**
     * Define a data de atualização
     *
     * @param \DateTime $atualizado_em
     * @return \RevendaTeste\Entity\Marca
     */
    public function setAtualizadoem(\DateTime $atualizado_em): \RevendaTeste\Entity\Marca
    {
        $this->atualizado_em = $atualizado_em;

        return $this;
    }

    /**
     * Retorna a data de atualização
     *
     * @return \DateTime
     */
    public function getAtualizadoem(): \DateTime
    {
        return $this->atualizado_em;
    }
}
