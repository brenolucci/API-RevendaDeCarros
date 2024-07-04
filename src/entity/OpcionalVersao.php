<?php

namespace RevendaTeste\Entity;

use RevendaTeste\Entity\Versao;
use RevendaTeste\Entity\Opcional;

class OpcionalVersao
{
    /**
     * Id do opcional_versao
     *
     * @var int
     */
    private int $id;

    /**
     * Referencia a tabela versoes
     *
     * @var Versao
     */
    private Versao $versao;

    /**
     * Referência a tabela Opcionais
     *
     * @var Opcional
     */
    private Opcional $opcional;

    /**
     * Define o id de opcional_versao
     *
     * @param int $id
     * @return \RevendaTeste\Entity\OpcionalVersao
     */
    public function setId(int $id): \RevendaTeste\Entity\OpcionalVersao
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id de opcional_versao
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define a versao do opcional_versao
     *
     * @param Versao $versao
     * @return OpcionalVersao
     */
    public function setVersao(Versao $versao): OpcionalVersao
    {
        $this->versao = $versao;

        return $this;
    }

    /**
     * Retorna a versao de opcional_versao
     *
     * @return Versao
     */
    public function getVersao(): Versao
    {
        return (is_null($this->versao)) ? new Versao() : $this->versao;
    }

    /**
     * Define o opcional de opcional_versao
     *
     * @param Opcional $opcional
     * @return OpcionalVersao
     */
    public function setOpcional(Opcional $opcional): OpcionalVersao
    {
        $this->opcional = $opcional;

        return $this;
    }

    /**
     * Retorna o opcional de opcional_versao
     *
     * @return Opcional
     */
    public function getOpcional(): Opcional
    {
        return (is_null($this->opcional)) ? new Opcional() : $this->opcional;
    }
}
