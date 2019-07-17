<?php

namespace application\models;

use application\core\Model;

class Country extends Model {
    public $error;

    public function getCountries() {
        $query = $this->db->query('SELECT * FROM countries');
        return $query->results();
    }
}