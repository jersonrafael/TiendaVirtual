<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale-1.0">
	<link rel="stylesheet" type="text/css" href="../../css/logiin-admin.css">
	<title>LOGIN</title>
</head>
<body>

<div class="container-flex">

<div class="container-form">
	<form action="validar.php" method="post">
		<h1>Introduce tus credenciales</h1>

		<div class="container-nombre">
			<p>Nombre de usuario<input type="text" name="usuario" placeholder="" autocomplete="off"></p>
		</div>

		<div class="container-clave">
			<p>Clave<input type="text" name="clave" placeholder="" autocomplete="off"></p>
		</div>

		<input type="submit" name="ingresar" class="entrar">
		<br>
		<a href="../../login.php" class="volver">Volver</a>
	</form>

</div>

</div>
<span>Una vez introduzcas tus credenciales se te volvera a pedir que las ingreses para asegurar que seas tu</span>
</body>
</html>