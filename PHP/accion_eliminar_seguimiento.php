<?php	
	session_start();	
	require_once("gestion_listas.php");
	require_once("gestionarPerfil.php");
	require_once("gestionBD.php");
	
	if (isset($_REQUEST["OID_IN"])) {
		$inmueble= $_REQUEST["OID_IN"];	
		
		$conexion = crearConexionBD();	
		$usuario=	informacionUsuario($conexion, $_SESSION["login"]);
		$excepcion = eliminar_seguimiento($conexion,$inmueble["OID_IN"],$usuario["OID_US"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "Seguimiento.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: Seguimiento.php");
	}
	else Header("Location: Seguimiento.php"); 
	
	
?>
