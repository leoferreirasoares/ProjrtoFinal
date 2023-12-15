<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Cliente;

class ClienteController {
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
    public function listaCliente($request, $response, $args) {
        $clinte = new Cliente();
        $clientes = $clinte->listar();
        $return = $response->withJson($clientes, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }
    
    /**
     * Cria um cliente
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function criarCliente($request, $response, $args) {
        $params = (object) $request->getParams();
        $cliente = new Cliente();
        $return = $response->withJson($cliente->salvar($params), 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }
}
