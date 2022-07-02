<?php 

App::uses('Controller', 'Controller');

class RelatoriosController extends AppController {

    var $uses = array('Despesas');    

    public function index()
    {
        $usuario = $this->Session->read('Person.usuario');

        if($this->request->is('post')) {            

            $data1 = $this->request->data['Rel']['data1'];
            $data2 = $this->request->data['Rel']['data2'];            
    
            $this->set('despesas', $this->Despesas->relatorioDespesas(
                $usuario['usu']['usu_id'], 
                $this->formataData($data1), 
                $this->formataData($data2)
            ));            
        }
        
    }

    public function formataData($data)
    {
        $date = DateTime::createFromFormat('d/m/Y', $data);
        return $date->format('Y-m-d');
    }

    public function exportarExcel()
    {
        # code...
    }
}