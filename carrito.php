<?php
include 'config.php';
?>
<!-- CARRITO DE COMPRAS -->
<div class="shopping-cart">
    <div class="">
        <h1 class="heading">
            Carrito de compras
        </h1>
    </div>
    <div class="">
        <table>
            <thead>
                <th>
                    Imagen
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Precio
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    Precio Total
                </th>
                <th>
                    #
                </th>
            </thead>
            <tbody>
                <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) >
                0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
                <tr>
                    <td>
                        <img alt="..." class="card-img-top" src="assets/img/<?php echo $fetch_cart['image']; ?>" style="height: 220px;"/>
                    </td>
                    <td>
                        <?php echo $fetch_cart['name']; ?>
                    </td>
                    <td>
                        $
                        <?php echo $fetch_cart['price']; ?>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input name="cart_id" type="hidden" value="<?php echo $fetch_cart['cart_id']; ?>">
                                <input min="1" name="cart_quantity" type="number" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input class="option-btn" name="update_cart" type="submit" value="actualizar">
                                    </input>
                                </input>
                            </input>
                        </form>
                    </td>
                    <td>
                        $
                        <?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>
                    </td>
                    <td>
                        <a class="delete-btn" href="index.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Eliminar Producto del Carrito?');">
                            Eliminar
                        </a>
                    </td>
                </tr>
                <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr>
                <td colspan="6" style="padding:20px; text-transform:capitalize;">
                    no item added
                </td>
            </tbody>
        </table>
    </div>
</div>
';
         }
      ?>
<tr class="table-bottom">
    <td colspan="4">
        Total de la compra :
    </td>
    <td>
        $
        <?php echo $grand_total; ?>
    </td>
    <td>
        <a class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" href="index.php?delete_all" onclick="return confirm('Seguro que Desea Limpiar el Carrito?');">
            Limpiar
        </a>
    </td>
</tr>
<div class="modal-footer">
    <div class="cart-btn">
        <a class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" href="#">
            Completar Pago
        </a>
    </div>
</div>