<?php

App::uses('Controller', 'Controller');

class TesteController extends AppController {

    var $uses = array('Usuarios');

    function index() {
        
        $usuarios = $this->Usuarios->find('all');
        $this->set('usuarios', $usuarios);
    }
}