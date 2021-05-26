<?php
	session_start();
	require_once ("Validaciones.php");
	
	if (isset($_REQUEST["submit"])) {
		$usuario["nombre"] = $_REQUEST["nombre"];
		$usuario["apellidos"] = $_REQUEST["apellidos"];
		$usuario["DNI"] = $_REQUEST["DNI"];
		$usuario["email"] = $_REQUEST["email"];
		$usuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$usuario["NumTel"] = $_REQUEST["NumTel"];
		$usuario["contrasena"] = $_REQUEST["contrasena"];
		$usuario["OIDUS"] = $_REQUEST["usuario"];
		
	}
	else 
		Header("Location: form_editar_usuario.php");

	$_SESSION["formulario"] = $usuario;

	$errores = validarDatosUsuario($usuario);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: exito_editar_usuario.php');
	} else
		Header('Location: accion_editar_usuario.php');


?>
