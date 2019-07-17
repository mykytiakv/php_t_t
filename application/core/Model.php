<?php

namespace application\core;

use application\lib\DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

abstract class Model {
    public $db, $logger;

    public function __construct() {
        $this->db = DB::getInstance();
        $this->logger = $this->createLogger();
    }

    private function createLogger() {
        $logger = new Logger('name');
        $logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT']  . '/logs/log', Logger::DEBUG));
        return $logger;
    }
}