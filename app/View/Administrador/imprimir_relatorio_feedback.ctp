<?php 
    header('charset=utf-8');

    $html = "

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
        
                    <h3>Relatório Usuarios & Feedbacks</h3>
        
                    <table>                
                        <thead>
                            <tr>
                                <th class='titulo_valor'>Cod. Usuário</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th class='titulo_valor'>Cod. Feedback</th>
                                <th>Descrição Feedback</th>                            
                                <th class='titulo_valor'>Data Criação</th>
                                <th class='titulo_valor'>Hora Criação</th>                                            
                            </tr>                              
                        </thead>
        
                        <tbody>";                    
                            foreach($feedback as $suporte) {                                                
                                $html .= "
                                    <tr>
                                        <td class='titulo_valor'>{$suporte['usu']['usu_id']}</td>
                                        <td>{$suporte['usu']['usu_nome']}</td>
                                        <td>{$suporte['usu']['usu_email']}</td>
                                        <td class='titulo_valor'>{$suporte['sup']['sup_id']}</td>
                                        <td>{$suporte['sup']['sup_descricao']}</td>                                    
                                        <td class='titulo_valor'>{$this->Utilitarios->formatarData($suporte['sup']['sup_dtcriacao'])}</td>
                                        <td class='titulo_valor'>{$suporte['sup']['sup_horacriacao']}</td>
                                    </tr>
                                ";
                            }
        
                            $html .= "                    
                        </tbody>                         
                    </table>                            
                </div>
            </body>
        </html>
    ";

    $this->Utilitarios->exportarDadosPDF("rel_usuario_feedbacks", $html, 'portrait');
?>