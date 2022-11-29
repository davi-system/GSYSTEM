<?php 
    header('charset=utf-8');

    $html = "
        <!DOCTYPE html>
        <html>
            <head>
                <style>

                    body {
                        padding-top: 10px;
                        padding-rigth: 10px;
                        padding-left: 20px;                        
                    }

                    #principal {
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }

                    .titulo_valor {
                        text-align:center;
                    }

                    h3 {
                        text-align:center;                        
                    }
                </style>       
            </head>

            <body>            
            <div id='principal'>
        
                <h3>Despesas Cadastradas</h3>
        
                <table>
                    <thead>    
                        <tr>                                                        
                            <th>Tipo</th>
                            <th>Forma de Pagamento</th>
                            <th>Descrição</th>
                            <th class='titulo_valor'>Valor</th>
                            <th class='titulo_valor'>Parcelas</th>
                            <th class='titulo_valor'>Data Criação</th>
                            <th class='titulo_valor'>Hora Criação</th>
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
                                <td class='titulo_valor'>{$des['des']['des_valor']}</td>
                                <td class='titulo_valor'>{$des['des']['des_parcela']}</td>
                                <td class='titulo_valor'>{$this->Utilitarios->formatarData($des['des']['des_dtcriacao'])}</td>
                                <td class='titulo_valor'>{$des['des']['des_horacriacao']}</td>                        
                            </tr>
                            ";
                        } 
                        $html .="                                                       
                    </tbody>
                </table>                            
            </div>
            </body>
        </html>
    ";

    $this->Utilitarios->exportarDadosPDF("rel_despesas", $html, 'portrait');  
?>