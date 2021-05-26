<?php
require_once("gestionBD.php");

if(isset($_GET["email"])){

	$conexion = crearConexionBD();
	$resultado = informacionUsuario($conexion, $_GET["email"]);
	
	if(!empty($resultado)){
		echo "<script type='text/javascript'>alert(\"El email ya está en uso \");</script>";
	}

	cerrarConexionBD($conexion);
	unset($_GET["email"]);
}

function informacionUsuario($conn,$email) {
	
		try {
		$consulta = "SELECT * FROM USUARIOS WHERE CORREO_ELECTRONICO=:email";
		$stmt = $conn->prepare( $consulta );
		$stmt->bindParam( ':email', $email );
		$stmt->execute();
		return $stmt->fetch();
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}

}


?>