<?php

namespace App\Models;

require './config/Config.php';

class Cliente{ 
    private $id;
    private $nome;
    private $email;
    private $telefone;    
    private $dataNascimanto;
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getDataNascimanto() {
        return $this->dataNascimanto;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setTelefone($telefone): void {
        $this->telefone = $telefone;
    }

    public function setDataNascimanto($dataNascimanto): void {
        $this->dataNascimanto = $dataNascimanto;
    }
    
    public function listar(){
        $pdo = conectaPDO();
        $clientes = $pdo->query("SELECT * FROM clientes")->fetchAll();
        foreach ($clientes as $cli){
            $array[] =[
                "id"                =>$cli['id'],
                "nome"              =>$cli['nome'],
                "email"             =>$cli['email'],
                "telefone"          =>$cli['telefone'],
                "dataNascimanto"    =>$cli['dataNascimanto'],
            ];
        }
        return $array;
    }

    
}
