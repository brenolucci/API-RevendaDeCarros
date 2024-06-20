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
     * Url da logomarca da marca
     *
     * @var string
     */
    private string $logo;

    /**
     * Data de criação da marca
     *
     * @var int
     */
    private int $created_at;

    /**
     * Data da última atualização da marca
     *
     * @var int
     */
    private int $updated_at;


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
     * Define a data que a logo foi registrada
     *
     * @param integer $created_at
     * @return \RevendaTeste\Entity\Marca
     */
    public function setCreated(int $created_at): \RevendaTeste\Entity\Marca
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Retorna a data que a logo foi registrada
     *
     * @return integer
     */
    public function getCreated(): int
    {
        return $this->created_at;
    }

    /**
     * Define a data de atualização
     *
     * @param integer $updated_at
     * @return \RevendaTeste\Entity\Marca
     */
    public function setUpdated(int $updated_at): \RevendaTeste\Entity\Marca
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Retorna a data de atualização
     *
     * @return integer
     */
    public function getUpdated(): int
    {
        return $this->updated_at;
    }
}
