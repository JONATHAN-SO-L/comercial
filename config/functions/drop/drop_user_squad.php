<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	
	switch ($_SESSION['tipo']) {
		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
		break;
	}

	$usuario = $_SERVER['QUERY_STRING'];
	$squad = '';

	require '../../conex.php';

	$d_seller_squad = $con->prepare("UPDATE usuario_lev SET squad = :squad WHERE usuario = :usuario");
	$d_seller_squad->bindValue(':squad', $squad);
	$d_seller_squad->bindValue(':usuario', $usuario);
	$d_seller_squad->execute();

	if ($d_seller_squad) {
		echo "<script>alert('Borrado ejecutado con éxito')</script>";
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/cuadrilla_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/cuadrilla_lista.php">';
			break;

			case 'J':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/cuadrilla_lista.php">';
			break;
		}
	} else {
		echo "<script>alert('Ocurrió un error al intentar borrar, contácte al soporte técnico')</script>";
		echo "<script>console.log('No se ejecutó correctamente la solicitud')</script>";
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/cuadrilla_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/cuadrilla_lista.php">';
			break;

			case 'J':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/cuadrilla_lista.php">';
			break;
		}
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>