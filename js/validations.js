//Validaciones de Formularios

function validarCrearHilo() {

  	var error1=validarTitulo();
  	var error2=validarDescripcion();
  	var error3=validarOIDUsuario();
	
	return (error1.length==0) && (error2.length==0) && (error3.length==0);

}

function validarRegistro(){
	
	var error1=validarNombre();
	var error2=validarApellidos();
	var error3=validarDNI();
	var error4=validarEmail();
	//var error5=validarFechaNacimiento();
	var error6=validarTlf();
	var error7=validarPasswordReg();

	return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0)
	&& (error6.length==0) && (error7.length==0) ;
	
}

function validarEdicion(){
	
	var error1=validarNombre();
	var error2=validarApellidos();
	var error3=validarDNI();
	var error4=validarEmail();
	//var error5=validarFechaNacimiento();
	var error6=validarTlf();
	var error7=validarPasswordReg();
	var error8=validarOIDUsuario();
	return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0)
	&& (error6.length==0) && (error7.length==0) && (error8.length==0);
	
}

function validarLogin(){
	
	var error1=validarEmail();
	var error2=validarPasswordLog();

	return (error1.length==0) && (error2.length==0) ;
	
}

function validarRespuesta(){
	
	var error1=validarRespuestaTexto();
	var error2=validarOIDHilo();
	var error3=validarOIDUsuario();

	return (error1.length==0) && (error2.length==0) && (error3.length==0);
	
}

function validarInmueble(){
	
	var error1=validarOIDInmueble();
	return (error1.length==0) ;
	
}

function validarHilo(){
	
	var error1=validarOIDHilo();
	return (error1.length==0) ;
	
}

function validarBusqueda(){
		var ok=true;
		var precioMin = document.getElementById("precioMin").value;
		var precioMax = document.getElementById("precioMax").value;
		var metrosMin = document.getElementById("metrosMin").value;
		var metrosMax = document.getElementById("metrosMax").value;
		var habitacionesMin = document.getElementById("habitacionesMin").value;
		var habitacionesMax = document.getElementById("habitacionesMax").value;
		var bañosMin = document.getElementById("bañosMin").value;
		var bañosMax = document.getElementById("bañosMax").value;
		var eficienciaEnergetica = document.getElementById("eficienciaEnergetica").value;
		var re=/^[0-9]*$/;
		var re2=/^[A-F]$/;
		var valid =(re.test(String(precioMin))) && (re.test(String(precioMax))) && (re.test(String(metrosMin)))
		&& (re.test(String(metrosMax))) && (re.test(String(habitacionesMin))) && (re.test(String(habitacionesMax)))
		&& (re.test(String(bañosMin)))&& (re.test(String(bañosMax))) && (re2.test(String(eficienciaEnergetica)))
		&& (precioMin.length>0) && (precioMax.length>0) && (metrosMin.length>0) && (metrosMax.length>0)
		&& (habitacionesMin.length>0) && (habitacionesMax.length>0) && (bañosMin.length>0) && (bañosMax.length>0);
		
		if(!valid){
			var error = "Por favor, introduzca datos válidos";
			 alert(error);
			 ok=false;
		}
		return ok;
	}

