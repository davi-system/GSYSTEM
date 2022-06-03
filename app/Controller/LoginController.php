<?php 

App::uses('Controller', 'Controller');

class LoginController extends AppController {

    var $uses = array('Usuarios');

    public function index()
    {
        if($this->request->is('post')) {

            $this->layout = null;
            $this->autoRender = false;

            return json_encode($this->Usuarios->find('count', array(
                'conditions' => array(
                    'usu_email' => $this->request->data['email'],
                    'usu_senha' => $this->request->data['senha']
                )
            )));
        }
    }
}