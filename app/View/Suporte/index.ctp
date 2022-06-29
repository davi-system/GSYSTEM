<?php echo $this->Session->flash(); ?>

<style>
    .texto {
        text-align: justify;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }

    .texto2 {
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }
</style>

<div id="principal-add">
    <div class="modal-header">
        <h3>Suporte</h3>
    </div>

    <div class="col-md-12">
        <div class="modal-body">
            <?php 
                echo $this->Html->link('<i class="bi bi-arrow-left"></i> Voltar', array(
                    'controller' => 'Menu',
                    'action' => 'index'
                ), array(
                    'class' => 'btn btn-secondary',
                    'escape' => false
                ));
            ?>
    
            <br /><br />
    
            <?php echo $this->Form->create('Suporte', array('url' => array('controller' => 'Suporte', 'action' => 'index'))); ?>
                <div class="row">                    
                    <div class="col-md-6">                        
                        <p class="texto">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem expedita 
                            cumque minus atque quisquam iure cupiditate assumenda harum libero quos fuga quae
                            voluptatibus facilis accusamus, consequuntur ipsa hic quis laudantium?
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p class="texto2">
                            Contatos
                        </p>
                    
                        <p class="texto2">
                            <i class="bi bi-envelope-fill" style="color:red;"></i> daviteste@gmail.com
                        </p>
    
                        <p class="texto2">
                            <i class="bi bi-telephone-fill" style="color:green;"></i> (14) 99999-9999
                        </p>                        
                    </div>
                </div>

                <br />

                <div class="row">                    
                    <div class="col-md-6">
                        <?php 
                            echo $this->Form->input('descricao', array(   
                                'label' => 'Feedback',                             
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'required',
                                'minlength' => '8',
                                'maxlength' => '500'
                            )); 
                        ?>

                        <br />

                        <?php 
                            echo $this->Form->button('Enviar', array(
                                'title' => '',
                                'type' => 'submit',
                                'class' => 'btn btn-primary'
                            )); 
                        ?>

                        <?php 
                            echo $this->Form->button('Histórico', array(
                                'title' => '',
                                'type' => 'button',
                                'class' => 'btn btn-warning',
                                'onclick' => "abreModalHistoricoSuporte({$codUsuario['usu']['usu_id']});"
                            )); 
                        ?>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<div id="modal">

</div>

<script>

    function abreModalHistoricoSuporte(codUsuario) {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Suporte', 'action' => 'modalHistoricoSuporte')); ?>`,
            type: 'POST',
            data: { 'codUsuario': codUsuario }           
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalHistoricoSup').modal('show');
        });
    }

    function btnExcluirChamado(codChamado, codUsuario) {

        if(confirm('Realmente você quer excluir? ') == true) {

            $.ajax({
                url: `<?php echo $this->Html->url(array('controller' => 'Suporte', 'action' => 'excluirChamado')); ?>`,
                type: 'POST',
                data: { 
                    'codChamado': codChamado,
                    'codUsuario': codUsuario
                }           
            }).done((data) => {            
                swal({
                    title: "Exluido!",
                    text: "Registro excluido com sucesso!",
                    icon: "success",                    
                });                    
                $('#modalHistoricoSup').modal('hide');
                abreModalHistoricoSuporte(codUsuario);                
            });
        }
    }

    function btnLimparHistoricoChamado(codUsuario) {

        if(confirm('Realmente você quer limpar o histórico? ') == true) {

            $.ajax({
                url: `<?php echo $this->Html->url(array('controller' => 'Suporte', 'action' => 'limparHistorico')); ?>`,
                type: 'POST',
                data: {                     
                    'codUsuario': codUsuario
                }  
            }).done((data) => {            
                swal({
                    title: "Exluido(s)!",
                    text: "Histórico limpo com sucessos!",
                    icon: "success",                    
                });                    
                $('#modalHistoricoSup').modal('hide');
                abreModalHistoricoSuporte(codUsuario);                
            });
        }
    }

</script>