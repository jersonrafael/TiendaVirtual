<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
</head>
<body>
	<div class="container">
		<h2>Crear cuenta</h2>
		<form action="" method="POST" >
			<?php
				include("db.php");
				include("controlador/controlador_registro.php");
			 ?>
			<div class="nombre">
				<p>Nombre: <input type="text" name="nombre" placeholder="Introduce tu nombre"></p>
			</div>

			<div class="apellido">
				<p>Apellido: <input type="text" name="apellido" placeholder="Introduce tu apellido"></p>
			</div>

			<div class="usuario">
				<p>Nombre de usuario: <input type="text" name="usuario" placeholder="Introduce tu nombre de usuario"></p>
			</div>

			<div class="clave">
				<p>Contrase: <input type="password" name="clave" placeholder="Introduce una contraseña"></p>
			</div>

			<input type="text" name="id_cargo" value="2" hidden>

			<input type="submit" name="registro" value="Regisrarse">
		</form>

		<a href="index.php">Ya tengo una cuenta</a>
	</div>
</body>
</html>