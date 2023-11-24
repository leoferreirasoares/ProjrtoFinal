<?php

namespace App\Models;

require './config/Config.php';

class Servicos{ 
    private $id;
    private $nome;
    private $valor;
    private $duracao;
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getDuracao() {
        return $this->duracao;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setValor($valor): void {
        $this->valor = $valor;
    }

    public function setDuracao($duracao): void {
        $this->duracao = $duracao;
    }

    public function listar(){       
        $pdo = conectaPDO();
        $servicos = $pdo->query("select * from servicos")->fetchAll();
        foreach ($servicos as $serv){
            $array[] =[
                "id"       =>$serv['id'],
                "nome"     =>$serv['nome'],
                "valor"    =>$serv['valor'],
                "duracao"    =>$serv['duracao']
            ];
        }
        return $array;
    }
    public function calcularComissao($params){
        $pdo = conectaPDO();
        try {
            if(empty($params->data)){
                $dataCalcular = date('Y-m-d');
            }else{
                $dataCalcular = $params->data;
            }
            $horaInicio =$pdo->prepare("SELECT
                            COUNT(*) as atendimento,
                            sum(s.valor)as total,
                            (sum(s.valor) * 0.50)as comissao,
                            u.nome as profissional
                            FROM agendamentos a
                            join itensagendamento i on i.idAgendamento = a.id
                            join servicos s on s.id = i.idservico
                            join usuarios u on u.id = a.idUsuario
                            WHERE 
                            a.status = 4 
                            and data = :data
                            group by u.nome
                                    ");
            $horaInicio->bindValue(":data", $dataCalcular);
            $horaInicio->execute();
            foreach ($horaInicio as $hr){
                $array[] =[
                    "atendimento" =>$hr['atendimento'],
                    "total" =>$hr['total'],
                    "comissao" => $hr['comissao'],
                    "profissional" => $hr['profissional']
                ];
            }
        } catch (Exception $ex) {
            
            $array = ["status"=>0,"erro"=>$ex];
        }        
        return $array;
    }
}
