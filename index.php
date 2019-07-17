<?php

require_once __DIR__ . '/vendor/autoload.php';

use application\core\Router;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');

    if (file_exists($path)) {
        require_once $path;
    }

});

$router = new Router();
$router->run();

$logger = new Logger('name');
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/log', Logger::WARNING));


