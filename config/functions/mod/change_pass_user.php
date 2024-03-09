<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	switch ($_SESSION['tipo']) {
		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
		break;

		case 'J':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
		break;
	}

	require '../../conex.php';

	$usuario = strip_tags($_POST['user']); echo $usuario; echo "<br>";
	$pass = strip_tags($_POST['new_pass']); echo $pass; echo "<br>";

	/**************************************
	VALIDACIÓN DE LA EXISTENCIA DEL USUARIO
	**************************************/

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>