<?php
require_once "../config/conexion.php";

if (isset($_POST)) {
    if (!empty($_POST)) {
        if (empty($_POST['nombre']) or empty($_POST['cantidad']) or empty($_POST['descripcion'])) {

           echo '
           <script>

           alert("Por favor no dejes ningun campo vacio");

           </script>';

       }elseif(is_numeric($_POST['nombre'])){

             echo '
           <script>

           alert("Por favor no coloques Numeros o algun caracter raro en el campo de nombre");

           </script>';
       }else{

        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
       
        $p_rebajado = $_POST['p_rebajado'];
        $categoria = $_POST['categoria'];
        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../assets/img/" . $foto;
        $query = mysqli_query($conexion, "INSERT INTO productos(nombre, descripcion,precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre', '$descripcion', '$p_rebajado', $cantidad, '$foto', $categoria)");
        if ($query) {
            if (move_uploaded_file($tmpname, $destino)) {
                header('Location: productos.php');
            }
        }
       }
    }
}
include("includes/header.php"); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm bg-gradient-warning" id="abrirProducto"><i class="fas fa-plus fa-sm text-white-50"></i>Nuevo</a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripci??n</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Categoria</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><img class="img-thumbnail" src="../assets/img/<?php echo $data['imagen']; ?>" width="50"></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['descripcion']; ?></td>
                            <td><?php echo $data['precio_rebajado']; ?></td>
                            <td><?php echo $data['cantidad']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td class="row">

                                <form method="post" action="eliminar.php?accion=pro&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>

                                <?php echo "<a href='../admin_control/editar/editar.php?id=".$data['id']."' class='btn btn-success'>EDITAR</a>"; ?>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
           <a class="d-flex justify-content-center btn btn-lg btn-primary shadow-sm bg-gradient-success" href="../reporte.php">Generar factura de productos</a>
    </div>
</div>
<div id="productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control nombre_modal" type="text" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion">Descripci??n</label>
                                <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripci??n" rows="3"></textarea>
                            </div>
                        </div>
                      <!--   <div class="col-md-6">
                            <div class="form-group">
                                <label for="p_normal">Precio Rebajado (Si no posee precio de rebaja coloca 0)</label>
                                <input id="p_normal" class="form-control" type="text" name="p_normal" placeholder="Precio Normal" required>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="p_rebajado">Precio</label>
                                <input id="p_rebajado" class="form-control" type="number" name="p_rebajado" placeholder="Precio">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select id="categoria" class="form-control" name="categoria">
                                    <?php
                                    $categorias = mysqli_query($conexion, "SELECT * FROM categorias");
                                    foreach ($categorias as $cat) { ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imagen">Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="error" class="form-group">
                                
                            </div>
                        </div>
                    </div>
                    <button id="" class="btn btn-primary bg-gradient-warning" type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>