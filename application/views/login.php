<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Cart Login</title>
	<link href="http://localhost/tsp-lab4-cart/assets/css/login.css" rel="stylesheet" type="text/css" />
	<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>  
    <script src="<?=base_url()?>/assets/js/popup.js" type="text/javascript"></script> 
</head>
<body>
	<div id="content">
		<div id="login-box">
			<?php echo form_open('login/user');?>
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
				<?php echo form_label('Contrase&ntilde;a: ', 'password');?>
			</div>
			<div id="login-box-field">
				<?php echo form_password('password', '', 'class="form-login"'); echo form_error('password');?>
			</div>			
			<?php echo form_input(array('type' => 'image', 'src' => base_url().'assets/img/login-btn.png', 'name' => 'submit', 'class' => "BtnLogin", 'width' => '103', 'height' => "42"));?>
			<?php echo form_close();?>
			<br />			
			<br />
			<br />
			<span class="login-box-options">
				<?php echo anchor('registro', 'Nuevo Usuario?', 'class="new_user"');?>
			</span>
			<br />
			<span class="login-box-options">
				<a id="JQpopup" class="new_user">CPanel</a>
			</span>
		</div>	
	</div>
	<div id="popupContact"> 
		<a id="popupContactClose">x</a> 
		<h1>Control Panel - Login</h1> 
		<div id="contactArea">
			<?php echo form_open('login/admin');?> 
			<span class="login-cp-name"><?php echo form_label('Email: ', 'email-cp');?></span>
			<div>
				<?php echo form_input('email-cp', set_value('email-cp'), 'class="form-cp"');?>
				<?php if(isset($errorcp))
						{ echo "<p>".$errorcp."</p>"; }  
					  echo form_error('email-cp');	  
				?>
			</div>
			<span class="login-cp-name"><?php echo form_label('Contrase&ntilde;a: ', 'password-cp');?></span>
			<div>
				<?php echo form_password('password-cp', '', 'class="form-cp"');?>
				<?php echo form_error('password-cp');?>
			</div>
			<span id="submit-cp">			
				<?php echo form_submit('entrar', 'Entrar', 'class="submit-cp"');?>
				<?php echo form_close();?>
			</span>
		</div> 
	</div> 
	<div id="backgroundPopup"></div>
</body>
</html>