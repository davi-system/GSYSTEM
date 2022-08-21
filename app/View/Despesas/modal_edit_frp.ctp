<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalEditFrp" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar forma de pagamento</h5>
                <button type="button" onclick="fechaModal();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">                                                                            
                        <?php 
                            echo $this->Form->input('frp_descricao', array(
                                'label' => 'Descrição',
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'descricao',
                                'value' => $formaPagamento['frp']['frp_descricao']
                            )); 
                        ?>                        
                    </div>                    
                </div>               
            </div>

            <div class="modal-footer">
                <?php 
                    echo $this->Form->button('Salvar', array(
                        'title' => 'Salvar cadastro',
                        'type' => 'button',
                        'class' => 'btn btn-primary',
                        'onclick' => "salvarFormaPagamento($idFrp);"
                    )); 
                ?>                
            </div>
        </div>
    </div>
</div>

<script>

    function salvarFormaPagamento(idFrp) {        

        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'salvaFormaPagamento')); ?>",
            type: "POST",            
            data: {    
                'frpId': idFrp,            
                'descricao': $('#descricao').val()                
            }
        }).done((data) => {            
            swal({
                title: "Sucesso!",
                text: "Forma de pagamento editado com sucesso!",
                icon: "success",
                button: true
            });
            fechaModal();
        });
    }

    function fechaModal() {        
        $('#modalEditFrp').modal('hide');
        abreModalAddFrp();
    }

</script>