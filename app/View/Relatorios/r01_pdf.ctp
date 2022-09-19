<?php 
    header('charset=utf-8');

    $html = "

        <style>
            #principal {
                width:90%;
                margin:0px auto;
            }

            .titulo_valor {
                text-align:center;
            }
        </style>

        <div id='principal'>

            <h3 align='center'>Despesas Cadastradas</h3>

            <table border=1>
                <thead>    
                    <tr>                            
                        <th class='titulo_valor'>Cod. Despesa</th>
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
                            <td class='titulo_valor'>{$des['des']['des_id']}</td>
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
    
    ";

    $this->Utilitarios->exportarDadosPDF("rel_despesas", $html);
?>