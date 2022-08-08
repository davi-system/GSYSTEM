<?php 

App::uses('Controller', 'Controller');

class MenuController extends AppController {

    var $uses = array('Usuarios');

    public function index()
    {
        // pegando o id e nome do usuario logado ou adicionado
        $codUser = $this->Session->read('Person.usuario');        
        
        if(isset($codUser['usu']['usu_id'])) {
            $codUsuario = $codUser['usu']['usu_id'];
        } else {
            $codUsuario = $this->Session->read('idUsuario.add');
        }        

        $this->set('codUsuario', $codUsuario);        

        $usuario = $this->Usuarios->find('first', array(
            'fields' => array(
                'usu_nome'
            ), 'conditions' => array(
                'usu_id' => $codUsuario
            )
        ));        
        $this->set('usuario', $usuario);
    }
}