<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = '<script>alert("DATOS")</script>';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->

   <!-- ESTILOS LOGIN -->

   <link rel="stylesheet" type="text/css" href="css/logiin.css">

</head>
<body>

<div class="container">
   
<div class="form-container">

   <h2><a href="pasarela.php">SUPLYMAX</a></h2>

   <form action="" method="post">
      <h3>Iniciar sesión</h3>

      <div class="contenedor-correo">
          <label>Direccion de correo electronico</label>
          <input type="email" name="email" required placeholder="" class="box correo" autocomplete="off">
      </div>
      <div class="contenedor-clave">
         <label>Contraseña</label>
         <input type="password" name="password" required placeholder="" class="box clave" autocomplete="off">
      </div>
      <input type="submit" name="submit" class="btn" value="Continuar">
   </form>
   <p class="texto-registro">¿Eres nuevo en Suplymax?
      <a href="register.php" class="btn-registro">Registrate</a>

       <p class="texto-registro admin">¿Eres otro tipo de usuario?
      <a href="admin_control/login/index.php" class="btn-registro btn-admin">Iniciar sesión</a>
   </p>
</div>

</div>


<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

</body>
</html>