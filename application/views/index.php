<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>  
<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<title>Carrito de compra</title>  
 	<link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css" />
 	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet"  type="text/css" />  
	<script type="text/javascript" src="<?=base_url()?>/assets/js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>/assets/js/core.js"></script>  
</head>  
<body>
	<?php $this->view('banner.php')?>
	<div id="general">
		<table>
			<tr>		
				<td><div class="carrito_lista">
							<h3>Tu carrito :</h3>
							<div id="carrito_contenido">
								<?=$this->view('cart.php')?>
							</div>
						</div></td>
			</tr>
			<tr>
				<td><?php $this->view($content_collectable);?></td>  
	  		</tr>
	  		<tr>	  			
				<td><?php $this->view($content_offers);?></td>		
	  		</tr>
	  	</table>	  		  		
	</div>
</body>  
</html>  