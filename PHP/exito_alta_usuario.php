<?php
	session_start();
	require_once ("gestionarUsuarios.php");
	require_once ("gestionBD.php");
	
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		unset($_SESSION["formulario"]); 
		unset($_SESSION["errores"]); 
	}
	else {
		Header("Location: Registro.php");
	}
	$conexion=crearConexionBD();
			
	?>

		
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <title>Registro: Usuario editado con éxito</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<header><?php include_once("Cabecera.php");?></header>

		<?php if(alta_usuario($conexion, $nuevoUsuario)){?>
			
		  <h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
			
			   Pulsa <a href="form_login.php">aquí</a> para iniciar sesión.
			
		

		<h2>Se ha creado el usuario:</h2>
		<ul>
			<li><?php echo "Nombre: " .$nuevoUsuario["nombre"]; ?></li>
			<li><?php echo "Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
			<li><?php echo "DNI: " . $nuevoUsuario["DNI"]; ?></li>
			<li><?php echo "E-mail: " . $nuevoUsuario["email"]; ?></li>
			<li><?php echo "Fecha de Nacimiento: " . $nuevoUsuario["fechaNacimiento"]; ?></li>
			<li><?php echo "Número de Teléfono: " . $nuevoUsuario["NumTel"]; ?></li>

		</ul>
		<?php }else{?>
				<h1>Ha habido un problema en el registro.</h1>
					
						Pulsa <a href="Registro.php">aquí</a> para volver al formulario.
					
		<?php } ?>		

	<footer ><?php include_once("pie.php");?></footer>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
	
?>
