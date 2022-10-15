<?php 

    include("../../config/conexion.php");

?>



 <?php

        if (isset($_POST['actualizar'])) {
          // AQUI ES CUANDO YA SE PRECIONO EL BOTON DE ENVIAR

          $nombre=$_POST['nombre'];
          $descripcion=$_POST['descripcion'];
          $precio_rebajado=$_POST['p_rebajado'];
          $cantidad=$_POST['cantidad'];
          $categoria=$_POST['categoria'];

          // ACTUALIZAR PRODUCTOS

          $sql="UPDATE productos SET nombre='".$nombre."', descripcion='".$descripcion."', precio='".$precio."', precio_rebajado='".$precio_rebajado."', cantidad='".$cantidad."', categoria='".$categoria."' ";

          $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                  
                  echo "<script language='JavaScript'> 

                          alert('Los datos se actualizaron Correctamente');

                          location.assing('productos.php');

                        </script>;

          ";

            }else{
              echo "<script language='JavaScript'> 

                      alert('Los datos no actualizaron Correctamente');

                      location.assing('productos.php');

                    </script>;

          ";

            }

        }else{
          // CUANDO AUN NO SE PRECIONA EL BOTON

          $id=$_GET['id'];
          $sql="SELECT * FROM productos WHERE id= '".$id."' ";
          $resultado=mysqli_query($conexion, $sql); 


          $row = mysqli_fetch_assoc($resultado);

          $nombre=$row['nombre'];
          $descripcion=$row['descripcion'];
          $precio_rebajado=$row['precio_rebajado'];
          $cantidad=$row['cantidad'];
          $categoria=$row['id_categoria'];

          mysqli_close($conexion);


        };

        { 
?>

<link rel="stylesheet" type="text/css" href="../assets/css/editar.css">

<div class="container_principal">
  <h2>HOla</h2>
  <form name="formulario" action="<?=$_SERVER['PHP_SELF']?>" method="post">
      <table class="table">
  <thead class="thead-dark">
    <tr>
      <th hidden scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Precio</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Categoria</th>
      <th scope="col">Imagen</th>
    </tr>
  </thead>

  <tbody>
    <tr>

      <td hidden class="id"> 
        <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $id; ?>" required>
      </td>

      <td class="nombre"> 
        <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $nombre; ?>" required>
      </td>

      <td class="Descripcion" >  
        <input id="descripcion" class="form-control" name="descripcion" value="<?php echo $descripcion; ?>" rows="3" required resizable="none"></textarea> 
    </td>

      <td class="Precio_rebaja"> 
        <input id="p_rebajado" class="form-control" type="text" name="p_rebajado" value="<?php echo $precio_rebajado; ?>" required>
      </td>

      <td class="cantidad"> 
        <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $cantidad; ?>" required>
      </td>

      <td class="Categoria"> 
        <label for="categoria">Categoria</label>
        
       <select id="categoria" class="form-control" name="categoria">
          <?php
          $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
          foreach ($categorias as $cat) { ?>
          <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
          <?php } ?>
        </select>
      </td>
      <td>
        <input type="submit" name="actualizar" value="Actualizar" class="btn-submit">
      </td>
    </tr>
  </tbody>
</table>
      
  </form>
</div>


<?php 

} 

?>


