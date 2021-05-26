<?php
	session_start();
	
	require_once("gestionarInmuebles.php");
	require_once("gestionBD.php");
	require_once ("paginacion_consulta.php");
		
	if(isset($_GET["submit"])){
		$nuevaBusqueda['zona'] = $_GET["zona"];
		$nuevaBusqueda['precioMin'] = $_GET["precioMin"];
		$nuevaBusqueda['precioMax'] = $_GET["precioMax"];
		$nuevaBusqueda['metrosMin'] = $_GET["metrosMin"];
		$nuevaBusqueda['metrosMax'] = $_GET["metrosMax"];
		$nuevaBusqueda['habitacionesMin'] = $_GET["habitacionesMin"];
		$nuevaBusqueda['habitacionesMax'] = $_GET["habitacionesMax"];
		$nuevaBusqueda['bañosMin'] = $_GET["bañosMin"];
		$nuevaBusqueda['bañosMax'] = $_GET["bañosMax"];
		$nuevaBusqueda['tipoInmueble'] = $_GET["tipoInmueble"];
		$nuevaBusqueda['tipoConstruccion'] = $_GET["tipoConstruccion"];
		$nuevaBusqueda['eficienciaEnergetica'] = $_GET["eficienciaEnergetica"];
		if(isset($_GET["ascensor"])){
			$nuevaBusqueda['ascensor'] = 'YES';
		}else{
			$nuevaBusqueda['ascensor']='NO';
		}
		if(isset($_GET["garaje"])){
			$nuevaBusqueda['garaje'] = 'YES';
		}else{
			$nuevaBusqueda['garaje']='NO';
		}
		if(isset($_GET["wifi"])){
			$nuevaBusqueda['wifi'] = 'YES';
		}else{
			$nuevaBusqueda['wifi']='NO';
		}

		unset($_SESSION["errores"]);

	}else{
		Header('Location: form_busqueda.php');
	}
	
	$conexion = crearConexionBD(); 
	
	$zona=$nuevaBusqueda['zona'];
	$eficiencia=$nuevaBusqueda['eficienciaEnergetica'];
	$tipoInm=$nuevaBusqueda['tipoInmueble'];
	$tipoCons=$nuevaBusqueda['tipoConstruccion'];
	$ascensor=$nuevaBusqueda['ascensor'];
	$garaje=$nuevaBusqueda['garaje'];
	$wifi=$nuevaBusqueda['wifi'];
 				
	$query= "SELECT * FROM INMUEBLES WHERE ZONA='$zona' AND PRECIO>=". $nuevaBusqueda['precioMin'] ." AND PRECIO<". $nuevaBusqueda['precioMax'] . 
 				" AND METROS>=". $nuevaBusqueda['metrosMin'] ." AND METROS<=". $nuevaBusqueda['metrosMax'] ." AND HABITACIONES>=". $nuevaBusqueda['habitacionesMin'] .
 				" AND HABITACIONES<=". $nuevaBusqueda['habitacionesMax']." AND BAÑOS>=". $nuevaBusqueda['bañosMin'] ." AND BAÑOS<=". $nuevaBusqueda['bañosMax'] .
 				" AND TIPOINMUEBLE='$tipoInm' AND TIPOCONSTRUCCION='$tipoCons' AND EFICIENCIAENERGETICA='$eficiencia'". 
 				" AND ASCENSOR='$ascensor' AND GARAJE='$garaje' AND WIFI='$wifi'";

	$stmt = $conexion->prepare( $query );
	$stmt->execute();
	$tablas = $stmt;
							
	cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
	
<head>
  <meta charset="utf-8">
   <link href="estilos/estilos.css" rel="stylesheet">
  <title>Inmuebles encontrados</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	
<header><?php include_once("Cabecera.php");?></header>

	<h2>Inmuebles encontrados</h2>
		
	<?php foreach ($tablas as $tabla) { ?>
			<table class="inmueble">
			<tr>
		
					<form method="get" action="Inmueble.php" onsubmit="return validarInmueble();">
						<input id="inmueble" name="inmueble" type="hidden" value="<?php echo $tabla["OID_IN"]; ?>"/>	
						<td colspan="3"><input id="submit" name="submit" style="width: 200px;height: 200px"  type="image" alt="Submit" src="images/<?php echo $tabla["OID_IN"];?>.jpg"/></td>
					</form>
				
			</tr>				
			<tr>
				<td colspan="3" >
					<?php echo $tabla["DIRECCION"];?>
				</td>
			</tr>	
			<tr>
				<td>
					<?php echo $tabla["PRECIO"]?>€
				</td>
				<td>
					 <?php echo $tabla["METROS"]?> m
				</td>
				<td>
					<?php echo $tabla["HABITACIONES"]?> hab.
				</td>	
			</tr>
		</table>
		
		<?php } ?>	

<footer><?php include_once("pie.php");?></footer>
	
</body>
</html>



