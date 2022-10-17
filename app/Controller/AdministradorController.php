<?php

App::uses('Controller', 'Controller');

class AdministradorController extends AppController {

    public $components = array("Utilitarios");   

    var $uses = array('Suporte', 'Usuarios');

    public function index()
    {                           
        $usuarios = $this->Usuarios->find('all', array(
            'fields' => array(
                'usu.usu_id',
                'usu.usu_nome'
            ),
            'joins' => array(                
                array(
                    'table' => 'Suporte',
                    'alias' => 'sup',
                    'type' => 'inner',
                    'conditions' => array('usu.usu_id = sup_usu_fk')
                )
            ),
            'conditions' => array(
                'sup_situacao' => 'A',
            ),
            'group' => 'usu_id'
        ));
        
        foreach($usuarios as $user) {
            $users[$user['usu']['usu_id']] = $user['usu']['usu_id'].' - '.$user['usu']['usu_nome'];
        }        
        $this->set('usuarios', $users);


        $usuario = '';
        $mes = '';
        $ano = '';

        if($this->request->is('post')) {            
                        
            $this->set('usuario', $this->request->data['ListaFeed']['usu_id']);
            $this->set('mes', $this->request->data['ListaFeed']['mes']);
            $this->set('ano', $this->request->data['ListaFeed']['ano']);

            $usuario = "sup.sup_usu_fk = ".$this->request->data['ListaFeed']['usu_id']."";
            $mes = "MONTH(sup.sup_dtcriacao) = '".$this->request->data['ListaFeed']['mes']."'";
            $ano = "YEAR(sup.sup_dtcriacao) = '".$this->request->data['ListaFeed']['ano']."'";
        }          
        
        $feedbackUsuarios = $this->Suporte->find('all', array(
            'fields' => array(                
                'sup.sup_id', 
                'sup.sup_descricao', 
                'sup.sup_dtcriacao', 
                'sup.sup_horacriacao', 
                'usu.usu_id',
                'usu.usu_nome',
                'usu.usu_email'
            ),
            'joins' => array(
                array(
                    'table' => 'Usuarios',
                    'alias' => 'usu',
                    'type' => 'inner',
                    'conditions' => array('usu.usu_id = sup_usu_fk')
                )
            ),
            'order' => array(
                'sup_id' => 'desc'
            ),            
            'conditions' => array(
                'sup_situacao' => 'A',
                $usuario,
                $mes,
                $ano             
            )
        ));     
        $this->set('feedbackUsuarios', $feedbackUsuarios);        
    }

    public function modalFeedbackUsuario($id)
    {
        $this->layout = null;

        $feedback = $this->Suporte->find('first', array(
            'conditions' => array(
                'sup_id' => $id
            )
        ));
        $this->set('feedback', $feedback);        
    }

    public function imprimirRelatorioFeedback($user, $month, $year)
    {
        $this->layout = null;        

        $usuario = "sup_usu_fk = ".$user."";
        $mes = "MONTH(sup_dtcriacao) = '".$month."'";
        $ano = "YEAR(sup_dtcriacao) = '".$year."'";        

        $feedback = $this->Suporte->find('all', array(
            'fields' => array(                
                'sup.sup_id', 
                'sup.sup_descricao', 
                'sup.sup_dtcriacao', 
                'sup.sup_horacriacao', 
                'usu.usu_id',
                'usu.usu_nome',
                'usu.usu_email'
            ),
            'joins' => array(
                array(
                    'table' => 'Usuarios',
                    'alias' => 'usu',
                    'type' => 'inner',
                    'conditions' => array('usu.usu_id = sup_usu_fk')
                )
            ),
            'order' => array(
                'sup_id' => 'desc'
            ),            
            'conditions' => array(
                'sup_situacao' => 'A',
                $usuario,
                $mes,
                $ano             
            )
        ));
        $this->set('feedback', $feedback);        
    }
}