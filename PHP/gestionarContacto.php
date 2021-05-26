<?php


function informacionOficina($conexion) {
	
 	$consulta = "SELECT DIRECCION, DIAS, HORA_APERTURA, HORA_CIERRE FROM OFICINAS ";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> execute();
	return $stmt;
}

function informacionEmpresa($conexion) {
	
 	$consulta = "SELECT CIF, TELEFONO, CORREOELECTRONICO,FACEBOOK FROM INFORMACIONCONTACTOEMPRESA ";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> execute();
	return $stmt;
}

function informacionOficinaYEmpresa($conexion) {
	
 	$consulta = "SELECT * FROM INFORMACIONCONTACTOEMPRESA INNER JOIN OFICINAS ON INFORMACIONCONTACTOEMPRESA.CIF=OFICINAS.CIF";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> execute();
	return $stmt;
}?>