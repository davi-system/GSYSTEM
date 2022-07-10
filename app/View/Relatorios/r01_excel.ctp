<?php 
    header('charset=utf-8');

    $html = "                           
        <table border='1'>
            <thead>    
                <tr>                            
                    <th>Cod. Despesa</th>
                    <th>Tipo</th>
                    <th>Forma de Pagamento</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Parcelas</th>
                    <th>Data Criação</th>
                    <th>Hora Criação</th>
                </tr>
            </thead>";

            $html .="
            <tbody>";                    
                foreach($despesas as $des) {
                    $html .= "
                    <tr>
                        <td>{$des['des']['des_id']}</td>
                        <td>{$des['tip']['tip_descricao']}</td>
                        <td>{$des['frp']['frp_descricao']}</td>
                        <td>{$des['des']['des_descricao']}</td>
                        <td>{$des['des']['des_valor']}</td>
                        <td>{$des['des']['des_parcela']}</td>
                        <td>{$des['des']['des_dtcriacao']}</td>
                        <td>{$des['des']['des_horacriacao']}</td>                        
                    </tr>
                    ";
                } 
                $html .="                                                       
            </tbody>
        </table>                            
    ";  
    
    $this->Utilitarios->exportarDadosExcel('rel_despesas_'.date('d/m/Y'), $html);
?>