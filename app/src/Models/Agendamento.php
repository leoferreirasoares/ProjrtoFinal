<?php
namespace App\Models;
require_once 'config/Config.php';
require_once 'config/funcoes.php';
class Agendamento{    
    
    private $id;
    private $idCliente;
    private $idUsuario;
    private $data;
    private $horaInicio;
    private $horaFim;
    private $checkin;
    private $inicio;
    private $conclusao;
    private $dataInc;
    private $idUsuInc;
    
    
    public function getId() {
        return $this->id;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getData() {
        return $this->data;
    }

    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function getHoraFim() {
        return $this->horaFim;
    }

    public function getCheckin() {
        return $this->checkin;
    }

    public function getInicio() {
        return $this->inicio;
    }

    public function getConclusao() {
        return $this->conclusao;
    }

    public function getDataInc() {
        return $this->dataInc;
    }

    public function getIdUsuInc() {
        return $this->idUsuInc;
    }

    public function setIdCliente($idCliente): void {
        $this->idCliente = $idCliente;
    }

    public function setIdUsuario($idUsuario): void {
        $this->idUsuario = $idUsuario;
    }

    public function setData($data): void {
        $this->data = $data;
    }

    public function setHoraInicio($horaInicio): void {
        $this->horaInicio = $horaInicio;
    }

    public function setHoraFim($horaFim): void {
        $this->horaFim = $horaFim;
    }

    public function setCheckin($checkin): void {
        $this->checkin = $checkin;
    }

    public function setInicio($inicio): void {
        $this->inicio = $inicio;
    }

    public function setConclusao($conclusao): void {
        $this->conclusao = $conclusao;
    }

    public function setDataInc($dataInc): void {
        $this->dataInc = $dataInc;
    }

    public function setIdUsuInc($idUsuInc): void {
        $this->idUsuInc = $idUsuInc;
    }
    
    public function listar(){
        $pdo = conectaPDO();
        $agendamentos = $pdo->query("select
                                    a.id,
                                    a.data,
                                    h.horaInicio,
                                    h.horaFim,
                                    a.checkin,
                                    a.inicio,
                                    a.conclusao,
                                    u.id as idUsuario,
                                    u.nome as nomeUsuario,
                                    c.id as idCliente,
                                    c.nome as nomeCliente,
                                    s.id as idServico,
                                    s.nome as nomeServico,
                                    s.valor,
                                    s.duracao
                                    from agendamentos a
                                    join usuarios u on u.id = a.idUsuario
                                    join clientes c on c.id = a.idCliente
                                    join itensagendamento i on i.idAgendamento = a.id
                                    join servicos s on s.id = i.idservico
                                    join horarios h on h.id = a.idhorario
                                    where a.status = 1
                                    order by  a.data,h.id")->fetchAll();
        foreach ($agendamentos as $ag){
            $array[] =[
                "id"            =>$ag['id'],
                "idCliente"     =>$ag['idCliente'],
                "idUsuario"     =>$ag['idUsuario'],
                "data"          => dataUsuario10Caracteres($ag['data']),
                "horaInicio"    =>$ag['horaInicio'],
                "horaFim"       =>$ag['horaFim'],
                "inicio"        =>$ag['inicio'],
                "checkin"       =>$ag['checkin'],
                "conclusao"     =>$ag['conclusao'],
                "nomeUsuario"   =>$ag['nomeUsuario'],
                "nomeCliente"   =>$ag['nomeCliente'],
                "idServico"     =>$ag['idServico'],
                "nomeServico"   =>$ag['nomeServico'],
                "valor"         => formatavalorusuario($ag['valor']),
                "duracao"       =>$ag['duracao'],               
            ];
        }
        return $array;
    }
    public function salvar($params){
        $pdo = conectaPDO();
        try {
            $insere =$pdo->prepare("
                insert into agendamentos
                      (idCliente,idUsuario,data,idHorario)
                VALUES(:idCliente,:idUsuario,:data,:horario)");
            $insere->bindValue(":idCliente", $params->idCliente);
            $insere->bindValue(":idUsuario", $params->idUsuario);
            $insere->bindValue(":data", $params->data);
            $insere->bindValue(":horario", $params->idHorario);
            $insere->execute();
            $idAgendamento =  $pdo->lastInsertId();
            $insereServicos =$pdo->prepare("
                INSERT INTO itensagendamento
                        (idAgendamento, idservico)
                VALUES (:idAgendamento, :idservico)");
            $insereServicos->bindValue(":idAgendamento", $idAgendamento);
            $insereServicos->bindValue(":idservico", $params->idservico);
            $insereServicos->execute();
            $array = ["status"=>1,"id"=>$idAgendamento];
        } catch (Exception $ex) {
            $array = ["status"=>0,"id"=>''];
        }
        
        return $array;
    }
    public function updateStatus($params){
        $pdo = conectaPDO();
        try {
            $update =$pdo->prepare("
                update agendamentos set status = :status where id =:id");
            $update->bindValue(":id", $params->id);
            $update->bindValue(":status", $params->status);
            $update->execute();
            $array = ["status"=>1,'erro' =>''];
        } catch (Exception $ex) {
            $array = ["status"=>0,"erro"=>$ex];
        }        
        return $array;
    }
    public function listaHoraInicio($params){
        $pdo = conectaPDO();
        try {
            $horaInicio =$pdo->prepare("select * from horarios h
                                        where 
                                        h.id NOT IN(select idHorario from agendamentos
                                        where 
                                            idHorario = h.id
                                            and idUsuario = :idUsuario
                                            and data =:data
                                            and (status = 1 or status = 4))
                                    ");
            $horaInicio->bindValue(":idUsuario", $params->id);
            $horaInicio->bindValue(":data", $params->data);
            $horaInicio->execute();
            foreach ($horaInicio as $hr){
                $array[] =[
                    "horaInicio" =>$hr['horaInicio'],
                    "horaFim" =>$hr['horaFim'],
                    "id" => $hr['id']
                ];
            }
        } catch (Exception $ex) {
            
            $array = ["status"=>0,"erro"=>$ex];
        }        
        return $array;
    }
    

}
