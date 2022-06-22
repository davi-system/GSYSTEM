<?php echo $this->Session->flash(); ?>

<nav class="navbar navbar-light bg-light px-3">
    <a class="navbar-brand" href="#"></a>
    <ul class="nav nav-pills">

        <li class="nav-item">
            <?php 
                echo $this->Html->link('<i class="bi bi-box-arrow-left"></i> Voltar', array(
                    'controller' => 'Login',
                    'action' => 'logout'
                ), array(
                    'class' => 'nav-link',
                    'escape' => false
                ));
            ?>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" href="#scrollspyHeading2">Second</a>
        </li> -->

        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#scrollspyHeading3">Third</a></li>
                <li><a class="dropdown-item" href="#scrollspyHeading4">Fourth</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#scrollspyHeading5">Fifth</a></li>
            </ul>
        </li> -->
    </ul>
</nav>

<nav class="navbar navbar-light bg-light flex-column align-items-stretch p-3">
    <a class="navbar-brand" href="#"></a>

    <nav class="nav nav-pills flex-column">        
        <?php 
            echo $this->Html->link('<i class="bi bi-house"></i> Home', array(
                'controller' => 'Menu',
                'action' => 'index'
            ), array(
                'class' => 'navbar-brand',
                'escape' => false
            ));
        ?>
               
        <?php 
            echo $this->Html->link('<i class="bi bi-plus-circle"></i> Cadastro de Despesa', array(
                'controller' => 'Despesas',
                'action' => 'add'
            ), array(
                'class' => 'navbar-brand',
                'escape' => false
            ));
        ?>

        <?php 
            echo $this->Html->link('<i class="bi bi-list-check"></i> Listar Despesa', array(
                'controller' => 'Despesas',
                'action' => 'index'
            ), array(
                'class' => 'navbar-brand',
                'escape' => false
            ));
        ?>
    </nav>
</nav>

<br /><br />

<?php 
    echo $this->Form->button('visualizar cadastro', array(
        'title' => '',
        'type' => 'button',
        'onclick' => "abreModalViewUsuario({$codUsuario});",
        'class' => 'btn btn-primary'
    )); 
?>

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