<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../admin/index.php">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;../gerencia/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../vendedor/index.php">';
		break;
	} ?>

	<<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_jefatura.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br><br>

		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/cuadrilla.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Mi cuadrilla</h1><br>
					</div>
				</div>
			</div>
		</div><br>

		<?php

		require '../../../config/conex.php';

		$search_seller = $con->prepare("SELECT nombre, usuario, area, tipo_usuario, squad FROM usuario_lev WHERE tipo_usuario = 'V' AND area = 'Ventas' AND squad = '' ORDER BY nombre ASC");
		$search_seller->setFetchMode(PDO::FETCH_OBJ);
		$search_seller->execute();

		$found_seller = $search_seller->fetchAll();

		?>

		<div class="container">
			<div class="card">
				<div class="card bg-primary text-white"><center><h6><strong>IMPORTANTE:</strong> Selecciona a un vendedor que aún no pertenezca a ninguna cuadrilla</h6></center></div>
			</div>

			<form class="border border-primary form-control" method="POST" action="../../../config/functions/add/add_squad.php">

				<div class="switches container" align="center">

					<select class="form-control" name="seller_gang" required>
						<option value=""> - Selecciona al integrante - </option>
						<?php
						if ($search_seller -> rowCount() > 0) {

							foreach ($found_seller as $value) {
								echo '<option value="'.$value -> usuario.'">'.$value -> nombre.'</option>';
							}

						} else {
							echo "<div class='alert alert-danger'>No hay usuarios sin cuadrillas</div>";
						}
						?>
					</select>
					<br>
					<input type="submit" name="alta_squad" class="btn btn-success" value="Agregar Integrante">

				</div>

			</form>

		</div>

	</body>
	</html>

<?php } else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>