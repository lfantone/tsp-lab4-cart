<ul class="ofertas">  
    <?php foreach ($offers as $o) {?>
    	<li>
    		<h3><?=character_limiter($o['descripcion'], 8, '')?></h3>
    		<img src="<?=base_url()?>assets/img/Bate.png" alt="<?=$o['imagen']?>" width="72" height="72"/>
    		<small>$ <?=$o['precio']?></small>
    		<?=form_open('cart/add_cart_item')?>
    			<fieldset>
    				<label>Cantidad: </label>
    				<?=form_input('quantity', '1', 'maxlength="2"')?>
    				<?=form_hidden('id_producto', $o['id_producto'])?>
    				<?=form_submit('add', 'Agregar')?>
    			</fieldset>
    		<?=form_close()?>
    	</li>
    <?php }?>  
</ul>  