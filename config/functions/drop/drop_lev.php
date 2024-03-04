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

	$uma = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	$d_lev = $con->prepare("DELETE FROM levantamientos WHERE levantamientos.uma = :uma");
	$d_lev->bindValue(':uma', $uma);
	$d_lev->execute();

	if ($d_lev) {
		echo "<script>alert('Borrado ejecutado con éxito')</script>";
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/index.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
			break;
		}
	} else {
		echo "<script>alert('Ocurrió un error al intentar borrar, contácte al soporte técnico')</script>";
		echo "<script>console.log('No se ejecutó correctamente la solicitud')</script>";
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/index.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
			break;
		}
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>