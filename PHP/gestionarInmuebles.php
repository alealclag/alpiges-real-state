<?php

function consulta_inmueble( $conn, $oidin ){
	try {
		$consulta ='SELECT * FROM INMUEBLES WHERE OID_IN= :oidin';
		$stmt = $conn->prepare( $consulta );
		$stmt->bindParam( ':oidin', $oidin );
		$stmt->execute();
		
		return $stmt->fetch();
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 

?>