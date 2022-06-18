<?php 

App::uses('Controller', 'Controller');

class MenuController extends AppController {

    public function index()
    {
        // pegando o id do usuario logado
        $this->set('codUsuario', $this->Session->read('Person.usuario'));
    }
}