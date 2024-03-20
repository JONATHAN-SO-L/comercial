<?php 
session_start();
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'G':
		echo '<meta http-equiv="refresh" content="0;../gerencia">';
		break;

		case 'J':
		echo '<meta http-equiv="refresh" content="0;../jefatura">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../vendedor">';
		break;
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_admin.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br>
		<div class="container" >
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header2"><br>
						<img class="empresa_pic" src="../../../assets/img/usuario.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Usuarios</h1><br>
					</div>
				</div>
			</div>
		</div>

		<?php
		require '../../../config/conex.php';

		//Preparación de consulta
		$data = $con->prepare("SELECT * FROM usuario_lev ORDER BY tipo_usuario ASC");
		$data->setFetchMode(PDO::FETCH_OBJ);
		$data->execute();

		$show_data = $data->fetchAll();

		if ($data -> rowCount() > 0) {
			echo "<div class='container mt-3 table-responsive'>     
			<table class='table table-striped table-hover table-bordered'>
			<thead class='table-primary'>
			<tr>
			<th>Acción</th>
			<th>Usuario</th>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Área</th>
			<th>Tipo de Usuario</th>
			<th>Cuadrilla</th>
			</tr>
			</thead>";
			foreach ($show_data as $value) {
				echo 
				"<tbody>
				<tr>
				<th>
				<a href='../../../config/permissions/mod/user_edit.php?".$value -> usuario."' class='btn btn-sm btn-warning' title='Editar Usuario'><img class='edit' src='../../../assets/img/editar.png'></a>
				<a href='./../../config/permissions/drop/drop_user.php?".$value -> usuario."' class='btn btn-sm btn-danger' title='Eliminar Usuario'><img class='edit' src='../../../assets/img/borrar.png'></a>
				</th>
				<th>".$value -> usuario."</th>
				<th>".$value -> nombre."</th>
				<th>".$value -> correo."</th>
				<th>".$value -> area."</th>
				<th>".$value -> tipo_usuario."</th>
				<th>".$value -> squad."</th>
				</tr>
				</tbody>";
			}
			echo "</table>
			</div>";
		} else {
			echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay usuarios registrados</h3></strong></center></div>';
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