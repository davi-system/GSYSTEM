<?php 

App::uses('Controller', 'Controller');

class UsuariosController extends AppController {

    var $uses = array('Usuarios');

    public function view()
    {
        $usuarios = $this->Usuarios->find('all');
        $this->set('usuarios', $usuarios);
    }
}