<!DOCTYPE html>
<html>
<head>
	<title>Mi perfil</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/structure.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/form.css" type="text/css" />
	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet"  type="text/css" />  
</head>
<body id="public">
	<?php $this->view('banner.php')?>
	<div id="container">
		<?php echo form_open('perfil/new_user');?>	
		<header id="header" class="info">
			<h2>Mi perfil</h2>
		</header>
		<ul>	
			<li class="item1">
				<?php echo form_label('Nombre', 'nombre');?>
				<div>
					<?php echo form_input('nombre', $usuario[0]['nombre'], 'tabindex="1" maxlength="50" disabled="disabled"'); echo form_error('nombre');?>
				</div>
			</li>			
			<li class="item2">
				<?php echo form_label('Apellido', 'apellido');?>
				<div>
					<?php echo form_input('apellido', $usuario[0]['apellido'], 'tabindex="2" maxlength="50" disabled="disabled"');echo form_error('apellido');?>
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
				<?php echo form_label('Direcci&oacute;n de e-mail', 'e-mail');?>
					<?php echo form_input('email', $usuario[0]['mail'], 'tabindex="5" maxlength="50" disabled="disabled"'); echo form_error('e-mail');?>
				<div>
				</div>
			</li>
			<li class="item6">				
				<?php echo form_label('Direcci&oacute;n', 'direccion');?>
				<div>
					<?php echo form_input('direccion', $usuario[0]['nombre_calle'], 'tabindex="6" maxlength="50"'); echo form_error('direccion');?>
				</div>
			</li>
			<li class="item7">				
				<?php echo form_label('N&uacute;mero', 'numero_calle');?>
				<div>
					<?php echo form_input('numero_calle', $usuario[0]['numero_calle'], 'tabindex="7" maxlength="50"'); echo form_error('numero_calle');?>
				</div>
			</li>
			<li class="item8">				
				<?php echo form_label('Localidad', 'localidad');?>
				<div>
					<?php echo form_input('localidad', $usuario[0]['localidad'], 'tabindex="8" maxlength="50"'); echo form_error('localidad');?>
				</div>
			</li>
			<li class="button">
				<div>
					<?php echo form_submit('agregar', 'Modificar mis datos', 'class="btSubmit"');?>
				</div>
			</li>
			<li class="button">
				<div>
					<?php echo anchor('perfil_usuario/ultimo_carro', 'Ir al ultimo carro', 'class="btSubmit"');?>
			</li>						
				</div>
		</ul>

		<?php echo form_close();?>
	</div>
</body>
</html>
