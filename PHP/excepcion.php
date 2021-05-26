<?php 
	session_start();
	
	$excepcion = $_SESSION["excepcion"];
	unset($_SESSION["excepcion"]);
	
	if (isset ($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);	
	} else 
		$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <title>¡Se ha producido un problema!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>	
	
<header><?php include_once("cabecera.php");?></header>

	
		<h2>Ups!</h2>
		<?php if ($destino<>"") { ?>
		<p>Ocurrió un problema durante el procesado de los datos. Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página principal.</p>
		<?php } else { ?>
		<p>Ocurrió un problema al acceder a la base de datos. </p>
		<?php } ?>
	
		
	<div style="color: red">	
		<?php echo "Información relativa al problema: $excepcion  "; ?>
		
	</div>

<footer><?php include_once("Pie.php");?></footer>	

</body>
</html>