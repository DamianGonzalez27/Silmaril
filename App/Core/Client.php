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
            $controller = new $this->controllers[$arrayController[0]]($this->controller);

            if(isset($this->controller['request']))
            {
                $request = new $this->requests[$this->controller['request']]($this->request);

                return $controller->$method($request);
            }
            else
            {
                return $controller->$method();
            }            
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
            $middleware = new $this->middlewares[$controller['middleware']]($this->request);

            return $middleware->run();
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
        
        $arrayPath = explode("/", $path);

        if(count($arrayPath) > 2 && count($arrayPath) < 4)
        {
            if($arrayPath[2] === "")
            {
                return self::validatePaths($data, $method, "/".$arrayPath[1]);
            }
            else
            {   
                if(isset($data[$method]["/".$arrayPath[1]]['sub-routes']))
                {
                    if(in_array($arrayPath[2], $data[$method]["/".$arrayPath[1]]['sub-routes']))
                    {
                        return self::validatePaths($data, $method, "/".$arrayPath[1]);
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }
        }
        else if(count($arrayPath)>4)
        {
            return false;
        }
        else
        {
            return self::validatePaths($data, $method, $path);
        }
    }

      /**
     * Metodo de preparacion de una sola ruta
     * 
     * @param array $data Datos de configuracion
     * @param string $method Metodo de la peticion
     * @param string $path Path de la ruta de acceso
     */
    private static function validatePaths($data, $method, $path)
    {
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
