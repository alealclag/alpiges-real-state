<?php
	session_start();

	require_once("gestionBD.php");
	require_once ("Validaciones.php");
	
	if (isset($_REQUEST["submit"])) {
		$respuesta["texto"]=$_REQUEST["texto"];
		$respuesta["usuario"]=$_REQUEST["usuario"];
		$respuesta["hilo"]=$_REQUEST["hilo"];
	}
	else
		Header("Location: Hilo.php");

	$_SESSION["respuesta"] = $respuesta;

	try{ 
		$conexion = crearConexionBD(); 
		$errores = validarRespuesta($conexion, $respuesta);
		cerrarConexionBD($conexion);
	}catch(PDOException $e){
		$_SESSION["errores"] = "<p>ERROR en la validación: fallo en el acceso a la base de datos.</p><p>" . $e->getMessage() . "</p>";
		Header('Location: Hilo.php');
	}
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: Hilo.php');
	} else
		Header('Location: exito_responder_hilo.php');


?>