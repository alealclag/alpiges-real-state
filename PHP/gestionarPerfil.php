<?php


function informacionUsuario($conn,$email) {
	
	if(isset($email)){
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
	}else{
		header("Location: form_login.php");
	}
	
}

function informacionUsuarioOID_US($conn,$oidus) {

		try {
		$consulta = "SELECT * FROM USUARIOS WHERE OID_US=:oidus";
		$stmt = $conn->prepare( $consulta );
		$stmt->bindParam( ':oidus', $oidus );
		$stmt->execute();
		return $stmt->fetch();
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}
?>