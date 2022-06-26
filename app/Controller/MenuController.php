<?php 

App::uses('Controller', 'Controller');

class MenuController extends AppController {

    public function index()
    {
        // pegando o id e nome do usuario logado
        $codUser = $this->Session->read('Person.usuario');
        $nomeUser = $this->Session->read('Person.nome');
        $this->set('codUsuario', $codUser['usu']['usu_id']);
        $this->set('nomeUsuario', $nomeUser['usu']['usu_nome']);
    }
}