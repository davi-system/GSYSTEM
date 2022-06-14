<?php echo $this->Session->flash(); ?>

<div id="principal-add">
    <div class="modal-header">
        <h3>Listar Despesas</h3>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Form->create('Despesas', array('url' => array('controller' => 'Despesas', 'action' => 'index'))); ?>

                    <div class="row">
                        <div class="col-md-3">
                            <?php 
                                echo $this->Form->input('des_tipo_fk', array(
                                    'label' => 'Descrição',
                                    'type' => 'select',
                                    'options' => array('0' => 'Descrição', '1' => 'Tipo'),
                                    'class' => 'form-control'
                                )); 
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php 
                                echo $this->Form->input('des_descricao', array(
                                    'label' => '',
                                    'type' => 'text',
                                    'class' => 'form-control'
                                )); 
                            ?>
                        </div>  
                        
                    </div>                    

                    <br />
                                          
                    <?php 
                        echo $this->Form->button('<i class="bi bi-search"></i> Buscar', array(
                            'title' => 'Consultar despesas',
                            'type' => 'submit',
                            'class' => 'btn btn-primary'                                
                        )); 
                    ?>
                                        
                <?php echo $this->Form->end(); ?>

                <br />

                <?php if(isset($despesas)) { ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Ações</th>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Forma de Pagamento</th>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Parcela</th>
                                <th>Data Criação</th>
                                <th>Hora Criação</th>
                            </tr>
                        </thead>

                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                        </button> -->

                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                        </button> -->

                        <!-- Modal -->
                        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                        </div> -->
        
                        <tbody>
                                <?php 
                                    foreach($despesas as $des) {                                    
                                        echo "
                                        <tr>
                                            <td>
                                                ".
                                                    $this->Form->button('<i class="bi bi-search"></i>', array(
                                                        'title' => 'Editar despesa',
                                                        'type' => 'button',                                                        
                                                        'onclick' => "abreModalEditDespesa();",
                                                        'class' => 'btn btn-warning'                                                                                                                         
                                                    ))
                                                ."                                                

                                                ".
                                                    $this->Form->button('<i class="bi bi-pencil-square"></i>', array(
                                                        'title' => '',
                                                        'type' => 'button',
                                                        'class' => 'btn btn-success'                                
                                                    ))
                                                ."
                                            </td>
                                            <td>{$des['des']['des_id']}</td>
                                            <td>{$des['tip']['tip_descricao']}</td>
                                            <td>{$des['frp']['frp_descricao']}</td>
                                            <td>{$des['des']['des_descricao']}</td>
                                            <td>{$des['des']['des_valor']}</td>
                                            <td>{$des['des']['des_parcela']}</td>
                                            <td>{$des['des']['des_dtcriacao']}</td>
                                            <td>{$des['des']['des_horacriacao']}</td>                                    
                                            </tr>
                                        ";
                                    }
                                ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>            
        </div>
    </div>
</div>

<div id="modal">
</div>

<script>

    function abreModalEditDespesa() {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalEditDespesa')); ?>`,
            type: 'GET'
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalEditDespesa').modal('show');
        });
    }
        
</script>