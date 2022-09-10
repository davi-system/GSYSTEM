<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalEditTipo" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar tipo da despesa</h5>
                <button type="button" onclick="fechaModal();" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-success"><b>Tipos da Despesa</b></div>
                
                    <div class="card-body">                                                                                                         
                        <div class="row">
                            <div class="col-md-12">                                                                                                  
                                <?php 
                                    echo $this->Form->input('tip_descricao', array(
                                        'label' => 'Descrição',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'descricao',
                                        'value' => $tipoDespesa['tip']['tip_descricao']
                                    )); 
                                ?>   
                            </div>                    
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent" style="text-align: right;">                                      
                        <?php 
                            echo $this->Form->button('Salvar', array(
                                'title' => 'Salvar cadastro',
                                'type' => 'button',
                                'class' => 'btn btn-success',
                                'onclick' => "salvarEditTipo($idTipo);"
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

    function salvarEditTipo(idTipo) {        

        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'salvaEditTipo')); ?>`,
            type: "POST",            
            data: {     
                'tip_id': idTipo,        
                'descricao': $('#descricao').val()                
            }
        }).done((data) => {            
            swal({
                title: "Sucesso!",
                text: "Tipo alterado com sucesso!",
                icon: "success",
                button: true
            });                        
            fechaModal();            
        });
    }

    function fechaModal() {        
        $('#modalEditTipo').modal('hide');
        abreModalAddTipo();
    }

</script>