<?php echo $this->Session->flash(); ?>

<br />

<div class="container shadow p-3 mb-2 bg-body rounded">
    <div class="modal-header">
        <h3>Cadastro de Despesas</h3>
    </div>

    <div class="modal-body">
        <div class="card">
            <div class="card-header text-white bg-primary"><i class="bi bi-pencil-fill"></i> <b>Despesa</b></div>

            <?php echo $this->Form->create('Despesas', array('url' => array('controller' => 'Despesas', 'action' => 'add'))); ?>
                <div class="card-body">                                        
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
                        echo $this->Form->button('<i class="bi bi-check"></i> Salvar', array(
                            'title' => 'Salvar cadastro de despesa',
                            'type' => 'submit',
                            'class' => 'btn btn-primary',
                            'escape' => false
                        )); 
                    ?>
        
                    <br /><br />
        
                    <div class="row">            
                        <div class="col-md-12">
                            <div class="alert alert-primary" role="alert">
                                Atenção! Campos com <b>*</b> são de preenchimento obrigatório.
                            </div>
        
                            <div class="row">
                                <div class="col-md-12 ">
                                    <?php 
                                        echo $this->Form->input('des_descricao', array(
                                            'label' => 'Descrição <font color="red">*</font>',
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
                                            'label' => 'Tipo <font color="red">*</font>',
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
                                            'label' => 'Forma de Pagamento <font color="red">*</font>',
                                            'type' => 'select',
                                            'options' => $formaPagamento,
                                            'empty' => true,
                                            'class' => 'form-select',
                                            'id' => 'formaPagamento',                                    
                                            'required'
                                        )); 
                                    ?>
                                </div>                                           
        
                                <div class="col-md-2">
                                    <?php 
                                        echo $this->Form->input('des_valor', array(
                                            'label' => 'Valor <font color="red">*</font>',
                                            'type' => 'text',
                                            'id' => 'valor',
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
                        </div>
                    </div>
        
                </div>
                
                <div class="card-footer bg-transparent" style="text-align: right;">
                    <?php 
                        echo $this->Form->button('<i class="bi bi-plus"></i> Tipo', array(
                            'title' => 'Adicionar novo tipo',
                            'type' => 'button',
                            'class' => 'btn btn-secondary',                            
                            'onclick' => 'abreModalAddTipo();',
                            'escape' => false
                        )); 
                    ?>

                    <?php 
                        echo $this->Form->button('<i class="bi bi-plus"></i> Forma de Pagamento', array(
                            'title' => 'Adicionar nova forma de pagamento',
                            'type' => 'button',
                            'class' => 'btn btn-secondary',                            
                            'onclick' => "abreModalAddFrp();",
                            'escape' => false
                        )); 
                    ?>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<!-- Abre o modal para adicionar um novo tipo de despesa ou forma de pagamento -->
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

    let valor = document.getElementById('valor').value;
    if(valor.length ) {

    }

</script>