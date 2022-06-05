<?php 

App::uses('Controller', 'Controller');

class LoginController extends AppController {

    var $uses = array('Usuarios');

    public function index()
    {
        if($this->request->is('post')) {

            $this->layout = null;
            $this->autoRender = false;

            // ainda não está pronto, tenho que aprender a guardar sessão no php
            // $usuario = $this->Usuarios->find('first', array(
            //     'fields' => array(
            //         'usu_id'
            //     ),
            //     'conditions' => array(
            //         'usu_email' => $this->request->data['email'],
            //         'usu_senha' => $this->request->data['senha']
            //     )
            // ));                        

            return json_encode($this->Usuarios->find('count', array(
                'conditions' => array(
                    'usu_email' => $this->request->data['email'],
                    'usu_senha' => $this->request->data['senha']
                )
            )));
        }
    }
}