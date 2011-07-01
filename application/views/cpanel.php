<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html>
<head>
	<title>CPanel</title>	
	<link href="<?=base_url()?>assets/css/structure.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/form.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet" type="text/css" />
</head>
<body id="public">
	<?php $this->view('banner_admin.php');?>
	<div id="container">
		<?php echo form_open('cpanel/redireccion', 'class="form_new_producto"');?>
		<div id="header" class="info">
			<h2>CPanel</h2>
		</div>
		<ul>	
			<li class="item1">
				<div>
					<?php echo form_label('Para dar de alta, seleccionar una opci&oacute;n', 'link');?>
					<?php echo form_dropdown('link', $link);?>					
				</div>				
			</li>
			<li class="button">
				<div>
					<?php echo form_submit('ir', 'Ir', 'class="btSubmit"');?>
				</div>
				<?php echo form_close();?>			
			</li>	
			<li class="item2">
				<?php echo form_open('cpanel/redireccion', 'class="form_new_producto"');?>
				<div>
					<?php echo form_label('Tipo de consulta', 'opciones')?>
					<?php echo form_dropdown('opciones', $opciones);?>
				</div>
			</li>
			<li class="button">
				<div>
					<?php echo form_submit('ir', 'Ir', 'class="btSubmit"');?>
				</div>
				<?php echo form_close();?>
			</li>			
		</ul>
	</div>	
</body>
</html>						
						