<?php 
	if(!$this->cart->contents()) {  
    	echo 'No tenés ning&uacute;n producto.';  
	} else {
	?>	<table width="100%" cellpadding="0" cellspacing="0">  
    		<thead>  
        		<tr>  
	            	<td>Cantidad</td>  
	            	<td>Nombre</td>  
	            	<td>Precio</td>  
	            	<td>Sub-Total</td>  
        		</tr>  
    		</thead>  
    		<tbody>        		  
	        	<?php foreach($this->cart->contents() as $items) { ?>	        		 
	        			<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>  
	            			<td><?php echo $items['qty'];?></td>  
	  						<td><?php echo $items['name'];?></td>  
	  		            	<td>$ <?php echo $this->cart->format_number($items['price']);?></td>  
			            	<td>$ <?php echo $this->cart->format_number($items['subtotal']);?></td>  
	        		</tr> 	        		
	        		<?php }?>  
          			<tr>  
            			<td></td>  
            			<td></td>  
            			<td><strong>Total</strong></td>  
            			<td>$ <?php echo $this->cart->format_number($this->cart->total());?></td>  
        			</tr>  
    			</tbody>  
			</table>			 
<?php } ?> 