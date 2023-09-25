<?php

class ApiResponse {
    public $status;
    public $message;
    public $data;

    public function __construct($status, $message, $data = null) {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}

class ConexaoMySQL {
    private $host = 'localhost'; // Host do banco de dados MySQL
    private $dbname = 'ascclub'; // Nome do banco de dados
    private $usuario = 'jonatas'; // Nome de usuário do MySQL
    private $senha = 'jon123'; // Senha do MySQL
    private $conexao;

    public function conectar() {
        try {
            // Configurar a string de conexão para MySQL
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->usuario, $this->senha);

            // Configurar o modo de erro do PDO para exceções
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Definir o conjunto de caracteres para UTF-8 (opcional)
            $this->conexao->exec("SET NAMES utf8");

            return $this->conexao;
        } catch (PDOException $e) {
            // Em caso de erro na conexão, trate a exceção aqui
            return new ApiResponse('error', "Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function desconectar() {
        $this->conexao = null; // Fecha a conexão
    }
}
