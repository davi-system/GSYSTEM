<?php 

class UtilitariosComponent extends Component {

    public function formataData($data)
    {
        $date = DateTime::createFromFormat('d/m/Y', $data);
        return $date->format('Y-m-d');
    }
        
    public function exportarDadosExcel($fileName)
    {
        header("Content-type: application/vnd.ms-excel");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=$fileName.xls");
        header("Pragma: no-cache");    
    }

    public function ajuntaFormataData($data)
    {
        $date = str_split($data, 2);        

        return $date['0'].'/'.$date['1'].'/'.$date['2'].$date['3'];        
    }
}
