<?php echo $this->Session->flash(); ?>

<br />

<div class="container shadow p-3 mb-2 bg-body rounded">
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

        <div class="card">
            <div class="card-header text-white" style="background-color:purple;"><i class="bi bi-list"></i> <b>Despesa</b></div>

            <div class="card-body">                            
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <?php 
                                    echo $this->Form->input('opcaoPesquisa', array(
                                        'label' => 'Buscar por',
                                        'type' => 'select',                                                                     
                                        'options' => array('0' => 'Descrição', '1' => 'Tipo', '2' => 'Todos'),                                    
                                        'class' => 'form-select',
                                        'id' => 'opcaoPesquisa',
                                        'onchange' => 'tipoPesquisa();',
                                        'required'
                                    )); 
                                ?>
                            </div>

                            <div class="col-md-5" id="div_descricao">
                                <?php 
                                    echo $this->Form->input('des_descricao', array(
                                        'label' => '',
                                        'type' => 'text',                                    
                                        'class' => 'form-control',
                                        'id' => 'descricao',                                    
                                        'placeholder' => 'descrição'
                                    )); 
                                ?>
                            </div>
                            
                            <div class="col-md-5" id="div_tipo" style="display:none;">
                                <?php 
                                    echo $this->Form->input('des_tipo', array(
                                        'label' => '',
                                        'type' => 'select',
                                        'options' => $tipos,
                                        'empty' => 'selecione',
                                        'class' => 'form-select',
                                        'id' => 'tipo',                                    
                                        'required'                                
                                    )); 
                                ?>
                            </div>
                                                        
                            <div class="col-md-2">
                                <?php                            
                                    echo $this->Form->input('', array(
                                        'label' => 'Total das Despesas',
                                        'type' => 'text',                                                                        
                                        'class' => 'form-control',
                                        'value' => $totalDespesas['0']['0']['total'],                          
                                        'disabled'                                    
                                    )); 
                                ?>
                            </div>                            

                            <div class="col-md-2">
                                <?php 
                                    echo $this->Form->button('<i class="bi bi-search"></i> Buscar', array(
                                        'title' => 'Consultar despesas',
                                        'type' => 'button',
                                        'onclick' => "consultarDespesas();",
                                        'class' => 'btn',
                                        'style' => 'margin-top:24px; background-color:purple; color:white;'                               
                                    )); 
                                ?>
                            </div>
                        </div>  

                        <br />

                        <div id="listaDespesa">
                        </div>                                                                                                                                  
                    </div>            
                </div>
            </div>
        </div>                        
    </div>
</div>

<div id="modal">
</div>

<script>

    function tipoPesquisa() {    

        let opcaoPesquisa = $('#opcaoPesquisa').val();

        if(opcaoPesquisa == '0') {   
            $('#div_tipo').css({ 'display' : 'none' });          
            $('#tipo').val('');
            $('#descricao').val('');
            $('#div_descricao').css({ 'display' : '' });
        } else if(opcaoPesquisa == '1') {
            $('#div_descricao').css({ 'display' : 'none' });
            $('#tipo').val('');
            $('#descricao').val('');
            $('#div_tipo').css({ 'display' : '' });
        } else if(opcaoPesquisa == '2'){
            $('#div_descricao').css({ 'display' : 'none' });
            $('#div_tipo').css({ 'display' : 'none' }); 
            $('#tipo').val('');
            $('#descricao').val('');
        }
    }

    function consultarDespesas() {        

        let opcaoPesquisa = document.getElementById('opcaoPesquisa').value;
        let descricao = document.getElementById('descricao').value

        if(opcaoPesquisa == '0' && descricao == '') {
            alert('Informe uma despesa!');
        } else {
            $.ajax({
                url: `<?php echo $this->Html->url(array('controller' => 'Despesas', 'action' => 'listaDespesa')); ?>`,
                type: 'POST',            
                data: { 
                    'opcaoPesquisa' : $('#opcaoPesquisa').val(),
                    'descricao' : $('#descricao').val(),
                    'tipo' : $('#tipo').val()
                }
            }).done((data) => {
                $('#listaDespesa').html(data);
            });
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
                    button: true
                });                 
                consultarDespesas();
            });
        }
    }
        
</script>