<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarContacto.php");

	$conexion = crearConexionBD(); 
	
	$tablas = informacionOficinaYEmpresa($conexion);
	
	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>

<html lang="es">
	
<head>
	<meta charset="utf-8">
	<title>Contacto</title>
	<link href="estilos/estilos.css" rel="stylesheet"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<header>
	<?php
		include_once("Cabecera.php");
	?>
	</header>
		
		<fieldset style="width: 40%; margin: 10px">
		<legend><h2>Oficina</h2></legend>
		
			<?php foreach ($tablas as $tabla){ ?>
			<b>Dirección:</b> <?php echo $tabla["DIRECCION"] ?> <br>
			<b>CIF:</b> <?php echo $tabla["CIF"] ?> <br>
			<b>Horario:</b><br>
			<div style="margin-left: 5%"><?php echo $tabla["DIAS"] ?>:</div>
			<div style="margin-left: 7%"><?php echo $tabla["HORA_APERTURA"]; ?> - 
				<?php echo $tabla["HORA_CIERRE"]; ?></div> 
			<b>Telefono:</b> <?php echo $tabla["TELEFONO"] ?> <br>
			<b>Correo Electronico: </b><?php echo $tabla["CORREOELECTRONICO"] ?> <br>
			<b>Facebook: </b><?php echo $tabla["FACEBOOK"] ?>	<br>
			<?php } ?>	
		
		</fieldset>
	
	
<footer style="position: relative;bottom: -80px">
<?php
	include_once("pie.php");
?>
</footer>
	
</body>
</html>