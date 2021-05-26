<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionarPerfil.php");
	
	if(!isset($_SESSION['login']))
		header("Location: form_login.php");	
			
		$conexion = crearConexionBD(); 		
		$usuario=informacionUsuario($conexion, $_SESSION['login']);	
		cerrarConexionBD($conexion);	
	
	
?>

<!DOCTYPE html>

<html lang="es">
	
<head>
	<meta charset="utf-8">
	<title>Perfil</title>
	<link href="estilos/estilos.css" rel="stylesheet"> 
	<script src="scripts.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	<style type="text/css" media="screen">
		 p.perfil{
		 	margin:5px;
		 }
	</style>
	<header><?php include_once("Cabecera.php"); ?></header>
	<h2>Perfil</h2> 
		
	<img style="margin-right: 30px; display: block" src="images/usuario<?php echo $usuario["OID_US"]?>.jpg" width="150" height="150" alt="Imagen perfil" border="3" align="left" >  
	<div style="margin-bottom: 30px"><p></p>
	<p class="perfil"><b>Nombre:</b> <?php echo $usuario["NOMBRE"] ?> </p>
	<p class="perfil"><b>Apellidos:</b> <?php echo $usuario["APELLIDOS"] ?> </p>
	<p class="perfil"><b>DNI:</b> <?php echo $usuario["DNI"] ?> </p>
	<p class="perfil"><b>Fecha Nacimiento:</b> <?php echo $usuario["FECHA_NACIMIENTO"] ?> </p>
	<p class="perfil"><b>Correo Electronico:</b> <?php echo $usuario["CORREO_ELECTRONICO"] ?> </p>
	<p class="perfil"><b>Teléfono:</b> <?php echo $usuario["TELEFONO"] ?> </p>
	<p class="perfil"><b><a href="form_editar_perfil.php">Editar Perfil</a></b></p>
	</div>
	
	<button style="display: inline-block" type="button" ><a href="Seguimiento.php"  role="button">Seguimiento</a></button> <br>
	<button style="display: inline-block" type="button" ><a href="Favoritos.php"  role="button">Favoritos</a></button> <br>
	<button style="display: inline-block; margin-bottom: 20px" type="button" ><a href="Historial.php"  role="button">Historial</a></button> <br>

	<b><a href="cerrar_sesion.php" style="color:red">Cerrar Sesion</a></b>
	
<footer>
	
<?php
	include_once("pie.php");
?>

</footer>
	
</body>
</html>