<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	require '../../conex.php';

	/*******************
	Obtención de datos
	*******************/
	$empresa_mod = $_POST['razon_social'];
	$rfc_mod = $_POST['rfc'];
	$calle_mod = $_POST['calle_empresa'];
	$num_ext_mod = $_POST['num_ext_empresa'];
	$num_int_mod = $_POST['num_int_empresa'];
	$colonia_mod = $_POST['colonia_empresa'];
	$municipio_mod = $_POST['municipio_empresa'];
	$entidad_mod = $_POST['entidad_federativa_empresa'];
	$cp_mod = $_POST['cp_empresa'];
	$contacto_mod = $_POST['nombre_contacto_empresa'];
	$contacto_puesto_mod = $_POST['puesto_contacto_empresa'];
	$contacto_mail_mod = $_POST['correo_contacto_empresa'];
	$contacto_tel_mod = $_POST['telefono_contacto_empresa'];

	$empresa_id = $_SERVER['QUERY_STRING'];

	/**********************
	Actualización de datos
	**********************/
	$up_empresa = $con->prepare("UPDATE empresas SET razon_social = ?, rfc = ?, calle = ?, numero_exterior = ?, numero_interior = ?, colonia = ?, municipio = ?, entidad_federativa = ?, codigo_postal = ?, contacto_nombre = ?, contacto_puesto = ?, contacto_email = ?, contacto_telefono = ? WHERE id = '$empresa_id'");

	$val_up_empresa = $up_empresa->execute([$empresa_mod, $rfc_mod, $calle_mod, $num_ext_mod, $num_int_mod, $colonia_mod, $municipio_mod, $entidad_mod, $cp_mod, $contacto_mod, $contacto_puesto_mod, $contacto_mail_mod, $contacto_tel_mod]);

	if ($val_up_empresa) {
		echo '<script>alert("Empresa modificada con éxito")</script>';

		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/empresas_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/empresas_lista.php">';
			break;

			case 'J':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/empresas_lista.php">';
			break;

			case 'V':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/empresas_lista.php">';
			break;

			default:
			echo '<meta http-equiv="refresh" content="0;../../../index.php">';
			break;
		}
		
	} else {
		echo '<script>alert("Hubo un error al actualizar, por favor inténtalo de nuevo")</script>';
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_empresa.php?'.$empresa_id.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>