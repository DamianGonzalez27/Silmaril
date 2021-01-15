<?php 

/**
 * @author DamianDev <damian27goa@gmail.com>
 * 
 * Este documento se encarga de hacer la carga de las librerias iniciales del proyecto
 * 
 * 1.- Se carga la libreria de manejo de plantillas PHP Plates
 * 2.- Se carga la libreria de manejo de errores Whoops
 * 
 */

session_start();

$templates = new \League\Plates\Engine('../views');
$templates->loadExtension(new League\Plates\Extension\URI($_SERVER['SERVER_NAME']));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/**
 * Funcion general dump and die
 * 
 * @param any Parametro general
 * 
 */
function dd($params)
{
    echo "<pre style='background-color: black; color: green;'>";
    die(
        var_dump($params)
    );  
}