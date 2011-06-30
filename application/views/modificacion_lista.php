<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">  
<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<title>CPanel - Modificac&iacute;on de producto</title>  
 	<link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css" />
 	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet"  type="text/css" />  
</head>  
<body>
	<?php $this->view('banner_admin.php');?>
	<h2>Productos</h2>	
	<table width="100%" cellpadding="0" cellspacing="0" class="productos_lista">  
	   	<thead>  
	       	<tr>	       		  
	      		<td>Descripci&oacute;n</td>  
	      		<td>Precio</td>
	      		<td>Stock</td>
	      		<td>Oferta</td>	
	       		<td>Proveedor</td>
	       		<td>Categor&iacute;a</td>        		      		  
	       		<td>Imagen</td>
	       	</tr>  
	   	</thead>  
	   	<tbody>
		   	<?php foreach ($productos as $p) {?>
				<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>					
				    <td><?=$p['descripcion']?></td>
				    <td><?=$p['precio']?></td>
				    <td><?=$p['stock']?></td>
				    <td><?=$p['oferta']?></td>
				    <td><?=$p['razon_social']?></td>
				    <td><?=$p['nombre']?></td>
				    <td><?=$p['imagen']?></td>
				    <td></td>				    
				    <td><?php echo form_open('modificacion/mod_producto');		   					  	  	  
				    		  echo form_hidden('id_producto', $p['id_producto']);		  
				    	 	  echo form_submit('modificar', 'Modificar');?></td> 		    		
			   			<?php echo form_close();?>	   			
			    </tr>  					
			<?php } ?>
	   	</tbody>
	</table>	
	<h2>Proveedores</h2>
	<table width="100%" cellpadding="0" cellspacing="0" class="productos_lista">  
	   	<thead>  
	       	<tr>	       		
	      		<td>Raz&oacute;n Social</td>  
	      		<td>Tel&eacute;fono</td>	      		
	      		<td>Calle</td>
	      		<td>N&uacute;mero de calle</td>	
	       		<td>Localidad</td>
	       		<td></td>
	       		<td></td>	       		
	       	</tr>  
	   	</thead>  
	   	<tbody>
		   	<?php foreach ($proveedores as $pr) {?>
				<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>					
				    <td><?=$pr['razon_social']?></td>
				    <td><?=$pr['telefono']?></td>
				    <td><?=$pr['nombre_calle']?></td>
				    <td><?=$pr['numero_calle']?></td>
				    <td><?=$pr['localidad']?></td>					    				    
				    <td></td>				    
				    <td><?php echo form_open('modificacion/mod_proovedor');		   					  	  	  
				    		  echo form_hidden('id_proveedor', $pr['id_proveedor']);
				    		  echo form_hidden('id_domicilio', $pr['id_domicilio']);		  
				    	 	  echo form_submit('modificar', 'Modificar');?></td> 		    		
			   			<?php echo form_close();?>	   			
			    </tr>  					
			<?php } ?>
	   	</tbody>
	</table>
	<h2>Categor&iacute;as</h2>
	<table width="100%" cellpadding="0" cellspacing="0" class="productos_lista">  
	   	<thead>  
	       	<tr>  
	      		<td>Nombre</td>
	      		<td></td>
	      		<td></td>	       		
	       	</tr>  
	   	</thead>  
	   	<tbody>
		   	<?php foreach ($categorias as $c) {?>
				<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>					
				    <td><?=$c['nombre']?></td>				    			    
				    <td></td>				    
				    <td><?php echo form_open('modificacion/mod_categoria');		   					  	  	  
				    		  echo form_hidden('id_categoria', $c['id_categoria']);				    		  		  
				    	 	  echo form_submit('modificar', 'Modificar');?></td> 		    		
			   			<?php echo form_close();?>	   			
			    </tr>  					
			<?php } ?>
	   	</tbody>
	</table>
</body>
</html> 