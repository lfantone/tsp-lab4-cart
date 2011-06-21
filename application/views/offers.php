<ul class="ofertas">  
    <?php foreach ($offers as $o) {?>
    	<li>
<<<<<<< HEAD
    		<h3><?=character_limiter($o['collectable_name'], 8, '')?></h3>
    		<img src="<?=base_url()?>assets/img/<?=$o['image']?>.png" alt="<?=$o['image']?>" width="72" height="72"/>
    		<small>$ <?=$o['base_price']?></small>
=======
    		<h3><?=character_limiter($o['descripcion'], 8, '')?></h3>
    		<img src="<?=base_url()?>assets/img/Bate.png" alt="<?=$o['imagen']?>" width="72" height="72"/>
    		<small>$ <?=$o['precio']?></small>
>>>>>>> de7319b30ab1fef9cd8257284caac78d25dd4aed
    		<?=form_open('cart/add_cart_item')?>
    			<fieldset>
    				<label>Cantidad: </label>
    				<?=form_input('quantity', '1', 'maxlength="2"')?>
<<<<<<< HEAD
    				<?=form_hidden('id_collectable', $o['id_collectable'])?>
=======
    				<?=form_hidden('id_producto', $o['id_producto'])?>
>>>>>>> de7319b30ab1fef9cd8257284caac78d25dd4aed
    				<?=form_submit('add', 'Agregar')?>
    			</fieldset>
    		<?=form_close()?>
    	</li>
    <?php }?>  
</ul>  