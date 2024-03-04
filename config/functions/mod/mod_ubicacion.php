<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	$ubicacion_id = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	$empresa_mod = $_POST['empresa'];
	$edificio_mod = $_POST['edificio'];
	$descripcion_mod = $_POST['descripcion_ubicacion'];
	$requisitos_accesso_mod = $_POST['req_acceso_ubicacion'];

	$up_ubicacion = $con->prepare("UPDATE ubicacion SET empresa_id  = ?, edificio_id = ?, ubicacion = ?, requisitos_acc = ?
		WHERE ubicacion.id_ubicacion = '$ubicacion_id'");

	$val_up_ubicacion = $up_ubicacion->execute([$empresa_mod, $edificio_mod, $descripcion_mod, $requisitos_accesso_mod]);

	if ($val_up_ubicacion) {
		echo '<script>alert("Ubicación modificada con éxito")</script>';
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/ubicaciones_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/ubicaciones_lista.php">';
			break;

			case 'J':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/ubicaciones_lista.php">';
			break;

			case 'V':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/ubicaciones_lista.php">';
			break;

			default:
			echo '<meta http-equiv="refresh" content="0;../../../index.php">';
			break;
		}
	} else {
		echo '<script>alert("Hubo un error al actualizar, por favor inténtalo de nuevo")</script>';
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_ubicacion.php?'.$ubicacion_id.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>