<?php namespace App\Core;

use App\Core\Client;
use App\Core\Response;

/**
 * Clase de manipulacion de rutas de acceso a informacion y views
 * 
 */
class Routes
{
    /**
     * @var class Clase templates
     */
    private $templates;

    /**
     * @var class Clase Response
     */
    private $response;

    /**
     * El metodo constructor recibe como parametro una instancia del objeto templates
     * 
     * @var class 
     */
    public function __construct($templates)
    {
        $this->templates = $templates;
        $this->response = new Response;
    }

    /**
     * Metodo de acceso a views
     * 
     * @return response Regresa un response con un template
     */
    public function getResponse($request)
    {
        return $this->validarController('GET', $request);
    }

    /**
     * Metodo de acceso a data
     * 
     * @return response Regresa un response en formato JSON
     */
    public function postResponse($request)
    {
        return $this->validarController('POST', $request);
    }

    /**
     * Metodo que retorna respuestas de error
     * 
     * El error por defecto es 404 pero puede recibir cualquier otro
     * 
     * @see https://developer.mozilla.org/es/docs/Web/HTTP/Status
     * 
     * Evaluamos el metodo del request y construimos una respuesta especifica para ambos casos
     * 
     * @param string method 
     * @param int status
     * 
     * @return response Regresa una respuesta especifica para cada peticion recibida
     */
    public function badResponse($method, $status = 404, $view = "404")
    {

        $this->response->setStatus($status);

        switch($method)
        {
            case 'POST':
                return $this->response->getJsonResponse([
                    'error' => $status
                ]);
            break;
            case 'GET':
            default;
                return $this->sendHtmlResponse($view);
            break;
        }
    }

    /**
     * Metodo para validar si existe o no un controlador
     * 
     * Si el controlador existe regresa una instancia del objeto Response
     * Esta instancia proviene del objeto Client
     * 
     * Si el controlador no existe regresa una instancia que proviene del metodo 
     * publico badResponse
     * 
     * @see App\Core\Response
     * @see App\Core\Client
     * 
     * @param string Metod 
     * @param class Request
     * 
     * @return class Response 
     */
    private function validarController($method, $request)
    {
        if($controller = Client::getDataControllers($method, $request->getPathInfo()))
        {
            $clientClass = new Client($request, $controller);

            return $this->validateResponseErrors($clientClass->getClient(), $method);
        }
        else
        {
            return $this->badResponse($method, 404);
        }
        
    }

    /**
     * Metodo validador de errores
     * 
     * Esto metodo valida si existe un error con el response, si no existen errores retorna un 
     * objeto response proveniente de la clase validateResponseType
     * 
     * @param array $response Es un arreglo con informacion de la respuesta
     * @param string $method Es el verbo HTTP
     * 
     * @return class Response
     */
    private function validateResponseErrors($response, $method)
    {
        if(isset($response['errors']))
        {
            if(isset($response['errors']['redirect']))
            {
                return $this->sendRedirect($response['errors']['redirect']);
            }

            return $this->badResponse($method, $response['errors']['error_code'], $response['errors']['view']);
        }
        else
        {
            return $this->validateResponseType($response, $method);
        }
    }

    /**
     * Metodo de envio de respuestas HTML
     * 
     * El metodo evalua si la data es null envia solo la view a la que se quiere aceder
     * de lo contrario regresa la view y la data
     * 
     * @param string $view Es el nombre de la view a acceder
     * @param array $data Es un arreglo con informacion para acceder en el frontend
     * 
     * @return class Response
     */
    private function sendHtmlResponse($view, $data = null)
    {
        if(is_null($data))
        {
            return $this->response->getHtmlResponse(
                $this->templates->render($view)
            );
        }
        else
        {
            return $this->response->getHtmlResponse(
                $this->templates->render($view, [
                    'data' => $data
                ])
            );
        }
    }

    /**
     * Metodo de envio de respuestas JSON
     */
    private function sendJsonResponse($data)
    {
        return $this->response->getJsonResponse($data);
    }

    /**
     * Metodo de redireccion de peticiones
     */
    private function sendRedirect($redirect)
    {
        return $this->response->getRedirectResponse($redirect);
    }

    /**
     * Metodo validador del metodo de comunicacion
     * 
     * Este metodo evalua si el verbo es GET o POST y retorna un objeto response segun sea el caso
     * 
     * @param array $response Es un objeto con la respuesta del controlador o errores
     * @param string $method Es el verbo HTTP del cual proviene la peticion
     * 
     * @return class Retorna un objeto response
     * 
     */
    private function validateResponseType($response, $method)
    {
        if($method == 'GET')
        {                
            if(is_null($response['data']))
            {
                return $this->sendHtmlResponse($response['views']);
            }
            else
            {
                return $this->sendHtmlResponse($response['views'], $response['data']);
            }
        }
        else
        {
            return $this->response->getJsonResponse($response);
        }
    }
}