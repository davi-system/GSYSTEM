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

        // Estou pegando o nome do usuário logado
        $nome = $this->Usuarios->find('first', array(
            'fields' => array(
                'usu_nome'
            ),
            'conditions' => array(
                'usu_id' => $codUser 
            )
        ));        
    
        if(isset($codUser)) {
            $this->set('nome', $nome['usu']['usu_nome']);            
        } else {
            $this->set('nome', $this->Session->read('Person.nomeUsuarioNovo'));            
        }
    }
}