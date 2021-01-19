<?php namespace App\Core;

/**
 * Clase padre de controlles
 */
class Controller
{

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
            'views' => $view,
            'data' => $params
        ];
    }
}