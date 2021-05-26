<?php
	session_start();
	require_once ("gestionarUsuarios.php");
	require_once ("gestionBD.php");
	
	if (isset($_SESSION["formulario"])) {
		$usuario = $_SESSION["formulario"];
		unset($_SESSION["formulario"]); 
		unset($_SESSION["errores"]); 
	}
	else {
		Header("Location: form_editar_perfil.php");
	}
	$conexion=crearConexionBD();
			
	?>

		
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <title>Los datos de usuario han sido actualizados</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	 <header><?php include_once("Cabecera.php");?></header>

	
		<?php if(editar_usuario($conexion, $usuario)){?>
			<div id="div_exito">
		  <h1><?php echo $usuario["nombre"]; ?>, has editado tus datos</h1>
			<div id="div_volver">	
			   Pulsa <a href="Perfil.php">aquí</a> para volver al Perfil.
			</div>
		</div>

		<h2>Los datos de usuario han sido actualizados:</h2>
		<ul>
			<li><?php echo "Nombre: " .$usuario["nombre"]; ?></li>
			<li><?php echo "Apellidos: " . $usuario["apellidos"]; ?></li>
			<li><?php echo "DNI: " . $usuario["DNI"]; ?></li>
			<li><?php echo "E-mail: " . $usuario["email"]; ?></li>
			<li><?php echo "Fecha de Nacimiento: " . $usuario["fechaNacimiento"]; ?></li>
			<li><?php echo "Número de Teléfono: " . $usuario["NumTel"]; ?></li>

		</ul>
		<?php }else{?>
				<h1>Ha habido un problema en la edición.</h1>
					
						Pulsa <a href="form_editar_perfil.php">aquí</a> para volver al formulario.
					
		<?php } ?>		
	
	<footer><?php include_once("pie.php");?></footer>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>
