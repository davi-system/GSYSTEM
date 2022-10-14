<?php echo $this->Session->flash(); ?>

<br />

<style>
    .date {
        font-family: Arial, Helvetica, sans-serif;
        /* font-weight: bold; */
    }
</style>

<div class="container shadow p-3 mb-2 bg-body rounded">
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
            
            <div class="card">
                <div class="card-header text-white" style="background-color:purple;"><i class="bi bi-journal-text"></i> <b>Relatório</b></div>

                <div class="card-body">                            
                    
                    <?php echo $this->Form->create('Rel', array('url' => array('controller' => 'Relatorios', 'action' => 'index'))); ?>
                        <div class="row">                    
                            <div>
                                <h4 align="center">Informe uma periodo para tirar o relatório</h4>

                                <br />
                            </div>
                            
                            <div class="col-md-4">
                                <?php 
                                    echo $this->Form->input('data1', array(
                                        'label' => 'Início',
                                        'type' => 'text',
                                        'class' => 'form-control date',
                                        'required',
                                        'onkeyup' => "mascaraData(this, this.value)",
                                        'minlength' => '10',
                                        'maxlength' => '10',
                                        'placeholder' => '00/00/0000'                                                                                                           
                                    )); 
                                ?>
                            </div>
                                                   
                            <div class="col-md-4">
                                <?php   
                                    echo $this->Form->input('data2', array(
                                        'label' => 'Término',
                                        'type' => 'text',
                                        'class' => 'form-control date',
                                        'required',
                                        'onkeyup' => "mascaraData(this, this.value)",
                                        'minlength' => '10',
                                        'maxlength' => '10',
                                        'placeholder' => '00/00/0000'                                                                                      
                                    )); 
                                ?>
                            </div>                    
                            
                            <div class="col-md-4">         
                            
                                <br />
        
                                <?php 
                                    echo $this->Form->button('<i class="bi bi-search"></i> Buscar', array(
                                        'title' => 'Buscar',
                                        'type' => 'submit',
                                        'class' => 'btn',
                                        'style' => 'background-color:purple; color:white;',
                                        'escape' => false                                                                                                        
                                    )); 
                                ?>  
                                
                                &nbsp;&nbsp;
        
                                <?php 
                                    // Envio as datas para o controller e depois recupero aqui
                                    $dataInicio = (isset($data1)) ? $this->Utilitarios->separaData($data1) : '';
                                    $dataFim = (isset($data2)) ? $this->Utilitarios->separaData($data2) : '';
                                    
                                    $disabled = (empty($despesas) ? 'disabled' : '');
        
                                    echo $this->Form->button('<i class="bi bi-file-earmark-spreadsheet"></i> Excel', array(
                                        'title' => 'Exportar para Excel',
                                        'type' => 'button',
                                        'onclick' => "btnExportarExcel({$usuario}, {$dataInicio}, {$dataFim})",                                                           
                                        'class' => 'btn btn-success',                                
                                        'escape' => false,
                                        $disabled                                                                                                          
                                    )); 
                                ?>

                                &nbsp;&nbsp;
                                        
                                <?php 
                                    // Envio as datas para o controller e depois recupero aqui
                                    $dataInicio = (isset($data1)) ? $this->Utilitarios->separaData($data1) : '';
                                    $dataFim = (isset($data2)) ? $this->Utilitarios->separaData($data2) : '';
                                    
                                    $disabled = (empty($despesas) ? 'disabled' : '');

                                    echo $this->Form->button('<i class="bi bi-file-earmark-pdf"></i> PDF', array(
                                        'title' => 'Exportar para PDF',
                                        'type' => 'button',
                                        'onclick' => "btnExportarPdf({$usuario}, {$dataInicio}, {$dataFim})",                                                           
                                        'class' => 'btn btn-danger',                                
                                        'escape' => false,
                                        $disabled                                                                                                          
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
                                    <?php if(!empty($despesas)) { ?>                    
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
                                    <?php } else {
                                        echo "<center><b>Nenhum registro encontrado!</b></center>";
                                    } ?>                   
                                </table> 
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>            
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

    function btnExportarPdf(usuario, data1, data2) {   

        window.location.href = `<?php echo $this->Html->url(array('controller' => 'Relatorios', 'action' => 'r01Pdf'), array('target' => '_blank')); ?>/${usuario}/${data1}/${data2}`;                
    }

</script>