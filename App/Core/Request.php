<?php namespace App\Core;

/**
 * Clase abstracta Request
 * 
 * Esta clase hereda sus propiedades a todas las clases Request
 */
abstract class Request
{
    /**
     * @param class Request
     */
    private $request;

    /**
     * @param array Arreglo con los parametros enviados
     */
    private $params;

    private $errors = null;

    /**
     * Metodo constructor
     */
    public function __construct($request)
    {
        $this->request = $request;

        $this->params = json_decode($request->getContent(), true);
    }

    /**
     * Funcion abstracta comun de todas las clases Request hijas
     */
    abstract public function run();

    /**
     * Funcion publica para retornar views
     * 
     * @param string $nameParam Nombre del parametro a acceder
     * 
     * @return string Valor del parametro recibido
     */
    public function getParam($nameParam)
    {
        return $this->params[$nameParam];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Funcion validadora de requests
     * 
     * Este metodo tiene el objetivo de validar los parametros recibidos del request
     * 
     * @return boolean Retorna un valor false o true
     */
    public function validate()
    {
        foreach($this->run() as $param => $key)
        {
            $this->validateParam($param, explode("|", $key));
        }

        if(is_null($this->errors))
        {
            return true;
        }
        return false;
    }

    /**
     * Funcion validadora de reglas
     * 
     * @param string $param Nombre del parametro a validar
     * @param array $rules Conjunto de reglas a validar
     */
    private function validateParam($param, $rules)
    {
        foreach($rules as $rule)
        {
            switch($rule)
            {
                case 'required':
                    $this->validateRequired($this->params[$param], $param);
                break;
            }
        }
    }

    /**
     * Funcion que valida si un parametro existe o no
     * 
     * @param string $param Valor del parametro a verificar
     * @param string $paramName Nombre del parametro a validar
     */
    private function validateRequired($param, $paramName)
    {
        if($param === '' or $param === "")
        {
            $this->errors['error'][$paramName] = "El parametro ".$paramName." es obligatorio";
        }
    }
}