//Validaciones de Campos

	function passwordValidation(){
		var password = document.getElementById("contrasena");
		var pwd = password.value;
		var valid = true;

		valid = valid && (pwd.length>=8);
		
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
		
		if(!valid){
			var error = "La contraseña debe contener mayúsculas, minúsculas, al menos un dígito y una letra y un mínimo de 8 caracteres";
		}else{
			var error = "";
		}
	        password.setCustomValidity(error);
		return error;
	}

	function validarPasswordReg(){
		var password = document.getElementById("contrasena").value;
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		var valid = (password.length>=8) && (hasNumber.test(password)) && (hasUpperCases.test(password)) 
			&& (hasLowerCases.test(password));

		if(!valid){
			var error = "La contraseña debe contener mayúsculas, minúsculas, al menos un dígito y una letra y un mínimo de 8 caracteres";
			alert(error);
		}else{
			var error = "";
		}
		return error;
	}
	
	function validarPasswordLog(){
		var password = document.getElementById("contrasena").value;
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		var valid = (password.length>=8) && (hasNumber.test(password)) && (hasUpperCases.test(password)) 
			&& (hasLowerCases.test(password));

		if(!valid){
			var error = "Contraseña no válida";
			alert(error);
		}else{
			var error = "";
		}
		return error;
	}

	function seguridadPassword(contrasena){

    		var letters = {};

    		var length = contrasena.length;
    		for(x = 0, length; x < length; x++) {

        		var l = contrasena.charAt(x);

        		letters[l] = (isNaN(letters[l])? 1 : letters[l] + 1);
    		}

    		return Object.keys(letters).length / length;
	}
	

	function colorPassword(){
		var passField = document.getElementById("contrasena");
		var strength = seguridadPassword(passField.value);
		
		if(!isNaN(strength)){
			var type = "weakpass";
			if(passwordValidation()!=""){
				type = "weakpass";
			}else if(strength > 0.7){
				type = "strongpass";
			}else if(strength > 0.4){
				type = "middlepass";
			}
		}else{
			type = "nanpass";
		}
		passField.className = type;
		
		return type;
	}

	function validarNombre(){
		var nombre = document.getElementById("nombre").value;
		var valid = nombre.length>0;
		
		if(!valid){
			var error = "Por favor, introduzca un nombre";
			 alert(error);

		}else{
			var error = "";
	
		}
	       
		return error;
	}
	
	function validarApellidos(){
		var apellidos = document.getElementById("apellidos").value;
		var valid = apellidos.length>0;
		
		if(!valid){

			var error = "Por favor, introduzca apellidos";
			 alert(error);
		}else{
			var error = "";

		}
		return error;
	}
	
	function validarEmail(){
		var email = document.getElementById("email").value;
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var valid = (email.length>0) && (re.test(String(email)));
		
		if(!valid){
			var error = "Por favor, introduzca un email válido";
			alert(error);
		}else{
			var error = "";
		}
	        
		return error;
	}
	
	
	function validarDNI(){
		var dni = document.getElementById("DNI").value;
		var re=/^[0-9]{8}[A-Z]$/;
		var valid =re.test(dni);
		
		if(!valid){
			var error = "Por favor, introduzca un dni correcto";
			alert(error);
		}else{
			var error = "";
		}
	        
		return error;
	}
	
	function validarTlf(){
		var tlf = document.getElementById("NumTel").value;
		var re=/^[0-9]{9}$/;
		var valid =re.test(String(tlf));
		
		if(!valid){
			var error = "Por favor, introduzca un teléfono correcto";
			alert(error);
		}else{
			var error = "";
		}
	        
		return error;
	}
	
	function validarFechaNacimiento(){
		var fechaNac = document.getElementById("fechaNacimiento").value;
		var hoy= new Date();
		var valid = fechaNac<hoy;

		if(!valid){
			var error = "Por favor, introduzca una fecha válida";
		alert(error);
		}else{
			var error = "";
		}
	       
		return error;
	}
	
	function validarOIDUsuario(){
		var usuario = document.getElementById("usuario").value;
		var re=/^[0-9]*$/;
		var valid = (usuario.length>0) && (re.test(String(usuario)));
		
		
		if(!valid){
			var error = "Usuario no válido";
			 alert(error);
		}else{
			var error = "";
		}
	       
		return error;
	}
	
	function validarTitulo(){
		var titulo = document.getElementById("titulo").value;
		var valid = ((titulo.length>0) &&  (titulo.length<=1000));
		
		
		if(!valid){
			var error = "Por favor, introduzca un título válido";
			 alert(error);
		}else{
			var error = "";
		}
	       
		return error;
	}
	
	function validarDescripcion(){
		var descripcion = document.getElementById("descripcion").value;
		var valid = descripcion.length>0 &&  descripcion.length<=4000;
		
		
		if(!valid){
			var error = "Por favor, introduzca una descripción válida";
			 alert(error);
		}else{
			var error = "";
		}
	       
		return error;
	}
	
	function validarOIDInmueble(){
		var inmueble = document.getElementById("inmueble").value;
		var re=/^[0-9]*$/;
		var valid = (inmueble.length>0) && (re.test(String(inmueble)));
		
		
		if(!valid){
			var error = false;
			 alert("Inmueble no válido");
		}else{
			var error = true;
		}
	       
		return error;
	}
	
	function validarOIDHilo(){
		var hilo = document.getElementById("hilo").value;
		var re=/^[0-9]*$/;
		var valid = (hilo.length>0) && (re.test(String(hilo)));
		
		
		
		if(!valid){
			var error = "Hilo no válido";
			 alert(error);
		}else{
			var error = "";
		}
	       
		return error;
	}
	
	function validarRespuestaTexto(){
		var texto = document.getElementById("texto").value;
		var valid = (texto.length>0);
		
		
		if(!valid){
			var error = "Por favor, introduzca una respuesta válida";
			 alert(error);
		}else{
			var error = "";
		}
	       
		return error;
	}