<?php
 
	session_start();

	if(isset($_SESSION["login"]))
		header("Location: Perfil.php");

	if (!isset($_SESSION['formulario'])) {
		
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['DNI'] = "";
		$formulario['email'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['NumTel'] = "";
		$formulario['contraseña'] = "";
		$formulario['clave'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}

	else
		$formulario = $_SESSION['formulario'];
			
	if (isset($_SESSION["errores"]))
		$errores = $_SESSION["errores"];
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
  <meta charset="utf-8">
  <link href="estilos/estilos.css" rel="stylesheet">
  <script src="js/Validaciones.js" type="text/javascript"></script>
  <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
  <title>Registro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<script>
	$(document).ready(function() {		
			$("#contrasena").on("keyup", function() {
				colorPassword();
			});
			
			$("#altaUsuario").on("submit", function () {
        		$.get("ValidacionCorreoAJAX.php", { email: $("#email").val()}, function (data) {
        			$("#altaUsuario").append(data); 
        			 	
				});		
	
    		});
		});

</script>
	<header><?php include_once("cabecera.php");?></header>

<?php 
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	
<h2>Registrarse</h2>
	 <form id="altaUsuario" method="post"  action="accion_alta_usuario.php"  novalidate="novalidate" onsubmit="return validarRegistro();">
	 	<fieldset>
	     <p>Nombre*: <input type="text" id="nombre" name="nombre" size="30" required/></p> 
	 	 <p>Apellidos*: <input type="text" id="apellidos" name="apellidos" size="40" required/>
	 	 Contraseña*:<input type="password" id="contrasena" name="contrasena" size="20" required 
	 	 		placeholder="numeros, mayusculas y minusculas" /></p> 	
		 <p>DNI*: <input type="text" id="DNI" name="DNI" size="20" required pattern="^[0-9]{8}[A-Z]" placeholder="8 digitos + 1 letra"></p>
		 <p>E-mail*: <input type="email" id="email" name="email" size="40" required/>	
		 Fecha de Nacimiento:<input type="date" id="fechaNacimiento" name="fechaNacimiento" required="required"></p>	
		 <p>Numero de Teléfono*: <input type="tel" id="NumTel" name="NumTel" size="40" pattern="^[0-9]{9}" required></p>	

	 	</fieldset>
	 	<input type="submit" value="Enviar">
	 </form>
	<footer style="position: relative;bottom: -500px"><?php include_once("pie.php");?></footer>
</body>	 

</html>
