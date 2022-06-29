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
                            daviteste@gmail.com
                        </p>

                        <p class="texto2">
                            (14) 99999-9999
                        </p>
                    </div>
                </div>

                <br />

                <div class="row">                    
                    <div class="col-md-6">
                        <div style="text-align:right;">
                            <?php 
                                echo $this->Form->button('<i class="bi bi-pencil-square"></i>', array(
                                    'title' => '',
                                    'type' => 'button',
                                    'class' => 'btn btn-outline-info',
                                    'escape' => false
                                )); 
                            ?>                            
                        </div>

                        <?php 
                            echo $this->Form->input('', array(   
                                'label' => 'Feedback',                             
                                'type' => 'textarea',
                                'class' => 'form-control'
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
                                'type' => 'submit',
                                'class' => 'btn btn-warning'
                            )); 
                        ?>
                    </div>
                </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>