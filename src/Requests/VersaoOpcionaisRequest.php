<?php

namespace RevendaTeste\Requests;

use RevendaTeste\Entity\Versao;
use RevendaTeste\Models\Versoes;
use RevendaTeste\Entity\Opcional;
use RevendaTeste\Models\Opcionais;

class VersaoOpcionaisRequest
{
    private Versao $versao;
    private array $listaOpcional;

    /**
     * Construtor da classe, e inicializa a versão e opcionais se informado
     *
     * @param array $data
     * [
     *  'versao_id' => int
     *  'opcional_id' => array
     * ]
     */
    public function __construct(array $data = [])
    {
        $this->listaOpcional = [];

        if (!empty($data['versao_id'])) {
            $this->setVersaoPorId($data['versao_id']);
        }
        if (!empty($data['opcional_id'])) {
            $this->setListaOpcionalPorId($data['opcional_id']);
        }
    }

    /**
     * Undocumented function
     *
     * @param int $id
     * @return VersaoOpcionaisRequest
     */
    protected function setVersaoPorId(int $id): VersaoOpcionaisRequest
    {
        $this->versao = (new Versoes)->buscaPorId($id);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return Versao
     */
    public function getVersao(): Versao
    {
        return $this->versao;
    }

    /**
     * @see self::addOpcional
     *
     * @param Opcional $opcional
     * @return VersaoOpcionaisRequest
     */
    public function setOpcional(Opcional $opcional): VersaoOpcionaisRequest
    {
        $this->addOpcional($opcional);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return Opcional
     */
    public function getOpcional(): Opcional
    {
        $key = key($this->listaOpcional);

        $opcional = $this->listaOpcional[$key];

        next($this->listaOpcional);

        return $opcional;
    }

    /**
     * Undocumented function
     *
     * @param Opcional $opcional
     * @return VersaoOpcionaisRequest
     */
    public function addOpcional(Opcional $opcional): VersaoOpcionaisRequest
    {
        array_push($this->listaOpcional, $opcional);

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return Opcional[]
     */
    public function getListaOpcional(): array
    {
        return $this->listaOpcional;
    }

    /**
     * Undocumented function
     *
     * @param array $listaId
     * @return VersaoOpcionaisRequest
     */
    public function setListaOpcionalPorId(array $listaId): VersaoOpcionaisRequest
    {
        foreach ($listaId as $opcionalId) {
            $this->addOpcional(
                (new Opcionais)->buscaPorId($opcionalId)
            );
        }

        return $this;
    }
}