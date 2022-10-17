<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalFeedbackUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualizar Despesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-warning"><i class="bi bi-binoculars"></i> <b>Despesa</b></div>

                    <div class="card-body">                            
                       <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    echo $this->Form->input('sup_descricao', array(
                                        'label' => 'Descrição Completa',
                                        'type' => 'textarea',
                                        'class' => 'form-control',
                                        'value' => $feedback['sup']['sup_descricao'],
                                        'disabled'
                                    )); 
                                ?>
                            </div>
                       </div>
                    </div>

                    <div class="card-footer bg-transparent" style="text-align:right;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>                                                
        </div>        
    </div>
</div>
