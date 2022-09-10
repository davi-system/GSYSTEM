<?php echo $this->Session->flash(); ?>

<div class="modal fade" id="modalAddTipo" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar novo tipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header text-white bg-primary"><i class="bi bi-pencil-fill"></i> <b>Tipo da Despesa</b></div>
                
                    <div class="card-body">                                        
                        <div class="row">
                            <div class="col-md-12">                                                                                                  
                                <?php 
                                    echo $this->Form->input('tip_descricao', array(
                                        'label' => 'Descrição',
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'id' => 'descricao'
                                    )); 
                                ?>   
                            </div>                    
                        </div>
                    </div>                                                 
                </div>                                

                <br />

                <div class="card">
                    <div class="card-header text-white" style="background-color: purple;"><b>Tipos Cadastrados</b></div>
                
                    <div class="card-body">                                                            
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ações</th>
                                            <th>Tipo de Despesa</th>
                                        </tr>
                                    </thead>
            
                                    <tbody>
                                        <?php 
                                            foreach($tipoDespesa as $value) {                                        
                                                echo "
                                                    <tr>
                                                        <td>
                                                            ".
                                                                $this->Form->button('<i class="bi bi-pencil-square"></i>', array(
                                                                    'title' => 'Editar tipo',
                                                                    'type' => 'button',                                                        
                                                                    'onclick' => "abreModalEditTipo({$value['tip']['tip_id']});",
                                                                    'class' => 'btn btn-success'                                                                                                                         
                                                                ))
                                                            ."
        
                                                            ".
                                                                $this->Form->button('<i class="bi bi-trash"></i>', array(
                                                                    'title' => 'Exluir tipo',
                                                                    'type' => 'button',                                                        
                                                                    'onclick' => "excluirTipoDespesa({$value['tip']['tip_id']});",
                                                                    'class' => 'btn btn-danger'                                                                                                                         
                                                                ))
                                                            ."
                                                        </td>
                                                        <td>{$value['tip']['tip_descricao']}</td>
                                                    </tr>                                
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="card-footer bg-transparent" style="text-align: right;">
                        <?php 
                            echo $this->Form->button('Salvar', array(
                                'title' => 'Salvar cadastro',
                                'type' => 'button',
                                'class' => 'btn btn-primary',
                                'onclick' => 'saveNovoTipo();'
                            )); 
                        ?>
            
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>  
            </div>           
        </div>
    </div>
</div>

<div id="modal">

</div>

<script>

    function saveNovoTipo() {        

        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'salvarTipo')); ?>`,
            type: "POST",            
            data: {                
                'descricao': $('#descricao').val()                
            }
        }).done((data) => {            
            swal({
                title: "Sucesso!",
                text: "Novo tipo cadastrado com sucesso!",
                icon: "success",
                button: false
            });
            setTimeout((data) => {
                $(window.location.reload()).hide();
            }, 2000);   
        });
    }

    function excluirTipoDespesa(tipId) {
        
        if(confirm('Deseja realmente excluir?') == true) {
            $.ajax({
                url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'deletaTipoDespesa')); ?>/${tipId}`,
                type: "GET"    
            }).done((data) => {                         
                swal({
                    title: "Sucesso!",
                    text: "Tipo da despesa excluido com sucesso!",
                    icon: "success",
                    // button: false
                });

                setTimeout((data) => {
                    $('#modalAddTipo').modal('hide');
                    abreModalAddTipo();
                }, 2000);
            });
        }
    }

    function abreModalEditTipo(idTipo) {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalEditTipo')); ?>/${idTipo}`,
            type: 'GET'            
        }).done((data) => {   
            $('#modalAddTipo').modal('hide');
            $('#modal').html(data);
            $('#modalEditTipo').modal('show');
        });
    }

</script>