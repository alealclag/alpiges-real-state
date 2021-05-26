<?php
 
	session_start();
	require_once("gestionarPerfil.php");
	require_once("gestionBD.php");

	if (!isset($_SESSION['login'])) {		
		header("Location: form_login.php");
	}else{
		$conexion=crearConexionBD();
		$usuario=informacionUsuario($conexion, $_SESSION['login']);
		
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
	}

	$usuario=informacionUsuario($conexion, $_SESSION["login"]);
	cerrarConexionBD($conexion); 
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <script src="js/Validaciones.js" type="text/javascript"></script>
  <title>Editar Perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>


<body>
	
	<header><?php include_once("Cabecera.php");?></header>
	<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
<h2>Editar datos de usuario</h2>
	 <form id="modificarUsuario" method="post"  action="accion_editar_usuario.php" novalidate="novalidate" onsubmit="return validarEdicion();">
	 	<fieldset>
	     <p>Nombre*: <input type="text" id="nombre" name="nombre" size="30" required value=<?php echo $usuario['NOMBRE']?> />	</p> 
	 	 <p>Apellidos*: <input type="text" id="apellidos" name="apellidos" size="40" required value=<?php echo $usuario['APELLIDOS']?> />		
	 	 Contraseña*:<input type="password" id="contrasena" name="contrasena" size="20" value=<?php echo $usuario['CONTRASENA']?> required placeholder="numeros, mayusculas y minusculas"/></p> 	
		 <p>DNI*: <input type="text" id="DNI" name="DNI" size="20" required value=<?php echo $usuario['DNI']?> pattern="^[0-9]{8}[A-Z]" placeholder="8 digitos + 1 letra"> </p>
		 <p>E-mail: <input type="email" readonly="readonly" id="email" style="background: lightgrey" name="email" value=<?php echo $usuario['CORREO_ELECTRONICO']?> size="40" required/>	
		 Fecha de Nacimiento:<input type="date" value=<?php echo $usuario['FECHA_NACIMIENTO']?> name="fechaNacimiento" id="fechaNacimiento" required="required"></p>	
		 <p>Numero de Teléfono*: <input type="tel" value=<?php echo $usuario['TELEFONO']?> name="NumTel" id="NumTel" size="40" pattern="^[0-9]{9}" required></p>	
		<input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario["OID_US"]?>"/><br/>
		 <br />
		 <input type="submit" name="submit" value="Enviar">
	 	</fieldset>
	 </form>
	 
	<footer style="position: relative;bottom: -500px"><?php include_once("pie.php");?></footer>
</body>	 


</html>
