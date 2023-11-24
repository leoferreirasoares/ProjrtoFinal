<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Agendamento;
/**
 * Description of AgendamentoController
 *
 * @author leo
 */
class AgendamentoController {
     /**
     * Container Class
     * @var [object]
     */
    private $container;
    
    /**
     * Undocumented function
     * @param [object] $container
     */
    public function __construct($container) {
        $this->container = $container;        
    }
    
    /**
     * Listagem de agendamentos
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listaAgendamento($request, $response, $args) {
        $agendamento = new Agendamento();
        $reservas = $agendamento->listar();
        $return = $response->withJson($reservas, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }    
    
    /**
     * Cria um agendamento
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function criarAgendamento($request, $response, $args) {
        $params = (object) $request->getParams();
        $agendamento = new Agendamento;
        $return = $response->withJson($agendamento->salvar($params), 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }
    /**
     * Update status
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function updateStatusAgendamento($request, $response, $args) {
        $params = (object) $request->getParams();
        $agendamento = new Agendamento;
        $return = $response->withJson($agendamento->updateStatus($params), 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }
    /**
     * Lista horario inicio
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listaHoraInicio($request, $response, $args) {
        $params = (object) $request->getParams();
        $agendamento = new Agendamento;
        $return = $response->withJson($agendamento->listaHoraInicio($params), 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }
}
