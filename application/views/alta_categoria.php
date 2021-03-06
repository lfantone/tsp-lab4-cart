<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
	<title>CPanel - Categor&iacute;a</title>
	<link href="<?=base_url()?>assets/css/structure.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/form.css" rel="stylesheet"  type="text/css" />
	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet"  type="text/css" />
</head>
<body id="public">
	<?php $this->view('banner_admin.php');?>
	<div id="container">
		<?php echo form_open('alta/new_categoria', 'class="form_new_categoria"');?>		
		<div id="header" class="info">
			<h2>Agregar Nueva Categor&iacute;a</h2>
		</div>
		<?php if(isset($error)){ echo $error; }?>
		<ul>	
			<li class="item1">
				<?php echo form_label('Nombre de Categor&iacute;a', 'nombre');?>
				<div>
					<?php echo form_input('nombre', set_value('nombre'),'tabindex="1" maxlength="50"');echo form_error('nombre');?> 
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