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
                        "Atenção!", 
                        "Esse e-mail já existe cadastrado no sistema!", 
                        "warning"
                    );
                </script>');
            } else {            
                $this->request->data['Usuarios']['usu_dtcriacao'] = date('Y-m-d');
                $this->request->data['Usuarios']['usu_horacriacao'] = date('H:i:s');
    
                $this->Usuarios->create();    
                if($this->Usuarios->save($this->request->data['Usuarios'])) {

                    $this->Session->write('idUsuario.add', $this->Usuarios->id);            

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

    public function modalViewUsuario()
    {
        $this->layout = null;

        $usuario = $this->Usuarios->find('first', array(
            'conditions' => array(
                'usu_id' => $this->request->data['id']
            )
        ));
        $this->set('usuario', $usuario);
    }

    public function modalEditUsuario()
    {       
        $this->layout = null;

        $usuario = $this->Usuarios->find('first', array(
            'conditions' => array(
                'usu_id' => $this->request->data['id']
            )
        ));
        $this->set('usuario', $usuario); 
    }

    public function salvaEditCadUsuario()
    {
        $this->layout = null;
        $this->autoRender = false;        

        $usu = array();
        $usu['usu_id'] = $this->request->data['id'];
        $usu['usu_nome'] = $this->request->data['nome'];
        $usu['usu_email'] = $this->request->data['email'];
        $usu['usu_senha'] = $this->request->data['senha'];
        $usu['usu_dtalteracao'] = date('Y-m-d');
        $usu['usu_horaalteracao'] = date('H:i:s');

        $this->Usuarios->save($usu);
    }
}