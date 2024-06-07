<?php

class Conexao
{
    //set das variaveis e parametros que o PDO precisa
    private $host = 'localhost';
    private $dbname = 'php_com_pdo';
    private $user = 'root';
    private $pass = '';

//iniciando o teste de conexão e criando o metodo de conexão utilizando os parametros já setados acima
    public function conectar()
    {
        try {
          
            $conexao = new PDO(
              "mysql:host=$this->host;dbname=$this->dbname",
              "$this->user",
              "$this->pass"
              
            );
            return $conexao;
        } catch (PDOException $e) {
          //exibindo o erro.
          echo '<p>Error: '.$e->getMessage().'</p>';
        }
    }

}

?>