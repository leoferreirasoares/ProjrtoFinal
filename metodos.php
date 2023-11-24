<?php
if($_POST['metodo'] == 'buscaAgendamentos'){
    echo buscaAgendamentos();
}else if($_POST['metodo'] == 'concluirAgendamentos'){
    echo concluirAgendamentos($_POST['id']);
}else if($_POST['metodo'] == 'cancelarAgendamentos'){
    echo cancelarAgendamentos($_POST['id']);
}else if($_POST['metodo'] == 'listarClientes'){
    echo listarClientes();
}else if($_POST['metodo'] == 'listarServicos'){
    echo listarServicos();
}else if($_POST['metodo']=='listarProfissionais'){
    echo listarProfissionais();
}else if($_POST['metodo']=='horarioDisponivel'){
    echo listarHorariosInicio($_POST['idProfissional'],$_POST['dataSelecionada']);
}else if($_POST['metodo']=='agendar'){
    echo agendar($_POST['idCliente'],$_POST['idUsuario'],$_POST['data'],$_POST['idHorario'],$_POST['idservico']);
}
function buscaAgendamentos(){
    $headers = array(
    'Content-Type: application/json'
    );
    $dadosReserva = curl_init();
           curl_setopt($dadosReserva, CURLOPT_URL, 'https://techbarber.com.br/app/agendamento');
           curl_setopt($dadosReserva, CURLOPT_CUSTOMREQUEST, "GET");
           curl_setopt($dadosReserva, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($dadosReserva, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($dadosReserva, CURLOPT_SSL_VERIFYPEER, false);
           $resultreservas = curl_exec($dadosReserva);
    return montaConsultaAgendamentos(json_decode($resultreservas));
}

function montaConsultaAgendamentos($dados){
    $table = '';
    foreach ($dados as $dadosAgendamento){
        $table.='<tr>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">'.$dadosAgendamento->data.'</td>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">'.$dadosAgendamento->horaInicio.'</td>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">'.$dadosAgendamento->horaFim.'</td>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">'.$dadosAgendamento->nomeUsuario.'</td>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">'.$dadosAgendamento->nomeCliente.'</td>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">'.$dadosAgendamento->nomeServico.'</td>';
        $table.='<td class="g-font-size-default g-color-black g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10">R$'.$dadosAgendamento->valor.'</td>';
        $table.='<td class="g-font-size-default g-color-white g-valign-middle g-brd-top-none g-brd-bottom g-brd-2 g-brd-gray-light-v4 g-py-10 ">';
        $table.='<a class="btn btn-sm u-btn-lightblue-v3 g-mr-10 g-mb-15 g-col text-center g-rounded-50 g-font-weight-600" onclick="ConcluirAtendimento('.$dadosAgendamento->id.')">';
        $table.='<i class="fa fa-check-circle g-mr-3"></i> Concluir </a>';
        $table.='<a class="btn btn-sm u-btn-red g-mr-10 g-mb-15 text-center g-rounded-50 g-font-weight-600" onclick="cancelarAgendamento('.$dadosAgendamento->id.')">';
        $table.='<i class="fa fa-trash g-mr-3"></i>Cancelar</a>';
        $table.='</td>';
        $table.='</tr>';
    }
    return $table;    
}
function concluirAgendamentos($id){
    $post = [
    "id" => $id,
    "status" =>4
];
 $headers = array(
'Content-Type: application/json'
);
$dadosStatus = curl_init();
curl_setopt($dadosStatus, CURLOPT_URL, 'https://techbarber.com.br/app/agendamento/status');
curl_setopt($dadosStatus, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($dadosStatus, CURLOPT_HTTPHEADER, $headers);
curl_setopt($dadosStatus, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dadosStatus, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($dadosStatus, CURLOPT_POSTFIELDS, json_encode($post));
$result = curl_exec($dadosStatus);
$resultStatus = json_decode($result);
    return $resultStatus->status;
}
function cancelarAgendamentos($id){
    $post = [
    "id" => $id,
    "status" =>0
    ];
     $headers = array(
    'Content-Type: application/json'
    );
    $dadosStatus = curl_init();
    curl_setopt($dadosStatus, CURLOPT_URL, 'https://techbarber.com.br/app/agendamento/status');
    curl_setopt($dadosStatus, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($dadosStatus, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($dadosStatus, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($dadosStatus, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($dadosStatus, CURLOPT_POSTFIELDS, json_encode($post));
    $result = curl_exec($dadosStatus);
    $resultStatus = json_decode($result);
    return $resultStatus->status;
}
function listarClientes(){
     $headers = array(
    'Content-Type: application/json'
    );
    $dadosCliente = curl_init();
           curl_setopt($dadosCliente, CURLOPT_URL, 'https://techbarber.com.br/app/cliente');
           curl_setopt($dadosCliente, CURLOPT_CUSTOMREQUEST, "GET");
           curl_setopt($dadosCliente, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($dadosCliente, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($dadosCliente, CURLOPT_SSL_VERIFYPEER, false);
           $resultClientes = curl_exec($dadosCliente);
    return montaSelectClientes(json_decode($resultClientes));    
}
function montaSelectClientes($clientes){
    $select = '<option valeu=""selected></option>';
    foreach ($clientes as $dadosClientes){
         $select.='<option value="'.$dadosClientes->id.'">'.$dadosClientes->nome.'</option>';
    }
    return $select;    
}
function listarServicos(){
     $headers = array(
    'Content-Type: application/json'
    );
    $dadosServico = curl_init();
           curl_setopt($dadosServico, CURLOPT_URL, 'https://techbarber.com.br/app/servico');
           curl_setopt($dadosServico, CURLOPT_CUSTOMREQUEST, "GET");
           curl_setopt($dadosServico, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($dadosServico, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($dadosServico, CURLOPT_SSL_VERIFYPEER, false);
           $resultServicos = curl_exec($dadosServico);
    return montaSelectServico(json_decode($resultServicos));    
}
function montaSelectServico($Servicos){
    $select = '<option valeu=""selected></option>';
    foreach ($Servicos as $dadosServicos){
        $select.='<option value="'.$dadosServicos->id.'">'.$dadosServicos->nome.'</option>';
    }
    return $select;    
}
function listarProfissionais(){
     $headers = array(
    'Content-Type: application/json'
    );
    $dadosProfissionais = curl_init();
           curl_setopt($dadosProfissionais, CURLOPT_URL, 'https://techbarber.com.br/app/usuario');
           curl_setopt($dadosProfissionais, CURLOPT_CUSTOMREQUEST, "GET");
           curl_setopt($dadosProfissionais, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($dadosProfissionais, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($dadosProfissionais, CURLOPT_SSL_VERIFYPEER, false);
           $resultProfissionais = curl_exec($dadosProfissionais);
    return montaSelectServico(json_decode($resultProfissionais));    
}
function montaSelectProfissional($profissionais){
    $select = '<option valeu=""selected></option>';        
    foreach ($profissionais as $dadosProfissional){
        $select.='<option value="'.$dadosProfissional->id.'">'.$dadosProfissional->nome.'</option>';
    }
    return $select;    
}
function listarHorariosInicio($idProfissional,$data){
    $post = [
    "id" => $idProfissional,
    "data" => $data
];
 $headers = array(
'Content-Type: application/json'
);
$dadosHoraInicio = curl_init();
curl_setopt($dadosHoraInicio, CURLOPT_URL, 'https://techbarber.com.br/app/agendamento/listaHoraInicio');
curl_setopt($dadosHoraInicio, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($dadosHoraInicio, CURLOPT_HTTPHEADER, $headers);
curl_setopt($dadosHoraInicio, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dadosHoraInicio, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($dadosHoraInicio, CURLOPT_POSTFIELDS, json_encode($post));
$result = curl_exec($dadosHoraInicio);
$resulthoraInicio = json_decode($result);
return montaSelectHoraInicio($resulthoraInicio);    
}
function montaSelectHoraInicio($horarios){
    $select = '<option valeu=""selected></option>';
    foreach ($horarios as $dadosHorariInicio){
        $select.='<option value="'.$dadosHorariInicio->id.'">'.$dadosHorariInicio->horaInicio.' às '.$dadosHorariInicio->horaFim.'</option>';
    }
    return $select;    
}
function agendar($idCliente,$idUsuario,$data,$idHorario,$idServico){
    $post = [
    "idCliente" => $idCliente,
    "idUsuario" =>$idUsuario,
    "data" =>$data,
    "idHorario" =>$idHorario,
    "idservico" =>$idServico
    ];
     $headers = array(
    'Content-Type: application/json'
    );
    $dadosStatus = curl_init();
    curl_setopt($dadosStatus, CURLOPT_URL, 'https://techbarber.com.br/app/agendamento');
    curl_setopt($dadosStatus, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($dadosStatus, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($dadosStatus, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($dadosStatus, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($dadosStatus, CURLOPT_POSTFIELDS, json_encode($post));
    $result = curl_exec($dadosStatus);
    $resultStatus = json_decode($result);
    return $resultStatus->status;
    
}