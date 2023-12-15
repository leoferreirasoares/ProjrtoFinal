<?php

namespace App\Models;

require './config/Config.php';

class Cliente{ 
    private $id;
    private $nome;
    private $telefone;    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setTelefone($telefone): void {
        $this->telefone = $telefone;
    }

        
    public function listar(){
        $pdo = conectaPDO();
        $clientes = $pdo->query("SELECT * FROM clientes")->fetchAll();
        foreach ($clientes as $cli){
            $array[] =[
                "id"                =>$cli['id'],
                "nome"              =>$cli['nome'],
                "telefone"          =>$cli['telefone'],
            ];
        }
        return $array;
    }
    
    public function salvar($params){
        $pdo = conectaPDO();
        try {
            $insere =$pdo->prepare("
                insert into clientes
                      (nome,telefone)
                VALUES(:nome,:telefone)");
            $insere->bindValue(":nome", $params->nome);
            $insere->bindValue(":telefone", $params->telefone);
            $insere->execute();
            $idCliente =  $pdo->lastInsertId();
            $array = ["status"=>1,"id"=>id];
        } catch (Exception $ex) {
            $array = ["status"=>0,"id"=>''];
        }        
        return $array;
    }
    
}
