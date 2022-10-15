<?php 

	if (!empty($_POST['registro'])) {
		
		if (empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['usuario']) or empty($_POST['clave']) or is_numeric($_POST['nombre']) or is_numeric($_POST['apellido']) or is_numeric($_POST['usuario']) or  strlen($_POST['clave']< 8)) {
			
			echo '<script>alert("Alguno de los datos esta vacio porfavor verificalo");</script>';

		}else{

			$nombre=$_POST['nombre'];
			$apellido=$_POST['apellido'];
			$usuario=$_POST['usuario'];
			$clave=$_POST['clave'];
			$cargo=$_POST['id_cargo'];

			$validar= "SELECT * FROM cliente WHERE usuario = '$usuario'";

			$validando=$conexion->query($validar);

			if($validando->num_rows > 0){
				echo('<h5>El nombre de usuario ya se encuentra registrado</h5>');

				
			}else{ 

			echo('<script>alert("Registrado con exito")</script>');
			$sql=$conexion->query("INSERT INTO cliente(nombre, apellido, usuario, clave , id_cargo) VALUES ('$nombre', '$apellido', '$usuario', '$clave' , '$cargo' ) ");

			header("location:../../index.php");
		   
		   }

		}
	}


?>