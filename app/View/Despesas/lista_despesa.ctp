<?php if(isset($despesas)) { ?>
    <table class="table table-striped table-hover">
        
        <?php if(!empty($despesas)) { ?>     
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Forma de Pagamento</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Parcela</th>
                    <th>Data Criação</th>
                    <th>Hora Criação</th>
                </tr>
            </thead> 

            <tbody>
                <?php                 
                    foreach($despesas as $des) {                                    
                        echo "
                            <tr>
                                <td>
                                    ".
                                        $this->Form->button('<i class="bi bi-search"></i>', array(
                                            'title' => 'Visualizar despesa',
                                            'type' => 'button',                                                        
                                            'onclick' => "abreModalViewDespesa({$des['des']['des_id']});",
                                            'class' => 'btn btn-warning'                                                                                                                         
                                        ))
                                    ."                                                

                                    ".
                                        $this->Form->button('<i class="bi bi-pencil-square"></i>', array(
                                            'title' => 'Editar despesa',
                                            'type' => 'button',
                                            'onclick' => "abreModalEditDespesa({$des['des']['des_id']});",
                                            'class' => 'btn btn-success'                                
                                        ))
                                    ."

                                    ".
                                    $this->Form->button('<i class="bi bi-trash"></i>', array(
                                        'title' => 'Excluir despesa',
                                        'type' => 'button',
                                        'onclick' => "deletarDespesa({$des['des']['des_id']});",
                                        'class' => 'btn btn-danger'                                
                                    ))
                                ."
                                </td>
                                <td>{$des['des']['des_id']}</td>
                                <td>{$des['tip']['tip_descricao']}</td>
                                <td>{$des['frp']['frp_descricao']}</td>
                                <td>{$des['des']['des_descricao']}</td>
                                <td>{$des['des']['des_valor']}</td>
                                <td>{$des['des']['des_parcela']}</td>
                                <td>{$this->Utilitarios->formatarData($des['des']['des_dtcriacao'])}</td>
                                <td>{$des['des']['des_horacriacao']}</td>                                    
                            </tr>
                        ";
                    }                
                ?>
            </tbody>
        <?php } else {
            echo "<center><b>Nenhum registro encontrado!</b></center>";
        } ?>
    </table>
<?php } ?>