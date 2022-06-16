<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalViewDespesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualizar Despesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
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
                                        'id' => 'descricao',
                                        'disabled'
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
                                        'id' => 'valor',
                                        'disabled'
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
                                        'class' => 'form-control',
                                        'value' => $despesa['des']['des_tipo_fk'],
                                        'id' => 'tipo',
                                        'disabled'
                                    ));
                                ?>
                            </div>

                            <div class="col-md-3">
                                <?php
                                    echo $this->Form->input('des_frp_fk', array(
                                        'label' => 'Forma de Pagamento',
                                        'type' => 'select',
                                        'options' => $formaPagamento,
                                        'empty' => true,
                                        'class' => 'form-control',
                                        'value' => $despesa['des']['des_frp_fk'],
                                        'id' => 'frp',
                                        'disabled'
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
                                        'id' => 'parcela',
                                        'disabled'
                                    ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>