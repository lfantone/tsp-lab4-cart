<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html>  
<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<title>&Uacute;ltima Compra</title>
	<link href="<?=base_url()?>assets/css/structure.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/css/form.css" rel="stylesheet"  type="text/css" />	  
 	<link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css" />
 	<link href="<?=base_url()?>assets/css/banner.css" rel="stylesheet"  type="text/css" /> 	
</head> 
<body id="public">
	<?php $this->view('banner');?>
	<div id="container">
		<div id="header" class="info">
			<h2>&Uacute;ltima Compra</h2>
		</div>	
		<?php if(isset($error)) { echo $error; } else {?>
		<table width="100%" cellpadding="0" cellspacing="0">  
	    	<thead>  
	        	<tr>  
		            <td>Cantidad</td>  
		            <td>Nombre</td>  
		            <td>Precio</td>	            	  
	        	</tr>  
	    	</thead>  
	    	<tbody>        		  
		        <?php foreach($productos as $p) { ?>	        		 
		        	<tr <?php if(alternator('0', '1')) { echo 'class="alt"'; }?>>  
		            	<td><?php echo $p['cantidad'];?></td>  
		  				<td><?php echo $p['descripcion'];?></td>  
		  		        <td>$ <?php echo $p['precio'];?></td>		          
		        	</tr> 	        		
		        <?php }?>          			  
	    	</tbody>  
		</table>
	<?php }?>
	</div>
</body>
</html>			 
 
