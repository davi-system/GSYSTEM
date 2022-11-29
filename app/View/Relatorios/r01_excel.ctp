<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />

<?php

    $html = "
        <!DOCTYPE html>
        <html>
            <head>
                <style>
                    .descricao_valor {
                        text-align: center;
                    }

                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                </style>
            </head>

            <body>
                <table>
                    <thead>    
                        <tr>                                                
                            <th>Tipo</th>
                            <th>Forma de Pagamento</th>
                            <th>Descrição</th>
                            <th class='descricao_valor'>Valor</th>
                            <th class='descricao_valor'>Parcelas</th>
                            <th class='descricao_valor'>Data Criação</th>
                            <th class='descricao_valor'>Hora Criação</th>
                        </tr>
                    </thead>";
                
                    $html .="
                    <tbody>";                    
                        foreach($despesas as $des) {
                            $html .= "
                            <tr>                        
                                <td>{$des['tip']['tip_descricao']}</td>
                                <td>{$des['frp']['frp_descricao']}</td>
                                <td>{$des['des']['des_descricao']}</td>
                                <td class='descricao_valor'>{$des['des']['des_valor']}</td>
                                <td class='descricao_valor'>{$des['des']['des_parcela']}</td>
                                <td class='descricao_valor'>{$des['des']['des_dtcriacao']}</td>
                                <td class='descricao_valor'>{$des['des']['des_horacriacao']}</td>                        
                            </tr>
                            ";
                        } 
                        $html .="                                                       
                    </tbody>
                </table>                            
            </body>
        </html>
    ";  
    
    $this->Utilitarios->exportarDadosExcel('rel_despesas_'.date('d/m/Y'), $html);    
?>