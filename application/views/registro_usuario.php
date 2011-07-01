<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>
<head>
	<title>Nuevo Usuario</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/structure.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/form.css" type="text/css" />
</head>
<body id="public">
	<div id="container">
		<?php echo form_open('registro/new_user', 'class="form_new_producto"');?>		
		<div id="header" class="info">
			<h2>Nuevo Usuario</h2>
		</div>
		<ul>	
			<li class="item1">
				<?php echo form_label('Nombre', 'nombre');?>
				<div>
					<?php echo form_input('nombre', set_value('nombre'), 'tabindex="1" maxlength="50"'); echo form_error('nombre');?>
				</div>
			</li>			
			<li class="item2">
				<?php echo form_label('Apellido', 'apellido');?>
				<div>
					<?php echo form_input('apellido', set_value('apellido'), 'tabindex="2" maxlength="50"');echo form_error('apellido');?>
				</div>
			</li>			
			<li class="item3">
				<?php echo form_label('Contrase&ntilde;a', 'password');?>
				<div>
					<?php echo form_password('password', '', 'tabindex="3" maxlength="50"');echo form_error('password');?>
				</div>
			</li>			
			<li class="item4">				
				<?php echo form_label('Confirme su contrase&ntilde;a', 'passconf');?>
				<div>
					<?php echo form_password('passconf', '', 'tabindex="4" maxlength="50"'); echo form_error('passconf');?>
				</div>
			</li>
			<li class="item5">				
				<?php echo form_label('Direcci&oacute;n de e-mail', 'email');?>
				<div>
					<?php echo form_input('email', set_value('email'), 'tabindex="5" maxlength="50"'); echo form_error('email');?>
				</div>
			</li>
			<li class="item6">				
				<?php echo form_label('Direcci&oacute;n', 'direccion');?>
				<div>
					<?php echo form_input('direccion', set_value('direccion'), 'tabindex="6" maxlength="50"'); echo form_error('direccion');?>
				</div>
			</li>
			<li class="item7">				
				<?php echo form_label('N&uacute;mero', 'numero_calle');?>
				<div>
					<?php echo form_input('numero_calle', set_value('numero_calle'), 'tabindex="7" maxlength="50"'); echo form_error('numero_calle');?>
				</div>
			</li>
			<li class="item8">				
				<?php echo form_label('Localidad', 'localidad');?>
				<div>
					<?php echo form_input('localidad', set_value('localidad'), 'tabindex="8" maxlength="50"'); echo form_error('localidad');?>
				</div>
			</li>
			<li class="button">
				<div>
					<?php echo form_submit('agregar', 'Agregar', 'class="btSubmit"');?>
				</div>
			</li>			
		</ul>
		<?php echo form_close();?>
	</div>
</body>
</html>
