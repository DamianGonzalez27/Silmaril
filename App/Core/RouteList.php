<?php namespace App\Core;

/**
 * Clase abstracta
 * 
 * En esta clase se enlistan todas las clases necesarias para instanciar los
 * controladores
 * 
 */

abstract class RouteList
{
    /**
     * Proveedor de controladores
     */
    public $controllers = [
        'PagesController' => \App\Controllers\PagesController::class
    ];

    /**
     * Proveedor de middlewares
     */
    public $middlewares = [
        'auth' => \App\Middlewares\AuthMiddleware::class
    ];

    /**
     * Proveedor de request
     */
    public $requests = [];
}