<?php 

App::uses('Controller', 'Controller');

class LoginController extends AppController {

    var $uses = array('Usuarios');

    public function index()
    {
        if($this->request->is('post')) {

            $this->layout = null;
            $this->autoRender = false;
            
            $usuario = $this->Usuarios->find('first', array(
                'fields' => array(
                    'usu_id'
                ),
                'conditions' => array(
                    'usu_email' => $this->request->data['email'],
                    'usu_senha' => $this->request->data['senha']
                )
            ));            
            
            $this->Session->write('Person.usuario', isset($usuario['usu']['usu_id']));                              

            return json_encode($this->Usuarios->find('count', array(
                'conditions' => array(
                    'usu_email' => $this->request->data['email'],
                    'usu_senha' => $this->request->data['senha']
                )
            )));
        }
    }
}