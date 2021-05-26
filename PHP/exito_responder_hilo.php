<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarForo.php");
		
	if (isset($_SESSION["respuesta"])) {
		$respuesta = $_SESSION["respuesta"];
		unset($_SESSION["respuesta"]);
		unset($_SESSION["errores"]);
	}
	else 
		Header("Location: Foro.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <title>Foro: Respuesta creada con éxito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<header><?php include_once("Cabecera.php");?></header>

		<?php if (!nueva_respuesta($conexion, $respuesta)) { ?>
				<h1>Ha habido un problema respondiendo al hilo.</h1>
				<div >	
					Pulsa <a href="responder_hilo.php">aquí</a> para volver al formulario.
				</div>
		<?php }else{?>
			<h1>Respuesta redactada con éxito.</h1>
				<div >	
					Pulsa <a href="Foro.php">aquí</a> para volver al foro.
				</div>
		<?php }?>

	<footer><?php include_once("pie.php");?></footer>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

