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
        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }   

        $tipos = $this->Tipos->find('list', array(
            'fields' => array(
                'tip_descricao'
            ),
            'conditions' => array(
                'tip_usu_fk' => $usuario
            ),
            'order' => array(
                'tip_descricao'
            )
        ));
        $this->set('tipos', $tipos);

        if($this->request->is('post')) {                    

            $opcaoPesquisa = $this->request->data['Despesas']['opcaoPesquisa'];
            $descricao = (isset($this->request->data['Despesas']['des_descricao'])) ? strtoupper(trim($this->request->data['Despesas']['des_descricao'])) : '';
            $tipo = (isset($this->request->data['Despesas']['des_tipo'])) ? $this->request->data['Despesas']['des_tipo'] : '';             
            
            $usuarioLogin = $this->Session->read('Person.usuario');
            $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');    
            
            if(isset($usuarioLogin['usu']['usu_id'])) {
                $usuario = $usuarioLogin['usu']['usu_id'];
            } else {
                $usuario = $ultimoUsuarioAdd;
            }

            $despesas = $this->Despesas->listaDespesas($opcaoPesquisa, $descricao, $tipo, $usuario);            
            $this->set('despesas', $despesas);
        }
    }

    public function add()
    {
        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }    

        $tipos = $this->Tipos->find('list', array(
            'fields' => array(
                'tip_descricao'
            ),
            'conditions' => array(
                'tip_usu_fk' => $usuario
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
            'conditions' => array(
                'frp_usu_fk' => $usuario    
            ),
            'order' => array(
                'frp_descricao'                
            )
        ));
        $this->set('formaPagamento', $formaPagamento);

        if($this->request->is('post')) {
            

            $quantidadeParcela = (!empty($this->request->data['Despesas']['des_parcela'])) ? $this->request->data['Despesas']['des_parcela'] : 0;

            $this->request->data['Despesas']['des_usu_fk'] = $usuario;
            $this->request->data['Despesas']['des_parcela'] = $quantidadeParcela;            
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

        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }
        
        $this->set('id', $this->request->data['id']);
        
        $tipos = $this->Tipos->find('list', array(
            'fields' => array(
                'tip_descricao'
            ),
            'conditions' => array(
                'tip_usu_fk' => $usuario
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
            'conditions' => array(
                'frp_usu_fk' => $usuario
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

    public function modalAddTipo()
    {
        $this->layout = null;

        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }

        $tipoDespesa = $this->Tipos->find('all', array(
            'conditions' => array(
                'tip_usu_fk' => $usuario
            )
        ));
        $this->set('tipoDespesa', $tipoDespesa);        
    }

    public function salvarTipo()
    {
        $this->layout = null;
        $this->autoRender = false;

        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }

        $tip = array();
        $tip['tip_descricao'] = $this->request->data['descricao'];
        $tip['tip_usu_fk'] = $usuario;

        $this->Tipos->create();
        $this->Tipos->save($tip);
    }

    public function deletaTipoDespesa($tipId)
    {
        $this->layout = null;
        $this->autoRender = false;

        $this->Tipos->delete($tipId);
    }

    public function modalEditTipo($idTipo)
    {
        $this->layout = null;

        $this->set('idTipo', $idTipo);

        $tipoDespesa = $this->Tipos->find('first', array(
            'fields' => array(
                'tip_descricao'
            ),
            'conditions' => array(
                'tip_id' => $idTipo
            )
        ));
        $this->set('tipoDespesa', $tipoDespesa);        
    }

    public function salvaEditTipo()
    {
        $this->layout = null;
        $this->autoRender = false;

        $tip = array();
        $tip['tip_id'] = $this->request->data['tip_id'];
        $tip['tip_descricao'] = $this->request->data['descricao'];
        $this->Tipos->save($tip);
    }

    public function modalAddFrp()
    {
        $this->layout = null;

        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }

        $formaPagamento = $this->FormaPagamento->find('all', array(
            'conditions' => array(
                'frp_usu_fk' => $usuario
            )
        ));
        $this->set('formaPagamento', $formaPagamento);        
    }

    public function salvarFormaPagamento()
    {
        $this->layout = null;
        $this->autoRender = false;

        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }

        $frp = array();
        $frp['frp_descricao'] = $this->request->data['descricao'];
        $frp['frp_usu_fk'] = $usuario;

        $this->FormaPagamento->create();
        $this->FormaPagamento->save($frp);
    }

    public function deletaFormaPagamento($frpId)
    {
        $this->layout = null;
        $this->autoRender = false;

        $this->FormaPagamento->delete($frpId);
    }

    public function modalEditFrp($idFrp)
    {
        $this->layout = null;

        $this->set('idFrp', $idFrp);

        $formaPagamento = $this->FormaPagamento->find('first', array(
            'fields' => array(
                'frp_descricao'
            ),
            'conditions' => array(
                'frp_id' => $idFrp
            )
        ));
        $this->set('formaPagamento', $formaPagamento);
    }

    public function salvaFormaPagamento()
    {
        $this->layout = null;
        $this->autoRender = false;

        $frp = array();
        $frp['frp_id'] = $this->request->data['frpId'];
        $frp['frp_descricao'] = $this->request->data['descricao'];
        $this->FormaPagamento->save($frp);
    }

}