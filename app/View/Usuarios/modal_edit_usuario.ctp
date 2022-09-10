<?php echo $this->Session->flash(); ?>

<style>
    .modal-dialog {
        width: 25%;
        margin: 5% auto;
    }
</style>

<div class="modal fade" id="modalEditUsuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cadastro</h5>
                <button type="button" onclick="fechaModal(<?php echo $usuario['usu']['usu_id']; ?>)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-success"><i class="bi bi-person"></i><b> Usuário</b></div>
                
                    <div class="card-body">                                                                                                                                                                     
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
                            <div class="col-md-12">
                                <p id="alert" class="alert alert-danger" role="alert" style="display:none; position:absolute; top:40px;">E-mail inválido</p>
                                <?php 
                                    echo $this->Form->input('usu_email', array(
                                        'label' => 'E-mail',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'placeholder' => 'exemplo@gmail.com',
                                        'value' => $usuario['usu']['usu_email'],
                                        'id' => 'email',
                                        'onblur' => 'validateEmail()'                                  
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
                                        'id' => 'senha'                                    
                                    )); 
                                ?>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    echo $this->Form->input('confirmaSenha', array(
                                        'label' => 'Confirmar Senha',
                                        'type' => 'password',
                                        'class' => 'form-control',                              
                                        'id' => 'confirmarSenha',
                                        'placeholder' => 'confirmar senha'                                  
                                    )); 
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent" style="text-align: right;">                                                                                      
                        <?php 
                            echo $this->Form->button('<i class="bi bi-check"></i> Salvar', array(
                                'title' => 'Editar cadastro',
                                'type' => 'button',
                                'onclick' => "salvarEditCadUsuario({$usuario['usu']['usu_id']});",
                                'class' => 'btn btn-success',
                                'id' => 'btnSalvar',
                                'escape' => false
                            ));

                            
                            echo "&nbsp;";
                            

                            echo $this->Form->button('Fechar', array(
                                'title' => 'Fechar tela',
                                'type' => 'button',
                                'onclick' => "fechaModal({$usuario['usu']['usu_id']});",
                                'class' => 'btn btn-secondary'
                            )); 
                        ?>                
                    </div>                    
                </div>
            </div>            
        </div>
    </div>
</div>

<script>

    function salvarEditCadUsuario(id) {

        let senha = document.getElementById('senha').value;
        let confirmarSenha = document.getElementById('confirmarSenha').value;

        if(senha.length < 6 || senha.length < 6) {
            alert('A senha não pode estar em branco e tem que ter pelo menos 6 digitos!');
        } else if(senha !== confirmarSenha) {
            alert('Senhas não são iguais!');
        } else {

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

    }

    function fechaModal(id) {

        $('#modalEditUsuario').modal('hide');
        attAbreModalViewUsuario(id);
    }

    function validateEmail() {
        let re = /\S+@\S+\.\S+/;        
        if(re.test(document.getElementById('email').value) == false) {            
            document.getElementById('alert').style.display = ''; 
            document.getElementById('btnSalvar').setAttribute('disabled', 'disabled');
        } else {
            document.getElementById('alert').style.display = 'none';
            document.getElementById('btnSalvar').removeAttribute('disabled');
            return true;
        }
    }
    
</script>