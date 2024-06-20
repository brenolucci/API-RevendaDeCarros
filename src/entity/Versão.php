<?php

namespace RevendaTeste\Entity;

use RevendaTeste\Entity\Modelo;

class Versao
{
    /**
     * Id da versão
     *
     * @var integer
     */
    private int $id;

    /**
     * Nome da versão
     *
     * @var string
     */
    private string $nome;

    /**
     * Referência ao id do modelo
     *
     * @var Modelo
     */
    private Modelo $modelo;


    /**
     * Define o id da versão
     *
     * @param integer $id
     * @return \RevendaTeste\Entity\Versao
     */
    public function setId(int $id): \RevendaTeste\Entity\Versao
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id da versão
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o nome da versão
     *
     * @param string $nome
     * @return \RevendaTeste\Entity\Versao
     */
    public function setNome(string $nome): \RevendaTeste\Entity\Versao
    {
        $this->nome - $nome;

        return $this;
    }

    /**
     * Retorna o nome da versão
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define o id do modelo da versão
     *
     * @param Modelo $modelo
     * @return Modelo
     */
    public function setModelo(Modelo $modelo): Modelo
    {
        $this->modelo = $modelo;

        return $this->modelo;
    }

    /**
     * Retorna o id do modelo da versão 
     *
     * @return Modelo
     */
    public function getModelo(): Modelo
    {
        return (is_null($this->modelo)) ? new Modelo() : $this->modelo;
    }

}