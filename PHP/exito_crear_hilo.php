<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarForo.php");
		
	if (isset($_SESSION["hilo"])) {
		$hilo = $_SESSION["hilo"];
		unset($_SESSION["hilo"]);
		unset($_SESSION["errores"]);
	}
	else 
		Header("Location: crearHilo.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <title>Foro: Hilo creado con éxito</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<header><?php include_once("Cabecera.php");?></header>

	
		<?php if (!nuevo_hilo($conexion, $hilo["titulo"],$hilo["descripcion"],$hilo["usuario"])) { ?>
				<h1>Ha habido un problema creando el hilo.</h1>
				<div >	
					Pulsa <a href="crearHilo.php">aquí</a> para volver al formulario.
					<?php echo $_SESSION["prueba"];
					echo $hilo["usuario"];
					?>
				</div>
		<?php }else{?>
			<h1>Hilo redactado con éxito.</h1>
				<div >	
					Pulsa <a href="Foro.php">aquí</a> para volver al foro.
				</div>
		<?php }?>

	<footer ><?php include_once("pie.php");?></footer>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

