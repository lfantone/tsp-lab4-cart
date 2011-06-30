<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Cart Login</title>
	<link href="http://localhost/tsp-lab4-cart/assets/css/login.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="content">
		<div id="login-box">
			<?php echo form_open('login');?>
			<h2>LOGIN</h2><br />
			<div id="login-box-name">
				<?php echo form_label('Email: ', 'email');?>
			</div>
			<div id="login-box-field">
				<?php echo form_input('email', set_value('email'), 'class="form-login"');?>
				<?php if(isset($error))
						{ echo "<p>".$error."</p>"; }  
					  echo form_error('email');	  
				?>
			</div>
			<div id="login-box-name">
				<?php echo form_label('Contrase&ntilde;a: ', 'contrasenia');?>
			</div>
			<div id="login-box-field">
				<?php echo form_password('password', '', 'class="form-login"');?>
				<?php echo form_error('password');?>
			</div>			
			<?php echo form_input(array('type' => 'image', 'src' => base_url().'assets/img/login-btn.png', 'name' => 'submit', 'class' => "BtnLogin", 'width' => '103', 'height' => "42"));?>
			<br />			
			<br />
			<br />
			<span class="login-box-options">
				<?php echo anchor('registro', 'Nuevo Usuario?', 'class="new_user"');?>
			</span>
			<br />
			<span class="login-box-options">
				<?php echo anchor('cpanel', 'CPanel', 'class="new_user"');?>
			</span>
		</div>	
	</div>
</body>
</html>