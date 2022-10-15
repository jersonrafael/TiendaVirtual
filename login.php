<?php require_once "config/conexion.php"; ?>

<!DOCTYPE html>
<html>
<head>
   	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tienda Suplimax</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilosv2.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>
	<div class="registro">
		<h2>SUPLYMAX</h2>
		
		<form class="row g-3">

  			<div class="col-md-6">
    			<label for="inputEmail4" class="form-label">Email</label>
    			<input type="email" class="form-control" id="inputEmail4">
  			</div>

  			<div class="col-md-6">
    			<label for="inputPassword4" class="form-label">Password</label>
    			<input type="password" class="form-control" id="inputPassword4">
  			</div>

  			<div class="col-12">
    			<label for="inputAddress" class="form-label">Address</label>
    			<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  			</div>

  			<div class="col-12">
    			<label for="inputAddress2" class="form-label">Address 2</label>
    			<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  			</div>

  			<div class="col-md-6">
    			<label for="inputCity" class="form-label">City</label>
    			<input type="text" class="form-control" id="inputCity">
  			</div>

  			<div class="col-md-4">
    			<label for="inputState" class="form-label">State</label>
    				<select id="inputState" class="form-select">
      				<option selected>Choose...</option>
      				<option>...</option>
    			</select>
  			</div>

  			<div class="col-md-2">
    			<label for="inputZip" class="form-label">Zip</label>
    			<input type="text" class="form-control" id="inputZip">
  			</div>

  			<div class="col-12">
    			<div class="form-check">
      				<input class="form-check-input" type="checkbox" id="gridCheck">
      				<label class="form-check-label" for="gridCheck">
        				Check me out
      				</label>
    			</div>
  			</div>

  			<div class="col-12">
    			<button type="submit" class="btn btn-primary">Sign in</button>
  			</div>

		</form>
	</div>

</body>
</html>

<!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>