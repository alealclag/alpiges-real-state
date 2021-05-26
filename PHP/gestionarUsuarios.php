<?php


 function alta_usuario($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "INSERT INTO USUARIOS (OID_US, DNI, NOMBRE, APELLIDOS, FECHA_NACIMIENTO, CORREO_ELECTRONICO, TELEFONO, CONTRASENA) 
VALUES (80,:nif, :nombre, :ape, :fec, :email, :tlf, :pass)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nif',$usuario["DNI"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':pass',$usuario["contrasena"]);
		$stmt->bindParam(':tlf',$usuario["NumTel"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		return false;
    }
}
 
function editar_usuario($conexion,$usuario) {
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

	try {
		$consulta = "CALL PAQ_USUARIOS.ACTUALIZAR(:oidus, :nif, :nombre, :ape, :fec, :email, :tlf, :pass)";		
		
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':oidus',$usuario["OIDUS"]);
		$stmt->bindParam(':nif',$usuario["DNI"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':pass',$usuario["contrasena"]);
		$stmt->bindParam(':tlf',$usuario["NumTel"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		return false;
    }
}
     
function consultarUsuario($conexion,$email,$pass) {
 	$consulta = 'SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE CORREO_ELECTRONICO=:email AND CONTRASENA=:pass';
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}



?>