<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../gerencia/index.php">';
		break;

		case 'J':
		echo '<meta http-equiv="refresh" content="0;../../jefatura/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../vendedor/index.php">';
		break;
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>

		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/contra.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Cambiar contraseña de usuario</h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Recuerda, debe de tener mínimo 8 carácteres</strong></h6></center></div>
			</div>
			<form method="POST" action="../../../functions/mod/change_pass_user.php?<?php $value -> usuario; ?>" class="border border-danger form-control">
				<label class="form"><strong>Usuario:</strong></label><br>
				<select class="form-control" name="user" required>
					<option value=""> - Selecciona el usuario - </option>
					<?php

					require "../../../config/conex.php";

					$list_user = $con->prepare("SELECT * FROM usuario_lev");
					$list_user->setFetchMode(PDO::FETCH_OBJ);
					$list_user->execute();

					$display_list = $list_user->fetchAll();

					if ($list_user -> rowCount() > 0) {

						foreach ($display_list as $value) {
							echo "<option value=".$value -> usuario.">".$value -> nombre."</option>";
						}

					} else {
						echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay levantamientos registrados</h3></strong></center></div>';
						echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
						exit();
					}
					
					?>
				</select><br>

				<label class="form"><strong>Contraseña Nueva:</strong></label><br>
				<input class="form form-control" type="password" name="new_pass" placeholder="Ingresa la contraseña nueva"  maxlength="100" required="" minlength="8"><br>

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