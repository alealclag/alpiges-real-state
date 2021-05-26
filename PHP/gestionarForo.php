<?php

 function nuevo_hilo($conexion, $titulo,$descripcion,$oid_us) {

	try {
		$date= date("d/m/Y"); 
		$stmt=$conexion->prepare("INSERT INTO HILOSFORO (TITULO, DESCRIPCION, FECHA, OID_US) VALUES (:titulo ,:descripcion , :fecha, $oid_us)");
		$stmt->bindParam(':titulo',$titulo);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':fecha',$date);
		
		$stmt->execute();
		
		return TRUE;
	} catch(PDOException $e) {		
		$_SESSION["prueba"] =$e->getMessage();
		return FALSE;
    }
}

function consulta_hilo( $conn, $oidhf ){
	try {
		$stmt = $conn->prepare( "SELECT * FROM HILOSFORO WHERE OID_HF= :oidhf" );
		$stmt->bindParam( ':oidhf', $oidhf );
		$stmt->execute();		
		return $stmt->fetch();
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
} 

 function nueva_respuesta($conexion,$respuesta) {

	try {
		$date= date("d/m/Y"); 
		$consulta = "INSERT INTO RESPUESTAS (TEXTO, FECHA, OID_HF, OID_US) VALUES (:texto ,:fecha , :hilo, :usuario)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':texto',$respuesta["texto"]);
		$stmt->bindParam(':hilo',$respuesta["hilo"]);
		$stmt->bindParam(':fecha',$date);
		$stmt->bindParam(':usuario',$respuesta["usuario"]);
		
		$stmt->execute();
		
		return TRUE;
	} catch(PDOException $e) {
		return FALSE;
    }
}
?>