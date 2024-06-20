<?php

namespace \RevendaTeste\Entity;

use \RevendaTeste\Entity\Versao ;

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


}