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
     * @param integer $id
     * @return void
     */
    public function setId(int $id): \RevendaTeste\Entity\Modelo
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id do modelo
     *
     * @return integer
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
     * @return void
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define o id da marca
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
     * Retorna o id da marca
     *
     * @return Marca
     */
    public function getMarca(): Marca
    {
        return (is_null($this->marca)) ? new Marca() : $this->marca;
    }
}


// Exemplo de como uma injeção de dependência funcionaria nesse caso da marca.
// $m = new Modelo();

// $m->setId(1)
//     ->setNome('Teste')
//     ->setMarca(
//         $m->getMarca()
//             ->setId(2)
//             ->setNome('Teste')
//     );


