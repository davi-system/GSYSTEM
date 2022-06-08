<?php echo $this->Session->flash(); ?>

<div id="principal-add">
    <div class="modal-header">
        <h3>Cadastro de Despesas</h3>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Form->create('Despesas', array('url' => array('controller' => 'Despesas', 'action' => 'add'))); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                echo $this->Form->input('des_descricao', array(
                                    'label' => 'Descrição',
                                    'type' => 'text',
                                    'class' => 'form-control'                                    
                                    // 'required'
                                )); 
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?php 
                                echo $this->Form->input('des_valor', array(
                                    'label' => 'Valor',
                                    'type' => 'number',
                                    'class' => 'form-control'                                    
                                    // 'required'
                                )); 
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?php 
                                echo $this->Form->input('des_tipo_fk', array(
                                    'label' => 'Tipo',
                                    'type' => 'select',
                                    'options' => $tipos,
                                    'empty' => true,
                                    'class' => 'form-control'
                                    // 'required'
                                )); 
                            ?>
                        </div>

                        <div class="col-auto">
                            <?php 
                                echo $this->Form->input('des_frp_fk', array(
                                    'label' => 'Forma de Pagamento',
                                    'type' => 'select',
                                    'options' => $formaPagamento,
                                    'empty' => true,
                                    'class' => 'form-control'
                                    // 'required'
                                )); 
                            ?>
                        </div>

                        <div class="col-auto">
                            <?php 
                                echo $this->Form->input('des_parcela', array(
                                    'label' => 'Parcela',
                                    'type' => 'number',
                                    'class' => 'form-control'                                    
                                    // 'required'
                                )); 
                            ?>
                        </div>
                    </div>

                    <div class="col-auto">
                        <?php 
                            echo $this->Form->button('Salvar', array(
                                'title' => 'Salvar cadastro de despesa',
                                'type' => 'submit',
                                'class' => 'btn btn-primary'
                            )); 
                        ?>
                    </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>