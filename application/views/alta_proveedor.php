<html>
<head>
	<title> Nuevo Proveedor </title>
</head>
<body>
	<div id="Alta_proveedor">
	
		<?php echo form_open('alta/new_proveedor'); ?>
		

			Razon Social: <?php echo form_input('razon_social', set_value('razon_social'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('razon_social'); ?> </label>
		
			Telefono: <?php echo form_input('telefono', set_value('telefono'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('telefono'); ?> </label>
		
			
			Direccion: <?php echo form_input('nombre_calle', set_value('nombre_calle'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('nombre_calle'); ?> </label>
		
			Numero: <?php echo form_input('numero_calle', set_value('numero_calle'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('numero_calle'); ?> </label>
			
			Localidad: <?php echo form_input('localidad', set_value('localidad'), 'size="50"');?> 
			<label id="req">* <?php echo form_error('localidad'); ?> </label>
		
			<p id="req">* Campos requeridos</p>
		
		<div><?php echo form_submit('agregar', 'Agregar');?></div>
		
		<?php echo form_close();?>	
</div>
</body>
</html>
