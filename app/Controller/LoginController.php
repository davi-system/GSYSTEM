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

            // se for maior que 0 existe usuário
            if($usuario > 0) {

                $dadosDoUsuario = $this->Usuarios->find('first', array(
                    'fields' => array(
                        'usu_id',
                        'usu_nome',
                        'usu_adm'
                    ),
                    'conditions' => array(
                        'usu_email' => $this->request->data['LoginUser']['usu_email'],
                        'usu_senha' => $this->request->data['LoginUser']['usu_senha']
                    )
                ));                

                $this->Session->write('Person.usuario', $dadosDoUsuario['usu']['usu_id']);
                $this->Session->write('Person.nome', $dadosDoUsuario['usu']['usu_nome']);
                $this->Session->write('Person.adm', $dadosDoUsuario['usu']['usu_adm']);               

                $this->redirect(array('controller' => 'Menu', 'action' => 'index'));

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
        $this->Session->destroy();
        $this->redirect(array('action' => 'index'));
    }
}