<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>  
<head>
</head>
<body>
	<?php if(isset($error)) {?>
	 <h3>Compra incompleta</h3>
		<ul>
			<?php foreach ($info as $i) {?>				
					<li><?php echo $i;?></li>				
			<?php }?>
		</ul>
	<?php } else {?>
			<h3><?php echo $info;?></h3>
	<?php }?>
		<?php echo anchor('main', 'Volver')?>
</body>
</html>