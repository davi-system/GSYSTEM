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
                        <th style='text-align:center;'>Cod. Usuário</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th style='text-align:center;'>Cod. Feedback</th>
                        <th>Descrição Feedback</th>                            
                        <th style='text-align:center;'>Data Criação</th>
                        <th style='text-align:center;'>Hora Criação</th>                                            
                    </tr>                              
                </thead>

                <tbody>";                    
                    foreach($feedback as $suporte) {                                                
                        $html .= "
                            <tr>
                                <td style='text-align:center;'>{$suporte['usu']['usu_id']}</td>
                                <td>{$suporte['usu']['usu_nome']}</td>
                                <td>{$suporte['usu']['usu_email']}</td>
                                <td style='text-align:center;'>{$suporte['sup']['sup_id']}</td>
                                <td>{$suporte['sup']['sup_descricao']}</td>                                    
                                <td style='text-align:center;'>{$this->Utilitarios->formatarData($suporte['sup']['sup_dtcriacao'])}</td>
                                <td style='text-align:center;'>{$suporte['sup']['sup_horacriacao']}</td>
                            </tr>
                        ";
                    }

                    $html .= "                    
                </tbody>                         
            </table>                            
        </div>
    ";

    $this->Utilitarios->exportarDadosPDF("rel_usuario_feedbacks", $html);
?>