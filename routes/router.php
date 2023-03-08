<?php
class Router
{
    private $controller;
    private $method;

    public function __construct()
    {
        $this->matchRoute();
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    private function showError($messageerror)
    {
        $error = new ErrorController();
        $error->setError404($messageerror);
        $error->index();
    }

    public function matchRoute()
    {
        $url = explode("/", URL);

        // Verificar si el índice 2 existe antes de intentar acceder a él
        $met = isset($url[2]) ? explode("?", $url[2]) : [];

        $this->setController($url[1]);
        $this->setMethod(isset($met[0]) ? $met[0] : '');
        $this->controller = $this->getController() . "Controller";

        // Verificar si el controlador existe
        if (!class_exists($this->getController())) {
            $this->showError("Error 404: Controlador no encontrado");
            return;
        }

        // Verificar si el método existe
        if (!method_exists($this->controller, $this->getMethod())) {
            $this->showError("Error 404: Método no encontrado");
            return;
        }

        require_once("controllers/" . $this->getController() . ".php");
    }

    public function run($datos)
    {
        $controller = new $this->controller();
        $method = $this->method;
        if (!isset($method) || trim($method) === '') {
            $this->showError("Error 404: Método no encontrado");
            return;
        }
        if (isset($datos)) {
            $controller->$method($datos);
        } else {
            $controller->$method();
        }
    }
}
