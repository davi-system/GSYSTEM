<?php 

App::uses('Controller', 'Controller');

class MenuController extends AppController {

    var $uses = array('Usuarios');

    public function index()
    {
        // ID da Sessão do usuário
        $codUser = $this->Session->read('Person.usuario');               
        
        // Verifico se é um usuário que já existe ou se é novo
        if(isset($codUser)) {
            $codUsuario = $codUser;
        } else {
            $codUsuario = $this->Session->read('idUsuario.add');
        }
        $this->set('codUsuario', $codUsuario);                    

        $nome = $this->Session->read('Person.nome');

        if(isset($nome)) {
            $this->set('nome', $this->Session->read('Person.nome'));
        } else {
            $this->set('nome', $this->Session->read('Person.nomeUsuarioNovo'));
        }
    }
}