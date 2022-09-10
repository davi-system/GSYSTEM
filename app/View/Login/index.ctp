<?php echo $this->Session->flash(); ?>

<div id="principal">
    <div class="row">
        <div class="col-md-12">                     

            <div id="logo-gsystem">
                <?php echo $this->Html->image('logo-gsystem.png', array('alt' => 'GSystem - Sistema de Controle Financeiro Pessoal', 'style' => 'width:80px; height:60px;')); ?>

                <br />

                <span id="titulo-gsystem">Sistema de Controle Financeiro Pessoal</span>
            </div>

            <br /><br />

            <?php echo $this->Form->create('LoginUser', array('url', array('controller' => 'Login', 'action' => 'index'))); ?>

                <div class="row">                                        
                    <?php 
                        echo $this->Form->input('usu_email', array(
                            'label' => false, 
                            'type' => 'email', 
                            'class' => 'form-control shadow bg-body rounded',                                    
                            'placeholder' => 'E-mail'
                        )); 
                    ?>                         
                    
                    &nbsp;
                    
                    <?php 
                        echo $this->Form->input('usu_senha', array(
                            'label' => false, 
                            'type' => 'password', 
                            'class' => 'form-control shadow bg-body rounded',                                    
                            'placeholder' => 'Senha'
                        )); 
                    ?>                                  
                </div>                                                                             

                <br />   
                
                <div class="row">
                    <div class="col-md-6">          
                        <?php 
                            echo $this->Form->button('<i class="bi bi-box-arrow-in-right"></i> Entrar', array(
                                'title' => 'Login',
                                'type' => 'submit',
                                'class' => 'btn btn-secondary',
                                'escape' => false
                            )); 
                        ?>
                    </div>                    
    
                    <div class="col-md-6" style="text-align:right;">
                        <?php            
                            echo $this->Html->link('<b>cadastra-se</b>', array(
                                'controller' => 'Usuarios', 
                                'action' => 'add'
                            ), array(
                                'style' => 'text-decoration:none',
                                'escape' => false
                            ))
                        ?>
                    </div>
                </div>

            <?php echo $this->Form->end(); ?>

        </div>
    </div>
</div>