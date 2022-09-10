<?php echo $this->Session->flash(); ?>

<style>
    .titulo-menu-superior {
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
        text-decoration: underline;
    }
</style>

<div>
    <nav class="navbar navbar-light bg-light px-3">
        
        <a class="navbar-brand" style="padding:4px;">            
            <?php echo $this->Html->image('logo-gsystem.png', array('alt' => 'GSystem - Sistema de Controle Financeiro Pessoal', 'style' => 'width:40px; height:24px;', 'id' => 'img-logo')); ?>
            &nbsp; 
            <span class="titulo-menu-superior">Sistema de Controle Financeiro Pessoal</span>    
        </a>

        <a class="navbar-brand" href="#"></a>
        <ul class="nav nav-pills">            

            <li class="nav-item">
                <a class="nav-link">
                    <i class="bi bi-person-fill"></i>&nbsp;<?php echo '<font color="#000"><b>'.$usuario['usu']['usu_nome'].'</b></font>' ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link">
                    <i class="bi bi-hourglass-split"></i>&nbsp;<?php echo '<font color="#000"><b id="hora"></b></font>' ?>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link">
                    <i class="bi bi-calendar"></i>&nbsp;<?php echo '<font color="#000"><b>'.date('d/m/Y').'</b></font>' ?>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><b>Ajuda</b></a>            
                <ul class="dropdown-menu">
                    <li>
                        <a style="cursor:pointer;" onclick="abreModalViewUsuario(<?php echo $codUsuario; ?>);" class="dropdown-item"><b>Minha Conta</b></a>
                    </li>

                    <li>                        
                        <?php 
                            echo $this->Html->link('<b>Suporte</b>', array(
                                'controller' => 'Suporte', 
                                'action' => 'index'
                            ), array(
                                'class' => 'dropdown-item',
                                'escape' => false
                            ));
                        ?>                        
                    </li>                  
                </ul>
            </li>
    
            <li class="nav-item">
                <b>
                    <?php 
                        echo $this->Html->link('<i class="bi bi-box-arrow-left"></i> Sair', array(
                            'controller' => 'Login',
                            'action' => 'logout'
                        ), array(
                            'class' => 'nav-link',
                            'escape' => false
                        ));
                    ?>
                </b>
            </li>
        </ul>
    </nav>
    
    <div style="width: 20%; margin: 10px 10px;">
        <nav class="navbar navbar-light bg-light flex-column align-items-stretch p-2">
            <a class="navbar-brand" href="#"></a>
        
            <nav class="nav nav-pills flex-column">  
                <?php 
                    // echo $this->Html->link('<i class="bi bi-house"></i> Home', array(
                    //     'controller' => 'Menu',
                    //     'action' => 'index'
                    // ), array(
                    //     'class' => 'nav-link',
                    //     'escape' => false
                    // ));
                ?>
                       
                <?php 
                    echo $this->Html->link('<i class="bi bi-plus-circle"></i> <b>Cadastro de Despesa</b>', array(
                        'controller' => 'Despesas',
                        'action' => 'add'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?>                
        
                <?php 
                    echo $this->Html->link('<i class="bi bi-list-check"></i> <b>Listar Despesa</b>', array(
                        'controller' => 'Despesas',
                        'action' => 'index'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?>
                
                <?php 
                    echo $this->Html->link('<i class="bi bi-card-text"></i> <b>Relatório de Despesas</b>', array(
                        'controller' => 'Relatorios',
                        'action' => 'index'
                    ), array(
                        'class' => 'nav-link',
                        'escape' => false
                    ));
                ?> 
            </nav>
        </nav>
    </div>
</div>

<div id="modal">
</div>

<div id="modalEdit">
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

    function attAbreModalViewUsuario(id) {        
        
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

    setInterval(() => {
    
        let novaHora = new Date();
        // getHours trará a hora
        // geMinutes trará os minutos
        // getSeconds trará os segundos

        let hora = novaHora.getHours();
        let minuto = novaHora.getMinutes();
        let segundo = novaHora.getSeconds();

        // Chamamos a função zero para que ela retorne a concatenação
        // com os minutos e segundos
        minuto = zero(minuto);
        segundo = zero(segundo);
        // Com o textContent, iremos inserir as horas, minutos e segundos
        // no nosso elemento HTML
        document.getElementById('hora').textContent = `${hora}:${minuto}:${segundo}`;
    }, 1000);

        // A function zero concatena a string (número) 0 em frente aos números
        // mantendo o zero na frente dos números menores que 10. Exemplo:
        // 21:05:01
        // 21:05:02
        // e assim, sucessivamente
    function zero(x) {

        if(x < 10) {
            x = '0' + x;
        } 
        return x;
    }
    
</script>