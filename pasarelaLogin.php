<?php

include 'config.php';
// session_start();
// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:pasarelaLogin.php');
// };

// if(isset($_GET['logout'])){
//    unset($user_id);
//    session_destroy();
//    header('location:pasarelaLogin.php');
// };

if(isset($_POST['add_to_cart'])){

   $message[] = 'Para comprar algun producto inicia sesion';

   // $product_name = $_POST['nombre'];
   // $product_price = $_POST['precio_rebajado'];
   // $product_image = $_POST['imagen'];
   // $product_quantity = $_POST['cantidad'];

   // $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   // if(mysqli_num_rows($select_cart) > 0){
   //    $message[] = 'Este producto ya se encuentra en el carrito';
   // }else{
   //    mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
   //    $message[] = 'Producto Agregado al carrito';
   // }

};

// if(isset($_POST['update_cart'])){
//    $update_quantity = $_POST['cart_quantity'];
//    $update_id = $_POST['cart_id'];
//    mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
//    $message[] = 'Cantidad actualizada correctamente';
// }

// if(isset($_GET['remove'])){
//    $remove_id = $_GET['remove'];
//    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
//    header('location:index.php');
// }
  
// if(isset($_GET['delete_all'])){
//    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
//    header('location:index.php');
// }

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tienda Suplymax</title>

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <!-- ESTILOS DEL BUSCADOR -->
   <link rel="stylesheet" type="text/css" href="assets/css/buscador.css">
   <!-- ESTILOS SLIDER -->
   <link href="assets/css/estilosv2.css" rel="stylesheet" />
   <!-- CDN BOOSTRAP -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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

<div class="user-profile">

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   
  <!--  <p> Correo Electronico : <span><?php //echo $fetch_user['email']; ?></span> </p> -->
   <div class="flex">
      <p> Bienvenido : <span><?php echo $fetch_user['name']; ?></span> </p>
      <a href="login.php" class="btn btn-success">Iniciar Session</a>
      <!-- <a href="register.php" class="option-btn">Registrar otra cuenta</a> -->
      <!-- <a href="index.php?logout=<?php //echo $user_id; ?>" onclick="return confirm('Seguro que deseas cerrar sesion?');" class="delete-btn">Cerrar Session</a> -->

   </div>

</div>
<!-- SLIDER -->

        <div class="slider">
            <ul class="ul_li">
                <li class="li_sli"><img src="assets/img/slider_img/1FB.jpg" id="1" class="img_sli"></li>
                
                <li class="li_sli"><img src="assets/img/slider_img/2FB.jpg" id="2" class="img_sli"></li>
                
                <li class="li_sli"><img src="assets/img/slider_img/3FB.jpg" id="3" class="img_sli"></li>

                <li class="li_sli"><img src="assets/img/slider_img/4FB.jpg" id="4" class="img_sli"></li>
            </ul>
        </div>
<!-- FILTRAR POR CATEGORIAS -->

       <!--  -->

        <ul class="nav justify-content-center">
                
     <?php
                        $query = mysqli_query($conn, "SELECT * FROM categorias");
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                            <a href="#productos" class="nav-link text-info" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
                        <?php } 
                        ?>

                        
        </ul>
    <!--  -->

<!-- PRODUCTOS -->


<div class="products">

   <h1 class="heading">Bienvenido mira todos nuestros productos</h1>
         
         <!-- BUSCADOR DE PRODUCTOS -->
         
         <div class="barraBusqueda">
            <input type="text" name="buscador" id="buscador" placeholder="Buscar.....">
         </div>

         <!-- TODO LOS PRODUCTOS-->

   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `productos`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box articulo" action="">
         <div categoy="<?php echo $fetch_product['categoria']; ?>"></div>
         <img class="card-img-top" src="assets/img/<?php echo $fetch_product['imagen']; ?>" alt="..." style="height: 220px;">
         <div class="name"><?php echo $fetch_product['nombre']; ?></div>
         <div class="price">$<?php echo $fetch_product['precio_rebajado']; ?></div>
         <input type="number" min="1" name="cantidad" value="1">
         <input type="hidden" name="imagen" value="<?php echo $fetch_product['imagen']; ?>">
         <input type="hidden" name=nombre value="<?php echo $fetch_product['nombre']; ?>">
         <input type="hidden" name="precio_rebajado" value="<?php echo $fetch_product['precio_rebajado']; ?>">
         <p><?php echo $fetch_product['descripcion']; ?></p>
         <input type="submit" value="Agregar al carrito" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   };
   ?>

   </div>

</div>

</div>
<script type="text/javascript" src="assets/js/buscador.js"></script>
</body>
</html>