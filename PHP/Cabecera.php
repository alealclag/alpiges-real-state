<style type="text/css" media="screen">
	img.cabecera{
 			margin-top: 10px;
 		}

		td.cabecera{
		 	background-color: #009999;
 		}
 
 		a.cabecera{
 			color: #eee;
 		}
 
 		 a.cabeceraPerfil{
		 	color: #009999;
		 }
</style>
	<a href="index.php"><img class="cabecera" src="images/Logo.png" alt="Inmobiliaria Alpigés" width="150" height="150" style="float: left">
		<h1>Inmobiliaria Alpigés</h1></a>
	
	<?php if(isset($_SESSION['login'])){?>
			<b><a class="cabeceraPerfil"href="Perfil.php" style="float: right;margin-right: 10px">Mi Perfil</a><br /></b>
			<b><a class="cabeceraPerfil" href="cerrar_sesion.php" style="float: right;margin: 10px; color: red">Cerrar sesión</a></b>
	<?php }else{?>
			<b><a class="cabeceraPerfil" href="form_login.php" style="float: right;margin-right: 10px">Inicia sesión</a><br /></b>
			<b><a class="cabeceraPerfil" href="Registro.php" style="float: right;margin: 10px; color: #00cc00">¿No estás registrado? Regístrate aquí</a></b>
	<?php }?>
	<h3>¿Quieres casas? Nosotros tenemos.</h3>
	<table style="width: 100%" >
		<tr>
			<td class="cabecera"><b><a class="cabecera" href="form_busqueda.php">Búsqueda</a></b></td>
			<td class="cabecera"><b><a class="cabecera" href="foro.php" >Foro</a></b></td>
			<td class="cabecera"><b><a class="cabecera" href="comerciales.php" >Comerciales</a></b></td>
			<td class="cabecera"><b><a class="cabecera" href="Contacto.php" >Contacto</a></b></td>
		</tr>
	</table>

