<?php namespace App\Database;

use PDO;
use App\Database\Conexion;

class Repo
{
    public static function fetchAll($query, $params)
    {
        Conexion::openConexion();
        $conexion = Conexion::getConexion();
        $sentencia = $conexion->prepare($query);
        foreach($params as $param)
        {
            $sentencia->bindValue($param['bindName'], $param['bindValue'], PDO::PARAM_STR);
        }
        $sentencia->execute();        
        Conexion::closeConexion();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetch($query, $params)
    {
        Conexion::openConexion();
        $conexion = Conexion::getConexion();
        $sentencia = $conexion->prepare($query);
        foreach($params as $param)
        {
            $sentencia->bindValue($param['bindName'], $param['bindValue'], PDO::PARAM_STR);
        }
        $sentencia->execute();        
        Conexion::closeConexion();
        return $sentencia->fetch(PDO::FETCH_ASSOC);
    }

}