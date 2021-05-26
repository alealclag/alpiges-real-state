<?php
session_start();

require_once ("gestionBD.php");
require_once ("paginacion_consulta.php");
require_once ("gestionarPerfil.php");
require_once ("gestion_listas.php");
	
	if (!isset($_SESSION["login"])) {
		header("Location: form_login.php");
	}else{

	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];

	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	$usuario=informacionUsuario($conexion, $_SESSION["login"]); 
	$query = 'SELECT * FROM ESTAENLISTAFAV WHERE OID_US='. $usuario["OID_US"];

	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$tablas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);

	
	}	
	

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link href="estilos/estilos.css" rel="stylesheet">
		<title>Lista de Favoritos</title>	
		<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
<body>
	
	<script>
		$(document).ready(function() {
			$("#eliminar").on("click", function() {
  				if(confirm("¿Está seguro de que desea borrarlo?")){
                	return true;
                }else{
                	return false;
                }
			});
		});
	</script>
	
		<header><?php include_once("Cabecera.php");?></header>

		<h2>Tu Lista de Favoritos</h2>
		
		<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
					if ( $pagina == $pagina_seleccionada) { 	?>
						<span class="current"><?php echo $pagina; ?></span>
			<?php }	else { ?>
						<a href="Favoritos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"> <?php echo $pagina; ?></a>
			<?php } ?>
		
		<form method="get" action="Favoritos.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>
		
		<?php foreach ($tablas as $tabla) {
			$inmueble=informacionInmueble($conexion, $tabla["OID_IN"]);
			?>
			<table class="inmueble">
			<tr>
				
					<form method="get" action="Inmueble.php" onsubmit="return validarInmueble();"> 
						<input id="inmueble" name="inmueble" type="hidden" value="<?php echo $inmueble["OID_IN"]; ?>"/>	
						<td colspan="3"><input id="submit" class="inmueble" name="submit"   type="image" alt="Submit" src="images/<?php echo $inmueble["OID_IN"]; ?>.jpg"/></td>
					</form>
					
			</tr>				
			<tr>
				<td colspan="3" >
					<?php echo $inmueble["DIRECCION"];?>
				</td>
			</tr>	
			<tr>
				<td>
					<?php echo $inmueble["PRECIO"];?>€
				</td>
				<td>
					 <?php echo $inmueble["METROS"];?> m
				</td>
				<td>
					<?php echo $inmueble["HABITACIONES"];?> hab.
				</td>	
			</tr>
		</table>

		<form method="post" action="accion_eliminar_favoritos.php" style="display: inline" onsubmit="return validarOIDInmueble">
			<input id="OID_IN" name="OID_IN" type="hidden" value="<?php echo $inmueble["OID_IN"]; ?>"/>
			<button id="eliminar" name="eliminar" type="submit" style="margin-right: 50px; border-radius: 100px" >
					<img src="images/eliminar.png" alt= "eliminar" title = "eliminar" width="50px"/>
			</button>
		</form>

		
		<?php } cerrarConexionBD($conexion);?>
		<footer style="position: relative;bottom: -100px"><?php include_once("pie.php");?></footer>
		
			
	</body>
</html>