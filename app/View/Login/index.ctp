<div id="principal">
    <div class="row">
        <div class="col-md-12">  
            
            <p id="titulo-login">Login</p>

            <div class="row">
                <div class="col-md-12">
                    <label class="form-label">E-mail</label>
                    <?php 
                        echo $this->Form->input('usu_email', array(
                            'label' => false, 
                            'type' => 'text', 
                            'class' => 'form-control',
                            'id' => 'email'
                        )); 
                    ?>            
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-12">
                <label class="form-label">Senha</label>
                    <?php 
                        echo $this->Form->input('usu_senha', array(
                            'label' => false, 
                            'type' => 'password', 
                            'class' => 'form-control',
                            'id' => 'senha'                            
                        )); 
                    ?>  
                </div>        
            </div>

            <br />

            <?php 
                echo $this->Form->button('Entrar', array(
                    'title' => 'Entrar',
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'onclick' => 'verificaEmailExiste();'
                )); 
            ?>            

        </div>
    </div>
</div>

<script>

    function verificaEmailExiste() {
        
        $.ajax({
            type: "POST",
            url: `<?php echo $this->Html->url(array('controller' => 'Login', 'action' => 'index')); ?>`,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {
                'email': $('#email').val(),
                'senha': $('#senha').val()
            }
        }).done((data) => {
            
            let obj = JSON.parse(data);

            if(obj > 0) {
                window.location.href = `<?php echo $this->Html->url(array('controller' => 'Menu', 'action' => 'index')); ?>`;
            } else {                
                swal({
                    title: "Erro!",
                    text: "Email ou senha inválidos!",
                    icon: "warning",
                    button: false
                });
                setTimeout((data) => {
                    $(window.location.reload());
                }, 2000);   
            }           
        });
    }

</script>