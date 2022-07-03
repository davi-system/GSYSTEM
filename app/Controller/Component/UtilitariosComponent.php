<?php 

class UtilitariosComponent extends Component {

    public function formataData($data)
    {
        $date = DateTime::createFromFormat('d/m/Y', $data);
        return $date->format('Y-m-d');
    }
        
    public function exportarDadosExcel()
    {
        # code...
    }
}
