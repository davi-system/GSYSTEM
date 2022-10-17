<?php

App::uses('AppModel', 'Model');

class Suporte extends AppModel {

    var $useTable = 'suporte';
    public $primaryKey = 'sup_id';
    public $displayField = 'sup_descricao';
    public $alias = 'sup';

    function inativarHistoricoChamados($codUsuario)
    {
        return $this->query(
            "UPDATE suporte set sup_situacao = 'I' where sup_situacao = 'A' and sup_usu_fk = $codUsuario"
        );
    }

    // function listaSuporteUsuario()
    // {
    //     return $this->query(
    //         "SELECT 
    //             sup_id, 
    //             sup_descricao, 
    //             sup_dtcriacao, 
    //             sup_horacriacao, 
    //             usu_id,
    //             usu_nome,
    //             usu_email
    //         FROM 
    //             suporte AS sup
    //         INNER JOIN usuarios AS usu ON usu.usu_id = sup.sup_usu_fk"
    //     );
    // }
}