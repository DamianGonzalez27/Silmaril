<?php namespace App\Core;

use App\Core\RouteList;

/**
 * Clase cliente
 * 
 * Esta clase es responsable de 2 funciones estaticas especificas
 * 
 * @method getClient
 * @method getDataControllers
 */
class Client extends RouteList
{
    /**
     * @param class Request
     */
    private $request;
    
    /**
     * @param array Informacion del controlador
     */
    private $controller;

    /**
     * Metodo constructor de la clase
     * 
     * @param class Clase Request
     * @param array Areglo con la informacion del controlador
     * 
     */
    public function __construct($request, $controller)
    {
        $this->request = $request;
        $this->controller = $controller;
    }

    /**
     * Metodo para obtencion de informacion del controller
     * 
     * @param string $arrayController[0] Indica el nombre del controlador
     * @param string $arrayController[1] Indica el nombre del metodo a invocar
     * 
     * @return template Puede retornar un template
     * @return array Puede regresar un arreglo para parsear a JSON
     */
    public function getClient()
    {
        $arrayController = explode("@", $this->controller['controller']);
        $method = $arrayController[1];
        $middleware = $this->middleware($this->controller);

        if(isset($middleware['accept']))
        {
            $controller = new $this->controllers[$arrayController[0]]($this->request);

            return $controller->$method();
        }
        else
        {
            return $middleware;
        }
    }

    /**
     * Funcion que valida los middlewares configurados para el controlador
     * 
     * Validamos si existe uno o una lista de middlewares
     * 
     * @return boolean Retorna un valor boleano false si las comprobaciones fallan
     * @return array Retorna un array 
     */
    private function middleware($controller)
    {
        if(isset($controller['middleware']))
        {
            if(is_array($controller['middleware']))
            {

            }
            else
            {
                $middleware = new $this->middlewares[$controller['middleware']]($this->request);

                return $middleware->run();
            }
        }
        else
        {
            return [
                'accept' => true
            ];
        }
    }

    /**
     * Metodo de validacion de controladores
     * 
     * Este metodo define el total de los controladores de la aplicacion, el documento que contiene esta
     * informacion es llamado mediante la ruta del documento
     * 
     * @provider Routes.json
     */
    public static function getDataControllers($method, $path)
    {
        $data = json_decode(@file_get_contents("../App/Routes.json"), true);

        if(isset($data[$method][$path]))
        {
            return $data[$method][$path];
        }
        else
        {
            return false;
        }
    }
}
