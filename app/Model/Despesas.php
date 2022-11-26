<?php

App::uses('AppModel', 'Model');

class Despesas extends AppModel {

    var $useTable = 'despesas';
    public $primaryKey = 'des_id';
    public $displayField = 'des_descricao';
    public $alias = 'des';    

    function listaDespesas($opcaoPesquisa, $descricao, $tipo, $usuario)
    {        
        if($opcaoPesquisa == '0') {
            $and = "and upper(des_descricao) like '%$descricao%'";
        } else if($opcaoPesquisa == '1') {
            $and = "and des_tipo_fk = $tipo";
        } else if($opcaoPesquisa == '2') {
            $and = null;
        }

        return $this->query(
            "SELECT 
                des.des_id, 
                des.des_tipo_fk, 
                tip.tip_descricao, 
                des.des_frp_fk, 
                frp.frp_descricao, 
                des.des_descricao, 
                des.des_valor, 
                des.des_parcela, 
                des.des_dtcriacao, 
                des.des_horacriacao
            FROM 
                despesas AS des
            INNER JOIN tipos AS tip ON tip.tip_id = des.des_tipo_fk
            INNER JOIN forma_pagamento AS frp ON frp.frp_id = des.des_frp_fk
            WHERE des_usu_fk = $usuario
            $and            
            ORDER BY des_descricao"
        );
    }

    function relatorioDespesas($id, $data1, $data2) {

        return $this->query(
            "SELECT 
                des.des_id, 
                des.des_tipo_fk, 
                tip.tip_descricao, 
                des.des_frp_fk, 
                frp.frp_descricao, 
                des.des_descricao, 
                des.des_valor, 
                des.des_parcela, 
                des.des_dtcriacao, 
                des.des_horacriacao
            FROM 
                despesas AS des
            INNER JOIN tipos AS tip ON tip.tip_id = des.des_tipo_fk
            INNER JOIN forma_pagamento AS frp ON frp.frp_id = des.des_frp_fk
            WHERE des_dtcriacao between '$data1' and '$data2'
            and des_usu_fk = $id
            ORDER BY des_descricao"
        );
    }
}