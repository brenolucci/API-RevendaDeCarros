<?php

namespace RevendaTeste\Entity;

use \RevendaTeste\Entity\Versao;

class Combustivel
{
    /**
     * Id do combustivel
     *
     * @var int
     */
    private int $id;
    /**
     * Nome do combustivel
     *
     * @var string
     */
    private string $nome;
    /**
     * Id da versão do combustivel
     *
     * @var Versao
     */
    private Versao $versao;

    /**
     * Define o Id do combustivel
     *
     * @param integer $id
     * @return \RevendaTeste\Entity\Combustivel
     */
    public function setId(int $id): \RevendaTeste\Entity\Combustivel
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id do combustivel
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o nome do combustivel
     *
     * @param string $nome
     * @return \RevendaTeste\Entity\Combustivel
     */
    public function setNome(string $nome): \RevendaTeste\Entity\Combustivel
    {
        $this->nome - $nome;

        return $this;
    }

    /**
     * Retorna o nome do combustivel
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define o id da versao do combustivel
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
     * Retorna o id da versao do combustivel
     *
     * @return Versao
     */
    public function getVersao(): Versao
    {
        return (is_null($this->versao)) ? new Versao() : $this->versao;
    }


}