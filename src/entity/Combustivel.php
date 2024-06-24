<?php

namespace RevendaTeste\Entity;

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
     * Define o Id do combustivel
     *
     * @param int $id
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
     * @return int
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
        $this->nome = $nome;

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
}
