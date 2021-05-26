<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionar_comercial.php");
require_once("gestionarInmuebles.php");
require_once("gestion_listas.php");
require_once("gestionarPerfil.php");

	$conexion = crearConexionBD();
	
	$inmueble=consulta_inmueble($conexion, $_GET["inmueble"]);
	
	if(isset($_SESSION["login"])){
		$usuario=	informacionUsuario($conexion, $_SESSION["login"]);
		$excepcion = anadir_historial($conexion,$inmueble["OID_IN"],$usuario["OID_US"]);
	}
	
	$comercial=eleccionComercial($conexion, $inmueble["OID_COMERCIAL"]);

	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link href="estilos/estilos.css" rel="stylesheet">
		<title>Inmueble</title>		
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>

	<body>
		<header><?php include_once("cabecera.php");?></header>
		 
		 
		 
		<fieldset style="width: 50%;display: inline-block">
			<legend> <h2> <?php echo $inmueble["DIRECCION"];?> </h2></legend>
			
			<form method="post" action="accion_anadir_favoritos.php" onsubmit="return validarOIDInmueble();" style="float: right">
				<input id="inmueble" name="inmueble" type="hidden" value="<?php echo $_GET["inmueble"]; ?>"/>
				<button id="fav" name="fav" type="submit" style="float: left;border-radius: 30px">
						<img src="images/fav.png" alt= "fav" title = "fav" width="50px"/>
				</button>
			</form>

			<form method="post" action="accion_anadir_seguimiento.php"  style="float: right">
				<input id="inmueble" name="inmueble" type="hidden" value="<?php echo $_GET["inmueble"]; ?>"/>
				<button id="seg" name="seg" type="submit" style="border-radius: 30px">
						<img src="images/seg.png" alt= "seg" title = "seg" width="50px"/>
				</button>
			 </form>	

				<img src="images/<?php echo $inmueble["OID_IN"]; ?>.jpg" alt="inmueble" class="izquierda" width="60%" /> 

			  	<p><b>Precio:</b> <?php echo $inmueble["PRECIO"];?> €</p>
				<p><b>Nº de Habitaciones:</b> <?php echo $inmueble["HABITACIONES"];?></p>

				
			
				<p><b>Superficie:</b> <?php echo $inmueble["METROS"];?> m2</p>
				<p><b>Nº de Baños:</b> <?php echo $inmueble["BAÑOS"];?></p>
				
				
				<p><b>Tipo de Inmueble:</b> <?php echo $inmueble["TIPOINMUEBLE"];?></p>
				<p><b>Tipo de Construcción:</b> <?php echo $inmueble["TIPOCONSTRUCCION"];?></p>
				<p><b>Eficiencia Energética:</b> <?php echo $inmueble["EFICIENCIAENERGETICA"];?></p>
				
				<p><b>Ascensor:</b> <?php echo $inmueble["ASCENSOR"];?></p>
				<p><b>Garaje:</b> <?php echo $inmueble["GARAJE"];?></p>
				<p><b>Wifi:</b> <?php echo $inmueble["WIFI"];?></p>
			

		</fieldset>
		
		<fieldset style="width: 20%; display: inline-block; margin-left: 20%; float: right; margin-right: 10px">	
			<legend> <h2> Comercial </h2></legend>		
					<h2><img src="images/comercial<?php echo $comercial["OID_CO"]?>.jpg" width="100%"/></h2>
					<p><b>Nombre:</b> <?php echo $comercial["NOMBRE"]?></p>
					<p><b>Apellidos:</b><?php echo $comercial["APELLIDOS"]?></p>
					<p><b>Correo Electrónico:</b> <?php echo $comercial["CORREO_ELECTRONICO"]?></p>
					<p><b>Teléfono:</b> <?php echo $comercial["TELEFONO"]?></p>																
		</fieldset>
		
		

		<footer style="display: block"><?php include_once("pie.php");?></footer>
	</body>
</html>	