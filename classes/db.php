<?php

//Classe do Banco de dados e conexão
class Banco{
    //Encapsular o Banco
    private $host;
    private $user;
    private $password;
    private $db;

    public function connect(){
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        $this->db = "joytec";

        //Se houver Conexão
        try{
            //Conexão via PDO
            $connection = new PDO("mysql: host=".$this->host.";dbname=".$this->db, $this->user, $this->password);
            
            //retorne ela
            return $connection;
        }

        //Se não, mostre o erro
        catch(PDOExpection $e){
            echo("Erro: ".$e->getMessage());
        }
    }
}

?>