<?php

App::uses('Controller', 'Controller');

class AdministradorController extends AppController {

    var $uses = array('Suporte');

    public function index()
    {                   
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
            'limit' => 10
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