<html>
<head>
	<title>Nuevo Usuario</title>
</head>
<body>
	<div id="Alta_productos">
	<table>	
		<?php echo form_open('alta/new_producto'); ?>
		
		<tr>
		<td>
			Descripci&oacute;n: <?php echo form_input('descripcion', set_value('descripcion'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('descripcion'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Precio: <?php echo form_input('precio', set_value('precio'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('precio'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Stock: <?php echo form_input('stock', set_value('stock'), 'size="5"');?> 
			<label id="req">* <?php echo form_error('stock'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Oferta:	<?php echo form_checkbox('oferta', '1', FALSE);?>
		</td>
		</tr>
		
		<tr>
		<td>
			Proveedor: <?php echo form_dropdown('proveedor',  array(
                  '1'  => 'Small Shirt',
                  '2'    => 'Medium Shirt',
                  '3'   => 'Large Shirt',
                  '4' => 'Extra Large Shirt',
                ));?> 
			<label id="req">* <?php echo form_error('proveedor'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			Categor&iacute;a: <?php echo form_dropdown('categoria',  array(
                  '1'  => 'Memorias',
                  '2'    => 'Procesadores',
                  '3'   => 'Video',
                  '4' => 'Accesorios',
                ));?>
			<label id="req">* <?php echo form_error('categoria'); ?> </label>
		</td>
		</tr>
		
		<tr>
		<td>
			<p id="req">* Campos requeridos</p>
		</td>
		</tr>
		
		<tr>
		<td>
			<div><?php echo form_submit('agregar', 'Agregar');?></div>
		</td>
		</tr>
		
		<?php echo form_close();?>	
	</table>
</div>
</body>
</html>
