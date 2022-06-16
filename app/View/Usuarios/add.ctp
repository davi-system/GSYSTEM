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
                                    'placeholder' => 'Fulano...',
                                    'required'
                                )); 
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('usu_email', array(
                                    'label' => 'E-mail',
                                    'type' => 'text',
                                    'class' => 'form-control',
                                    'placeholder' => 'fulano@gmail.com',
                                    'required'
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
                            'class' => 'btn btn-primary'
                        )); 
                    ?>
                    
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>