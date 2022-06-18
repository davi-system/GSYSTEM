<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalEditUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                echo $this->Form->input('usu_nome', array(
                                    'label' => 'Nome',
                                    'type' => 'text',
                                    'class' => 'form-control',                                    
                                    'value' => $usuario['usu']['usu_nome'],
                                    'id' => 'nome'                                                                     
                                )); 
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('usu_email', array(
                                    'label' => 'E-mail',
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'placeholder' => 'fulano@gmail.com',
                                    'value' => $usuario['usu']['usu_email'],
                                    'id' => 'email'                                    
                                )); 
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('usu_senha', array(
                                    'label' => 'Senha',
                                    'type' => 'password',
                                    'class' => 'form-control', 
                                    'value' => $usuario['usu']['usu_senha'],
                                    'id' => 'senha'                                    
                                )); 
                            ?>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <?php 
                    echo $this->Form->button('Salvar', array(
                        'title' => 'Editar cadastro',
                        'type' => 'button',
                        'onclick' => "salvarEditCadUsuario({$usuario['usu']['usu_id']});",
                        'class' => 'btn btn-primary'
                    ));

                    echo $this->Form->button('Fechar', array(
                        'title' => 'Fechar tela',
                        'type' => 'button',
                        'onclick' => "",
                        'class' => 'btn btn-secondary'
                    )); 
                ?>                
            </div>
        </div>
    </div>
</div>

<script>

    function salvarEditCadUsuario(id) {

        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'salvaEditCadUsuario')); ?>`,
            type: 'POST',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { 
                'id': id,
                'nome': $('#nome').val(),
                'email': $('#email').val(),
                'senha': $('#senha').val()
            }
        }).done((data) => {
            swal({
                title: "Sucesso!",
                text: "Cadastro editado com sucesso!",
                icon: "success",
                button: false
            });
                setTimeout((data) => {
                $(window.location.reload()).hide();                
            }, 2000);         
        });
    }
    
</script>