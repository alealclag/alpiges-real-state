<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	if(isset($_SESSION["login"]))
		header("Location: Perfil.php");
	
	if (isset($_POST['submit'])){
		$email= $_POST['email'];
		$pass = $_POST['contrasena'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$email,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0){
			$login = "error";	
		}else {
			$_SESSION['login'] = $email;
			Header("Location: index.php");
		}	
	}
?>

<!DOCTYPE html>

<html lang="es">
	
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link href="estilos/estilos.css" rel="stylesheet">
	<script src="js/Validaciones.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<header><?php include_once("cabecera.php");?></header>
	
	
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";  
		echo "</div>";
	}	
	?>

		<h2 style="text-align: center">Iniciar Sesion</h2>

		<form action="form_login.php" method="post" onsubmit="return validarLogin();" style="text-align: center">
		Email: <input type="text" name="email" id="email" style="margin-bottom: 10px"/><br />
		Contraseña: <input type="password" name="contrasena" id="contrasena" style="margin-bottom: 10px"/><br />
		<input type="submit" name="submit" value="Entrar" />
	</form> 


<footer style="position: relative;bottom: -230px">
<?php
	include_once("pie.php");
?>
</footer>
	
</body>
</html>