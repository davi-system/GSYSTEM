<?php

App::uses('AppModel', 'Model');

class FormaPagamento extends AppModel {

    var $useTable = 'forma_pagamento';
    public $primaryKey = 'frp_id';
    public $displayField = 'frp_descricao';
    public $alias = 'frp';
}