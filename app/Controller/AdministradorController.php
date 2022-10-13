<?php

App::uses('Controller', 'Controller');

class AdministradorController extends AppController {

    public $components = array("Utilitarios");   

    var $uses = array('Suporte', 'Usuarios');

    public function index()
    {                   
        $usuarios = $this->Usuarios->find('list', array(
            'order' => 'usu_nome'
        ));
        $this->set('usuarios', $usuarios);

        $usuario = '';
        $mes = '';
        $ano = '';

        if($this->request->is('post')) {    
                        
            $usuario = "sup_usu_fk = ".$this->request->data['ListaFeed']['usu_id']."";
            $mes = "MONTH(sup_dtcriacao) = '".$this->request->data['ListaFeed']['mes']."'";
            $ano = "YEAR(sup_dtcriacao) = '".$this->request->data['ListaFeed']['ano']."'";                        
        }

        $options = array(
            'fields' => array(
                'sup.sup_id',
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
            'limit' => 10,
            'conditions' => array(
                'sup_situacao' => 'A',
                $usuario,
                $mes,
                $ano             
            )
        );        

        $this->paginate = $options;
 
        // Roda a consulta, já trazendo os resultados paginados
        $feedbackUsuarios = $this->paginate('Suporte');
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
}