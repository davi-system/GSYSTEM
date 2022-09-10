<?php echo $this->Session->flash(); ?>

<style>
    .modal-dialog {
        width: 25%;
        margin: 5% auto;
    }
</style>

<div class="modal fade" id="modalAddUsuario" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-primary"><i class="bi bi-person"></i> <b>Usuário</b></div>

                    <div class="card-body">                        
                        <div class="alert alert-primary" role="alert">
                            Atenção! Campos com <b>*</b> são de preenchimento obrigatório.
                        </div>
    
                        <?php echo $this->Form->create('Usuarios', array('url' => array('controller' => 'Usuarios', 'action' => 'modalAddUsuario'), 'id' => 'form')); ?>
    
                            <div class="row">
                                <?php 
                                    echo $this->Form->input('usu_nome', array(
                                        'label' => 'Nome <font color="red">*</font>',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'nome'                                                                        
                                    )); 
                                ?>
                            </div>
    
                            <div class="row">                                                                                                
                                <?php 
                                    echo $this->Form->input('usu_email', array(
                                        'label' => 'E-mail <font color="red">*</font>',
                                        'type' => 'email',
                                        'class' => 'form-control',                                        
                                        'id' => 'email',
                                        'onblur' => 'validateEmail(this);'                                   
                                    )); 
                                ?>                        
                            </div>
    
                            <div class="row">
                                <?php 
                                    echo $this->Form->input('usu_senha', array(
                                        'label' => 'Senha <font color="red">*</font>',
                                        'type' => 'password',
                                        'class' => 'form-control',                                                                       
                                        'id' => 'senha'
                                    )); 
                                ?>
                            </div>
    
                            <div class="row">
                                <?php 
                                    echo $this->Form->input('confirmaSenha', array(
                                        'label' => 'Confirmar senha <font color="red">*</font>',
                                        'type' => 'password',
                                        'class' => 'form-control',
                                        'required',
                                        'id' => 'confirma_senha'                                
                                    )); 
                                ?>
                            </div>
    
                            <br />
                            
                            <div>
                                <?php 
                                    echo $this->Form->button('Salvar', array(
                                        'title' => 'Salvar cadastro do usuário',
                                        'type' => 'button',
                                        'class' => 'btn btn-primary',
                                        'id' => 'btnSalvar',
                                        'style' => 'width:100%',
                                        'onclick' => "validarSenha();"                        
                                    )); 
                                ?>
                            </div>
                            
                        <?php echo $this->Form->end(); ?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function validateEmail() {
        let re = /\S+@\S+\.\S+/;        
        if(re.test(document.getElementById('email').value) == false) {                        
            alert('E-mail inválido!');
            document.getElementById('btnSalvar').setAttribute('disabled', 'disabled');
        } else {            
            document.getElementById('btnSalvar').removeAttribute('disabled');
            return true;
        }
    }    

    function validarSenha() {

        let nome = $('#nome').val();
        let email = $('#email').val();

        const senha = document.getElementById('senha').value;
        const confirmaSenha = document.getElementById('confirma_senha').value;  
        
        if((nome == '') || (email == '') || (senha == '') || (confirmaSenha == '')) {
            alert('A campos sem preencher!');
        } else if(senha != confirmaSenha) {
            alert('Senhas não são iguais!');
        } else {            

            $.ajax({
                type : "POST",
                url : "<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'verificaUsuarioExiste')); ?>",
                data : { 'email' : email }
            }).done((data) => {

                let obj  = JSON.parse(data);

                if(obj > 0) {
                    swal(
                        "Atenção!", 
                        "Esse e-mail já existe cadastrado no sistema!", 
                        "warning"
                    );
                } else {
                    salvarAddUsuario();
                }
            });
        }
    }

    function salvarAddUsuario() {

        let nome = $('#nome').val();
        let email = $('#email').val();
        let senha = $('#senha').val();

        $.ajax({
            type : "POST",
            url : "<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'saveAddUsuario')); ?>",
            data : { 
                nome,
                email,
                senha
            }
        }).done((data) => {

            swal({
                title: "Sucesso!",
                text: "Cadastro realizado com sucesso!",
                icon: "success",
                button: false
            });
            setTimeout((data) => {
                window.location.href = "<?php echo $this->Html->url(array('controller' => 'Menu', 'action' => 'index')); ?>";
            }, 2000);  
        });
    }
    
</script>