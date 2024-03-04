<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	require '../../conex.php';

	if (isset($_POST['guardar_ubicacion'])) {
		$empresa_id = $_POST['empresa_lev'];
		$edificio_id = $_POST['edificio_lev'];
		$ubicacion = $_POST['descripcion_ubicacion'];
		$requisitos_acc = $_POST['req_acceso_ubicacion'];
		$vendedor = $_SESSION['nombre'];

		$search_data = $con->prepare("SELECT * FROM ubicacion WHERE ubicacion = '$ubicacion'");
		$val_search = $search_data -> fetch();

		if ($val_search['ubicacion'] == '') {
			/***************
			Captura de datos
			****************/
			$up_location = $con->prepare("INSERT INTO ubicacion (empresa_id, edificio_id, ubicacion, requisitos_acc, vendedor) VALUES (?, ?, ?, ?, ?);");

			$val_up_location = $up_location->execute([$empresa_id, $edificio_id, $ubicacion, $requisitos_acc, $vendedor]);
			echo "<script>alert('Ubicación guardada con éxito')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/ubicacion.php">';
		} else {
			/***************************************
			Redirección al ya existir la descripción
			***************************************/
			include '../../../assets/navs/links.php'; ?>
			<br><div class="container-sm alert alert-danger">
				<center><strong>ERROR 001:</strong> La ubicacion <strong><?php echo $ubicacion; ?></strong> ya existe, por favor verifica que la información sea correcta.</center><br>
				<center><a href="../../../admin/views/vendedor/ubicacion.php" class="btn btn-sm btn-danger"><strong>Verificar datos</strong></a></center>
			</div>
		<?php }
	}
} else {
	echo '<meta http-equiv="refresh" content="0;../../../../index.php">';
}
?>