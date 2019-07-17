<?php

namespace application\controllers;

use application\core\Controller;
use application\core\Input;
use application\models\Country;


class UserController extends Controller {


    public function listAction() {
        $users = $this->model->getUsers();
        $vars = [
            'users' => $users
        ];
        $this->view->render('Users List', $vars);
    }

    public function createAction() {
        $countryModel = new Country();
        $message = [];
        $countries = $countryModel->getCountries();

        $vars = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'country_id' => Input::get('country_id'),
            'countries' => $countries
        ];

        if (!empty($_POST)) {
            if (!$this->model->validate($_POST, 'create')) {
                $message = $this->view->message('error', $this->model->error);
            } else {
                $this->model->create($_POST);
                $message = $this->view->message('success', 'New user created');

                $vars = [
                    'countries' => $countries
                ];
            }
        }

        $this->setMessage($message);
        $vars['message'] = $this->getMessage();
        $vars['action_title'] = 'Create';

        $this->view->render('Create user', $vars);
    }


    public function editAction() {
        $message = [];

        $countryModel = new Country();

        $id = $this->route['id'];
        $obj = $this->model->find($id);

        if (!$obj) {
            $this->view->errorCode(404);
        } else {
            $obj = $this->model->getData();
        }

        $vars = [
            'id' => $id,
            'name' => $obj->name,
            'email' => $obj->email,
            'country_id' => $obj->country_id,
            'countries' => $countryModel->getCountries()
        ];

        if (!empty($_POST)) {
            if (!$this->model->validate($_POST, 'edit')) {
                $message = $this->view->message('error', $this->model->error);
            } else {
                $this->model->update($_POST, $id);

                $message = $this->view->message(
                    'success',
                    'User information has been successfully updated'
                );

                $vars['name'] = Input::get('name');
                $vars['email'] = Input::get('email');
                $vars['country_id'] = Input::get('country_id');

            }
        }

        $this->setMessage($message);
        $vars['message'] = $this->getMessage();
        $vars['action_title'] = 'Edit';

        $this->view->path = 'user/create';
        $this->view->render('Edit user', $vars);

    }

    public function deleteAction() {
        $id = $this->route['id'];
        if (!$this->model->find($id)) {
            $this->view->errorCode(404);
        }
        $this->model->delete($id);
        $this->view->redirect('');
    }
}