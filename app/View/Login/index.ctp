<?php echo $this->Session->flash(); ?>

<div id="principal">
    <div class="row">
        <div class="col-md-12">  
            
            <p id="titulo-login">Login</p>

            <?php echo $this->Form->create('LoginUser', array('url', array('controller' => 'Login', 'action' => 'index'))); ?>

                <div class="row">
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <div class="col-md-10">
                            <?php 
                                echo $this->Form->input('usu_email', array(
                                    'label' => false, 
                                    'type' => 'text', 
                                    'class' => 'form-control',                                    
                                    'placeholder' => 'E-mail'
                                )); 
                            ?>
                        </div>
                    </div>
                </div>                
                            
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <div class="col-md-10">
                            <?php 
                                echo $this->Form->input('usu_senha', array(
                                    'label' => false, 
                                    'type' => 'password', 
                                    'class' => 'form-control',                                    
                                    'placeholder' => 'Senha'
                                )); 
                            ?> 
                        </div>
                    </div>
                </div>                

                <br />                

                <?php 
                    echo $this->Form->button('Entrar', array(
                        'title' => 'Login',
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    )); 
                ?>

                &nbsp;

                <?php            
                    echo $this->Html->link('cadastra-se', array(
                        'controller' => 'Usuarios', 
                        'action' => 'add'
                    ), array(
                        'style' => 'text-decoration:none'
                    ))
                ?>

            <?php echo $this->Form->end(); ?>

        </div>
    </div>
</div>