<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\User;
use RevendaTeste\ORM\Database;
use RevendaTeste\Traits\ObjectToArray;

class Users
{
    use ObjectToArray;

    /**
     * Instância de Conexão com banco de dados
     *
     * @var \mysqli
     */
    private \mysqli $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }


    public function buscaUsers(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome, email, senha FROM users';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $users[] = ($asArray) ? $this->toArray($this->montaUser($row)) : $this->montaUser($row);
        }

        return $users;
    }

    /**
     * Verifica se o usuário existe no banco de dados
     *
     * @param array $dados
     * @return User
     */
    public function login(array $dados): User
    {
        $sql = 'SELECT id, nome, email, senha FROM users WHERE email = ' . "'{$dados['email']}'" . 'AND senha = ' . "'{$dados['senha']}'" . 'LIMIT 1';
        $result = $this->conn->query($sql);
        $assoc = $result->fetch_assoc();

        if (!$assoc) {
            throw new \InvalidArgumentException('Versão não encontrada ou inexistente!', 422);
        }

        return $this->montaUser(
            $assoc
        );

    }
    public function buscaPorId(int $id): User
    {
        $sql = 'SELECT id, nome, email, senha FROM users WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaUser(
            $result->fetch_assoc()
        );

    }

    public function montaUser(array $dados): User
    {
        $user = new User();

        if (!empty($dados['id'])) {
            $user->setId((int) $dados['id']);
        }
        if (!empty($dados['nome'])) {
            $user->setNome((string) $dados['nome']);
        }
        if (!empty($dados['email'])) {
            $user->setEmail((string) $dados['email']);
        }
        if (!empty($dados['senha'])) {
            $user->setSenha((string) $dados['senha']);
        }

        return $user;
    }

}
