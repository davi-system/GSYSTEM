<div id="principal">
    <div class="modal-header">
        <h2>Listagem de usuários cadastrados</h2>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align:center;">ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th style="text-align:center;">Data Criação</th>                            
                        </tr>
                    </thead>

                    <?php
                        
                        foreach($usuarios as $user) {
                            echo "                        
                                <tbody>
                                    <tr>
                                        <td style='text-align:center;'>{$user['usu']['usu_id']}</td>
                                        <td>{$user['usu']['usu_nome']}</td>
                                        <td>{$user['usu']['usu_email']}</td>
                                        <td style='text-align:center;'>{$user['usu']['usu_dtcriacao']}</td>                                        
                                    </tr>
                                </tbody>
                            ";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="modal-footer">    
    </div>
</div>