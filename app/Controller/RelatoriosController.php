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
            
            $this->set('data1', $data1);
            $this->set('data2', $data2);
    
            // Consultando e enviando para view            
            $this->set('despesas', $this->Despesas->relatorioDespesas(
                $usuario, 
                $this->Utilitarios->formataData($data1), 
                $this->Utilitarios->formataData($data2)
            ));            
        }    
    }

    public function r01Excel($usuario, $data1, $data2)
    {        
        $this->layout = null;        

        // Consultando e enviando para view
        $this->set('despesas', $this->Despesas->relatorioDespesas(
            $usuario,
            $this->Utilitarios->formataData(str_pad($this->Utilitarios->ajuntaFormataData($data1) , 8 , '0' , STR_PAD_LEFT)), 
            $this->Utilitarios->formataData(str_pad($this->Utilitarios->ajuntaFormataData($data2) , 8 , '0' , STR_PAD_LEFT))
        ));        
    }
    
    public function r01Pdf($usuario, $data1, $data2) {        
        
        $this->layout = null;
        
        // Consultando e enviando para view
        $this->set('despesas', $this->Despesas->relatorioDespesas(
            $usuario,
            $this->Utilitarios->formataData(str_pad($this->Utilitarios->ajuntaFormataData($data1) , 8 , '0' , STR_PAD_LEFT)), 
            $this->Utilitarios->formataData(str_pad($this->Utilitarios->ajuntaFormataData($data2) , 8 , '0' , STR_PAD_LEFT))
        ));
    }
}