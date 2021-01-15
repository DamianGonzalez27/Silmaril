<?php namespace App\Core;

/**
 * Clase maestra de Middlewares
 * 
 * Esta es una clase abstracta que implementa el metodo abstracto publico run
 * 
 * @method abstract run 
 */
abstract class Middleware
{
    /**
     * @param class Request
     */
    public $request;

    /**
     * Constructor de los metodos Middleware
     * 
     * Al momento que un middleware es invocado el constructor de esta clase recibe como parametro 
     * el objeto request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Metodo abstracto 
     * 
     * Este metodo debe ser implementado en todas las clases middleware del sistema
     */
    abstract public function run();
}