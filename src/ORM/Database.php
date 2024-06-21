<?php

namespace RevendaTeste\ORM;

class Database
{

    /**
     * Undocumented variable
     *
     * @var \mysqli
     */
    private \mysqli $conn;

    /**
     * Undocumented variable
     *
     * @var array
     */
    private array $config = [
        'host',
        'user',
        'pswd',
        'database',
    ];

    /**
     * Essa função é chamada toda vez que essa classe é instanciada
     * 
     * @param $config = [
     *  'host'
     *  'user'
     *  'pswd'
     *  'db'
     * ]
     */
    public function __construct(array $config = [])
    {
        $this->setConfig(array_merge([
            'host' => 'localhost',
            'user' => 'root',
            'pswd' => '',
            'db' => 'revendacarros_db',
        ], $config))->connect();
    }

    public function setConfig(array $config): Database
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Realiza a conexão com o banco de dados
     */
    public function connect()
    {
        $this->conn = mysqli_connect($this->config['host'], $this->config['user'], $this->config['pswd'], $this->config['db']);
    }

    /**
     * Undocumented function
     *
     * @return bool
     */
    public function disconnect(): bool
    {
        return mysqli_close($this->conn);
    }

    /**
     * Undocumented function
     *
     * @return \mysqli
     */
    public function getConnection(): \mysqli
    {
        return $this->conn;
    }
}



// /**
//  * Nome de Servidor do banco de dados
//  *
//  * @var string
//  */
// private string $nomeServidor;

// /**
//  * Nome de usuário do banco de dados 
//  *
//  * @var string
//  */
// private string $nomeUsuario;

// /**
//  * Senha do banco de dados
//  *
//  * @var string
//  */
// private string $senha;

// /**
//  * Nome do banco de dados
//  *
//  * @var string
//  */
// private string $nomeBanco;

// /**
//  * Status de conexão do banco de dados
//  *
//  * @var mysqli
//  */
// private mysqli $conn;



// public function setServidor(string $nomeServidor): \RevendaTeste\ORM\DataBase
// {
//     $this->$nomeServidor = $nomeServidor;

//     return $this;
// }

// public function getServidor(): string
// {
//     return $this->nomeServidor;
// }

// public function setUsuario(string $nomeUsuario): \RevendaTeste\ORM\DataBase
// {
//     $this->$nomeUsuario = $nomeUsuario;

//     return $this;
// }

// public function getUsuario(): string
// {
//     return $this->nomeUsuario;
// }

// public function setSenha(string $senha): \RevendaTeste\ORM\DataBase
// {
//     $this->senha = $senha;

//     return $this;
// }

// public function getSenha(): string
// {
//     return $this->senha;
// }

// public function setBanco(string $nomeBanco): \RevendaTeste\ORM\Database
// {
//     $this->nomeBanco = $nomeBanco;

//     return $this;
// }

// public function getBanco(): string
// {
//     return $this->nomeBanco;
// }

// public function setConn(mysqli $conn): mysqli
// {
//     $this->conn = $conn;

//     return $this->conn;
// }

// public function getConn(): mysqli
// {
//     return (is_null($this->conn)) ? new mysqli() : $this->conn;
// }

// public function setConexao(mysqli $conn): mysqli
// {
// $nomeServidor = "localhost";
// $nomeUsuario = "root";
// $senha = "";
// $nomeBanco = "revendacarros_db";

//     try {
//         $conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
//     } catch (\Exception $e) {
//         echo 'Conexão falhou: ' . $conn->connect_error;
//         die;
//     }
//     return;
// }





// define('DS', DIRECTORY_SEPARATOR);

// $nomeServidor = "localhost";
// $nomeUsuario = "root";
// $senha = "";
// $nomeBanco = "revendacarros_db";



// $conn = new mysqli($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
// if ($conn->connect_error) {
//     die("Conexão Falhou: " . $conn->connect_error);
// }

// require_once (realpath(dirname(__FILE__) . '/') . DS . 'functions.php')
