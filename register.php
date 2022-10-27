<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrate</title>

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->

   <!-- ESTILOS REGISTRO  -->
   <link rel="stylesheet" type="text/css" href="css/registro.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<div class="container">
 
<div class="form-container">
         
         <h2><a href="pasarela.php">SUPLYMAX</a></h2>
   <form action="" method="post">

      <h3>Crear cuenta</h3>
      
      <div class="contenedor-nombre">
         <span>Tu nombre</span>
         <input type="text" name="name" required placeholder="" class="box" autocomplete="off">
      </div>

     <div class="contenedor-correo">
         <span>Correo Electronico</span>
         <input type="email" name="email" required placeholder="" class="box" autocomplete="off">
     </div>

      <div class="contenedor-clave">
         <span>Contraseña</span>
         <input type="password" name="password" required placeholder="" class="box" autocomplete="off">
         <br>
         <span>Vuelve a escribir la contraseña</span>
         <input type="password" name="cpassword" required placeholder="" class="box" autocomplete="off">
      </div>

      <input type="submit" name="submit" class="btn" value="Registrate">

      <div class="footer-card">
         <p class="cuenta-existente">¿Ya tienes una cuenta?<a class="login-link" href="login.php">Iniciar sesión</a></p>
      </div>
      
   </form>

</div>

</div>

</body>
</html>