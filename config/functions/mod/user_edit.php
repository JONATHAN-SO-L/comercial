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

	if (isset($_POST['guadar_cambios'])) {
        require '../../conex.php';

	/*******************
	Obtención de datos
	*******************/
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$area = $_POST['area'];
	$tipo = $_POST['tipo'];
	//$squad = $_POST['squad'];

	$usuario = $_SERVER['QUERY_STRING'];

	/**********************
	Actualización de datos
	**********************/
	$up_empresa = $con->prepare("UPDATE usuario_lev SET usuario = ?, nombre = ?, correo = ?, area = ?, tipo_usuario = ?/*, squad = ?*/ WHERE usuario = '$usuario'");

    $val_up_empresa = $up_empresa->execute([$usuario, $nombre, $correo, $area, $tipo/*, $squad*/]);

	if ($val_up_empresa) {
		echo '<script>alert("Usuario modificado con éxito")</script>';
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/user_list.php">';
		
	} else {
		echo '<script>alert("Hubo un error al actualizar, por favor inténtalo de nuevo")</script>';
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/user_edit.php?'.$usuario.'">';
	}
    } else {
        # code...
    }

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>