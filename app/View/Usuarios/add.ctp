<?php echo $this->Session->flash(); ?>

<div id="principal-add">
    <div class="modal-header">
        <h3>Cadastro de Usuário</h3>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Form->create('Usuarios', array('url' => array('controller' => 'Usuarios', 'action' => 'add'))); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                echo $this->Form->input('usu_nome', array(
                                    'label' => 'Nome',
                                    'type' => 'text',
                                    'class' => 'form-control',                                    
                                    'required'
                                )); 
                            ?>
                        </div>
                    </div>

                    <div class="row">                                                
                        
                        <div class="col-md-6">
                            <p id="alert" class="alert alert-danger" role="alert" style="display:none; position:absolute; top:40px;">E-mail inválido</p>
                            <?php 
                                echo $this->Form->input('usu_email', array(
                                    'label' => 'E-mail',
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'placeholder' => 'exemplo@gmail.com',
                                    'required',
                                    'id' => 'email',
                                    'onblur' => 'validateEmail(this);'                                   
                                )); 
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('usu_senha', array(
                                    'label' => 'Senha',
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'required'
                                )); 
                            ?>
                        </div>
                    </div>

                    <br />

                    <?php 
                        echo $this->Form->button('Salvar', array(
                            'title' => 'Salvar cadastro do usuário',
                            'type' => 'submit',
                            'class' => 'btn btn-primary',
                            'id' => 'btnSalvar'  
                        )); 
                    ?>
                    
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<script>

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