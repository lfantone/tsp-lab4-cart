<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
	<title>Nuevo Proveedor</title>
	<link href="<?=base_url()?>assets/css/structure.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/form.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet" type="text/css" />
</head>
<body id="public">
	<?php $this->view('banner_admin.php');?>
	<div id="container">
		<?php echo form_open('alta/new_proveedor', 'class="form_new_proveedor"');?>		
		<div id="header" class="info">
			<h2>Agregar Nuevo Proveedor</h2>
		</div>
		<ul>	
			<li class="item1">
				<?php echo form_label('Raz&oacute;n Social', 'razon_social');?>
				<div>
					<?php echo form_input('razon_social', set_value('razon_social'), 'tabindex="1" maxlength="50"'); echo form_error('razon_social');?>
				</div>
			</li>
			<li class="item2">
				<?php echo form_label('Tel&eacute;fono', 'telefono');?>
				<div>
					<?php echo form_input('telefono', set_value('telefono'), 'tabindex="2" maxlength="50"'); echo form_error('telefono');?>
				</div>
			</li>
			<li class="item3">
				<?php echo form_label('Direcci&oacute;n', 'nombre_calle');?>
				<div>
					<?php echo form_input('nombre_calle', set_value('nombre_calle'), 'tabindex="3" maxlength="50"'); echo form_error('nombre_calle');?>
				</div>
			</li>		
			<li class="item4">
				<?php echo form_label('N&uacute;mero', 'numero_calle');?>
				<div>
					<?php echo form_input('numero_calle', set_value('numero_calle'), 'tabindex="4" maxlength="50"'); echo form_error('numero_calle');?>
				</div>
			</li>
			<li class="item5">
				<?php echo form_label('Localidad', 'localidad');?>
				<div>
					<?php echo form_input('localidad', set_value('localidad'), 'tabindex="5" maxlength="50"'); echo form_error('localidad');?>
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