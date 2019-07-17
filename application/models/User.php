<?php

namespace application\models;

use application\core\Model;

class User extends Model {
    private $_data;
    public $error;

    public function create($post) {
        $params = [
            'id' => '',
            'name' => $post['name'],
            'email' => $post['email'],
            'country_id' => ($post['country_id'] !== '') ? $post['country_id'] : null,
        ];

        if (!$this->db->insert('users', $params)) {
            $this->logger->error('There was a problem creating an user', $params);
        } else {
            $this->logger->info('User created', $params);
        }
    }

    public function validate($post, $type) {
        $nameLength = iconv_strlen($post['name']);
        $email = iconv_strlen($post['$email']);
        $userExists = $this->find($post['name']);

        if ($nameLength < 3 or $nameLength > 50) {
            $this->error = 'Название должно содержать от 3 до 500 символов';
            return false;
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = 'E-mail адрес ' . $email . ' указан неверно.\n';
            return false;
        }

        if ($userExists and $type === 'create') {
            $this->error = 'Пользователь с таким именем уже существует';
            return false;
        } elseif ($userExists and $type === 'edit') {
            if ($this->getData()->id != $post['id']) {
                $this->error = 'Пользователь с таким именем уже существует';
                return false;
            }
        }

        return true;
    }

    public function update($post, $id = null) {
        $fields = [
            'id' => $id,
            'name' => $post['name'],
            'email' => $post['email'],
            'country_id' => ($post['country_id'] !== '') ? $post['country_id'] : null,
        ];

        if (!$this->db->update('users', $id, $fields)) {
            $this->logger->error('There was a problem updating an user', $fields);
        } else {
            $this->logger->info('User updated', $fields);
        }
    }

    public function delete($id) {
        $data = array('id' => $id);
        if (!$this->db->delete('users', $id)) {
            $this->logger->error('There was a problem deleting an user', $data);
        } else {
            $this->logger->info('User deleted', $data);
        }
    }

    public function find($user = null) {
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'name';
            $data = $this->db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->results()[0];
                return true;
            } else {
                $this->logger->info('User not found', array($field => $user));
            }
        }
    }

    public function getData() {
        return $this->_data;
    }

    public function getUsers() {
        $query = $this->db->query("SELECT u.id, u.name, u.email, c.country FROM users u LEFT JOIN countries c ON c.id = u.country_id", array());
        return $query->results();
    }
}