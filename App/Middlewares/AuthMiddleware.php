<?php namespace App\Middlewares;

use App\Core\Middleware;

/**
 * Middleware de autenticacion
 * 
 * Esta clase es responsable de validar si el usuario esta autenticado o no
 * 
 * Los middlewares solo contienen un unico metodo llamado run()
 * 
 * @method run
 */
class AuthMiddleware extends Middleware
{
    /**
     * Metodo run
     * 
     * Este es el metodo ejecutor del middleware, retorna un arreglo de configuracion o respuesta
     * 
     * @return array Config
     */
    public function run()
    {
        if(isset($_SESSION['user']))
        {
            return [
                'accept' => true
            ];
        }
        return [
            'errors' => [
                'error_code' => 403,
                'redirect' => '/'
            ]
        ];
    }
}