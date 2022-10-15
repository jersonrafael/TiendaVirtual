<?php 

    include("../../../config/conexion.php");
    $id = $_GET["id"];
    $productos = "SELECT * FROM productos WHERE id = '$id'"

?>



 <?php

            $resultado = mysqli_query($conexion,$productos);
            while ($row=mysqli_fetch_assoc($resultado)) { ?>


<div>
    <form>
        <table>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Precio de rebaja</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>

            <tbody>

             <tr>       
                <td>
                    <td class="nombre">
                        <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $row["nombre"]; ?>" required>
                    </td>
                </td>

                 <td>
                    <td class="Descripcion">
                        <input id="descripcion" class="form-control" name="descripcion" value="<?php echo $row["descripcion"];?>" rows="3" required resizable="none">
                    </td>
                </td>

                 <td>
                    <td class="Precio_rebaja">
                        <input id="p_rebajado" class="form-control" type="text" name="p_rebajado" placeholder="<?php echo $row["precio_rebajado"]; ?>" required>
                    </td>
                </td>

                <td>
                    <td class="cantidad">
                        <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="<?php echo $row["cantidad"]; ?>" required>
                    </td>
                </td>

                 <td>
                    <td class="Categoria"> 
                        <label for="categoria">Categoria</label>
        
                        <select id="categoria" class="form-control" name="categoria" required>
                            
                        <option value="<?php echo $row["id_categoria"]; ?>"><?php echo $cat['categoria']; ?></option>
                             
                         </select>
                    </td>
                </td>
                
                <td class="Imagen"> 
                    <img class="img-thumbnail" src="../assets/img/<?php echo $row['imagen']; ?>" width="50">
                </td>

                </tr>
                
            </tbody>
        </table>

    </form>
</div>

