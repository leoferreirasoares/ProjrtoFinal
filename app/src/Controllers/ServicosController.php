<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Servicos;

class ServicosController {
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
     * Listagem de clientes
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listaServicos($request, $response, $args) {
        $servico = new Servicos();
        $servicos = $servico->listar();
        $return = $response->withJson($servicos, 200)
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
    public function Calculacomissao($request, $response, $args) {
        $params = (object) $request->getParams();
        $servicos = new Servicos;
        $return = $response->withJson($servicos->calcularComissao($params), 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }
}
