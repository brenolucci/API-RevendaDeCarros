<?php

namespace RevendaTeste\Entity;

use RevendaTeste\Entity\Modelo;
use RevendaTeste\Entity\Combustivel;
use RevendaTeste\Entity\Imagem;

class Versao
{
    /**
     * Id da versão
     *
     * @var int
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
     * Referencia ao id de combustivel
     *
     * @var Combustivel
     */
    private Combustivel $combustivel;

    /**
     * Preço da versão
     *
     * @var int
     */
    private int $preco;

    /**
     * Ano da versão
     *
     * @var int
     */
    private int $ano;

    /**
     * Ano do modelo;
     *
     * @var int
     */
    private int $ano_modelo;

    /**
     * Quilometragem da versão
     *
     * @var string
     */
    private string $quilometragem;

    /**
     * Localização da versão 
     *
     * @var string
     */
    private string $localizacao;

    /**
     * Lista de opcionais da versão
     *
     * @var array
     */
    private array $opcionais_versao = [];

    /**
     * Imagem da versao
     *
     * @var Imagem[]
     */
    private array $imagens;


    /**
     * Define o id da versão
     *
     * @param int $id
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
     * @return int
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
        $this->nome = $nome;

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
     * Define o modelo da versão
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
     * Retorna o modelo da versão 
     *
     * @return Modelo
     */
    public function getModelo(): Modelo
    {
        return (is_null($this->modelo)) ? new Modelo() : $this->modelo;
    }

    /**
     * Define o combustivel
     *
     * @param Combustivel $combustivel
     * @return Combustivel
     */
    public function setCombustivel(Combustivel $combustivel): Combustivel
    {
        $this->combustivel = $combustivel;

        return $this->combustivel;
    }

    /**
     * Retorna o combustivel
     *
     * @return Combustivel
     */
    public function getCombustivel(): Combustivel
    {
        return (is_null($this->combustivel)) ? new Combustivel() : $this->combustivel;
    }

    /**
     * Define o preço da versão
     *
     * @param int $preco
     * @return \RevendaTeste\Entity\Versao
     */
    public function setPreco(int $preco): \RevendaTeste\Entity\Versao
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Retorna o preço da versão 
     *
     * @return int
     */
    public function getPreco(): int
    {
        return $this->preco;
    }

    /**
     * Define o ano da versão 
     *
     * @param int $ano
     * @return \RevendaTeste\Entity\Versao
     */
    public function setAno(int $ano): \RevendaTeste\Entity\Versao
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Retorna o ano da versão 
     *
     * @return int
     */
    public function getAno(): int
    {
        return $this->ano;
    }

    public function setAnoModelo(int $ano_modelo): \RevendaTeste\Entity\Versao
    {
        $this->ano_modelo = $ano_modelo;

        return $this;
    }

    public function getAnoModelo(): int
    {
        return $this->ano_modelo;
    }

    /**
     * Defina a quilometragem da versão
     *
     * @param string $quilometragem
     * @return \RevendaTeste\Entity\Versao
     */
    public function setQuilometragem(string $quilometragem): \RevendaTeste\Entity\Versao
    {
        $this->quilometragem = $quilometragem;

        return $this;
    }

    /**
     * Retorna a quilometragem da versão
     *
     * @return string
     */
    public function getQuilometragem(): string
    {
        return $this->quilometragem;
    }

    /**
     * Define a localização da versão 
     *
     * @param string $localizacao
     * @return \RevendaTeste\Entity\Versao
     */
    public function setLocalizacao(string $localizacao): \RevendaTeste\Entity\Versao
    {
        $this->localizacao = $localizacao;

        return $this;
    }

    /**
     * Retorna a localização da versão
     *
     * @return string
     */
    public function getLocalizacao(): string
    {
        return $this->localizacao;
    }

    /**
     * Define os opcionais da versão
     *
     * @param \RevendaTeste\Entity\OpcionalVersao[] $opcionais
     * @return Versao
     */
    public function setOpcionais(array $opcionais): Versao
    {
        foreach ($opcionais as $opcional) {
            if (!$opcional instanceof \RevendaTeste\Entity\OpcionalVersao) {
                throw new \InvalidArgumentException('O opcional ' . print_r($opcional, 1) . ' é inválido!');
            }
        }

        $this->opcionais_versao = $opcionais;

        return $this;
    }

    /**
     * Retorna os opcionais da versão
     *
     * @return \RevendaTeste\Entity\OpcionalVersao[] 
     */
    public function getOpcionais(): array
    {
        return $this->opcionais_versao;
    }

    /**
     * Undocumented function
     *
     * @param array $imagem
     * @return \RevendaTeste\Entity\Versao
     */
    public function setImagem(array $imagem): Versao
    {
        $this->imagens = $imagem;

        return $this;
    }

    public function getImagem(): array
    {
        return $this->imagens;
    }
}
