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
						<img class="empresa_pic" src="../../../assets/img/empresa.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Mis empresas</h1>
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
		$data = $con->prepare("SELECT * FROM empresas ORDER BY razon_social ASC");
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
			<th>RFC</th>
			<th>Entidad Federativa</th>
			<th>Contacto</th>
			<th>Correo</th>
			<th>Teléfono</th>
			<th>Vendedor que registró</th>
			<th>Fecha de Registro</th>
			</tr>
			</thead>";
			foreach ($show_data as $value) {
				echo 
				"<tbody>
				<tr>
				<th>
				<a href='../../../config/permissions/mod/mod_empresa.php?".$value -> id."' class='btn btn-sm btn-warning' title='Editar registro'><img class='edit' src='../../../assets/img/editar.png'></a>
				<a href='../../../config/permissions/mod/reasign_company_admin.php?".$value->id."' class='btn btn-sm btn-primary' title='Reasignar registro'><img class='edit' src='../../../assets/img/reasignar.png'></a>
				<a href='../../../config/permissions/drop/drop_empresa.php?".$value -> id."' class='btn btn-sm btn-danger' title='Eliminar registro'><img class='edit' src='../../../assets/img/borrar.png'></a>
				</th>
				<th>".$value -> razon_social."</th>
				<th>".$value -> rfc."</th>
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
			echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas registradas</h3></strong></center></div>';
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