<?php echo $this->Session->flash(); ?>

<br />

<div class="container shadow p-3 mb-2 bg-body rounded">
    <div class="modal-header">
        <div class="modal-title">
            <h3>Relatório de Usuários & Feedbacks</h3>
        </div>
    </div>

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

        <div class="card">
            <div class="card-header text-white" style="background-color:purple;"><i class="bi bi-list"></i> <b>Usuarios x Feedbacks</b></div>

            <div class="card-body">

                <?php echo $this->Form->create('ListaFeed', array('url', array('controller' => 'Administrador', 'action' => 'index'))); ?>                    
                
                    <div class="row">
                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('usu_id', array(
                                    'label' => 'Nome',
                                    'type' => 'select',
                                    'empty' => true,
                                    'options' => $usuarios,
                                    'class' => 'form-select',
                                    'required'
                                )); 
                            ?>
                        </div>

                        <div class="col-md-2">
                            <?php 
                                echo $this->Form->input('mes', array(
                                    'label' => 'Mês',
                                    'type' => 'text',                                
                                    'class' => 'form-control',
                                    'maxlength' => '2',
                                    'mixlength' => '2',
                                    'placeholder' => '00',
                                    'required'                                    
                                )); 
                            ?>
                        </div>

                        <div class="col-md-2">
                            <?php 
                                echo $this->Form->input('ano', array(
                                    'label' => 'Ano',
                                    'type' => 'text',                                
                                    'class' => 'form-control',
                                    'maxlength' => '4',
                                    'mixlength' => '4',
                                    'placeholder' => '0000',
                                    'required'                                    
                                )); 
                            ?>
                        </div>

                        <div class="col-md-1">
                            <?php 
                                echo $this->Form->button('Buscar', array(
                                    'title' => 'Buscar',
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'style' => 'margin-top:25px;'                              
                                )); 
                            ?>
                        </div>

                        <div class="col-md-1">
                            <?php 
                                $usuario = (isset($usuario) ? $usuario : '');
                                $mes = (isset($mes) ? $mes : '');
                                $ano = (isset($ano) ? $ano : '');

                                if(empty($usuario) || empty($mes) || empty($ano) || empty($feedbackUsuarios)) {
                                    $disabled = 'disabled';
                                } else {
                                    $disabled = '';
                                }

                                echo $this->Form->button('<i class="bi bi-file-earmark-pdf"></i> PDF', array(
                                    'title' => 'Exportar para PDF',
                                    'type' => 'button',                                                                                              
                                    'class' => 'btn btn-danger',                                
                                    'escape' => false,
                                    'style' => 'margin-top:25px;',
                                    'onclick' => "exportarPDF({$usuario}, {$mes}, {$ano})",
                                    $disabled                                                                                                                              
                                ));
                            ?>
                        </div>
                    </div>

                <?php echo $this->Form->end(); ?>            

                <br />

                <?php if(isset($feedbackUsuarios)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-hover">
                                <?php if(!empty($feedbackUsuarios)) { ?>                    
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;">Cod. Usuário</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th style="text-align:center;">Cod. Feedback</th>
                                            <th>Descrição Feedback</th>
                                            <th style="text-align:center;"></th>
                                            <th style="text-align:center;">Data Criação</th>
                                            <th style="text-align:center;">Hora Criação</th>                                            
                                        </tr>                              
                                    </thead>

                                    <tbody>
                                        <?php
                                            foreach($feedbackUsuarios as $suporte) {                                                
                                                echo "
                                                    <tr>
                                                        <td style='text-align:center;'>{$suporte['usu']['usu_id']}</td>
                                                        <td>{$suporte['usu']['usu_nome']}</td>
                                                        <td>{$suporte['usu']['usu_email']}</td>
                                                        <td style='text-align:center;'>{$suporte['sup']['sup_id']}</td>
                                                        <td>
                                                            ".
                                                                mb_strimwidth($suporte['sup']['sup_descricao'], 0, 25, '...')
                                                            ."
                                                        </td>
                                                        <td style='text-align:center;'>
                                                            ".
                                                                $this->Form->button('<i class="bi bi-search"></i>', array(
                                                                    'title' => 'Visualizar Feedback',
                                                                    'type' => 'button',                                                        
                                                                    'onclick' => "abreModalFeedbackUsuario({$suporte['sup']['sup_id']})",
                                                                    'class' => 'btn btn-warning'                                                                                                                         
                                                                ))
                                                            ."   
                                                        </td>
                                                        <td style='text-align:center;'>{$this->Utilitarios->formatarData($suporte['sup']['sup_dtcriacao'])}</td>
                                                        <td style='text-align:center;'>{$suporte['sup']['sup_horacriacao']}</td>
                                                    </tr>
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                <?php } else {
                                    echo "<center><b>Nenhum registro encontrado!</b></center>";
                                } ?>                   
                            </table> 
                        </div>
                    </div>
                <?php } ?>                                                     
            </div>
        </div>                        
    </div>
</div>

<div id="modal">
</div>

<script>

    function abreModalFeedbackUsuario(id) {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Administrador', 'action' => 'modalFeedbackUsuario')); ?>/${id}`,
            type: 'GET'            
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalFeedbackUsuario').modal('show');
        });
    }

    function exportarPDF(usuario, mes, ano) {   

        window.location.href = `<?php echo $this->Html->url(array('controller' => 'Administrador', 'action' => 'imprimirRelatorioFeedback'), array('target' => '_blank')); ?>/${usuario}/${mes}/${ano}`;                
    }

</script>