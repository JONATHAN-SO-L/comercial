<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	require '../../conex.php';

	if (isset($_POST['guardar_empresa'])) {
		/************************
		Recepción de datos
		************************/
		$razon_social = $_POST['razon_social'];
		$rfc = $_POST['rfc'];
		$calle_empresa = $_POST['calle_empresa'];
		$num_ext_empresa = $_POST['num_ext_empresa'];
		$num_int_empresa = $_POST['num_int_empresa'];
		$colonia_empresa = $_POST['colonia_empresa'];
		$municipio_empresa = $_POST['municipio_empresa'];
		$entidad_federativa_empresa = $_POST['entidad_federativa_empresa'];
		$cp_empresa = $_POST['cp_empresa'];
		$nombre_contacto_empresa = $_POST['nombre_contacto_empresa'];
		$puesto_contacto_empresa = $_POST['puesto_contacto_empresa'];
		$correo_contacto_empresa = $_POST['correo_contacto_empresa'];
		$telefono_contacto_empresa = $_POST['telefono_contacto_empresa'];
		$vendedor = $_SESSION['nombre'];

		/*******************************
		Validación de dato no almacenado
		*******************************/
		$search_data = $con->query("SELECT * FROM empresas WHERE razon_social = '$razon_social';");
		$val_search = $search_data->fetch();

		if ($val_search['razon_social'] == '') {
			/***************
			Captura de datos
			****************/
			$up_company = $con->prepare("INSERT INTO empresas (rfc, razon_social, calle, numero_exterior, numero_interior, colonia, municipio, entidad_federativa, codigo_postal, contacto_nombre, contacto_puesto, contacto_email, contacto_telefono, vendedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

			$val_up_company = $up_company->execute([$rfc, $razon_social, $calle_empresa, $num_ext_empresa, $num_int_empresa, $colonia_empresa, $municipio_empresa, $entidad_federativa_empresa, $cp_empresa, $nombre_contacto_empresa, $puesto_contacto_empresa, $correo_contacto_empresa, $telefono_contacto_empresa, $vendedor]);
			echo "<script>alert('Empresa guardada con éxito')</script>";
			
			switch ($_SESSION['tipo']) {
				case 'J':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/empresa.php">';
				break;

				case 'V':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/empresa.php">';
				break;
			}

		} else {
			/***********************************
			Redirección al ya existir la empresa
			***********************************/
			include '../../../assets/navs/links.php'; ?>
			<br><div class="container-sm alert alert-danger">
				<center><strong>ERROR 001:</strong> La empresa <strong><?php echo $razon_social; ?></strong> ya existe, por favor verifica que la información sea correcta.</center><br>
				<?php

				switch ($_SESSION['tipo']) {
					case 'J':
					echo '<center><a href="../../../admin/views/jefatura/empresa.php" class="btn btn-sm btn-danger"><strong>Verificar datos</strong></a></center>';
					break;

					case 'V':
					echo '<center><a href="../../../admin/views/vendedor/empresa.php" class="btn btn-sm btn-danger"><strong>Verificar datos</strong></a></center>';
					break;
				}

				?>
			</div>
		<?php }

	} else {
		echo '<meta http-equiv="refresh" content="0;../../../../index.php">';
	}
} else {
	echo '<meta http-equiv="refresh" content="0;../../../../index.php">';
}

?>