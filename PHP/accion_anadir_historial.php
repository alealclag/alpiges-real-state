<?php	
	session_start();	
	require_once("gestion_listas.php");
	require_once("gestionarPerfil.php");
	require_once("gestionBD.php");
	
	if (isset($_REQUEST["OID_IN"])) {
		$inmueble = $_REQUEST["inmueble"];
		
		$conexion = crearConexionBD();		
		$usuario=	informacionUsuario($conexion, $_SESSION["login"]);
		$excepcion = anadir_historial($conexion,$inmueble["inmueble"],$usuario["OID_US"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "Historial.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: Historial.php");
	}
	else Header("Location: Historial.php");
?>