<?php 

App::uses('Controller', 'Controller');

class RelatoriosController extends AppController {

    public $components = array("Utilitarios");    

    var $uses = array('Despesas');    

    public function index()
    {    
        $usuarioLogin = $this->Session->read('Person.usuario');
        $ultimoUsuarioAdd = $this->Session->read('idUsuario.add');            
        
        if(isset($usuarioLogin['usu']['usu_id'])) {
            $usuario = $usuarioLogin['usu']['usu_id'];
        } else {
            $usuario = $ultimoUsuarioAdd;
        }

        $this->set('usuario', $usuario);

        if($this->request->is('post')) {            

            $data1 = $this->request->data['Rel']['data1'];
            $data2 = $this->request->data['Rel']['data2'];            
            
            $this->set('data1', $this->Utilitarios->formatoAmericanoSemTraco($data1));
            $this->set('data2', $this->Utilitarios->formatoAmericanoSemTraco($data2));
    
            $despesas = $this->Despesas->relatorioDespesas($usuario, $this->Utilitarios->formataData($data1), $this->Utilitarios->formataData($data2));        
            $this->set('despesas', $despesas);            
        }    
    }

    public function r01Excel($usuario, $data1, $data2)
    {        
        $this->layout = null;     
        
        $dataInicio = $this->Utilitarios->ajuntaFormataData($data1);
        $dataFim = $this->Utilitarios->ajuntaFormataData($data2);

        $despesas = $this->Despesas->relatorioDespesas($usuario, $dataInicio, $dataFim);
        $this->set('despesas', $despesas);
    }
    
    public function r01Pdf($usuario, $data1, $data2) {        
        
        $this->layout = null;        

        $dataInicio = $this->Utilitarios->ajuntaFormataData($data1);
        $dataFim = $this->Utilitarios->ajuntaFormataData($data2);        

        $despesas = $this->Despesas->relatorioDespesas($usuario, $dataInicio, $dataFim);
        $this->set('despesas', $despesas);        
    }
}