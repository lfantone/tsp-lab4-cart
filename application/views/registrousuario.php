<html>
<head>
	<title>Nuevo Usuario</title>
</head>
<style type="text/css">
	#form1
	{ text-align:left;}
	#req
	{ color: red;}
</style>
<body>
	<div id="form1">
	<table>	
		<?php // echo validation_errors();?>
		<?php echo form_open('registro/new_user'); ?>
		
		<tr>
		<td>
			Nombre: <?php echo form_input('firstname', set_value('firstname'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('firstname'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Apellido: <?php echo form_input('lastname', set_value('lastname'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('lastname'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Contrase&ntilde;a: <?php echo form_password('password', set_value('password'), 'size="50"')?> 
			<label id="req">* <?php echo form_error('password'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Confirme su contrase&ntilde;a:	<?php echo form_password('passconf', set_value('passconf'), 'size="50"')?> 
			<label id="req">* <?php echo form_error('passconf'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Direcci&oacute;n de e-mail: <?php echo form_input('email', set_value('email'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('email'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Direcci&oacute;n: <?php echo form_input('address', set_value('address'), 'size="50"');?>
			<label id="req">* <?php echo form_error('address'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			N&uacute;mero:	<?php echo form_input('address_number', set_value('address_number'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('address_number'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Localidad: <?php echo form_input('city', set_value('city'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('city'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			<p id="req">* Campos requeridos</p>
		</td>
		</tr>
		
		<tr>
		<td>
			<div><?php echo form_submit('aceptar', 'Aceptar');?></div>
		</td>
		</tr>
		
		<?php echo form_close();?>	
	</table>
</div>
</body>
</html>
