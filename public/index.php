<?php
/**
 * @author DamianDev <damian27goa@gmail.com>
 * 
 * Archivo de carga y punto de inicio del proyecto
 * 
 * 1.- Se carga el documento autoload.php de composer
 * 2.- Se cargan las librerias generales del proyecto
 * 3.- Se crea una nueva instancia de la clase Genesis
 * 
 * @see https://getcomposer.org/
 * @see https://platesphp.com/
 * @see https://filp.github.io/whoops/
 */

 require_once "../vendor/autoload.php";

 require_once "../packages/Charger.php";

 $app = new \App\Core\Genesis($templates);

 $app->run(\Symfony\Component\HttpFoundation\Request::createFromGlobals());