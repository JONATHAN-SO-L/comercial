<?php session_start(); 
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	require '../../../config/conex.php';
	$vendedor = $_SESSION['nombre'];
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

	<!------------------------------
	Tabla de datos | Dashboard
	------------------------------->
		<?php
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
				<th>
				<a href='../../../assets/lib/reports/FV-06-8-010.php?".$value -> uma."' class='btn btn-sm btn-success' target='_blank' title='Ver PDF'><img class='see' src='../../../assets/img/pdf.png'></a>
				<a href='#' class='btn btn-sm btn-warning' data-bs-toggle='modal' data-bs-target='#myModal' title='Editar registro'><img class='edit' src='../../../assets/img/editar.png'></a>
				<a href='#' class='btn btn-sm btn-primary' title='Ver Levantamiento'><img class='see' src='../../../assets/img/ver.png'></a>
				<!--a href='#' class='btn btn-sm btn-info' title='Enviar por correo'><img class='edit' src='../../../assets/img/enviar.png'></a-->
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

			/**********************************************************************
			Validación de ausencia de autorización en modificación de levantamiento
			**********************************************************************/
			$s_auth = $con->prepare("SELECT sol_mod, mod_auth FROM levantamientos WHERE vendedor = :vendedor");
			$s_auth->bindValue(':vendedor', $vendedor);
			$s_auth->setFetchMode(PDO::FETCH_OBJ);
			$s_auth->execute();

			$f_auth = $s_auth->fetchAll();

			if ($s_auth -> rowCount() > 0) {
				foreach ($f_auth as $item) {
					$solicitud = $item -> sol_mod;
					$autorizacion = $item -> mod_auth;
				}
			} else {
				echo '<script>console.log("No hay autorizaciones ni solicitudes")</script>';
			}

			if ($solicitud == '') {
				echo '
				<!-----------------------------------------------------------
				MODAL PARA SOLICITAR PERMISO DE MODIFICACIÓN DE LEVANTAMIENTO
				------------------------------------------------------------>
				<div class="modal fade" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

					<!-- Header -->
					<div class="modal-header">
					<h4 class="modal-title">Solicitud para editar</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
					<strong>¿Quieres solicitar a tu jefe directo el permiso para modificar?</strong><br>
					<i>En caso de ser aprobado, te llegará la notificación por correo</i>
					</div>

					<div class="modal-footer">
					<a href="../../../config/functions/request/mod_lev.php?'.$value -> uma.'" class="btn btn-success">Iniciar solicitud</a>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar solicitud</button>
					</div>

				</div>
				</div>
				</div>';
			} elseif ($solicitud != '' && $autorizacion == '') {
				echo '
				<!-----------------------------------------------------------
				MODAL PARA SOLICITAR PERMISO DE MODIFICACIÓN DE LEVANTAMIENTO
				------------------------------------------------------------>
				<div class="modal fade" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

					<!-- Header -->
					<div class="modal-header">
					<h4 class="modal-title">Solicitud para editar</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
					La aprobación está en proceso por parte del Jefe Directo, en cuanto esté aprobado se te hará llegar por correo.
					</div>

					<div class="modal-footer">
					<button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
					</div>

				</div>
				</div>
				</div>';
			} else {
				echo '
				<!-----------------------------------------------------------
				MODAL PARA SOLICITAR PERMISO DE MODIFICACIÓN DE LEVANTAMIENTO
				------------------------------------------------------------>
				<div class="modal fade" id="myModal">
				<div class="modal-dialog">
				<div class="modal-content">

					<!-- Header -->
					<div class="modal-header">
					<h4 class="modal-title">Solicitud para editar</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
					¿Quieres modificar los datos de este levantamiento?
					</div>

					<div class="modal-footer">
					<button type="button" class="btn btn-success" data-bs-dismiss="modal">Si, modificación</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No, cancelar</button>
					</div>

				</div>
				</div>
				</div>';
			}
			
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