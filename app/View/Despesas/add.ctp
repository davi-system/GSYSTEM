<?php echo $this->Session->flash(); ?>

<div id="view-despesa">
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
                                    'required',
                                    'placeholder' => 'Informe uma descrição'
                                )); 
                            ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-group">
                            <div class="col-md-11">
                                <?php 
                                    echo $this->Form->input('des_tipo_fk', array(
                                        'label' => 'Tipo',
                                        'type' => 'select',
                                        'options' => $tipos,
                                        'empty' => 'Informe um tipo',
                                        'class' => 'form-select',
                                        'required'
                                    ));                                                                 
                                ?>
                            </div>

                            &nbsp;&nbsp;&nbsp;

                            <div>
                                <?php 
                                    echo $this->Form->button('<i class="bi bi-plus"></i>', array(
                                        'title' => 'Adicionar novo tipo',
                                        'type' => 'button',
                                        'class' => 'btn btn-outline-secondary',
                                        'style' => 'margin-top:24px;',
                                        'onclick' => 'abreModalAddTipo();'
                                    )); 
                                ?>
                            </div>                            
                        </div>

                        <div class="input-group">                           
                            <div class="col-md-11">
                                <?php 
                                    echo $this->Form->input('des_frp_fk', array(
                                        'label' => 'Forma de Pagamento',
                                        'type' => 'select',
                                        'options' => $formaPagamento,
                                        'empty' => 'Informe meio de pagamento',
                                        'class' => 'form-select',
                                        'id' => 'formaPagamento',
                                        'onchange' => 'opcaoDePagamento();',
                                        'required'
                                    )); 
                                ?>
                            </div>

                            &nbsp;&nbsp;&nbsp;

                            <div>
                                <?php 
                                    echo $this->Form->button('<i class="bi bi-plus"></i>', array(
                                        'title' => 'Adicionar nova forma de pagamento',
                                        'type' => 'button',
                                        'class' => 'btn btn-outline-secondary',
                                        'style' => 'margin-top:24px;',
                                        'onclick' => "abreModalAddFrp();"
                                    )); 
                                ?>
                            </div>                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('des_valor', array(
                                    'label' => 'Valor',
                                    'type' => 'number',
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => 'Informe um valor'
                                )); 
                            ?>
                        </div>
                                                                                       
                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('des_parcela', array(
                                    'label' => 'Parcela',
                                    'type' => 'number',                                    
                                    'class' => 'form-control',
                                    'id' => 'parcela',
                                    'placeholder' => '(opcional)'                             
                                )); 
                            ?>
                        </div>
                    </div>

                    <br />

                    <?php 
                        echo $this->Form->button('<i class="bi bi bi-save2"></i> Salvar', array(
                            'title' => 'Salvar cadastro de despesa',
                            'type' => 'submit',
                            'class' => 'btn btn-primary',
                            'escape' => false
                        )); 
                    ?>
                                    
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