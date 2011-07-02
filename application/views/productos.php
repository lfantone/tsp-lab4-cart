<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>  
<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<title>Productos</title>
	<link href="<?=base_url()?>assets/css/structure.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/form.css" rel="stylesheet"  type="text/css" />	  
 	<link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css" />
 	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet"  type="text/css" />  
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/carro.js"></script>  
</head> 
<body id="public">
	<?php $this->view('banner');?>
	<div id="container">
		<div id="header" class="info">
			<h2>Productos</h2>
		</div> 
		<div id="categorias">
			<?php echo form_open('productos');?>
			<?php echo form_dropdown('categoria', $categoria, 'all');?>
			<?php echo form_submit('ok', 'Ok!');?>
			<?php echo form_close();?>
			<?php if(isset($error_cat))	{ echo "<p>".$error_cat."</p>"; } ?>
		</div>
		<?php if(!isset($error_pro)) {?>
			<table width="100%" cellpadding="0" cellspacing="0" class="productos_lista">  
			   	<thead>  
			       	<tr>  
			       		<td>Nombre</td>  
			      		<td>Precio</td>  
			      		<td>+5</td>
			      		<td>+10</td>
			      		<td>Stock disponible</td>	
			       		<td>Cantidad</td>
			       		<td></td>        		      		  
			       	</tr>  
			   	</thead>  
			   	<tbody>		   		
				   	<?php foreach ($productos as $p) {?>
						<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>
							<td><?php echo character_limiter($p['descripcion'], 10, '')?></td>
						    <td><?php echo $p['precio']?></td>
						    <td><?php echo $p['precio']-$p['precio']*0.10?></td>
						    <td><?php echo $p['precio']-$p['precio']*0.25?></td>
						    <td><?php echo $p['stock'];?></td>
						    <td><?php echo form_open('carro/agregar_producto');
				   					  echo form_input('cantidad', '1', 'maxlength="2"');	  	  
						    		  echo form_hidden('id_producto', $p['id_producto']);?></td>		  
						    <td><?php echo form_submit('add', 'Agregar');?></td> 		    		
					   			<?php echo form_close();?>	   			
					    </tr>  					
					<?php } ?>
			   	</tbody>
			</table>
		<?php } else {
			echo "<p>".$error_pro."</p>";
		}?>
		<div class="carrito_lista">
			<h3>Tu carrito :</h3>
			<div id="carrito_contenido">
				<?php echo $this->view('carro_mostrar.php');?>
			</div>
		</div>
	</div>  
</body>
</html>     
