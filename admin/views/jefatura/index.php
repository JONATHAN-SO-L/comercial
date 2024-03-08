<?php session_start();
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../admin">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;../jefatura">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../vendedor">';
		break;
		
		default:
		
		break;
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_jefatura.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br><br>
		<a href="levantamientos.php" class="btn btn-primary nuevo_lev"><img class="agregar" src="../../../assets/img/agregar.png"> <strong>Nuevo Levantamiento</strong></a>

		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Levantamientos</h1><br>

						<form action="../../../config/functions/levantamiento_csv.php" method="POST">
							<div class="alert alert-success">
								Ingresa el rango de fechas para extraer información en <strong>CSV</strong>
							</div>
							<input type="datetime-local" name="fecha1_csv" required>
							<input type="datetime-local" name="fecha2_csv" required>
							<button class="btn btn-success" name="levantamientos_csv">Levantamientos CSV <img src="../../../assets/img/csv.png" style="border-radius: 15px; height: 35px;"></button>
						</form><br>

						<form action="../../../config/functions/levantamiento_pdf.php" method="POST">
							<div class="alert alert-danger">
								Ingresa el rango de fechas para extraer información en <strong>PDF</strong>
							</div>
							<input type="datetime-local" name="fecha1_pdf" required>
							<input type="datetime-local" name="fecha2_pdf" required>
							<button class="btn btn-danger" name="levantamientos_pdf">Levantamientos PDF <img src="../../../assets/img/pdf.png" style="border-radius: 15px; height: 35px;"></button>
						</form>
					</div>
				</div>
			</div>
		</div><br>

		<?php
		require '../../../config/conex.php';

		//Preparación de consulta
		$data = $con->prepare("SELECT * FROM levantamientos");
		$data->setFetchMode(PDO::FETCH_OBJ);
		$data->execute();

		$show_data = $data->fetchAll();

		if ($data -> rowCount() > 0) {
			echo "<div class='container mt-3 table-responsive'>     
			<table class='table table-striped table-hover table-bordered'>
			<thead class='table-primary'>
			<tr>
			<th>Acción</th>
			<th>Empresa</th>
			<th>Edificio</th>
			<th>Ubicación</th>
			<th>UMA</th>
			<th>Vendedor</th>
			<th>Fecha y Hora de Inicio</th>
			<th>Fecha y Hora de Fin</th>
			</tr>
			</thead>";
			foreach ($show_data as $value) {
				//Búsqueda de empresa en base al ID
				$search_company = $con->prepare("SELECT razon_social FROM empresas, levantamientos WHERE empresas.id = levantamientos.empresa AND levantamientos.empresa = ".$value->empresa."");
				$search_company->setFetchMode(PDO::FETCH_OBJ);
				$search_company->execute();
				$company = $search_company->fetchAll();

				if ($search_company -> rowCount() > 0) {
					foreach ($company as $rel) {
						$rel -> razon_social;
					}
				}

				//Búsqueda de edificio en base al ID de la empresa
				$search_build = $con->prepare("SELECT descripcion FROM edificio, levantamientos WHERE edificio.id_edificio = levantamientos.edificio AND levantamientos.edificio = ".$value->edificio."");
				$search_build->setFetchMode(PDO::FETCH_OBJ);
				$search_build->execute();
				$build = $search_build->fetchAll();

				if ($search_build -> rowCount() > 0) {
					foreach ($build as $edi) {
						$edi -> descripcion;
					}
				}

				//Búsqueda de la ubicación en base al ID del edificio
				$search_location = $con->prepare("SELECT ubicacion.ubicacion FROM ubicacion, levantamientos WHERE ubicacion.id_ubicacion = levantamientos.ubicacion AND levantamientos.ubicacion = ".$value->ubicacion."");
				$search_location->setFetchMode(PDO::FETCH_OBJ);
				$search_location->execute();
				$locate = $search_location->fetchAll();

				if ($search_location -> rowCount() > 0) {
					foreach ($locate as $local) {
						$local -> ubicacion;
					}
				}

				echo 
				"<tbody>
				<tr>
				<th>
				<a href='../../../assets/lib/reports/FV-06-8-010.php?".$value -> uma."' class='btn btn-sm btn-success' target='_blank' title='Ver PDF'><img class='see' src='../../../assets/img/pdf.png'></a>
				<a href='../../../config/permissions/mod/mod_lev.php?".$value -> uma."' class='btn btn-sm btn-warning' title='Editar registro'><img class='edit' src='../../../assets/img/editar.png'></a>
				<!--a href='../../../config/permissions/drop/drop_lev.php?".$value -> uma."' class='btn btn-sm btn-danger' title='Eliminar registro'><img class='edit' src='../../../assets/img/borrar.png'></a-->
				</th>
				<th>".$rel -> razon_social."</th>
				<th>".$edi -> descripcion."</th>
				<th>".$local -> ubicacion."</th>
				<th>".$value -> uma."</th>
				<th>".$value -> vendedor."</th>
				<th>".$value -> fecha_hora_inicio."</th>
				<th>".$value -> fecha_hora_fin."</th>
				</tr>
				</tbody>";
			}
			echo "</table>
			</div>";
		} else {
			echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay levantamientos registrados</h3></strong></center></div>';
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