<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	
	switch ($_SESSION['tipo']) {
		case 'J':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">'; 
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">'; 
		break;
	}

	$ubicacion = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	// s_ = search / buscar
	$s_location = $con->prepare("SELECT id_edificio, id_ubicacion, ubicacion FROM edificio, ubicacion WHERE edificio.id_edificio = ubicacion.edificio_id AND ubicacion.id_ubicacion = :ubicacion");
	$s_location->bindValue(':ubicacion', $ubicacion);
	$s_location->setFetchMode(PDO::FETCH_OBJ);
	$s_location->execute();

	// f_ = found / encontrado
	$f_location = $s_location->fetchAll();

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
			<img class="empresa_pic" src="../../../assets/img/borrar2.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Eliminar permanentemente ubicacion: <strong><br><br>
				<?php

				if ($s_location -> rowCount() > 0) {
					foreach ($f_location as $value) {
						echo "<center>".$value -> ubicacion."</center>";
					}
				} else {
					echo "<br><br><div class='alert alert-danger'><center>No se encontraron ubicaciones registrados</center></div>";
					echo "<script>console.log('Error al obtener datos de la consulta')</script>";
					exit();
				}

				?>					
			</strong></h3><br>
			<div class="card">
				<div class="card bg-danger text-white">
					<center>
						<h4><strong>¿Estás de acuerdo en eliminar este registro?</strong></h4>
					</center>
				</div>
			</div>

			<form method="POST" action="../../functions/drop/drop_ubicacion.php?<?php echo $ubicacion;?>" class="border border-danger form-control">
				<center><br>
					<input type="submit" name="drop_ubicacion" class="btn btn-danger" value="Eliminar ubicacion">
					<?php
					switch ($_SESSION['tipo']) {
						case 'A':
						echo "<a href='../../../admin/views/admin/ubicaciones_lista.php' class='btn btn-success'>No, cancelar</a>";
						break;

						case 'G':
						echo "<a href='../../../admin/views/gerencia/ubicaciones_lista.php' class='btn btn-success'>No, cancelar</a>";
						break;
					}
					?>
				</center><br>
			</form>

		</div>

	</body>
	</html>

	<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>