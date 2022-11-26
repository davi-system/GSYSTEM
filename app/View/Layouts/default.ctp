<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html>
<html>
	<head lang="pt-br">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo $this->Html->charset(); ?>
		
		<title><?php echo $title_for_layout?></title>

		<?php
			echo $this->Html->meta('icon');		
			echo $this->Html->css('bootstrap.min.css');
			echo $this->Html->css('style_usuarios.css');			
			echo $this->Html->css('style_login.css');
			echo $this->Html->css("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css");
			echo $this->Html->css('jquery-ui.css');

			echo $this->Html->script('jquery-3.6.0.min.js'); // tem que ficar em primeiro
			echo $this->Html->script('bootstrap.bundle.min.js'); // tem que ficar em segundo
			echo $this->Html->script('jquery-ui.js');
			echo $this->Html->script('datepicker.js');
			echo $this->Html->script('sweetalert.min.js');
			echo $this->Html->script('jquery.maskMoney.min.js');
						
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');			
		?>
	</head>
	<body>
		<?php echo $this->Flash->render(); ?>	
		
		<div id="header">    		
			<?php //require_once 'header.ctp'; ?>	
		</div>
		<?php echo $this->fetch('content'); ?>
	</body>
	
</html>