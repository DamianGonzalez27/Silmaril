<?php namespace App\Core;

/**
 * Clase padre de controlles
 */
class Controller
{

    /**
     * @param class Clase Request
     */
    private $request;

    /**
     * Metodo constructor
     * 
     * Al ser creado cualquier controlador nuevo este metodo recibe el objeto $request como parametro 
     * y lo iguala a una variable publica para acceder a este objeto en cualquier controlador
     * 
     * @param class $request Clase Request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Metodo para retornar views
     * 
     * Este metodo tiene la principal funcion de retornar un arreglo con la informacion de view y 
     * parametros a enviar al front
     * 
     * @param string $view Nombre de la vista a retornar
     * @param array $params Parametros e informacion de parseo en el front
     * 
     * @return array Regresa un array con la informacion principal de la respuesta
     */
    public function getView($view, $params = null)
    {
        return [
            'view' => $view,
            'params' => $params
        ];
    }

    /**
     * Metodo para retornar respuestas en formato JSON
     * 
     * Este metodo es usado para devolver parametros en formato JSON al front
     */
    public function getResponse($params)
    {
        return $params;
    }
}