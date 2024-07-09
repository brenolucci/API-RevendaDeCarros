<?php

namespace RevendaTeste\Models;

use RevendaTeste\Entity\User;
use RevendaTeste\ORM\Database;
use RevendaTeste\Requests\MyJWT;
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

    /**
     * Retorna uma lista com todos os usuários
     *
     * @param boolean $asArray
     * @return array
     */
    public function buscaUsers(bool $asArray = false): array
    {
        $sql = 'SELECT id, nome, email, senha FROM users';
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $users[] = ($asArray) ? $this->toArray($this->montaUser($row)) : $this->montaUser($row);
        }

        return $users;
    }

    public function buscaPorToken(string $token): User
    {
        $jwt = new MyJWT;
        $user = $jwt->decodeJWT($token);

        print_r($user);
        die;

    }

    public function registrar(array $dados): User
    {
        $sql = "INSERT INTO users ( nome, email, senha ) 
        VALUES ( '{$dados['nome']}', '{$dados['email']}', '{$dados['senha']}' )";
        $result = $this->conn->query($sql);

        // Obtém o ID recém inserido
        $sql = 'SELECT LAST_INSERT_ID() AS last_id FROM users';
        $result = mysqli_fetch_assoc($this->conn->query($sql));
        $dados['id'] = $result['last_id'];

        return $this->montaUser($dados);
    }

    public function buscaPorId(int $id): User
    {
        $sql = 'SELECT id, nome, email, senha FROM users WHERE id = ' . $id . ' LIMIT 1';
        $result = $this->conn->query($sql);

        return $this->montaUser(
            $result->fetch_assoc()
        );

    }
    public function buscaPorEmail(string $email): bool
    {
        $sql = 'SELECT id, nome, email, senha FROM users WHERE email = ' . "'{$email}'" . ' LIMIT 1';

        $result = $this->conn->query($sql);

        $assoc = $result->fetch_assoc();

        if (!is_null($assoc)) {
            return true;
        } else {
            return false;
        }
    }
    public function buscaLogin(string $email): User
    {
        $sql = 'SELECT id, nome, email, senha FROM users WHERE email = ' . "'{$email}'" . ' LIMIT 1';

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
