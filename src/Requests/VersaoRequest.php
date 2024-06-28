<?php

namespace RevendaTeste\Requests;

use RevendaTeste\Entity\Versao;
use RevendaTeste\Models\Modelos;

class VersaoRequest
{
    private Versao $versao;

    public function __construct(array $data = [])
    {
        $this->versao = new Versao;

        if (!empty($data['modelo_id'])) {
            $this->setModeloPorId($data['modelo_id']);
        }
    }

    /**
     * Define o modelo através do seu Id
     *
     * @param int $modeloId
     * @return VersaoRequest
     */
    public function setModeloPorId(int $modeloId): VersaoRequest
    {
        $modeloTable = new Modelos();

        $this->versao->setModelo(
            $modeloTable->buscaPorId($modeloId)
        );

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
}