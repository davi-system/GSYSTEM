<?php

App::uses('Controller', 'Controller');

class SuporteController extends AppController {

    var $uses = array('Suporte');

    public function index()
    {        
        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');         
        
        if(isset($usuarioLogin)) {
            $codUsuario = $usuarioLogin;
        } else {
            $codUsuario = $ultimoUsuarioAdd;
        }

        $this->set('codUsuario', $codUsuario);

        if($this->request->is('post')) {            

            $sup = array();
            $sup['sup_usu_fk'] = $codUsuario;
            $sup['sup_descricao'] = $this->request->data['Suporte']['descricao'];
            $sup['sup_situacao'] = 'A';
            $sup['sup_dtcriacao'] = date('Y-m-d');
            $sup['sup_horacriacao'] = date('H:I:s');

            $this->Suporte->create();
            if($this->Suporte->save($sup)) {

                $this->Session->setFlash('
                <script>                
                    swal(
                        "Sucesso!", 
                        "Feedback enviando com sucesso!", 
                        "success"
                    );
                </script>');
                $this->redirect(array('controller' => 'Suporte', 'action' => 'index'));
            }
        }
    }

    public function modalHistoricoSuporte()
    {
        $this->layout = null;        

        $this->set('chamados', $this->Suporte->find('all', array(
            'conditions' => array(
                'sup_usu_fk' => $this->request->data['codUsuario'],
                'sup_situacao' => 'A'
            )
        )));
    }

    public function excluirChamado()
    {
        $this->layout = null;
        $this->autoRender = false;

        $sup = array();
        $sup['sup_id'] = $this->request->data['codChamado'];
        $sup['sup_usu_fk'] = $this->request->data['codUsuario'];
        $sup['sup_situacao'] = 'I';

        $this->Suporte->save($sup);
    }

    public function limparHistorico()
    {
        $this->layout = null;
        $this->autoRender = false;

        $this->Suporte->inativarHistoricoChamados($this->request->data['codUsuario']);
    }
}