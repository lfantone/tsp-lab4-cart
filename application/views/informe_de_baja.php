<html>
	<head>
		<title>Eliminaci&oacute;nes</title>
	</head>

	<body>
		<h3><?php if(isset($error)){echo $error;}else{echo'Eliminaci&oacute;n exitosa';}?></h3>
		<!--CAMBIAR URL POR PAGINA PRINCIPAL-->
		<p><?php echo anchor('cpanel', 'Ir a la p&aacute;gina principal'); ?></p>
	</body>
</html>