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
			<h2>Mi Carrito</h2>
		</div>
	<?php 
		if(!$this->cart->contents()) {  
	    	echo '<p>No ten&eacute;s ning&uacute;n producto.</p>';  
		} else {			
			echo form_open('carro/actualizar_carro');?>  
				<table width="100%" cellpadding="0" cellspacing="0">  
	    			<thead>  
	        			<tr>  
		            		<td>Cantidad</td>  
		            		<td>Nombre</td>  
		            		<td>Precio</td>  
		            		<td>Sub-Total</td>  
	        			</tr>  
	    			</thead>  
	    			<tbody>        		  
		        		<?php foreach($this->cart->contents() as $items) {
		        			echo form_hidden('rowid[]', $items['rowid']);
		        			echo form_hidden('id[]', $items['id']);?>  
		        		<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>  
		            		<td><?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5'))?></td>  
		  					<td><?php echo $items['name']?></td>  
		  		            <td>$ <?php echo $this->cart->format_number($items['price'])?></td>  
				            <td>$ <?php echo $this->cart->format_number($items['subtotal'])?></td>  
		        		</tr> 	        		
		        		<?php }?>  
	          			<tr>  
	            			<td></td>  
	            			<td></td>  
	            			<td><strong>Total</strong></td>  
	            			<td>$ <?php echo $this->cart->format_number($this->cart->total())?></td>  
	        			</tr>  
	    			</tbody>  
				</table>  
			<p><?php echo form_submit('actualizar', 'Actualizar'); 
					 echo anchor('carro/comprar_carro', 'Comprar');
					 echo anchor('carro/vaciar_carro', 'Vaciar', 'class="vaciar"');?></p>  
			<p><small>Si se introduce una cantidad igual a 0 se borrará el producto del carrito.</small></p>  
	<?php  
			echo form_close();  
		}  
	?>
	</div>
</body>
</html>  