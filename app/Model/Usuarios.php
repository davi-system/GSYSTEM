<?php 

App::uses('AppModel', 'Model');

class Usuarios extends AppModel {

    var $useTable = 'usuarios';
    var $alias = 'usu';

    public $primaryKey = 'usu_id';
    public $displayField = 'usu_nome';
}