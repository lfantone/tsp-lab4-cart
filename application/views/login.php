<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>iCart Login</title>
	<link href="<?=base_url()?>assets/css/login.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.6.1.min.js"></script>  
    <script src="<?=base_url()?>assets/js/popup.js" type="text/javascript"></script> 
</head>
<body>
	<div id="content">
		<div id="login-box">
			<?php echo form_open('login/user');?>
			<h2>Project iCart</h2><br />
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
			<?php echo form_input(array('type' => 'image', 'src' => base_url().'assets/img/login-btn.png', 'name' => 'submit', 'class' => "BtnLogin"));?>
			<?php echo form_close();?>
			<span class="login-box-options">
				<?php echo anchor('registro', 'Nuevo Usuario?', 'class="new_user"');?>
			</span>			
			<span class="login-box-options">
				<a id="JQpopup" >CPanel</a>
			</span>
		</div>	
	</div>
	<div id="popupContact"> 
		<a id="popupContactClose">x</a> 
		<h1>Control Panel - Login</h1> 
		<div id="contactArea">
			<?php echo form_open('login/admin');?> 
			<span class="login-cp-name"><?php echo form_label('Email: ', 'emailcp');?></span>
			<div>
				<?php echo form_input('emailcp', set_value('emailcp'), 'class="form-cp"');?>
				<?php if(isset($errorcp))
						{ echo "<p>".$errorcp."</p>"; }  
					  echo form_error('emailcp');	  
				?>
			</div>
			<span class="login-cp-name"><?php echo form_label('Contrase&ntilde;a: ', 'passwordcp');?></span>
			<div>
				<?php echo form_password('passwordcp', '', 'class="form-cp"');?>
				<?php echo form_error('passwordcp');?>
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