<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'J':
		echo '<meta http-equiv="refresh" content="0;../jefatura/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../vendedor/index.php">';
		break;
	} ?>

	<<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_gerente.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>

		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/jefes.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Jefes Comerciales</h1><br>
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
				<div class="card bg-primary text-white"><center><h6><strong>IMPORTANTE:</strong> Selecciona a un vendedor para asignarlo como Jefe Comercial</h6></center></div>
			</div>

			<form class="border border-primary form-control" method="POST" action="../../../config/functions/add/add_boss_admin.php">

				<div class="switches container" align="center">

					<select class="form-control" name="seller_gang" required>
						<option value=""> - Selecciona al vendedor - </option>
						<?php
						if ($search_seller -> rowCount() > 0) {

							foreach ($found_seller as $value) {
								echo '<option value="'.$value -> usuario.'">'.$value -> nombre.'</option>';
							}

						} else {
							echo "<div class='alert alert-danger'>No hay vendedores disponibles para asignar</div>";
						}
						?>
					</select>
					<br>
					<input type="submit" name="alta_boss" class="btn btn-success" value="Asinar Jefe">

				</div>

			</form>

		</div>

	</body>
	</html>

<?php } else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>