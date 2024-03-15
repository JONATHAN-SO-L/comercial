<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../admin">';
		break;

		case 'J':
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
		<?php require '../../../assets/navs/nav_gerente.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br>
		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/edificio.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Mis edificios</h1>
					</div>
				</div>
			</div>
		</div><br>

		<!------------------------------
		Tabla de datos | Dashboard
		------------------------------->
		<?php 
		require '../../../config/conex.php';

		//Preparación de consulta
		$data = $con->prepare("SELECT * FROM edificio ORDER BY empresa_id ASC");
		$data->setFetchMode(PDO::FETCH_OBJ);
		$data->execute();

		$show_data = $data->fetchAll();

		if ($data -> rowCount() > 0) {
			echo "<div class='container mt-3 table table-responsive'>     
			<table class='table table-striped table-hover table-bordered'>
			<thead class='table-primary'>
			<tr>
			<th>Acción</th>
			<th>Razón Social</th>
			<th>Descripción</th>
			<th>Entidad Federativa</th>
			<th>Contacto</th>
			<th>Correo</th>
			<th>Teléfono</th>
			<th>Vendedor que registró</th>
			<th>Fecha de Registro</th>
			</tr>
			</thead>";
			foreach ($show_data as $value) {
				// Búsqueda de razón social del edificio
				$build = $con->prepare("SELECT razon_social FROM empresas, edificio WHERE empresas.id = edificio.empresa_id AND edificio.id_edificio = ".$value->id_edificio."");
				$build->setFetchMode(PDO::FETCH_OBJ);
				$build->execute();
				$build_data = $build->fetchAll();

				if ($build -> rowCount() > 0) {
					foreach ($build_data as $rel) {
						$rel -> razon_social;
					}
				}

				echo 
				"<tbody>
				<tr>
				<th>
				<a href='../../../config/permissions/mod/mod_edificio.php?".$value -> id_edificio."' class='btn btn-sm btn-warning' title='Editar registro'><img class='edit' src='../../../assets/img/editar.png'></a>
				<a href='../../../config/permissions/mod/reasign_build_admin.php?".$value->id_edificio."' class='btn btn-sm btn-primary' title='Reasingar registro'><img class='edit' src='../../../assets/img/reasignar.png'></a>
				<a href='../../../config/permissions/drop/drop_edificio.php?".$value -> id_edificio."' class='btn btn-sm btn-danger' title='Eliminar registro'><img class='edit' src='../../../assets/img/borrar.png'></a>
				</th>
				<th>".$rel -> razon_social."</th>
				<th>".$value -> descripcion."</th>
				<th>".$value -> entidad_federativa."</th>
				<th>".$value -> contacto_nombre."</th>
				<th>".$value -> contacto_email."</th>
				<th>".$value -> contacto_telefono."</th>
				<th>".$value -> vendedor."</th>
				<th>".$value -> fecha."</th>
				</tr>
				</tbody>";
			}
			echo "</table>
			</div>";
		} else {
			echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios registrados</h3></strong></center></div>';
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