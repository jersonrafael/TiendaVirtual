<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale-1.0">
	<title>LOGIN</title>
</head>
<body>
	<form action="validar.php" method="post">
		<h1>Por favor Introduce tus datos</h1>

		<p>Nombre de usuario  <input type="text" name="usuario" placeholder="Introdusca su nombre de usuario"></p>
		<p>Contrase;a  <input type="text" name="clave" placeholder="Introdusca su contrase;a"></p>
		<input type="submit" name="ingresar">
	</form>
	<a href="registro_usuario.php">Aun no tienes cuenta?</a>
</body>
</html>