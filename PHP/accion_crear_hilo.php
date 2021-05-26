<?php
	session_start();

	require_once("gestionBD.php");
	require_once("Validaciones.php");
	
	if (isset($_REQUEST["submit"])) {
		$hilo["titulo"]= $_REQUEST["titulo"];
		$hilo["descripcion"]=$_REQUEST["descripcion"];
		$hilo["usuario"]=$_REQUEST["usuario"];	
	}
	else 
		Header("Location: crearHilo.php");

	$_SESSION["hilo"] = $hilo;

	try{ 
		$conexion = crearConexionBD(); 
		$errores = validarHilo($conexion, $hilo);
		cerrarConexionBD($conexion);
	}catch(PDOException $e){
		$_SESSION["errores"] = "<p>ERROR en la validación: fallo en el acceso a la base de datos.</p><p>" . $e->getMessage() . "</p>";
		Header('Location: crearHilo.php');
	}

	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: crearHilo.php');
	} else
		Header('Location: exito_crear_Hilo.php');


?>