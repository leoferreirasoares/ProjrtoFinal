<?php
$post = [
    "email" => $_POST['usuario'],
    "senha" =>$_POST['senha']
];
 $headers = array(
'Content-Type: application/json'
);
$dadosLogar = curl_init();
curl_setopt($dadosLogar, CURLOPT_URL, 'https://techbarber.com.br/app/usuario/logar');
curl_setopt($dadosLogar, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($dadosLogar, CURLOPT_HTTPHEADER, $headers);
curl_setopt($dadosLogar, CURLOPT_RETURNTRANSFER, true);
curl_setopt($dadosLogar, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($dadosLogar, CURLOPT_POSTFIELDS, json_encode($post));
$result = curl_exec($dadosLogar);
$resultLogin = json_decode($result);
if($resultLogin->status == 1){
    session_start();
    $_SESSION['id'] = $resultLogin->id;
    $_SESSION['email']= $resultLogin->email;
    $_SESSION['perfil']= $resultLogin->idTipoUsuario;
    $_SESSION['nome']= $resultLogin->nome;
    $_SESSION['idComissao']= $resultLogin->idComissao;
 }
echo $resultLogin->erro;