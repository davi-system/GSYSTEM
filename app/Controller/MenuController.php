<?php 

App::uses('Controller', 'Controller');

class MenuController extends AppController {

    public function index()
    {
        // pegando o id do usuario logado
        $codUser = $this->Session->read('Person.usuario');
        $this->set('codUsuario', $codUser['usu']['usu_id']);
    }
}