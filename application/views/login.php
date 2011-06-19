<html>
<head>
	<title>Login</title>
</head>

<body>
	
	<?php echo form_open('login'); ?>

	<div id="LoginUsuarios">
	   <div class="fila">
		  <div class="LoginUsuariosCabecera">E-mail:</div>
		  <div class="LoginUsuariosDato"><?php echo form_input('email', set_value('email'), 'size="25"');?></div>
		  <div class="LoginUsuariosError">
		  <?php
		  if(isset($error)){
			 echo "<p>".$error."</p>";
		  }
		  echo form_error('email');
		  ?>
		  </div>
	   </div>      
	   <div class="fila">
		  <div class="LoginUsuariosCabecera">Contrase&ntilde;a:</div>
		  <div class="LoginUsuariosDato"><?php echo form_password('password', set_value('password'), 'size="25"');?></div>
		  <div class="LoginUsuariosError"><?php echo form_error('password'); ?></div>
	   </div>
	   
	   <div class="fila">
		  <div class="LoginUsuariosCabecera"><?php echo form_submit('ingresar', 'Ingresar');?></div>
		  <div class="LoginUsuariosDato"><?php echo anchor('controlregistro', 'Nuevo usuario?');?></div>
	   </div>      
	</div>
	<?php echo form_close();?>
</body>
</html>