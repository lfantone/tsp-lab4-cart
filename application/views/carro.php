<?php 
	if(!$this->cart->contents()) {  
    	echo 'No tenés ning&uacute;n producto.';  
	} else {  
?>  
		<?php echo form_open('carro/actualizar_carro')?>  
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
		<p><?php echo form_submit('', 'Actualizar'); 
				 echo anchor('carro/vaciar_carro', 'Vaciar', 'class="vaciar"');?></p>  
		<p><small>Si se introduce una cantidad igual a 0 se borrará el producto del carrito.</small></p>  
<?php  
		echo form_close();  
	}  
?>  