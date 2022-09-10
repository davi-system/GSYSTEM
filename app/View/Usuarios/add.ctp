<?php echo $this->Session->flash(); ?>

<br />

<div class="container">
    <div class="modal-body">
        <div class="row">        
            <div class="col-md-4" style="margin: 0px auto;">

                <div>            
                    <?php 
                        echo $this->Html->link('<i class="bi bi-arrow-left"></i> Voltar', array(
                            'controller' => 'Login', 
                            'action' => 'index'
                        ), array(
                            'class' => 'btn btn-secondary',
                            'escape' => false,
                            'title' => 'Voltar para tela de login'
                        )); 
                    ?>
                </div>

                <br />

                <h3 style="text-align:center;">Cadastro de Usuário</h3>  
                                
                <br />

                <div class="alert alert-primary" role="alert">
                    Atenção! Campos com <b>*</b> são de preenchimento obrigatório.
                </div>

                <?php echo $this->Form->create('Usuarios', array('url' => array('controller' => 'Usuarios', 'action' => 'add'), 'id' => 'form')); ?>

                    <div class="row">
                        <?php 
                            echo $this->Form->input('usu_nome', array(
                                'label' => 'Nome <font color="red">*</font>',
                                'type' => 'text',
                                'class' => 'form-control',                                    
                                'required'                                
                            )); 
                        ?>
                    </div>

                    <div class="row">                                                                                                
                        <?php 
                            echo $this->Form->input('usu_email', array(
                                'label' => 'E-mail <font color="red">*</font>',
                                'type' => 'email',
                                'class' => 'form-control',                                
                                'required',
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
                                'required',                                
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

        const senha = document.getElementById('senha').value;
        const confirmaSenha = document.getElementById('confirma_senha').value;        

        if(senha != confirmaSenha) {
            alert('Senhas não são iguais!')
        } else {
            document.getElementById('form').submit();
        }
    }
    
</script>