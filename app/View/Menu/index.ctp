<?php echo $this->Session->flash(); ?>

<?php echo $this->Html->link('cadastro despesa', array('controller' => 'Despesas', 'action' => 'add')); ?>
<br />
<?php echo $this->Html->link('listar despesas', array('controller' => 'Despesas', 'action' => 'index')); ?>