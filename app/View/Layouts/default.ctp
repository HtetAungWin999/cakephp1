<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
// $cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cake PHP Tutorial</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('jquery-confirm.css');
		echo $this->Html->css('font-awesome.min.css');
		echo $this->Html->css('font-awesome-animation.css');
		echo $this->Html->css('bootstrap-timepicker.min.css');
		echo $this->Html->css('datepicker3.css');
		echo $this->Html->css('daterangepicker-bs3.css');		
		
		echo $this->Html->script('jquery-2.1.4.min.js');
		echo $this->Html->script('bootstrap.js');
		echo $this->Html->script('jquery-confirm.js');		
		echo $this->Html->script('bootstrap-datepicker.js');		
		echo $this->Html->script('bootstrap-timepicker.min.js');		
		echo $this->Html->script('daterangepicker.js');		
		echo $this->Html->script('icheck.min');		
		echo $this->Html->script('jquery.autocomplete.js');		
		echo $this->Html->script('jquery.inputmask.js');

		echo $this->Html->script('script');
		echo $this->Html->css('style');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body style="background: #a9cce3;">
	<nav style="background: #58D68D;">
		<ul>
			<li>
				<a href="<?php echo $this->webroot; ?>DashBoard"><span class="fa fa-dashboard fa-fwHome"></span> DashBoard</a>
			</li>
			<li>
				<a href="<?php echo $this->webroot; ?>Users"><span class="fa fa-list"></span>&nbsp;&nbsp;List</a>
			</li>
			<li>
				<a href="<?php echo $this->webroot; ?>Registration"><span class="fa fa-user"></span> Sign Up</a>
			</li>
			<li>
				<a href="<?php echo $this->webroot; ?>Login/logout"><span class="fa fa-sign-out"></span> &nbsp;Logout</a>
			</li>
		</ul>
	</nav>

	<div id="container">
		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<?php 
					echo $this->Flash->render();
					echo $this->fetch('content'); 
				?>
			</div>
		</div>
	</div>
</body>
</html>
