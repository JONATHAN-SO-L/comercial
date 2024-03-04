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

	$edificio = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	// s_ = search / buscar
	$s_build = $con->prepare("SELECT id_edificio, empresa_id, descripcion FROM edificio, empresas WHERE empresas.id = edificio.empresa_id AND edificio.id_edificio = :edificio");
	$s_build->bindValue(':edificio', $edificio);
	$s_build->setFetchMode(PDO::FETCH_OBJ);
	$s_build->execute();

	// f_ = found / encontrado
	$f_build = $s_build->fetchAll();

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
			<img class="empresa_pic" src="../../../assets/img/borrar2.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Eliminar permanentemente Edificio: <strong><br><br>
				<?php

				if ($s_build -> rowCount() > 0) {
					foreach ($f_build as $value) {
						echo "<center>".$value -> descripcion."</center>";
					}
				} else {
					echo "<br><br><div class='alert alert-danger'><center>No se encontraron edificios registrados</center></div>";
					echo "<script>console.log('Error al obtener datos de la consulta')</script>";
					exit();
				}

				?>					
			</strong></h3><br>
			<div class="card">
				<div class="card bg-danger text-white">
					<center>
						<h4><strong>¿Estás de acuerdo en elminiar este registro?</strong></h4>
					</center>
				</div>
			</div>

			<form method="POST" action="../../functions/drop/drop_edificio.php?<?php echo $edificio;?>" class="border border-danger form-control">
				<center>
					<h5>Primero debes eliminar todas las ubicaciones asociadas a este edificio para no tener errores al eliminar de forma permanente</h5><br>
					<?php
					switch ($_SESSION['tipo']) {
						case 'A':
						echo "<a href='../../../admin/views/admin/ubicaciones_lista.php' class='btn btn-warning'>Validar ubicaciones</a>";
						break;

						case 'G':
						echo "<a href='../../../admin/views/gerencia/ubicaciones_lista.php' class='btn btn-warning'>Validar ubicaciones</a>";
						break;
					}
					?>
					<input type="submit" name="drop_edificio" class="btn btn-danger" value="Eliminar edificio">
					<?php
					switch ($_SESSION['tipo']) {
						case 'A':
						echo "<a href='../../../admin/views/admin/edificios_lista.php' class='btn btn-success'>No, cancelar</a>";
						break;

						case 'G':
						echo "<a href='../../../admin/views/gerencia/edificios_lista.php' class='btn btn-success'>No, cancelar</a>";
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