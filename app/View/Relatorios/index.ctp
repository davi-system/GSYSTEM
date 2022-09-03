<?php echo $this->Session->flash(); ?>

<style>
    .date {
        /* text-align: center; */
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
    }
</style>

<div id="principal-add">
    <div class="modal-header">
        <h3>Relatórios</h3>        
    </div>

    <div class="col-md-12">
        <div class="modal-body">         

            <?php 
                echo $this->Html->link('<i class="bi bi-arrow-left"></i> Voltar', array(
                    'controller' => 'Menu',
                    'action' => 'index'
                ), array(
                    'class' => 'btn btn-secondary',
                    'escape' => false
                ));
            ?>

            <br /><br />

            <?php echo $this->Form->create('Rel', array('url' => array('controller' => 'Relatorios', 'action' => 'index'))); ?>
                <div class="row">                    
                    <div>
                        <h4>Informe uma periodo para tirar o relatório</h4>
                    </div>
                    
                    <div class="col-md-3">
                        <?php 
                            echo $this->Form->input('data1', array(
                                'label' => 'De',
                                'type' => 'text',
                                'class' => 'form-control date',
                                'required',
                                'onkeyup' => "mascaraData(this, this.value)",
                                'minlength' => '10',
                                'maxlength' => '10',
                                'placeholder' => 'Data início'                                                                                                           
                            )); 
                        ?>
                    </div>

                    <div class="col-md-3">
                        <?php   
                            echo $this->Form->input('data2', array(
                                'label' => 'Até',
                                'type' => 'text',
                                'class' => 'form-control date',
                                'required',
                                'onkeyup' => "mascaraData(this, this.value)",
                                'minlength' => '10',
                                'maxlength' => '10',
                                'placeholder' => 'Data fim'                                                                                      
                            )); 
                        ?>
                    </div>                    
                    
                    <div class="col-md-6">         
                    
                        <br />

                        <?php 
                            echo $this->Form->button('Buscar', array(
                                'title' => 'Buscar',
                                'type' => 'submit',
                                'class' => 'btn btn-primary'                                                                                                           
                            )); 
                        ?>                                           

                        <?php 
                            // Envio as datas para o controller e depois recupero aqui
                            $dataInicio = (isset($data1)) ? $this->Utilitarios->separaData($data1) : '';
                            $dataFim = (isset($data2)) ? $this->Utilitarios->separaData($data2) : '';                            

                            echo $this->Form->button('<i class="bi bi-file-earmark-spreadsheet"></i> Exportar Excel', array(
                                'title' => '',
                                'type' => 'button',
                                'onclick' => "btnExportarExcel({$usuario}, {$dataInicio}, {$dataFim})",                                                           
                                'class' => 'btn btn-success',                                
                                'escape' => false                                                                                                            
                            )); 
                        ?>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>

            <br />
            
            <?php if(isset($despesas)) { ?>

                <div class="row">
                    <div class="col-md-12">                    
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Cod. Despesa</th>
                                    <th>Tipo</th>
                                    <th>Forma de Pagamento</th>
                                    <th>Descrição</th>
                                    <th style="text-align:center;">Valor</th>
                                    <th>Parcelas</th>
                                    <th style="text-align:center;">Data Criação</th>
                                    <th style="text-align:center;">Hora Criação</th>
                                </tr>                              
                            </thead>

                            <tbody>
                                <?php
                                    foreach($despesas as $des) {
                                        echo "
                                            <tr>
                                                <td style='text-align:center;'>{$des['des']['des_id']}</td>
                                                <td>{$des['tip']['tip_descricao']}</td>
                                                <td>{$des['frp']['frp_descricao']}</td>
                                                <td>{$des['des']['des_descricao']}</td>
                                                <td style='text-align:center;'>{$des['des']['des_valor']}</td>
                                                <td style='text-align:center;'>{$des['des']['des_parcela']}</td>
                                                <td style='text-align:center;'>{$this->Utilitarios->formatarData($des['des']['des_dtcriacao'])}</td>
                                                <td style='text-align:center;'>{$des['des']['des_horacriacao']}</td>
                                            </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>                    
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>

    function mascaraData(campo, valor){

        var mydata = '';

        mydata += valor;

        if(mydata.length == 2) {
            mydata += '/';
            campo.value = mydata;
        }

        if(mydata.length == 5) {
            mydata += '/';
            campo.value = mydata;
        }
    }

    function btnExportarExcel(usuario, data1, data2) {   

        window.location.href = `<?php echo $this->Html->url(array('controller' => 'Relatorios', 'action' => 'r01Excel'), array('target' => '_blank')); ?>/${usuario}/${data1}/${data2}`;                
    }

</script>