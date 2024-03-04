<?php session_start(); 
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_vendedor.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>
		<a href="levantamiento.php" class="btn btn-primary nuevo_lev"><img class="agregar" src="../../../assets/img/agregar.png"> <strong>Nuevo Levantamiento</strong></a>

		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Levantamientos</h1>
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
		$data = $con->prepare("SELECT * FROM levantamientos WHERE vendedor = :vendedor");
		$data->bindValue(':vendedor', $vendedor);
		$data->setFetchMode(PDO::FETCH_OBJ);
		$data->execute();

		$show_data = $data->fetchAll();

		if ($data -> rowCount() > 0) {
			echo "<div class='container table-responsive'>     
			<table class='table table-striped table-hover table-bordered'>
			<thead class='table-primary'>
			<tr>
			<th>Acción</th>
			<th>Empresa</th>
			<th>UMA</th>
			<th>Edificio</th>
			<th>Ubicación</th>
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
				<th><a href='../../../assets/lib/reports/FV-06-8-010.php?".$value -> uma."' class='btn btn-sm btn-success' target='_blank' title='Ver PDF'><img class='see' src='../../../assets/img/pdf.png'></a>
				<!--a href='mod.php' class='btn btn-sm btn-warning' title='Editar registro'><img class='edit' src='../../../assets/img/editar.png'></a--></td>
				<th>".$rel -> razon_social."</th>
				<th>".$value -> uma."</th>
				<th>".$edi -> descripcion."</th>
				<th>".$local -> ubicacion."</th>
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