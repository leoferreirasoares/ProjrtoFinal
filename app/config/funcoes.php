<?php
function formatar_data_banco($pData){

    return date("Y-m-d",strtotime(str_replace('/', '-', $pData)));

}
function formatavalor($valor){
    $valor = number_format($valor,5,",",".");
    //$valor =  substr($valor , 0, $length-3);
    return $valor;
} 
function dataUsuario($datausu){
    $datausu = implode("/", array_reverse((explode("-",$datausu))));
    return $datausu;
}

function dataUsuario10Caracteres($datausucaract){
   $datausucaract = substr($datausucaract, 0, 10);
    $datausucaract = implode("/", array_reverse((explode("-",$datausucaract))));
    return $datausucaract;
}
function formatavalorusuario($valorusu){
    $valorusu = number_format($valorusu,2,",",".");
    //$valor =  substr($valor , 0, $length-3);
    return $valorusu;
} 
function trocavirgulaponto($valor){
   $retorno = str_replace(",",".",$valor);
   return $retorno;
}
function trocapontoporvirgula($valor){
   $retorno = str_replace(".",",",$valor);
   return $retorno;
}
