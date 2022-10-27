<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:pasarela.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:pasarela.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['nombre'];
   $product_price = $_POST['precio_rebajado'];
   $product_image = $_POST['imagen'];
   $product_quantity = $_POST['cantidad'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = '<script>alert("Este producto ya se encuentra en el carrito!")</script>';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = '<script>alert("Producto agregado al carrito")</script>';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = '<script>alert("Cantidad actualizada correctamente!")</script>';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SUPLYMAX</title>

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="css/style.css"> -->

   <!-- ESTILOS MIOS -->

   <link rel="stylesheet" type="text/css" href="css/productos.css">
   <!-- ESTILO DEL BUSCADOR -->
   <link href="assets/css/buscador.css" rel="stylesheet" type="text/css">

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

<div class="contenedor-header">

<div class="user-profile">

   <h2>SUPLYMAX</h2>

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <!-- <p> email : <span><?php //echo $fetch_user['email']; ?></span> </p> -->


   <div class="acciones-usuario">
      <!-- <a href="login.php" class="btn">login</a>
      <a href="register.php" class="option-btn">register</a> -->
      <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Deseas cerrar sesion?');" class="delete-btn">Cerrar Sesion</a>
   </div>

   <button class="btn-carrito verCarrito"><img src="assets/icons/carticon.png" style="width: 1.5rem; height: 1.5rem;"> Ver Carrito</button>
   <a href="categorias.php" class="categorias" hidden>Ver las categorias</a>

     <p><b>Hola </b><span><?php echo $fetch_user['name']; ?></span> </p>


</div>

</div>

   <!-- SLIDER-->

    <header>

        <div class="slider">
            <ul class="ul_li">
                <li class="li_sli"><img src="assets/img/slider_img/1FB.jpg" id="1" class="img_sli"></li>
                
                <li class="li_sli"><img src="assets/img/slider_img/2FB.jpg" id="2" class="img_sli"></li>
                
                <li class="li_sli"><img src="assets/img/slider_img/3FB.jpg" id="3" class="img_sli"></li>

                <li class="li_sli"><img src="assets/img/slider_img/4FB.jpg" id="4" class="img_sli"></li>
            </ul>
        </div>
    </header>

   <!--  -->

<!-- TODOS LOS PRODUCTOS -->

<div class="products">

   <h1 class="heading">Productos</h1>

   <!-- BUSQUEDA DE PRODUCTOS -->

      <div class="barraBusqueda">
            <input id="buscador" name="buscador" placeholder="Buscar....." type="text" autocomplete="off">
            </input>
      </div>

   <!-- CARTA PRODUCTOS -->

   <div class="box-container">


   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `productos`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box articulo" action="" >
         <div class="imagenContainer">
         <img alt="..." class="" src="assets/img/<?php echo $fetch_product['imagen']; ?>">
         </div>

         <div class="info-producto">
            <div class="name"><?php echo $fetch_product['nombre']; ?></div>
            <div class="price">$<?php echo $fetch_product['precio_rebajado']; ?></div>
            <input class="cantidad" type="number" min="1" name="cantidad" value="1" autocomplete="off">
            <input type="hidden" name="imagen" value="<?php echo $fetch_product['imagen']; ?>">
            <input type="hidden" name="nombre" value="<?php echo $fetch_product['nombre']; ?>">
            <input type="hidden" name="precio_rebajado" value="<?php echo $fetch_product['precio_rebajado']; ?>">
            <input type="submit" value="Agregar al carrito" name="add_to_cart" class="btn-agregar">
         </div>

      </form>
   <?php
      };
   };
   ?>

   </div>

</div>

<!-- CARRITO DE COMPRAS -->

<div class="modal">

<div class="modalContainer">

<div class="shopping-cart">

   <h1 class="heading">Carrito de compras</h1>

   <table>
      <thead>
         <th>Imagen</th>
         <th>Nombre</th>
         <th>Precio</th>
         <th>Cantidad</th>
         <th>Precio Total</th>
         <th>#</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img alt="..." class="image" src="assets/img/<?php echo $fetch_cart['image']; ?>" height="100"></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo $fetch_cart['price']; ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input class="cantidad-carrito" type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="cambiar" class="option-btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Eliminar elemento del Carrito?');">Quitar del carrito</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">Tu carrito se encuentra vacio</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Total de la compra :</td>
         <td>$<?php echo $grand_total; ?></td>
         <td><a href="index.php?delete_all" onclick="return confirm('Deseas Vaciar el Carrito?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Limpiar el carrito</a></td>
      </tr>
   </tbody>
   </table>

   <div class="cart-btn"> 
      <a href="#" class="cerrar">Cerrar y seguir comprando</a> 
      <a href="reporteFactura.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Completar pago</a>
   </div>

</div>

</div>
</div>
</div>
   <!-- SCRIPT DEL BUSCADOR -->

   <script src="assets/js/buscador1.js"></script>

   <!-- SCRIPT MODAL -->

   <script src="assets/js/modal.js"></script>
</body>
</html>