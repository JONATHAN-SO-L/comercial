<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/index.php">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
		break;
	}

	$edificio_id = $_SERVER['QUERY_STRING'];
	$squad = $_SESSION['nombre'];

	require '../../conex.php';

	$building_search = $con->prepare("SELECT * FROM edificio WHERE id_edificio = :edificio_id");
	$building_search->bindValue(':edificio_id', $edificio_id);
	$building_search->setFetchMode(PDO::FETCH_OBJ);
	$building_search->execute();

	$building_found = $building_search->fetchAll();

	if ($building_search -> rowCount() > 0) {
		foreach ($building_found as $edi) {

			$edificio = $edi->descripcion;

		}
	} else {
		echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
		exit();
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
			<img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Reasignar Empresa: <strong><?php echo $edificio; ?></strong></h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Para poder reasignar un edificio existente debes de seleccionar el vendedor de tu cuadrilla a quien deseas asignarlo</strong></h6></center></div>
			</div>

			<form method="POST" action="../../functions/mod/reasign_building.php?<?php echo $edificio_id;?>" class="border border-danger form-control"><br>
				
				<select class="form-control" name="new_seller" required>
					<option value=""> - Selecciona el nuevo vendedor a asignar - </option>
					<?php

					$s_seller = $con->prepare("SELECT nombre, usuario FROM usuario_lev WHERE squad = :squad");
					$s_seller->bindValue(':squad', $squad);
					$s_seller->setFetchMode(PDO::FETCH_OBJ);
					$s_seller->execute();

					$f_seller = $s_seller->fetchAll();

					if ($s_seller -> rowCount() > 0) {
						foreach ($f_seller as $value) {
							echo '<option value="'.$value -> usuario.'">'.$value -> nombre.'</option>';
						}
					} else {
						echo "<div class='alert alert-danger'>No hay vendedores para asignar</div>";
					}

					?>
				</select><br>

				<center><input type="submit" class="btn btn-success" name="actualizar_edificio" value="Reasignar"></center><br>
			</form><br>

		</div>
	</body>
	</html>

	<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>