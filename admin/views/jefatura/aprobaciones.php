<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    $squad = $_SESSION['nombre'];

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
						<img class="empresa_pic" src="../../../assets/img/solicitud.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Aprobaciones pendientes</h1><br>
					</div>
                    <hr>
                    <h4>Revisa las solicitudes de modificación de levantamientos</h4>
                    <hr>
				</div>
			</div>
		</div><br>

		<?php

		require '../../../config/conex.php';

		$search_seller = $con->prepare("SELECT empresa, edificio, ubicacion, uma, fecha_solicitud, vendedor FROM levantamientos WHERE sol_mod != '' AND mod_auth = 'Pendiente' AND squad = :squad ORDER BY uma ASC");
        $search_seller->bindValue(':squad', $squad);
		$search_seller->setFetchMode(PDO::FETCH_OBJ);
		$search_seller->execute();

		$found_seller = $search_seller->fetchAll();

		if ($search_seller -> rowCount() > 0) {
			echo "<div class='container table-responsive'>     
			<table class='table table-striped table-hover table-bordered'>
			<thead class='table-primary'>
			<tr>
			<th>Acción</th>
			<th>Empresa</th>
			<th>Edificio</th>
			<th>Ubicación</th>
			<th>UMA</th>
            <th>Vendedor</th>
            <th>Fecha de Solicitud</th>
			</tr>
			</thead>";
			foreach ($found_seller as $value) {
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
                <a href='../../../config/functions/request/aproval.php?".$value -> uma."' class='btn btn-sm btn-success' title='Aprobar'><img class='edit' src='../../../assets/img/aprobado.png'></a>
                <a href='../../../config/permissions/request/aproval_denied.php?".$value -> uma."' class='btn btn-sm btn-danger' title='Rechazar'><img class='edit' src='../../../assets/img/rechazado.png'></a>
                </td>
				<th>".$rel -> razon_social."</th>
				<th>".$edi -> descripcion."</th>
				<th>".$local -> ubicacion."</th>
				<th>".$value -> uma."</th>
                <th>".$value -> vendedor."</th>
                <th>".$value -> fecha_solicitud."</th>
				</tr>
				</tbody>";
			}
			echo "</table>
			</div>";
		} else {
			echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay solicitudes pendientes por aprobar</h3></strong></center></div>';
			echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
			exit();
		} ?>

	</body>
	</html>

<?php } else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>