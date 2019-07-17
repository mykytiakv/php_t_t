<?php

namespace application\core;

use application\core\View;

abstract class Controller {

    public $route, $view, $model;
    private $_message;

    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        $path = 'application\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function setMessage($message) {
        $this->_message = $message;
    }

    public function getMessage() {
        return $this->_message;
    }
}