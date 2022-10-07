<?php 

App::uses('Controller', 'Controller');

class LoginController extends AppController {

    var $uses = array('Usuarios');

    public function index()
    {        
        if($this->request->is('post')) {

            // Verifico se o usuário e senha existe
            $usuario = $this->Usuarios->find('count', array(                
                'conditions' => array(
                    'usu_email' => $this->request->data['LoginUser']['usu_email'],
                    'usu_senha' => $this->request->data['LoginUser']['usu_senha']
                )
            ));

            if($usuario > 0) {
                $this->Session->write('Person.usuario', $this->Usuarios->find('first', array(
                    'fields' => array(
                        'usu_id'
                    ),
                    'conditions' => array(
                        'usu_email' => $this->request->data['LoginUser']['usu_email'],
                        'usu_senha' => $this->request->data['LoginUser']['usu_senha']
                    )
                )));

                $this->Session->write('Person.nome', $this->Usuarios->find('first', array(
                    'fields' => array(
                        'usu_nome'
                    ),
                    'conditions' => array(
                        'usu_email' => $this->request->data['LoginUser']['usu_email'],
                        'usu_senha' => $this->request->data['LoginUser']['usu_senha']
                    )
                )));

                $this->Session->write('Person.adm', $this->Usuarios->find('first', array(
                    'fields' => array(
                        'usu_adm'
                    ),
                    'conditions' => array(
                        'usu_email' => $this->request->data['LoginUser']['usu_email'],
                        'usu_senha' => $this->request->data['LoginUser']['usu_senha']
                    )
                )));

                $this->redirect(array(
                    'controller' => 'Menu', 
                    'action' => 'index'
                ));

            } else {
                $this->Session->setFlash('
                <script>                
                    swal(
                        "Acesso Negado!", 
                        "E-mail ou senha inválido!", 
                        "warning"
                    );
                </script>');                
            }
        }
    }

    public function logout()
    {
        // $this->Session->delete('Person.usuario');
        // $this->Session->delete('Person.nome');
        $this->Session->destroy();
        $this->redirect(array('action' => 'index'));
    }
}