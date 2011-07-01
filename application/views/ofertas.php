<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>  
<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<title>Main</title>
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
			<h2>Productos en ofertas !</h2>
		</div>		
		<ul class="ofertas">
			<?php foreach ($ofertas as $o) {?>
			<li>    		
				<h3><?php echo $o['descripcion'];?></h3>
			    <img src="<?=base_url()?>assets/img/Bate.png" alt="<?php echo $o['imagen'];?>" width="72" height="72"/>
			    <small>$ <?php echo $o['precio'];?></small>
			    <?php echo form_open('carro/agregar_producto');?>
			    <fieldset>
			    	<?php echo form_label('Cantidad:', 'cantidad');?>
			    	<?php echo form_input('cantidad', '1', 'maxlength="2"');?>    				
			    	<?php echo form_hidden('id_producto', $o['id_producto']);?>
			    	<?php echo form_submit('add', 'Agregar');?>
			    </fieldset>
			    		<?php echo form_close();?>
			</li>
			<?php }?>
		</ul>
		<div class="carrito_lista">
			<h3>Tu carrito :</h3>
			<div id="carrito_contenido">
				<?php echo $this->view('carro_mostrar.php');?>
			</div>
		</div>  
	</div>	
</body>  
</html> 