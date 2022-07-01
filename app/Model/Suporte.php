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
}