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

    /**
     * Retorna o status da resposta.
     *
     * @return string O status da resposta (texto).
     */
    public function getStatus () : string {
        return $this->status;
    }

    /**
     * Retorna a mensagem da resposta.
     *
     * @return string A mensagem da resposta (texto).
     */
    public function getMessage () : string {
        return $this->message;
    }

    /**
     * Retorna os dados da resposta.
     *
     * @return mixed Os dados da resposta (pode ser de qualquer tipo).
     */
    public function getData () {
        return $this->data;
    }

}

class ConexaoMySQL {
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $conexao;

    public function __construct($host, $user, $password, $dbname) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function conectar() {
        try {
            // Configurar a string de conexão para MySQL
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);

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
