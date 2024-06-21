<?php

namespace RevendaTeste\Entity;

class Opcional
{
    /**
     * Id de combustivel
     *
     * @var int
     */
    private int $id;

    /**
     * Nome de combustivel
     *
     * @var string
     */
    private string $nome;

    /**
     * Define o id de combustivel
     *
     * @param int $id
     * @return \RevendaTeste\Entity\Opcional
     */
    public function setId(int $id): \RevendaTeste\Entity\Opcional
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o valor de combustivel
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o nome de combustivel
     *
     * @param string $nome
     * @return \RevendaTeste\Entity\Opcional
     */
    public function setNome(string $nome): \RevendaTeste\Entity\Opcional
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Retorna o nome de combustivel
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }
}
