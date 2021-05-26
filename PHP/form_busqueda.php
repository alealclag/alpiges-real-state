<?php
	session_start();

	if (!isset($_SESSION['formulario'])) {
		$formulario['zona'] = "";
		$formulario['precioMin'] = "";
		$formulario['precioMax'] = "";
		$formulario['metrosMin'] = "";
		$formulario['metrosMax'] = "";
		$formulario['habitacionesMin'] = "";
		$formulario['habitacionesMax'] = "";
		$formulario['bañosMin'] = "";
		$formulario['bañosMax'] = "";
		$formulario['tipoInmueble'] = "";
		$formulario['tipoConstruccion'] = "";
		$formulario['eficienciaEnergetica'] = "";
		$formulario['ascensor'] = "";
		$formulario['garaje'] = "";
		$formulario['wifi'] = "";
		
		$_SESSION['formulario'] = $formulario;
	}
	else{
		$formulario = $_SESSION['formulario'];
	}
	if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
	}
	
?>

<!DOCTYPE html>

<html lang="es">
	
<head>
	<meta charset="utf-8">
	<title>Busqueda</title>
	<link href="estilos/estilos.css" rel="stylesheet">
	<script src="js/Validaciones.js" type="text/javascript"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
	
<header><?php include_once("Cabecera.php");?></header>

<?php 

		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
?>
	
	<div class="columnas">

	<form id="busquedaInmueble" method="get" action="accion_busqueda.php"  onsubmit="return validarBusqueda();" >
	<fieldset>
		<legend><h2>Busqueda</h2> </legend>

			Zona
			<select name="zona" id="zona">
				<option value="cascoAntiguo">Casco Antiguo</option>
				<option value="elValle">El Valle</option>
				<option value="lasMoreras" >Las Moreras</option>
				<option value="laZarzuela">La Zarzuela</option>
				<option value="elBalconDeEcija">El Balcón de Écija</option>
				<option value="laPaz">La Paz</option>
				<option value="laAlmazara">La Almazara</option>
				<option value="laGuita">La Guita</option>
				<option value="lasCasitas">Las casitas</option>
				<option value="elArroyo">El arroyo</option>
				<option value="elMatadero">El Matadero</option>
				<option value="lasHuertas">Las Huertas</option>
				<option value="laMercedSanGil" >La Merced-San Gil</option>
				<option value="elPuente">El puente</option>
				<option value="laAlcarrachela">La Alcarrachela</option>
				<option value="las200Viviendas">Las 200 viviendas</option>
				<option value="losPisosAmarillos">Los pisos amarillos</option>
				<option value="colon-LosEmigrantes">Colón-Los Emigrantes</option>
				<option value="laCerámica">La Cerámica</option>
			</select>
		<br />
		Precio:

		<input name="precioMin" id="precioMin" type="number" value="5000" size="8" maxlength="8" min="5000" max="10000000" pattern="[0-9]"> 
		- 

		<input name="precioMax" id="precioMax" type="number" value="10000000" size="8" maxlength="8" min="5000" max="10000000" pattern="[0-9]"> 
		 
		
		Metros:

		<input name="metrosMin" id="metrosMin" type="number" value="20" size="5" maxlength="5" min="20" max="50000" pattern="[0-9]"> 
		- 
		
		<label for="metrosMax"></label> 
		<input name="metrosMax" id="metrosMax" type="number" value="50000" size="5" maxlength="5" min="20" max="50000" pattern="[0-9]"> 
		<br>
		
		Habitaciones:

		<input name="habitacionesMin" id="habitacionesMin" type="number" value="0" size="2" maxlength="2" min="0" max="10" pattern="[0-9]"> 
		- 
		

		<input name="habitacionesMax" id="habitacionesMax" type="number" value="10" size="2" maxlength="2" min="0" max="10" pattern="[0-9]"> 
	 	<br />
		
		Baños:

		<input name="bañosMin" id="bañosMin" type="number" value="0" size="1" maxlength="1" min="0" max="5" pattern="[0-9]"> 
		- 
		
		
		<input name="bañosMax" id="bañosMax" type="number" value="5" size="1" maxlength="1" min="0" max="5" pattern="[0-9]"> 
		<br />
		
		Tipo Inmueble
		
			<select name="tipoInmueble" id="tipoInmueble">
				<option value="Chalet">Chalet</option>
				<option value="Adosasado">Adosado</option>
				<option value="Local Comercial">Local Comercial</option>
				<option value="Oficina">Oficina</option>
				<option value="Edificio">Edificio</option>
				<option value="Nave Industrial">Nave Industrial</option>
				<option value="Terreno">Terreno</option>
				<option value="Finca Rústica">Finca Rustica</option>
			</select>
		<br />
		
		Tipo Construcción
			<select name="tipoConstruccion" id="tipoConstruccion">
				<option value="Nueva">Nueva</option>
				<option value="Antigua">Antigua</option>
				<option value="Reforma">Reforma</option>
			</select>
		<br />
		
		Eficiencia Energética
			<select name="eficienciaEnergetica" id="eficienciaEnergetica">
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="C">C</option>
				<option value="D">D</option>
				<option value="E">E</option>
				<option value="F">F</option>
			</select>
		<br>
		
		Extras:
		<input name="ascensor" id="ascensor" type="checkbox">Ascensor
		<input name="garaje" id="garaje" type="checkbox">Garaje
		<input name="wifi" id="wifi" type="checkbox">Wifi
		<br>
		
	</fieldset>
	
		<input name="submit" type="submit" value="Buscar" /> <br> <br>
		
	</form>
</div>
<footer style="position: relative; bottom: -400px"><?php include_once("pie.php");?></footer>
	
</body>
</html>