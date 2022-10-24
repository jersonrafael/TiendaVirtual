<?php
    include("../../config/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../boostrap/css/estilos.css">
    <link rel="stylesheet" href="../boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="../boostrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<?php 

    if (isset($_POST['actualizar'])) {
        //CUANDO LE DE CLICK EN ACTUALIZAR
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $cantidad=$_POST['cantidad'];
        $descripcion=$_POST['descripcion'];
        $precio_rebajado=$_POST['precio_rebajado'];


        //HACER EL UPDATE
        $sql = "UPDATE productos SET nombre='".$nombre."', cantidad='".$cantidad."', descripcion='".$descripcion."', precio_rebajado='".$precio_rebajado."' WHERE id='".$id."' ";

        $resultado =mysqli_query($conexion, $sql);

        if($resultado){
            echo "<script language='JavaScript'>alert('Actualizacion Correcta');location.assign('../../admin/productos.php');</script>";
            ;
            
        }else{
            echo "<script language='JavaScript'>alert('Error'); location.assign('index.php');</script>";
            
        }

        mysqli_close($conexion);
    }else{
        //SI NO SE HA REALIZADO CLICK EN ACTUALIZAR
        $id=$_GET['id'];
        $sql="SELECT * FROM productos WHERE id='".$id."'";
        $resultado = mysqli_query($conexion,$sql);

        $fila=mysqli_fetch_assoc($resultado);

        $nombre=$fila["nombre"];
        $cantidad=$fila["cantidad"];
        $descripcion=$fila["descripcion"];
        $precio_rebajado=$fila["precio_rebajado"];

        mysqli_close($conexion);

?>
<body>
<div class="container_principal">
  <form name="formulario" action="<?=$_SERVER['PHP_SELF']?>" method="post" class="form-group">
      <table class="table">
            <tr>
                <td hidden scope="col">id</td>
                <td scope="col">Nombre</td>
                <td scope="col">Descripcion</td>
                <td scope="col">Precio</td>
                <td scope="col">Cantidad</td>
            </tr>
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
                    <input id="p_rebajado" class="form-control" type="text" name="precio_rebajado" value="<?php echo $precio_rebajado; ?>" required>
                </td>

                <td class="cantidad"> 
                    <input id="cantidad" class="form-control" type="number" name="cantidad" value="<?php echo $cantidad; ?>" required>
                </td>

        </td>
    </tr>
 </table>
 <input type="submit" value="actualizar" name="actualizar" class="col px-md-5 btn btn-warning">
</form>
</div>
<?php
  }
?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <script>
</body>
</html>


