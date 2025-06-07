<?php

// COPIE este arquivo para `db.class.php` e preencha com credenciais!

class DB {

    private $host   = 'COLOQUE_SEU_HOST_AQUI';    // ex.: 'localhost'
    private $port   = 'COLOQUE_SUA_PORTA_AQUI';   // ex.: '3306'
    private $dbname = 'COLOQUE_SEU_BANCO_AQUI';   // ex.: 'printlab'
    private $user   = 'COLE_SEU_USUARIO_AQUI';    // ex.: 'root'
    private $pass   = 'COLE_SUA_SENHA_AQUI';      // ex.: 'minhaSenha'

    private $pdo;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset=utf8mb4";
            $this->pdo = new PDO(
                $dsn,
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            exit("Falha ao conectar ao banco: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
