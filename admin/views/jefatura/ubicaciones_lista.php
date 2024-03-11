<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { ?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_jefatura.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br><br><br>
		<a href="ubicacion.php" class="btn btn-primary nuevo_lev"><img class="agregar" src="../../../assets/img/agregar.png"> <strong>Nueva ubicación</strong></a>

		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/edificio.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Ubicaciones de mi cuadrilla</h1>
					</div>
				</div>
			</div>
		</div><br>

		<!--------------------------------
		Búsqueda de levantamientos
		--------------------------------->

		<!------------------------------
		Tabla de datos | Dashboard
		------------------------------->
		<?php 
		require '../../../config/conex.php';

		$vendedor = $_SESSION['nombre'];

		//Preparación de consulta
		$data = $con->prepare("SELECT * FROM ubicacion ORDER BY empresa_id ASC");
		$data->setFetchMode(PDO::FETCH_OBJ);
		$data->execute();

		$show_data = $data->fetchAll();

		if ($data -> rowCount() > 0) {
			echo "<div class='container table-responsive'>     
			<table class='table table-striped table-hover table-bordered'>
			<thead class='table-primary'>
			<tr>
			<th>Acción</th>
			<th>Razón Social</th>
			<th>Edificio</th>
			<th>Ubicación</th>
			<th>Requisitos de Acceso</th>
			<th>Vendedor que registró</th>
			</tr>
			</thead>";
			foreach ($show_data as $value) {
				// Búsqueda de razón social de la ubicación
				$locate = $con->prepare("SELECT razon_social FROM empresas, ubicacion WHERE empresas.id = ubicacion.empresa_id AND ubicacion.id_ubicacion = ".$value->id_ubicacion."");
				$locate->setFetchMode(PDO::FETCH_OBJ);
				$locate->execute();
				$locate_data = $locate->fetchAll();

				if ($locate -> rowCount() > 0) {
					foreach ($locate_data as $rs) {
						$rs -> razon_social;
					}
				}

				// Búsqueda de descripción del edificio
				$build = $con->prepare("SELECT descripcion FROM edificio, ubicacion WHERE edificio.id_edificio = ubicacion.edificio_id AND ubicacion.edificio_id = ".$value->edificio_id."");
				$build->setFetchMode(PDO::FETCH_OBJ);
				$build->execute();
				$build_data = $build->fetchAll();

				if ($build -> rowCount() > 0) {
					foreach ($build_data as $edi) {
						$edi -> descripcion;
					}
				}

				echo 
				"<tbody>
				<tr>
				<th><a href='../../../config/permissions/mod/mod_ubicacion.php?".$value->id_ubicacion."' class='btn btn-sm btn-warning' title='Editar registro'><img class='edit' src='../../../assets/img/editar.png'></a></td>
				<th>".$rs -> razon_social."</th>
				<th>".$edi -> descripcion."</th>
				<th>".$value -> ubicacion."</th>
				<th>".$value -> requisitos_acc."</th>
				<th>".$value -> vendedor."</th>
				</tr>
				</tbody>";
			}
			echo "</table>
			</div>";
		} else {
			echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay ubicaciones registradas</h3></strong></center></div>';
			echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
			exit();
		} ?>

	</body>
	</html>

	<?php include '../../../assets/subir.php'; 
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>