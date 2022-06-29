<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalAddTipo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar novo tipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">                                                                            
                        <?php 
                            echo $this->Form->input('tip_descricao', array(
                                'label' => 'Descrição',
                                'type' => 'text',
                                'class' => 'form-control',
                                'id' => 'descricao'
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
                        'onclick' => 'saveNovoTipo();'
                    )); 
                ?>

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>

    function saveNovoTipo() {        

        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'salvarTipo')); ?>`,
            type: "POST",            
            data: {                
                'descricao': $('#descricao').val()                
            }
        }).done((data) => {            
            swal({
                title: "Sucesso!",
                text: "Novo tipo cadastrado com sucesso!",
                icon: "success",
                button: false
            });
            setTimeout((data) => {
                $(window.location.reload()).hide();
            }, 2000);   
        });
    }

</script>