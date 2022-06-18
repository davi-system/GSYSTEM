<?php echo $this->Session->flash(); ?>

<?php 
    echo $this->Form->button('visualizar cadastro', array(
        'title' => '',
        'type' => 'button',
        'onclick' => "abreModalViewUsuario({$codUsuario});",
        'class' => 'btn btn-primary'
    )); 
?>

<br />

<?php echo $this->Html->link('listar despesas', array('controller' => 'Despesas', 'action' => 'index')); ?>

<div id="modal">
</div>

<script>

    function abreModalViewUsuario(id) {        
        
        $.ajax({
            url: `<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'modalViewUsuario')); ?>`,
            type: 'POST',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: { 'id': id }
        }).done((data) => {            
            $('#modal').html(data);
            $('#modalViewUsuario').modal('show');
        });
    }
    
</script>