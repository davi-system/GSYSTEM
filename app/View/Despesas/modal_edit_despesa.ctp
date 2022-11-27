<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalEditDespesa" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Despesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-success"><i class="bi bi-pencil-fill"></i> <b>Despesa</b></div>

                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-md-12">
        
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                            echo $this->Form->input('des_descricao', array(
                                                'label' => 'Descrição',
                                                'type' => 'text',
                                                'class' => 'form-control',
                                                'value' => $despesa['des']['des_descricao'],
                                                'id' => 'descricao_edit'
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
                                                'value' => $despesa['des']['des_valor'],
                                                'id' => 'valor_edit'
                                            ));
                                        ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <?php                                
                                            echo $this->Form->input('des_tipo_fk', array(
                                                'label' => 'Tipo',
                                                'type' => 'select',
                                                'options' => $tipos,                                                
                                                'class' => 'form-select',
                                                'value' => $despesa['des']['des_tipo_fk'],
                                                'id' => 'tipo_edit'
                                            ));
                                        ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <?php
                                            echo $this->Form->input('des_frp_fk', array(
                                                'label' => 'Forma de Pagamento',
                                                'type' => 'select',
                                                'options' => $formaPagamento,                                                
                                                'class' => 'form-select',
                                                'value' => $despesa['des']['des_frp_fk'],
                                                'id' => 'frp_edit'
                                            ));
                                        ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <?php
                                            echo $this->Form->input('des_parcela', array(
                                                'label' => 'Parcela',
                                                'type' => 'number',
                                                'class' => 'form-control',
                                                'value' => $despesa['des']['des_parcela'],
                                                'id' => 'parcela_edit'
                                            ));
                                        ?>
                                    </div>
                                </div>                                                                                        
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent" style="text-align: right;">
                        <?php
                            echo $this->Form->button('Salvar', array(
                                'title' => 'Salvar cadastro de despesa',
                                'type' => 'button',
                                'class' => 'btn btn-success',
                                'onclick' => "saveEditDespesa({$id});"
                            ));
                        ?>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>

    function saveEditDespesa(id) {              

        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'salvaEditDespesa')); ?>`,
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {
                'id': id,
                'descricao': $('#descricao_edit').val(),
                'valor': $('#valor_edit').val(),
                'tipo': $('#tipo_edit').val(),
                'formaPagamento': $('#frp_edit').val(),
                'parcelas': $('#parcela_edit').val()
            }
        }).done((data) => {            
            swal({
                title: "Sucesso!",
                text: "Registro editado com sucesso!",
                icon: "success",
                button: true
            });            
            $('#modalEditDespesa').modal('hide');
            consultarDespesas();
        });
    }

</script>