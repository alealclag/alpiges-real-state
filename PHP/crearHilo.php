<?php 
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionarPerfil.php");
	
	if(isset($_SESSION["hilo"])){
		$hilo=$_SESSION["hilo"];
	}else{
		$hilo["titulo"]="";
		$hilo["descripcion"]="";
		$hilo["usuario"]="";
		
		$_SESSION["hilo"]=$hilo;
	}
	
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}
	
	$conexion = crearConexionBD();
	$usuario=informacionUsuario($conexion, $_SESSION["login"]);
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Crear Hilo</title>
		<link href="estilos/estilos.css" rel="stylesheet">
		<script src="js/Validaciones.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	</head>
<body>
	<header><?php include_once("Cabecera.php");?></header>
	
<h2>Crear hilo del foro</h2>

	<?php 

		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores :</h4>";
    		foreach($errores as $error){
    			echo $error;
			} 
    		echo "</div>";
  		}
	?>
<?php if (!isset($_SESSION["login"])){
			echo "Debes iniciar sesión para redactar un hilo";
		}else{ ?>
	<p style="margin-left: 10px">Título:<p>
	<form id="crearHilo" action="accion_crear_hilo.php" method="get" onsubmit="return validarCrearHilo();">
  <input type="text" size="100" id="titulo" name="titulo" placeholder="Título del hilo" value="<?php echo $hilo['titulo'] ?>" />  
  <br>
  <p>Descripción:<p>
  <textarea rows="4" cols="50" name="descripcion" id="descripcion" ><?php echo $hilo["descripcion"] ?></textarea>
  <input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario["OID_US"]?>"/>
 
  <input type="submit" name="submit" value="Enviar">
</form> 
<?php } ?>
	<footer style="margin-top: 220px"><?php include_once ("pie.php");?></footer>
	
	<?php
	cerrarConexionBD($conexion);
	?>

</body>
</html>
