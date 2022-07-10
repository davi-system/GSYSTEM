<?php

App::uses('AppModel', 'Model');

class Despesas extends AppModel {

    var $useTable = 'despesas';
    public $primaryKey = 'des_id';
    public $displayField = 'des_descricao';
    public $alias = 'des';

    function listaDespesas($tipo, $descricao, $usuario)
    {        
        if($tipo == 0) {
            $where = "upper(des_descricao) like '%$descricao%'";
        } else {
            $where = "upper(tip_descricao) like '%$descricao%'";
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
            WHERE $where
            and des_usu_fk = $usuario
            ORDER BY des_descricao"
        );
    }

    function deletaDespesa($id)
    {        
        return $this->query(
            "DELETE FROM despesas WHERE des_id = $id"
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