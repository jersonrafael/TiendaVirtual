<?php require_once "config/conexion.php";
require_once "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">SUPLYMAX</a>
            </div>
        </nav>
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Productos</th>
                                    <th>Precio</th>
                                    <!-- <th>Cantidad</th> -->
                                    <!-- <th>Sub Total</th> -->
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <form action="#" class="form-group" id="formulario" name="formulario" method="POST">
                        <label for="">Nombre</label>
                        <input type="text" placeholder="Nombre" class="form-control" id="nombre"  require autocomplete="off"> 
                        <br>
                        <label for="">Apellido</label>
                        <input type="text" placeholder="Apellido" class="form-control" id="apellido"  require autocomplete="off">
                        <br>
                        <label for="">Numero Telefonico</label><input type="number" placeholder="Introduce tu numero por ejemplo 0426-0000-000" class="form-control" id="numero" autocomplete="off">
                        <br>
                        <label for="">Correo Electronico</label><input type="email" placeholder="Introduce tu Correo" class="form-control" id="email" autocomplete="off">
                        <br>
                        <label for="">Direccion completa</label>
                        <input type="text" placeholder="Direccion completa" class="form-control" id="direccion" require autocomplete="off">
                    </form>
                    <br>
                    <div id="hacerParrafo"></div>
                </div>
                <br>   <br>
                <div class="col-md-5 ms-auto">
                    <h4>Total a Pagar: <span id="total_pagar">0.00</span></h4>
                    <div class="d-grid gap-2">
                        <div id="paypal-button-container"></div>
                        <button class="btn btn-success" onclick="generarFactura()" id="generar">Generar Factura</button>
                        <a class="btn btn-danger" href="carrito.php" id="cancelar">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white" id="derechos">Copyright &copy; SUPLYMAX 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&locale=<?php echo LOCALE; ?>"></script>
    <script src="assets/js/scripts.js"></script>
    <script defer>
        mostrarCarrito();

        function mostrarCarrito() {
            if (localStorage.getItem("productos") != null) {
                let array = JSON.parse(localStorage.getItem('productos'));
                if (array.length > 0) {
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        async: true,
                        data: {
                            action: 'buscar',
                            data: array
                        },
                        success: function(response) {
                            console.log(response);
                            const res = JSON.parse(response);
                            let html = '';
                            res.datos.forEach(element => {
                                html += `
                            <tr>
                                <td>${element.nombre}</td>
                                <td>${element.precio}</td>
                            </tr>
                            `;
                            });
                            $('#tblCarrito').html(html);
                            $('#total_pagar').text(res.total + ' $USD');
                            paypal.Buttons({
                                style: {
                                    color: 'blue',
                                    shape: 'pill',
                                    label: 'pay'
                                },
                                createOrder: function(data, actions) {
                                    // This function sets up the details of the transaction, including the amount and line item details.
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: res.total
                                            }
                                        }]
                                    });
                                },
                                onApprove: function(data, actions) {
                                    // This function captures the funds from the transaction.
                                    return actions.order.capture().then(function(details) {
                                        // This function shows a transaction success message to your buyer.
                                        alert('Transaction completed by ' + details.payer.name.given_name);
                                    });
                                }
                            }).render('#paypal-button-container');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        };

        function obtenerDatosProductos(){
            e.preventDefault();
            if(localStorage.getItem("productos")){
                //SI EXISTE EL LOCALSTORANGE
                const obtenerProductos = JSON.parse(localStorage.getItem("productos"))
                console.log(obtenerProductos)
            }else{
                console.log("No hay productos")
            }
        }

        function generarFactura(){
            //SELECCION ELEMENTOS DEL FORMULARIO
            const nombre = document.getElementById('nombre').value.trim() ;
            const apellido = document.getElementById('apellido').value.trim() ;
            const numero = document.getElementById('numero').value.trim() ;
            const direccion = document.getElementById('direccion').value.trim();
            const parrafo = document.getElementById('parrafo');
            
            if(nombre === "" || apellido === "" || cedula === "" || numero === "" || direccion === "" ){

                alert("No dejes los campos vacios");
                
            }else if(numero.length <= 10 || cedula.length >=12 ){
                alert("Revisa tu numero telefonico");
            }else{

                //SELECCION DE BOTONES DEL FORMULARIO
                const cancelar = document.getElementById('cancelar');
                const generar = document.getElementById('generar');

                //CONFIGURACION DE BOTONES LUEGO DE HACER PRINT

                // // CREANDO LOS HTML CON SU TEXTO
                let elementoP = document.createElement("h2");
                //GENERANDO NUMERO AL AZAR PARA LA FACTURA
                let numeroFactura = Math.random();
                let textoP= document.createTextNode("ID de compra: " + numeroFactura);
                // //AGERGAR AL CONTENEDOR EL TEXTO
                elementoP.appendChild(textoP)
                // //AGREGAR LOS ELEMENTOS AL DOM
                hacerParrafo.appendChild(elementoP)

                //FUNCION DE IMPRIMIR
                window.print()
                
            }
            
        }
    </script>
</body>

</html>