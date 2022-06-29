<?php

App::uses('AppModel', 'Model');

class Suporte extends AppModel {

    var $useTable = 'suporte';
    public $primaryKey = 'sup_id';
    public $displayField = 'sup_descricao';
    public $alias = 'sup';
}