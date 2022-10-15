<?php

 $usuario=$_POST['usuario'];
 $clave=$_POST['clave'];

 session_start();

 $_SESSION['usuario']=$usuario;

 include('db.php');

 $consulta="SELECT*FROM cliente WHERE usuario='$usuario' and clave='$clave'";

 $resultado=mysqli_query($conexion,$consulta);

 $filas=mysqli_fetch_array($resultado);

 $resultado=mysqli_query($conexion,$consulta);
 $num = mysqli_num_rows($resultado);
  if($num == 0){
    echo '<script>alert("No existe un usuario con eso datos registrate")</script>';
    include("index.php");
    exit();
  }

 if($filas['id_cargo'] == 1) { //ADMINSTRADOR

  echo '<script>alert("Para Verificar que eres administrador ingresa nuevamente tus datos")</script>';
 	header("location:../../admin/productos.php");

}else if($filas['id_cargo'] == 2){ // CLIENTE
  echo '<script>alert("Has ingresado correctamente")</script>';
  header("location:../../index.php");
}
 else{
 	?>

 	<?php

 	?>

 	<h1 class="bad">No existe ningun usuario con esas creedenciales <a href="#">¿Deseas crear una cuenta?</a> </h1>

 	<?php
 }

mysqli_free_result($resultado);

mysqli_close($conexion);
