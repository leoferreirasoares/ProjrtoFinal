<?php
namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Usuario as Usuario;


class UsuarioController {

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
     * Listagem de usuarios
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listUsuario($request, $response, $args) {
        $usuario = new Usuario();
        $usuarios = $usuario->listar();
        $return = $response->withJson($usuarios, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }   
   /**
     * Listagem de usuarios
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function logarUsuario($request, $response, $args) {
        $params = (object) $request->getParams();
        $usuario = new Usuario();     
        $return = $response->withJson($usuario->logar($params), 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }  
    
}