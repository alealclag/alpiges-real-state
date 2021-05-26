<?php

function eleccionComercial($conexion, $oid_co) {
	$consulta = "SELECT * FROM COMERCIALES WHERE OID_CO =:oid_co"; 
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':oid_co',$oid_co);	
	$stmt -> execute();
	
	return $stmt->fetch();
}
?>