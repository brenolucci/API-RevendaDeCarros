<?php

namespace RevendaTeste\Entity;

class User
{
    /**
     * id do usuário
     *
     * @var integer
     */
    private int $id;

    /**
     * nome do usuário
     *
     * @var string
     */
    private string $nome;

    /**
     * email do usuário
     *
     * @var string
     */
    private string $email;

    /**
     * Undocumented variable
     *
     * @var string
     */
    private string $senha;

    /**
     * Token de acesso do usuário
     *
     * @var string
     */
    private string $token;

    /**
     * Define o id do Usuário
     *
     * @param integer $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retorna o id do usuário
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Define o nome do usuário
     *
     * @param string $nome
     * @return User
     */
    public function setNome(string $nome): User
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Retorna o nome do usuário
     *
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Define o email do usuário
     *
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Retorna o email do usuário
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Define a senha do usuário 
     *
     * @param string $senha
     * @return User
     */
    public function setSenha(string $senha): User
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Retorna a senha do usuário
     *
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }


    /**
     * Define o token do usuário
     *
     * @param string $token
     * @return User
     */
    public function setToken(string $token): User
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Retorna a token do usuário
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}