<?php
	session_start();
	
	require_once ("gestionBD.php");
	require_once ("paginacion_consulta.php");
	
	if (isset($_SESSION["inmueble"])) {
		$inmueble = $_SESSION["inmueble"];
		unset($_SESSION["inmueble"]);
	}

	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];

	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	$query = 'SELECT * FROM COMERCIALES';
	
	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$tablas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);

	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Comerciales</title>
		<link href="estilos/estilos.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<header><?php include_once("cabecera.php");?></header>
<h2>Comerciales</h2>
<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="comerciales.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>
		
		<form method="get" action="comerciales.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>
		
<?php
	foreach ($tablas as $tabla) {?>
		<table class="comerciales">
			<tr>
				<td rowspan="4" ><img src="images/comercial<?php echo $tabla["OID_CO"]?>.jpg" style="width: 100%; height: 200px" alt= "<?php echo $tabla["NOMBRE"]?>" title = "<?php echo $tabla["NOMBRE"]?>"/></td>
				<td><b>Nombre:</b> <?php echo $tabla["NOMBRE"]?></td>
			</tr>
			<tr>
				<td><b>Apellido:</b> <?php echo $tabla["APELLIDOS"]?></td>
			</tr>
			<tr>
				<td><b>Correo Electrónico:</b> <?php echo $tabla["CORREO_ELECTRONICO"]?></td>
			</tr>
			<tr>
				<td><b>Teléfono:</b> <?php echo $tabla["TELEFONO"]?></td>
			</tr>
		</table>
		
	<?php } ?>
	<footer><?php include_once("Pie.php");?></footer>
			
		
	</body>
</html>