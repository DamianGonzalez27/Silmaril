<?php namespace App\Core;

use App\Core\Routes;

/**
 * Clase Genesis
 * 
 * Esta clase tiene la unica responsabilidad de separar el tipo de peticion que se recibe por medio de HTTP
 * hace uso de la clase Routes
 * 
 * @see App\Core\Routes
 * 
 */
class Genesis
{
    /**
     * Clase de manipulacion de plantillas
     * 
     * @var class
     */
    private $templates;

    /**
     * Clase de manipulacion de rutas
     * 
     * @var class
     */
    private $routes;

    /**
     * @param class Clase Templates
     * 
     */
    public function __construct($templates)
    {
        $this->templates = $templates;
        $this->routes = new Routes($templates);
    }

    /**
     * Metodo de ejecucion
     * 
     * @param class Clase \Symfony\Component\HttpFoundation\Request
     * @see https://symfony.com/doc/current/components/http_foundation.html
     * 
     * Este metodo ejecuta la ruta de acuerdo al tipo de peticion recibida
     * 
     * [GET] => Metodo usado solo para manipulacion de rutas/views
     * [POST] => Metodo de acceso a data
     * 
     * Solo se admiten estos dos verbos
     */
    public function run($request)
    {
        switch($request->server->get('REQUEST_METHOD'))
        {
            case 'GET': 
                $this->routes->getResponse($request, $request->getPathInfo())->send();
            break;

            case 'POST': 
                $this->routes->postResponse($request, $request->getPathInfo())->send();
            break;

            default: 
                $this->routes->badResponse($request->server->get('REQUEST_METHOD'), 404)->send();
            break;
        }
    }
}