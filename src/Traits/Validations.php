<?php

namespace RevendaTeste\Traits;

use \RevendaTeste\Models\{Versoes, Opcionais};

trait Validations
{
    public function versaoExiste(int $id)
    {
        $versoesTable = new Versoes();
        $versao = $versoesTable->buscaPorId($id);

        return $versao;
    }

    public function opcionalExiste(int $id)
    {
        $opcionalTable = new Opcionais();
        $opcional = $opcionalTable->buscaPorId($id);

        return $opcional;
    }

    public function valida($data)
    {

        $retorno = [];

        $versoesTable = new Versoes();
        $versao = $versoesTable->buscaPorId($data['versao_id']);

        $opcionalTable = new Opcionais();
        foreach ($data['opcional_id'] as $indice => $value) {
            $opcional = $opcionalTable->buscaPorId($value);

            // Valida SE JÁ EXISTE
            $opcionalVersao = $this->buscarPorVersaoIdEOpcionalId($versao->getId(), $opcional->getId());
            if (!is_null($opcionalVersao)) {
                // throw new \InvalidArgumentException("Opcional {$opcional->getNome()} já cadastrado para a Versão {$versao->getNome()}", 422);
                $retorno[] = $opcionalVersao;
                var_dump($data);
                var_dump($retorno);
                continue;
            }

        }

        return $retorno;
    }

    function validateRequestType(string|array $requestType): bool
    {
        if (is_array($requestType)) {
            $valid = false;
            foreach ($requestType as $request) {
                try {
                    $valid = $this->validateRequestType($request);
                } catch (\Exception) {
                    // Do nothing
                }
                if ($valid) {
                    break;
                }
            }
        }

        $requestType = strtoupper($requestType);
        if (!in_array($requestType, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
            throw new \Exception('Verbo da requisição inválido!', 405);
        }

        if (strtoupper($_SERVER["REQUEST_METHOD"]) !== $requestType) {
            throw new \Exception('Tipo de requisição inválido!', 405);
        }

        return true;
    }

    // public function existeOpcionalVersao()
    // {
    //     $opcionalVersao = $this->buscarPorVersaoIdEOpcionalId($versao->getId(), $opcional->getId());

    // }

    public function validaOpcionais(int $versao_id, int $opcional_id)
    {

        // Valida SE JÁ EXISTE
        $opcionalVersao = $this->buscarPorVersaoIdEOpcionalId($versao_id, $opcional_id);
        if (!is_null($opcionalVersao)) {
            return $opcionalVersao;
        }
        return false;
    }
}