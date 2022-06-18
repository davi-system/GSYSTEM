<?php

App::uses('Controller', 'Controller');

class DespesasController extends AppController {

    var $uses = array(
        'Tipos', 
        'FormaPagamento', 
        'Despesas'
    );

    public function index()
    {
        if($this->request->is('post')) {            

            $tipo = $this->request->data['Despesas']['des_tipo_fk'];
            $descricao = strtoupper(trim($this->request->data['Despesas']['des_descricao']));
            $usuario = $this->Session->read('Person.usuario');

            $despesas = $this->Despesas->listaDespesas($tipo, $descricao, $usuario);            
            $this->set('despesas', $despesas);
        }
    }

    public function add()
    {
        $tipos = $this->Tipos->find('list', array(
            'fields' => array(
                'tip_descricao'
            ),
            'order' => array(
                'tip_descricao'
            )
        ));
        $this->set('tipos', $tipos);

        $formaPagamento = $this->FormaPagamento->find('list', array(
            'fields' => array(
                'frp_descricao'
            ),
            'order' => array(
                'frp_descricao'
            )
        ));
        $this->set('formaPagamento', $formaPagamento);

        if($this->request->is('post')) {

            $this->request->data['Despesas']['des_usu_fk'] = $this->Session->read('Person.usuario');
            $this->request->data['Despesas']['des_situacao'] = 'A';
            $this->request->data['Despesas']['des_dtcriacao'] = date('Y-m-d');
            $this->request->data['Despesas']['des_horacriacao'] = date('H:i:s');

            $this->Despesas->create();
            if($this->Despesas->save($this->request->data['Despesas'])) {
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

    public function modalEditDespesa()
    {
        $this->layout = null;
        
        $this->set('id', $this->request->data['id']);
        
        $tipos = $this->Tipos->find('list', array(
            'fields' => array(
                'tip_descricao'
            ),
            'order' => array(
                'tip_descricao'
            )
        ));
        $this->set('tipos', $tipos);

        $formaPagamento = $this->FormaPagamento->find('list', array(
            'fields' => array(
                'frp_descricao'
            ),
            'order' => array(
                'frp_descricao'
            )
        ));
        $this->set('formaPagamento', $formaPagamento);

        $despesa = $this->Despesas->find('first', array(
            'conditions' => array(
                'des_id' => $this->request->data['id']
            )
        ));
        $this->set('despesa', $despesa);        
    }

    public function salvaEditDespesa()
    {
        $this->layout = null;
        $this->autoRender = false;

        $des = array();
        $des['des_id'] = $this->request->data['id'];
        $des['des_descricao'] = $this->request->data['descricao'];
        $des['des_valor'] = $this->request->data['valor'];
        $des['des_tipo_fk'] = $this->request->data['tipo'];
        $des['des_frp_fk'] = $this->request->data['formaPagamento'];
        $des['des_parcela'] = $this->request->data['parcelas'];

        $this->Despesas->save($des);  
    }

    public function modalViewDespesa()
    {
        $this->layout = null;
        
        $this->set('id', $this->request->data['id']);
        
        $tipos = $this->Tipos->find('list', array(
            'fields' => array(
                'tip_descricao'
            ),
            'order' => array(
                'tip_descricao'
            )
        ));
        $this->set('tipos', $tipos);

        $formaPagamento = $this->FormaPagamento->find('list', array(
            'fields' => array(
                'frp_descricao'
            ),
            'order' => array(
                'frp_descricao'
            )
        ));
        $this->set('formaPagamento', $formaPagamento);

        $despesa = $this->Despesas->find('first', array(
            'conditions' => array(
                'des_id' => $this->request->data['id']                
            )
        ));
        $this->set('despesa', $despesa);        
    }

    public function deletaDespesa()
    {
        $this->layout = null;
        $this->autoRender = false;        

        $this->Despesas->deletaDespesa($this->request->data['id']);
    }
}