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
        $ano = substr($data, 0, 4);
        $mes = substr($data, 4, 2); 
        $dia = substr($data, 6, 8);
        
        return $ano.'-'.$mes.'-'.$dia;
    }

    public function formatoAmericanoSemTraco($date)
    {
        $dataFormatoBrasileiro = DateTime::createFromFormat('d/m/Y', $date);
        $dataFormatoAmericano = $dataFormatoBrasileiro->format('Y-m-d');

        $formatandoData = explode('-', $dataFormatoAmericano);
        return $formatandoData['0'].$formatandoData['1'].$formatandoData['2'];
    }
}
