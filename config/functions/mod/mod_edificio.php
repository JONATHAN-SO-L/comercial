<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	$edificio_id = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	$empresa_mod  = $_POST['empresa'];
	$descripcion_mod = $_POST['descripcion_edificio'];
	$calle_mod = $_POST['calle_edificio'];
	$num_ext_mod = $_POST['num_ext_edificio'];
	$num_int_mod = $_POST['num_int_edificio'];
	$colonia_mod = $_POST['colonia_edificio'];
	$municipio_mod = $_POST['municipio_edificio'];
	$entidad_mod = $_POST['entidad_federativa_edificio'];
	$cp_mod = $_POST['cp_edificio'];
	$contacto_nombre_mod = $_POST['nombre_contacto_edificio'];
	$contacto_puesto_mod = $_POST['puesto_contacto_edificio'];
	$contacto_mail_mod = $_POST['correo_contacto_edificio'];
	$contacto_tel_mod = $_POST['telefono_contacto_edificio'];
	$requisitos_mod = $_POST['req_acceso_edificio'];

	$up_edificio = $con->prepare("UPDATE edificio SET empresa_id  = ?, descripcion = ?, calle = ?, numero_exterior = ?,
		numero_interior = ?, colonia = ?, municipio = ?, entidad_federativa = ?,
		codigo_postal = ?, contacto_nombre = ?, contacto_puesto = ?, contacto_email = ?,
		contacto_telefono = ?, requisitos_acceso = ? WHERE edificio.id_edificio = '$edificio_id'");

	$val_up_edificio = $up_edificio->execute([$empresa_mod, $descripcion_mod, $calle_mod, $num_ext_mod,
		$num_int_mod, $colonia_mod, $municipio_mod, $entidad_mod,
		$cp_mod, $contacto_nombre_mod, $contacto_puesto_mod, $contacto_mail_mod,
		$contacto_tel_mod, $requisitos_mod]);

	if ($val_up_edificio) {
		echo '<script>alert("Empresa modificada con éxito")</script>';
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/edificios_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/edificios_lista.php">';
			break;

			case 'J':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/edificios_lista.php">';
			break;

			case 'V':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/edificios_lista.php">';
			break;

			default:
			echo '<meta http-equiv="refresh" content="0;../../../index.php">';
			break;
		}
	} else {
		echo '<script>alert("Hubo un error al actualizar, por favor inténtalo de nuevo")</script>';
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_edificio.php?'.$edificio_id.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>