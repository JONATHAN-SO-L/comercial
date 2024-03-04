<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	require '../../conex.php';

	if (isset($_POST['guardar_edificio'])) {
		$empresa_id = $_POST['empresa'];
		$descripcion = $_POST['descripcion_edificio'];
		$calle = $_POST['calle_edificio'];
		$numero_exterior = $_POST['num_ext_edificio'];
		$numero_interior = $_POST['num_int_edificio'];
		$colonia = $_POST['colonia_edificio'];
		$municipio = $_POST['municipio_edificio'];
		$entidad_federativa = $_POST['entidad_federativa_edificio'];
		$codigo_postal = $_POST['cp_edificio'];
		$contacto_nombre = $_POST['nombre_contacto_edificio'];
		$contacto_puesto = $_POST['puesto_contacto_edificio'];
		$contacto_email = $_POST['correo_contacto_edificio'];
		$contacto_telefono = $_POST['telefono_contacto_edificio'];
		$requisitos_acceso = $_POST['req_acceso_edificio'];
		$vendedor = $_SESSION['nombre'];

		$search_data = $con->prepare("SELECT * FROM edificio WHERE descripcion = '$descripcion'");
		$val_search = $search_data -> fetch();

		if ($val_search['descripcion'] == '') {
			/***************
			Captura de datos
			****************/
			$up_building = $con->prepare("INSERT INTO edificio (empresa_id, descripcion, calle, numero_exterior, numero_interior, colonia, municipio, entidad_federativa, codigo_postal, contacto_nombre, contacto_puesto, contacto_email, contacto_telefono, requisitos_acceso, vendedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

			$val_up_building = $up_building->execute([$empresa_id, $descripcion, $calle, $numero_exterior, $numero_interior, $colonia, $municipio, $entidad_federativa, $codigo_postal, $contacto_nombre, $contacto_puesto, $contacto_email, $contacto_telefono, $requisitos_acceso, $vendedor]);
			echo "<script>alert('Edificio guardado con éxito')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/edificio.php">';
		} else {
			/***************************************
			Redirección al ya existir la descripción
			***************************************/
			include '../../../assets/navs/links.php'; ?>
			<br><div class="container-sm alert alert-danger">
				<center><strong>ERROR 001:</strong> El edificio <strong><?php echo $descripcion; ?></strong> ya existe, por favor verifica que la información sea correcta.</center><br>
				<center><a href="../../../admin/views/vendedor/edificio.php" class="btn btn-sm btn-danger"><strong>Verificar datos</strong></a></center>
			</div>
		<?php }
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../../index.php">';
}
	
?>