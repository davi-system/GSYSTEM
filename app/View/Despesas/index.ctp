<?php echo $this->Session->flash(); ?>

<div id="principal-add">
    <div class="modal-header">
        <div class="modal-title">
            <h3>Listar Despesas</h3>
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

        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Form->create('Despesas', array('url' => array('controller' => 'Despesas', 'action' => 'index'))); ?>

                    <div class="row">
                        <div class="col-md-2">
                            <?php 
                                echo $this->Form->input('opcaoPesquisa', array(
                                    'label' => 'Buscar por',
                                    'type' => 'select',                                    
                                    'options' => array('0' => 'Descrição', '1' => 'Tipo'),
                                    'class' => 'form-select',
                                    'id' => 'opcaoPesquisa',
                                    'onchange' => 'tipoPesquisa();'
                                )); 
                            ?>
                        </div>

                        <div class="col-md-4" id="div_descricao">
                            <?php 
                                echo $this->Form->input('des_descricao', array(
                                    'label' => '',
                                    'type' => 'text',                                    
                                    'class' => 'form-control',
                                    'id' => 'descricao',
                                    'required',
                                    'placeholder' => 'informe uma descrição'
                                )); 
                            ?>
                        </div>
                        
                        <div class="col-md-4" id="div_tipo" style="display:none;">
                            <?php 
                                echo $this->Form->input('des_tipo', array(
                                    'label' => '',
                                    'type' => 'select',
                                    'options' => $tipos,
                                    'empty' => 'informe um tipo',
                                    'class' => 'form-select',
                                    'id' => 'tipo',
                                    'disabled',
                                    'required'                                
                                )); 
                            ?>
                        </div>
                        
                        <div class="col-md-3">
                            <?php 
                                echo $this->Form->button('<i class="bi bi-search"></i> Buscar', array(
                                    'title' => 'Consultar despesas',
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'style' => 'margin-top:24px;'                               
                                )); 
                            ?>
                        </div>
                    </div>                    

                    <br />
                            
                                        
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
                                        <td>
                                            ".
                                                $this->Form->button('<i class="bi bi-search"></i>', array(
                                                    'title' => 'Visualizar despesa',
                                                    'type' => 'button',                                                        
                                                    'onclick' => "abreModalViewDespesa({$des['des']['des_id']});",
                                                    'class' => 'btn btn-warning'                                                                                                                         
                                                ))
                                            ."                                                

                                            ".
                                                $this->Form->button('<i class="bi bi-pencil-square"></i>', array(
                                                    'title' => 'Editar despesa',
                                                    'type' => 'button',
                                                    'onclick' => "abreModalEditDespesa({$des['des']['des_id']});",
                                                    'class' => 'btn btn-success'                                
                                                ))
                                            ."

                                            ".
                                            $this->Form->button('<i class="bi bi-trash"></i>', array(
                                                'title' => 'Excluir despesa',
                                                'type' => 'button',
                                                'onclick' => "deletarDespesa({$des['des']['des_id']});",
                                                'class' => 'btn btn-danger'                                
                                            ))
                                        ."
                                        </td>
                                        <td>{$des['des']['des_id']}</td>
                                        <td>{$des['tip']['tip_descricao']}</td>
                                        <td>{$des['frp']['frp_descricao']}</td>
                                        <td>{$des['des']['des_descricao']}</td>
                                        <td>{$des['des']['des_valor']}</td>
                                        <td>{$des['des']['des_parcela']}</td>
                                        <td>{$this->Utilitarios->formatarData($des['des']['des_dtcriacao'])}</td>
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

    function tipoPesquisa() {

        const input = document.querySelector('#opcaoPesquisa');

        if(input.selectedIndex == '0') {
            document.getElementById('div_tipo').style.display = 'none';
            document.getElementById('div_descricao').style.display = '';
            document.getElementById('tipo').setAttribute('disabled', 'disabled');
            document.getElementById('descricao').removeAttribute('disabled');
        } else {
            document.getElementById('div_descricao').style.display = 'none';
            document.getElementById('div_tipo').style.display = '';
            document.getElementById('tipo').removeAttribute('disabled');
            document.getElementById('descricao').setAttribute('disabled', 'disabled');
        }
    }

    function abreModalEditDespesa(id) {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalEditDespesa')); ?>`,
            type: 'POST',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { 'id': id }
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalEditDespesa').modal('show');
        });
    }

    function abreModalViewDespesa(id) {
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'modalViewDespesa')); ?>`,
            type: 'POST',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { 'id': id }
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalViewDespesa').modal('show');
        });
    }

    function deletarDespesa(id) {        

        if(confirm('Deseja realmente excluir essa despesa?') == true) {
            $.ajax({
                url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'deletaDespesa')); ?>`,
                type: 'POST',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: { 'id': id }
            }).done((data) => {            
                swal({
                    title: "Sucesso!",
                    text: "Registro excluido com sucesso!",
                    icon: "success",
                    button: false
                });
                    setTimeout((data) => {
                    $(window.location.reload()).hide();
                }, 2000);  
            });
        }
    }
        
</script>