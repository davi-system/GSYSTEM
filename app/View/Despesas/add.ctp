<?php echo $this->Session->flash(); ?>

<br />

<div class="container">
    <div class="modal-header">
        <h3>Cadastro de Despesas</h3>
    </div>

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

        <?php 
            echo $this->Form->button('<i class="bi bi bi-save2"></i> Salvar', array(
                'title' => 'Salvar cadastro de despesa',
                'type' => 'submit',
                'class' => 'btn btn-primary',
                'escape' => false
            )); 
        ?>

        <br /><br />

        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Form->create('Despesas', array('url' => array('controller' => 'Despesas', 'action' => 'add'))); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                echo $this->Form->input('des_descricao', array(
                                    'label' => 'Descrição',
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'required'                                    
                                )); 
                            ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <?php 
                                echo $this->Form->input('des_tipo_fk', array(
                                    'label' => 'Tipo',
                                    'type' => 'select',
                                    'options' => $tipos,
                                    'empty' => true,
                                    'class' => 'form-select',
                                    'required'
                                ));                                                                 
                            ?>
                        </div>                                               

                        <div class="col-md-4">
                            <?php 
                                echo $this->Form->input('des_frp_fk', array(
                                    'label' => 'Forma de Pagamento',
                                    'type' => 'select',
                                    'options' => $formaPagamento,
                                    'empty' => true,
                                    'class' => 'form-select',
                                    'id' => 'formaPagamento',
                                    'onchange' => 'opcaoDePagamento();',
                                    'required'
                                )); 
                            ?>
                        </div>                                           

                        <div class="col-md-2">
                            <?php 
                                echo $this->Form->input('des_valor', array(
                                    'label' => 'Valor',
                                    'type' => 'number',
                                    'class' => 'form-control',
                                    'required'                                    
                                )); 
                            ?>
                        </div>

                        <div class="col-md-2">
                            <?php 
                                echo $this->Form->input('des_parcela', array(
                                    'label' => 'Parcela',
                                    'type' => 'number',                                    
                                    'class' => 'form-control',
                                    'id' => 'parcela'                                                               
                                )); 
                            ?>
                        </div>
                    </div>                                        

                    <div class="row" style="text-align:right;">                        
                        <div class="col-md-12">
                            <?php 
                                echo $this->Form->button('<i class="bi bi-plus"></i> Tipo', array(
                                    'title' => 'Adicionar novo tipo',
                                    'type' => 'button',
                                    'class' => 'btn btn-secondary',
                                    'style' => 'margin-top:24px;',
                                    'onclick' => 'abreModalAddTipo();',
                                    'escape' => false
                                )); 
                            ?>

                            <?php 
                                echo $this->Form->button('<i class="bi bi-plus"></i> Forma de Pagamento', array(
                                    'title' => 'Adicionar nova forma de pagamento',
                                    'type' => 'button',
                                    'class' => 'btn btn-secondary',
                                    'style' => 'margin-top:24px;',
                                    'onclick' => "abreModalAddFrp();",
                                    'escape' => false
                                )); 
                            ?>
                        </div>                            
                    </div>

                    <br />                    
                                    
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<div id="modal">

</div>

<script>    

    function abreModalAddTipo() {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalAddTipo')); ?>`,
            type: 'GET'            
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalAddTipo').modal('show');
        });
    }

    function abreModalAddFrp() {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalAddFrp')); ?>`,
            type: 'GET'            
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalAddFrp').modal('show');
        });
    }

</script>