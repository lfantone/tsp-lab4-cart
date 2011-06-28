<div>
	<?php echo form_open('cart');?>
	<?php echo form_dropdown('categoria', $categoria);?>
	<?php echo form_submit('ok', 'Ok!');?>
	<?php echo form_close();?>
</div>
<table width="100%" cellpadding="0" cellspacing="0" class="productos_lista">  
   	<thead>  
       	<tr>  
       		<td>Nombre</td>  
      		<td>Precio</td>  
      		<td>+5</td>
      		<td>+10</td>
      		<td>Stock</td>	
       		<td>Cantidad</td>
       		<td></td>        		      		  
       	</tr>  
   	</thead>  
   	<tbody>
	   	<?php foreach ($collectable as $c) {?>
			<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>
				<td><?=character_limiter($c['descripcion'], 8, '')?></td>
			    <td><?=$c['precio']?></td>
			    <td><?=$c['precio']-$c['precio']*0.10?></td>
			    <td><?=$c['precio']-$c['precio']*0.25?></td>
			    <td><?php print_r($c['id_producto']);?></td>
			    <td><?php echo form_open('cart/add_cart_item');
	   					  echo form_input('quantity', '1', 'maxlength="2"');	  	  
			    		  echo form_hidden('id_producto', $c['id_producto']);?></td>		  
			    <td><?php echo form_submit('add', 'Agregar');?></td> 		    		
		   			<?php echo form_close();?>	   			
		    </tr>  					
		<?php } ?>
   	</tbody>
</table>     
