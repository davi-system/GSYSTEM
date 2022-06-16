<?php

App::uses('AppModel', 'Model');

class Tipos extends AppModel {

    var $useTable = 'tipos';
    public $primaryKey = 'tip_id';
    public $displayField = 'tip_descricao';
    public $alias = 'tip';
}