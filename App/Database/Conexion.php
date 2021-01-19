<?php namespace App\Database;

use PDO;
use PDOException;

/**
 * Clase de conexion con base de datos
 * 
 * Esta clase tiene la unica responsabilidad de gestionar las conexiones con la base de datos
 */
class Conexion
{

    /**
     * @param class Clase Conexion
     */
    private static $conexion;

    /**
     * Metodo abrir conexion
     * 
     * Este metodo establece una conexion con la base de datos
     * 
     * @see https://www.php.net/manual/es/book.pdo.php
     */
    public static function openConexion()
    {
        if(!isset(self::$conexion))
        {
            try
            {
                self::$conexion = new PDO('mysql:host='.CONFIGS['database']['server'].'; dbname='.CONFIGS['database']['name'], CONFIGS['database']['user'], CONFIGS['database']['pass']);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET CHARACTER SEt utf8");
            }
            catch(PDOException $e)
            {
                print "Error con la conexion a la base de datos: " .$e->getMessage();
                die;
            }
        }
    }

    /**
     * Metodo para obtener la conexion
     * 
     * Este metodo retorna una instancia de la conecion PDO de la base
     * 
     * @return class Conexion
     */
    public static function getConexion()
    {
        return self::$conexion;
    }

    /**
     * Metodo para cerrar la conexion
     * 
     * Este metodo valida si la conexion esta abierta y si esta abierta retorna null
     * 
     * @return null 
     */
    public static function closeConexion()
    {
        if(isset(self::$conexion))
        {
            self::$conexion = null;
        }
    }
}