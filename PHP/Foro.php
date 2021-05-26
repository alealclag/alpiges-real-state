<?php
session_start();

require_once ("gestionBD.php");
require_once ("paginacion_consulta.php");
require_once ("gestionarForo.php");
require_once("gestionarPerfil.php");


	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];

	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	
	$query = 'SELECT * FROM HILOSFORO';

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
		<title>Listado de Hilos del Foro</title>
		 <link href="estilos/estilos.css" rel="stylesheet">
		<script src="js/Validaciones.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<header><?php include_once("Cabecera.php");?></header>
		<h2>Hilos</h2>
		
		<h3><a href="crearHilo.php">Pregunta a la comunidad</a></h3>
		
		<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="Foro.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>
		
		<form method="get" action="Foro.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>
		
		<?php foreach ($tablas as $tabla) {
			$usuario=	informacionUsuarioOID_US($conexion, $tabla["OID_US"]); ?>
			<table class="hilo">		
			<tr>
				<td  colspan="3">
					<h3 style="text-align: left"><?php echo $tabla["TITULO"];?></h3>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: left">
					<?php echo $tabla["DESCRIPCION"];?>
				</td>
			</tr>
			<tr>
				<td>
					 <?php echo $usuario["NOMBRE"]." ". $usuario["APELLIDOS"];?>
				</td>
				<td>
					<?php echo $tabla["FECHA"];?>
				</td>	
			</tr>
		</table>
		
		<form method="get" action="Hilo.php" onsubmit="return validarHilo();">		
			<input id="hilo" name="hilo" type="hidden" value="<?php echo $tabla["OID_HF"]; ?>"/>	
			<input id="usuario" name="usuario" type="hidden" value="<?php echo $tabla["OID_US"]; ?>"/>
			<input style="margin-top: 0px;margin-bottom: 5px" id="submit" name="submit" type="submit" value="Ver Hilo" />
			
		</form>
		
		<?php } ?>
		
		<footer><?php include_once("pie.php");?></footer>
		
				
	</body>
</html>