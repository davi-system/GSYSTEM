<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalHistoricoSup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Histórico de chamado(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php if(!empty($chamados)) {?>
                <div class="col-md-12">
                    <div class="modal-body">
                        <div class="row">
                            <?php foreach($chamados as $cha): ?>
                                <div class="col-md-12">
                                    <div style="text-align:right; font-weight: bold;">
                                        <span><i class="bi bi-calendar"></i> <?php echo $cha['sup']['sup_dtcriacao']; ?></span>
                                        &nbsp;
                                        <span><i class="bi bi-hourglass-split"></i> <?php echo $cha['sup']['sup_horacriacao']; ?></span>
                                    </div>

                                    <label><b><?php echo $cha['sup']['sup_id']; ?> - Cartão</b></label>
                                    <?php 
                                        echo $this->Form->input('descricao', array(
                                            'label' => false,
                                            'type' => 'textarea',
                                            'class' => 'form-control',
                                            'value' => $cha['sup']['sup_descricao'],
                                            'disabled'
                                        )); 
                                    ?>                    
                                </div>                                            

                                <div>

                                    <br />

                                    <?php 
                                        echo $this->Form->button('<i class="bi bi-trash2"></i> Excluir', array(
                                            'title' => 'Excluir chamado',
                                            'type' => 'button',
                                            'class' => 'btn btn-danger',
                                            'escape' => false,
                                            'onclick' => "btnExcluirChamado({$cha['sup']['sup_id']}, {$cha['sup']['sup_usu_fk']});"
                                        )); 
                                    ?>

                                    <hr />

                                </div>                                                        
                            <?php endforeach; ?>
                            
                        </div>
                    </div>                
        
                    <div class="modal-footer">
                        <?php
                            echo $this->Form->button('<i class="bi bi-trash2"></i> Limpar Histórico', array(
                                'title' => 'Limpar histórico',
                                'type' => 'button',
                                'class' => 'btn btn-danger',
                                'escape' => false,
                                'onclick' => "btnLimparHistoricoChamado({$chamados[0]['sup']['sup_usu_fk']});"
                            )); 
                        ?>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            <?php } else {
                echo '
                    <div class="alert alert-danger" role="alert">
                        Você não tem chamados!
                    </div>
                ';
            } ?>
        </div>
    </div>
</div>