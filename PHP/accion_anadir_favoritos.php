<?php	
	session_start();	
	require_once("gestion_listas.php");
	require_once("gestionarPerfil.php");
	require_once("gestionBD.php");
		
		$conexion = crearConexionBD();		
		$usuario=	informacionUsuario($conexion, $_SESSION["login"]);
		$excepcion = anadir_favoritos($conexion,$_REQUEST["inmueble"],$usuario["OID_US"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "Favoritos.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: Favoritos.php");
	
?>