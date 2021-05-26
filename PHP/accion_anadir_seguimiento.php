<?php	
	session_start();	
	require_once("gestion_listas.php");
	require_once("gestionarPerfil.php");
	require_once("gestionBD.php");
	
		$conexion = crearConexionBD();		
		$usuario=	informacionUsuario($conexion, $_SESSION["login"]);
		$excepcion = anadir_seguimiento($conexion,$_REQUEST["inmueble"],$usuario["OID_US"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "Seguimiento.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: Seguimiento.php");
?>