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
<<<<<<< HEAD
				<td><?=character_limiter($c['collectable_name'], 8, '')?></td>
			    <td><?=$c['base_price']?></td>
			    <td><?=$c['base_price']-$c['base_price']*0.10?></td>
			    <td><?=$c['base_price']-$c['base_price']*0.25?></td>
			    <td><?php print_r($c['id_collectable']);?></td>
			    <td><?php echo form_open('cart/add_cart_item', array('name'=>'a'));
	   					  echo form_input('quantity', '1', 'maxlength="2"');	  	  
			    		  echo form_hidden('id_collectable', $c['id_collectable']);?></td>   						
=======
				<td><?=character_limiter($c['descripcion'], 8, '')?></td>
			    <td><?=$c['precio']?></td>
			    <td><?=$c['precio']-$c['precio']*0.10?></td>
			    <td><?=$c['precio']-$c['precio']*0.25?></td>
			    <td><?php print_r($c['id_producto']);?></td>
			    <td><?php echo form_open('cart/add_cart_item', array('name'=>'a'));
	   					  echo form_input('quantity', '1', 'maxlength="2"');	  	  
			    		  echo form_hidden('id_producto', $c['id_producto']);?></td>   						
>>>>>>> de7319b30ab1fef9cd8257284caac78d25dd4aed
			    <td><?php echo form_submit('add', 'Agregar');?></td> 		    		
		   			<?php echo form_close();?>	   			
		    </tr>  					
		<?php } ?>
   	</tbody>
</table>     
