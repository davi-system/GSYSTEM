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
                        echo $this->Form->button('Buscar', array(
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
        
                        <tbody>
                                <?php 
                                    foreach($despesas as $des) {                                    
                                        echo "
                                        <tr>
                                            <td></td>
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