<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {	?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>

		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/contra.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Cambiar contraseña</h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Recuerda, debe de tener mínimo 8 carácteres</strong></h6></center></div>
			</div>
			<form method="POST" action="../../functions/mod/change_pass.php" class="border border-danger form-control">
				<label class="form"><strong>Contraseña Actual:</strong></label><br>
				<input class="form form-control" type="password" name="actual_pass" placeholder="Ingresa tu contraseña actual"  maxlength="100" required="" minlength="8"><br>
				<label class="form"><strong>Contraseña Nueva:</strong></label><br>
				<input class="form form-control" type="password" name="new_pass" placeholder="Ingresa tu contraseña nueva"  maxlength="100" required="" minlength="8"><br>
				<label class="form"><strong>Repetir Contraseña Nueva:</strong></label><br>
				<input class="form form-control" type="password" name="new_pass_repeat" placeholder="Ingresa tu contraseña nueva de nuevo"  maxlength="100" required="" minlength="8"><br>
				<center><input type="submit" class="btn btn-success" name="cambiar_contrasena" value="Cambiar"></center><br>
			</form>
		</div>

	</body>
	</html>

	<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>