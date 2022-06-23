<?php echo $this->Session->flash(); ?>

<div>
    <nav class="navbar navbar-light bg-light px-3">
        <a class="navbar-brand" href="#"></a>
        <ul class="nav nav-pills">
    
            <li class="nav-item">
                <?php 
                    echo $this->Html->link('<i class="bi bi-box-arrow-left"></i> Logout', array(
                        'controller' => 'Login',
                        'action' => 'logout'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?>
            </li>
        </ul>
    </nav>
    
    <div style="width: 20%; margin: 10px 10px;">
        <nav class="navbar navbar-light bg-light flex-column align-items-stretch p-2">
            <a class="navbar-brand" href="#"></a>
        
            <nav class="nav nav-pills flex-column">  
                <?php 
                    echo $this->Html->link('<i class="bi bi-house"></i> Home', array(
                        'controller' => 'Menu',
                        'action' => 'index'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?>
                       
                <?php 
                    echo $this->Html->link('<i class="bi bi-plus-circle"></i> Cadastro de Despesa', array(
                        'controller' => 'Despesas',
                        'action' => 'add'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?>
        
                <?php 
                    echo $this->Html->link('<i class="bi bi-list-check"></i> Listar Despesa', array(
                        'controller' => 'Despesas',
                        'action' => 'index'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?>
        
                <a style="cursor:pointer;" onclick="abreModalViewUsuario(<?php echo $codUsuario; ?>);" class="nav-link"><i class="bi bi-eye"></i> Visualizar Cadastro</a>
            </nav>
        </nav>
    </div>
</div>

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