<?php

namespace App\Models;

require './config/Config.php';

class Usuario{ 
    private $id;
    private $idTipoUsuario;
    private $nome;
    private $email;
    private $senha;
    private $idComissao;
    
    public function getId() {
        return $this->id;
    }

    public function getIdTipoUsuario() {
        return $this->idTipoUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getIdComissao() {
        return $this->idComissao;
    }

    

    public function setIdTipoUsuario($idTipoUsuario): void {
        $this->idTipoUsuario = $idTipoUsuario;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setSenha($senha): void {
        $this->senha = $senha;
    }

    public function setIdComissao($idComissao): void {
        $this->idComissao = $idComissao;
    }
    public function logar($params){
        $pdo = conectaPDO();
       try {
            $usuarios = $pdo->query("select * from usuarios where email='$params->email' and senha = '$params->senha'")->fetchAll();
            if(count($usuarios) > 0){ 
                foreach ($usuarios as $usu){
                 $id = $usu['id']; 
                }
                $array = $this->buscaUsuario($id);
            }else{
                $array = ["status"=>0,"id"=>'',"erro"=>'Usuário ou senha incorretos'];
            }            
        } catch (Exception $ex) {
            $array = ["status"=>0,"id"=>'',"erro"=>$ex];
        }
        return $array;
    }
    public function listar(){
        $pdo = conectaPDO();
        $usuarios = $pdo->query("select * from usuarios where (idTipoUsuario = 4 or idTipoUsuario = 5)")->fetchAll();
        foreach ($usuarios as $usu){
            $array[] =[
                "id"       =>$usu['id'],
                "nome"     =>$usu['nome'],
                "email"    =>$usu['email'],
            ];
        }
        return $array;
    }
    public function buscaUsuario($id){
        $pdo = conectaPDO();
        if($id > 0){
            $usuarios = $pdo->query("select * from usuarios where id = $id")->fetchAll();
            foreach ($usuarios as $usu){
                $array =[
                    "id"            =>$usu['id'],
                    "nome"          =>$usu['nome'],
                    "email"         =>$usu['email'],
                    "idTipoUsuario" =>$usu['idTipoUsuario'],
                    "idComissao"    =>$usu['idComissao'],
                    "status"        =>1,
                    "erro"          =>''
                    
                ];
            }
        }else{
            $array =[
                    "status"        =>0,
                    "erro"          =>'nenhum registro encontrado'
                    
                ];
        }        
        return $array;
    }
    
    
}
