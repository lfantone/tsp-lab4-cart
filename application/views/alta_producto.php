<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Producto</title>
	<link href="<?=base_url()?>assets/css/structure.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/form.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet" type="text/css" />
</head>
<body id="public">
	<?php $this->view('banner_admin.php')?>
	<div id="container">
		<?php echo form_open('alta/new_producto', 'class="form_new_producto"');?>		
		<header id="header" class="info">
			<h2>Agregar nuevo producto</h2>
		</header>
		<ul>	
			<li class="item1">
				<?php echo form_label('Descripci&oacute;n', 'descripcion');?>
				<div>
					<?php echo form_input('descripcion', set_value('descripcion'), 'tabindex="1" maxlength="50"'); echo form_error('descripcion');?>
				</div>
			</li>			
			<li class="item2">
				<?php echo form_label('Precio', 'precio');?>
				<div>
					<?php echo form_input('precio', set_value('precio'), 'size="8" tabindex="2" maxlength="50"');echo form_error('precio');?>
				</div>
			</li>			
			<li class="item3">
				<?php echo form_label('Stock', 'stock');?>
				<div>
					<?php echo form_input('stock', set_value('Stock'), 'size="8" tabindex="3" maxlength="2"');echo form_error('stock');?>
				</div>
			</li>			
			<li class="item4">				
				<div>
					<span class="left">						
						<?php echo form_label('Proveedor', 'proveedor');?>
						<?php echo form_dropdown('proveedor', $proveedores, '', 'tabindex="4"');echo form_error('proveedor');?>
					</span>
					<span>						
						<?php echo form_label('Categor&iacute;a', 'categoria');?>
						<?php echo form_dropdown('categoria', $categorias, '', 'tabindex="5"');echo form_error('categoria');?>
					</span>
					<span class="right">
						<?php echo form_label('Oferta', 'oferta');?>
						<?php echo form_checkbox('oferta', '1', FALSE, 'tabindex="6"');echo form_error('oferta');?>
					</span>
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