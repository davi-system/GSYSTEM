<?php echo $this->Session->flash(); ?>

<style>
    .novo_usuario {
        color:blue; 
        cursor:pointer;
        text-decoration: none;
    }

    .novo_usuario:hover {
        color: green;
    }
</style>

<div id="principal">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">                     
    
                <div id="logo-gsystem">
                    <?php 
                        echo $this->Html->image('logo-gsystem.png', array(
                            'alt' => 'GSystem - Sistema de Controle Financeiro Pessoal', 
                            'style' => 'width:100px; height:70px;'
                        )); 
                    ?>  
                </div>
    
                <br />
    
                <?php echo $this->Form->create('LoginUser', array('url', array('controller' => 'Login', 'action' => 'index'))); ?>
    
                    <div class="row">                                        
                        <?php 
                            echo $this->Form->input('usu_email', array(
                                'label' => 'E-mail', 
                                'type' => 'email', 
                                'class' => 'form-control'                            
                            )); 
                        ?>                         
                    </div>                                                                             
                        
                    <div class="row">
                        <?php 
                            echo $this->Form->input('usu_senha', array(
                                'label' => 'Senha', 
                                'type' => 'password', 
                                'class' => 'form-control'                            
                            )); 
                        ?>                                
                    </div>
    
                    <br />
    
                    <div>
                        <?php 
                            echo $this->Form->button('Entrar', array(
                                'title' => 'Login',
                                'type' => 'submit',
                                'class' => 'btn btn-success',
                                'escape' => false,
                                'style' => 'width:100%'
                            )); 
                        ?>                                           
                    </div>

                    <br />
                                                        
                    <div style="text-align:center;">
                        Não tem uma conta ainda? <a onclick="abreModalAddUsuario();" class="novo_usuario">Registrar agora</a>                        
                    </div>
    
                <?php echo $this->Form->end(); ?>
    
            </div>
        </div>
    </div>
</div>

<div id="modal">
</div>

<script>
    
    function abreModalAddUsuario() {         
        
        $.ajax({
            type: 'GET',
            url: "<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'modalAddUsuario')); ?>"            
        }).done((data) => {                             				
            $('#modal').html(data);
            $('#modalAddUsuario').modal('show').fadeTo('slow', 1);
        });
    }

</script>