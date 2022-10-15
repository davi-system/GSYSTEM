<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'autoload.inc.php'); 

use Dompdf\Dompdf;
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class UtilitariosHelper extends Helper {

    public function formatarData($data)
    {
        $date = DateTime::createFromFormat('Y-m-d', $data);
        return $date->format('d/m/Y');
    }

    public function exportarDadosExcel($fileName, $html)
    {                             
        header("Content-type: application/xls");
        header("Content-type: application/force-download");     
        header("Content-Disposition: attachment; filename=$fileName.xls");                 
        header("Pragma: no-cache");
        echo $html;
    }

    public function exportarDadosPDF($fileName, $html)
    {                             
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($fileName);
    }

    public function separaData($data)
    {        
        $date = explode('/', $data);        

        $dia = $date['0'];
        $mes = $date['1'];
        $ano = $date['2'];            
        
        return $dia.$mes.$ano;                
    }
}
