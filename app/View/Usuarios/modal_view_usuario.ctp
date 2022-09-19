<?php echo $this->Session->flash(); ?>

<style>
    .modal-dialog {
        width: 25%;
        margin: 1% auto;
    }
</style>

<div class="modal fade" id="modalViewUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Visualizar Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-warning"><i class="bi bi-person"></i> <b>Usuário</b></div>

                    <div class="card-body">                     
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    echo $this->Form->input('usu_nome', array(
                                        'label' => 'Nome',
                                        'type' => 'text',
                                        'class' => 'form-control',                                    
                                        'value' => $usuario['usu']['usu_nome'],
                                        'disabled'                                 
                                    )); 
                                ?>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    echo $this->Form->input('usu_email', array(
                                        'label' => 'E-mail',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'placeholder' => 'fulano@gmail.com',
                                        'value' => $usuario['usu']['usu_email'],
                                        'disabled'
                                    )); 
                                ?>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    echo $this->Form->input('usu_senha', array(
                                        'label' => 'Senha',
                                        'type' => 'password',
                                        'class' => 'form-control', 
                                        'value' => $usuario['usu']['usu_senha'],
                                        'disabled'
                                    )); 
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent" style="text-align:right;">
                        
                        <?php 
                            echo $this->Form->button('Editar', array(
                                'title' => 'Editar cadastro',
                                'type' => 'button',
                                'onclick' => "editCadastroUsuario({$usuario['usu']['usu_id']});",
                                'class' => 'btn btn-success',
                                'escape' => false
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

    function editCadastroUsuario(id) {

        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'modalEditUsuario')); ?>`,
            type: 'POST',            
            data: { 'id': id }
        }).done((data) => {            
            $('#modalViewUsuario').modal('hide'); 
            $('#modalEdit').html(data);
            $('#modalEditUsuario').modal('show');          
        });
    }
    
</script>