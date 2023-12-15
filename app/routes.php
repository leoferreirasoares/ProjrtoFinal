<?php

$app->group('/usuario', function() {
    $this->get('', '\App\Controllers\UsuarioController:listUsuario');
    $this->post('', '\App\Controllers\UsuarioController:createUsuario');
    $this->post('/logar', '\App\Controllers\UsuarioController:logarUsuario');
    /**
     * Validando se tem um integer no final da URL
     */
    $this->get('/{id:[0-9]+}', '\App\Controllers\UsuarioController:viewUsuario');
    $this->put('/{id:[0-9]+}', '\App\Controllers\UsuarioController:updateUsuario');
    $this->delete('/{id:[0-9]+}', '\App\Controllers\UsuarioController:deleteUsuario');
});
$app->group('/agendamento', function() {
    $this->get('', '\App\Controllers\AgendamentoController:listaAgendamento');
    $this->post('', '\App\Controllers\AgendamentoController:criarAgendamento');
    $this->post('/status', '\App\Controllers\AgendamentoController:updateStatusAgendamento');
    $this->post('/listaHoraInicio', '\App\Controllers\AgendamentoController:listaHoraInicio');
    
    $this->get('/{id:[0-9]+}', '\App\Controllers\AgendamentoController:viewUsuario');
    $this->put('/{id:[0-9]+}', '\App\Controllers\AgendamentoController:updateUsuario');
    $this->delete('/{id:[0-9]+}', '\App\Controllers\AgendamentoController:deleteUsuario');
});

$app->group('/cliente', function() {
    $this->get('', '\App\Controllers\ClienteController:listaCliente');
    $this->post('', '\App\Controllers\ClienteController:criarCliente');
});
$app->group('/servico', function() {
    $this->get('', '\App\Controllers\ServicosController:listaServicos');
    $this->post('/comissaoes', '\App\Controllers\ServicosController:Calculacomissao');
});
