<?php
	session_start();
	require_once ("../js/validations.js");

	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["DNI"] = $_REQUEST["DNI"];
		$nuevoUsuario["email"] = $_REQUEST["email"];
		$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$nuevoUsuario["NumTel"] = $_REQUEST["NumTel"];
		$nuevoUsuario["contrasena"] = $_REQUEST["contrasena"];
		
	}
	else 
		Header("Location: Registro.php");

	$_SESSION["formulario"] = $nuevoUsuario;

	$errores = validarDatosUsuario($nuevoUsuario);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: Registro.php');
	} else
		Header('Location: exito_alta_usuario.php');

?>
