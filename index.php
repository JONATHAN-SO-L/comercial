<?php
session_start();

if (isset($_SESSION['tipo'])) {
	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;./admin/views/admin">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;./admin/views/gerencia">';
		break;

		case 'J':
		echo '<meta http-equiv="refresh" content="0;./admin/views/jefatura">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;./admin/views/vendedor">';
		break;
		
		default:
		
		break;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php require './assets/navs/links.php'; ?>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>

	<div class="container"><br><br><br>
		<form method="POST" action="./config/sessions/login.php">
			<center><img class="logo" src="./assets/img/vecoo.png"></center>
			<h3 class="modal-title"><strong><center>Iniciar Sesión | Levantamientos</center></strong></h3><br>
			<label><strong><h5>Usuario:</h5></strong></label>
			<input type="text" name="user" class="form-control" placeholder="Por ejemplo: VECO" required><br>
			<label><strong><h5>Contraseña:</h5></strong></label>
			<input type="password" name="pwd" class="form-control" placeholder="Ingresa la contraseña asignada"><br>
			<center><input type="submit" name="acceder" class="btn btn-success" value="Acceder" required>
			</center>
		</form>
	</div>
</body>
</html>