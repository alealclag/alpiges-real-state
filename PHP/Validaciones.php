<?php
function validarDatosUsuario($nuevoUsuario){

		if($nuevoUsuario["DNI"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["DNI"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["DNI"]. "</p>";
		}

		if($nuevoUsuario["email"]==""){ 
		$errores[] = "<p>El email no puede estar vacío</p>";
	}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
		$errores[] = "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
	}
		
		if($nuevoUsuario["NumTel"]=="") 
			$errores[] = "<p>El email no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{9}$/", $nuevoUsuario["NumTel"])){
			$errores[] = "<p>El número de teléfono no es válido: " . $nuevoUsuario["NumTel"]. "</p>";
		}
				
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		if($nuevoUsuario["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacíos</p>";
		

		if($nuevoUsuario["email"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoUsuario["email"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["email"]. "</p>";
		}
			
		if(!isset($nuevoUsuario["contrasena"]) || strlen($nuevoUsuario["contrasena"])<8){
		$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	}else if(!preg_match("/[a-z]+/", $nuevoUsuario["contrasena"]) || 
		!preg_match("/[A-Z]+/", $nuevoUsuario["contrasena"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contrasena"])){
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	}
	
		return $errores;
	} 
	
	function validarHilo($conexion, $hilo){
		$errores=array();
		if($hilo["titulo"]=="") 
			$errores[] = "<p>El título no puede estar vacío</p>";
			
		if($hilo["descripcion"]=="") 
			$errores[] = "<p>La descripción no puede estar vacío</p>";
		
		if($hilo["usuario"]=="" ) 
			$errores[] = "<p>Debes estar registrado para crear un hilo</p>";
		
		return $errores;
	}
	function validarRespuesta($conexion, $respuesta){
		$errores=array();
		if($respuesta["texto"]=="") 
			$errores[] = "<p>La respuesta no puede estar vacía</p>";
		
		return $errores;
	}
?>