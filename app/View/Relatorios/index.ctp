<?php echo $this->Session->flash(); ?>

<style>
    .date {
        text-align: center;
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
                                'class' => 'form-control',
                                'required',
                                'onkeyup' => "mascaraData(this, this.value)",
                                'minlength' => '10',
                                'maxlength' => '10'
                            )); 
                        ?>
                    </div>

                    <div class="col-md-3">
                        <?php   
                            echo $this->Form->input('data2', array(
                                'label' => 'Até',
                                'type' => 'text',
                                'class' => 'form-control',
                                'required',
                                'onkeyup' => "mascaraData(this, this.value)",
                                'minlength' => '10',
                                'maxlength' => '10'
                            )); 
                        ?>
                    </div>                    
                    
                    <div class="col-md-6">         
                    
                        <br />

                        <?php 
                            echo $this->Form->button('Buscar', array(
                                'titile' => '',
                                'type' => 'submit',
                                'class' => 'btn btn-primary',
                                'escape' => false                                                          
                            )); 
                        ?>

                        <?php 
                            echo $this->Html->link('<i class="bi bi-file-earmark-spreadsheet"></i> Exportar Excel', array(                                
                                'controller' => 'Relatorios',
                                'action' => ''                                
                            ), array(
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
                                <th>Cod. Despesa</th>
                                <th>Tipo</th>
                                <th>Forma de Pagamento</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Parcelas</th>
                                <th>Data Criação</th>
                                <th>Hora Criação</th>
                            </thead>

                            <tbody>
                                <?php
                                    foreach($despesas as $des) {
                                        echo "
                                            <td>{$des['des']['des_id']}</td>
                                            <td>{$des['tip']['tip_descricao']}</td>
                                            <td>{$des['frp']['frp_descricao']}</td>
                                            <td>{$des['des']['des_descricao']}</td>
                                            <td>{$des['des']['des_valor']}</td>
                                            <td>{$des['des']['des_parcela']}</td>
                                            <td>{$des['des']['des_dtcriacao']}</td>
                                            <td>{$des['des']['des_horacriacao']}</td>
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

</script>