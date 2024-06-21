<?php

namespace RevendaTeste\Entity;

use RevendaTeste\Entity\Marca;

class Modelo
{
    /**
     * Id do Modelo
     * 
     * @var int
     */
    private int $id;

    /**
     * Nome do Modelo
     * 
     * @var string
     */
    private string $nome;

    /**
     * Referencia ao id da Marca
     *
     * @var Marca
     */
    private Marca $marca;

    /**
     * Define o Id do modelo
     *
     * @param int $id
     * @return \RevendaTeste\Entity\Modelo
     */
    public function setId(int $id): \RevendaTeste\Entity\Modelo
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id do modelo
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o nome do modelo
     *
     * @param string $nome
     * @return \RevendaTeste\Entity\Modelo
     */
    public function setNome(string $nome): \RevendaTeste\Entity\Modelo
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Retorna o id do modelo
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define a marca
     *
     * @param Marca $marca
     * @return Marca
     */
    public function setMarca(Marca $marca): Marca
    {
        $this->marca = $marca;

        return $this->marca;
    }

    /**
     * Retorna a marca
     *
     * @return Marca
     */
    public function getMarca(): Marca
    {
        return (is_null($this->marca)) ? new Marca() : $this->marca;
    }
}
