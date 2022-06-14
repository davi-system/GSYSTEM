<?php

App::uses('Controller', 'Controller');

class DespesasController extends AppController {

    var $uses = array(
        'Tipos', 
        'FormaPagamento', 
        'Despesas'
    );

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

    public function index()
    {
        if($this->request->is('post')) {            

            $tipo = $this->request->data['Despesas']['des_tipo_fk'];
            $descricao = strtoupper(trim($this->request->data['Despesas']['des_descricao']));

            $despesas = $this->Despesas->listaDespesas($tipo, $descricao);
            $this->set($despesas);
            $this->set('despesas', $despesas);
        }
    }

    public function modalEditDespesa()
    {
        $this->layout = null;
    }
}