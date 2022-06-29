<?php echo $this->Session->flash(); ?>

<div id="principal-add">
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
                                    'required'
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
                                    'class' => 'form-control',
                                    'required'
                                )); 
                            ?>
                        </div>
                        
                        <div class="input-group" style="width: 300px;">
                            <div class="col-md-10">
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
                        
                        <div class="col-md-3">
                            <?php 
                                echo $this->Form->input('des_frp_fk', array(
                                    'label' => 'Forma de Pagamento',
                                    'type' => 'select',
                                    'options' => $formaPagamento,
                                    'empty' => true,
                                    'class' => 'form-select',
                                    'id' => 'formaPagamento',
                                    'onchange' => 'qtdParcelas();',
                                    'required'
                                )); 
                            ?>
                        </div>

                        <div class="col-md-2" id="qtdParcela" style="display:none;">
                            <?php 
                                echo $this->Form->input('des_parcela', array(
                                    'label' => 'Parcela',
                                    'type' => 'number',                                    
                                    'class' => 'form-control'                                    
                                )); 
                            ?>
                        </div>
                    </div>
                                        
                    <br />

                    <div class="col-md-3">
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

<div id="modal">

</div>

<script>

    function qtdParcelas() {

        const qtdParcela = document.querySelector('#formaPagamento');

        if(qtdParcela.selectedIndex === 2) {
            document.getElementById('qtdParcela').style.display = '';
        } else {
            document.getElementById('qtdParcela').style.display = 'none';
        }
    }

    function abreModalAddTipo() {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalAddTipo')); ?>`,
            type: 'GET'            
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalAddTipo').modal('show');
        });
    }

</script>