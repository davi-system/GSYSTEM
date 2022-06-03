<?php 

App::uses('Controller', 'Controller');

class UsuariosController extends AppController {

    var $uses = array('Usuarios');

    public function add()
    {
        if($this->request->is('post')) {

            $verificaEmailExiste = $this->Usuarios->find('count', array(
                'conditions' => array(
                    'usu_email' => $this->request->data['Usuarios']['usu_email']
                )
            ));
            
            if($verificaEmailExiste > 0) {
                $this->Session->setFlash('
                <script>                
                    swal(
                        "Acesso negado!", 
                        "Esse e-mail já existe cadastrado no sistema!", 
                        "warning"
                    );
                </script>');
            } else {            
                $this->request->data['Usuarios']['usu_dtcriacao'] = date('Y-m-d');
                $this->request->data['Usuarios']['usu_horacriacao'] = date('H:i:s');
    
                $this->Usuarios->create();    
                if($this->Usuarios->save($this->request->data['Usuarios'])) {
                    $this->Session->setFlash('
                    <script>                
                        swal(
                            "Sucesso!", 
                            "Cadatro realizado com sucesso!", 
                            "success"
                        );
                    </script>');
                    $this->redirect(array('controller' => 'Menu', 'action' => 'index'));
                }
            }
        }
    }

    public function view()
    {
        $usuarios = $this->Usuarios->find('all');
        $this->set('usuarios', $usuarios);
    }
}