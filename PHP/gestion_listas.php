<?php


function anadir_favoritos($conexion,$oid_in,$oid_us) {
		
			try {
				$stmt=$conexion->prepare('CALL PAQ_ESTAENLISTAFAV.INSERTAR(:oid_in, :oid_us)');
				$stmt->bindParam(':oid_in',$oid_in);
				$stmt->bindParam(':oid_us',$oid_us);
				$stmt->execute();
		
				return "";
			}catch(PDOException $e) {
				return $e->getMessage();
   			 }
	
}

function anadir_seguimiento($conexion,$oid_in,$oid_us) {
	try {	
		$stmt=$conexion->prepare('CALL PAQ_ESTAENLISTASEG.INSERTAR(:oid_in,:oid_us)');
		$stmt->bindParam(':oid_in',$oid_in);
		$stmt->bindParam(':oid_us',$oid_us);
		$stmt->execute();
		
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function anadir_historial($conexion,$oid_in,$oid_us) {
	try {
		$date= date("d/m/Y"); 
		$stmt=$conexion->prepare("INSERT INTO HISTORIALESBUSQUEDA (FECHAYHORA, OID_IN, OID_US) VALUES (:fecha, :oid_in, :oid_us)");
		$stmt->bindParam(':fecha',$date);
		$stmt->bindParam(':oid_in',$oid_in);
		$stmt->bindParam(':oid_us',$oid_us);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function eliminar_favoritos($conexion,$oid_in,$oid_us) {
	try {
		$stmt=$conexion->prepare('DELETE FROM ESTAENLISTAFAV WHERE OID_US = :oid_us AND OID_IN=:oid_in');
		$stmt->bindParam(':oid_in',$oid_in);
		$stmt->bindParam(':oid_us',$oid_us);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function eliminar_seguimiento($conexion,$oid_in,$oid_us) {
	try {		
		$stmt=$conexion->prepare('DELETE FROM ESTAENLISTASEG WHERE OID_US = :oid_us AND OID_IN=:oid_in');
		$stmt->bindParam(':oid_in',$oid_in);
		$stmt->bindParam(':oid_us',$oid_us);
		$stmt->execute();		
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}


function informacionInmueble($conn,$oid_in) {
	
		try {
		$consulta="SELECT * FROM INMUEBLES WHERE OID_IN =($oid_in)";
		$stmt = $conn->prepare( $consulta );
		$stmt->execute();
		return $stmt->fetch();
	}	
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
	return $consulta;
	
}
?>