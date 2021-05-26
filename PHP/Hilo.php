<?php
session_start();

require_once ("gestionBD.php");
require_once ("paginacion_consulta.php");
require_once ("gestionarForo.php");
require_once("gestionarPerfil.php");

	$conexion = crearConexionBD();
	$hilo=consulta_hilo($conexion, $_GET["hilo"]);
	$usuario=	informacionUsuarioOID_US($conexion, $hilo["OID_US"]);

	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];

	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$query="SELECT * FROM RESPUESTAS WHERE OID_HF=". $hilo["OID_HF"];

	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$respuestas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);

	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="utf-8">
		<link href="estilos/estilos.css" rel="stylesheet">
		<script src="js/responder_hilo.js"></script>
		<script src="js/Validaciones.js" type="text/javascript"></script>
		<title>Foro</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	
	<body>
	 <header><?php include_once("Cabecera.php");?></header>
		
	<fieldset style="margin: 10px"> 
		<legend>Pregunta:</legend>
		<table style="width: 99%; margin: 10px" >
			<tr>
				<td  style="text-align: left; width: 75%"><h3><?php echo $hilo["TITULO"];?></h3></td>
				<td><?php echo $usuario["NOMBRE"]." ". $usuario["APELLIDOS"];?></td>
				<td><?php echo $hilo["FECHA"];?></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: left"><?php echo $hilo["DESCRIPCION"]; ?></td>
			</tr>
		</table>
	</fieldset>

	<fieldset style="margin: 10px"> 
		<legend>Respuestas: </legend>
		<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="Hilo.php?PAG_NUM=<?php echo $pagina; ?>&hilo=<?php echo $hilo["OID_HF"]; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>
		
		<form method="get" action="Hilo.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
			<input id="hilo" name="hilo" type="hidden" value="<?php echo $hilo["OID_HF"]; ?>"/>	
			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">
			</form>
			
		<?php foreach($respuestas as $respuesta){
			$usuario=informacionUsuarioOID_US($conexion, $respuesta["OID_US"]);?>

		<table style="margin: 20px;width: 99%" >
			<tr>
				<td  style="text-align: left; width: 75%"><b><?php echo $usuario["NOMBRE"]." ". $usuario["APELLIDOS"];?></b></td>
				<td><?php echo $respuesta["FECHA"];?></td>
			</tr>
			<tr>
				<td colspan="3" style="text-align: left"><?php echo $respuesta["TEXTO"]; ?></td>
			</tr>
		</table>
		<?php } ?>
	</fieldset>
	
	<?php if (!isset($_SESSION["login"])){
			echo "Debes iniciar sesión para redactar una respuesta";
		}else{ ?>
	<button id="boton_respuesta" type="button" value="Responder" style="color: black" onclick="abrir_cuadro_responder()"/>Responder</button>
	<form id="respuesta" action="accion_responder_hilo.php" method="post" style="visibility: hidden" onsubmit="return validarRespuesta();">
		<textarea name="texto" id="texto" name="texto" placeholder="Respuesta" cols="80" rows="4" /></textarea> <br/>
		<input name="submit" type="submit" value="Enviar"/>
		<input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario["OID_US"]?>"/><br/>
		<input type="hidden" name="hilo" id="hilo" value="<?php echo $hilo["OID_HF"]?>"/><br/>		
	</form>	
<?php } ?>	
	<footer style="margin-top: 100px"><?php include_once ("pie.php");?></footer>
	
	</body>
	
	
	
</html>