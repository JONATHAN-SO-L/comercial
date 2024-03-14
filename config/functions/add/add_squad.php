<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/index.php">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
		break;
	}

	if (isset($_POST['alta_squad'])) {

		require '../../conex.php';

		/*****************
		RECEPCIÓN DE DATOS
		*****************/
		$jefe = $_SESSION['nombre'];

		$seller_gang = $_POST['seller_gang'];

		$up_gang = $con->prepare("UPDATE usuario_lev SET squad = :squad where usuario = :usuario");
		$up_gang->bindValue(':squad', $jefe);
		$up_gang->bindValue(':usuario', $seller_gang);
		$up_gang->execute();

		if ($up_gang) {
			echo "<script>alert('Resgistro exitoso, continúa dando agregando integrantes')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/cuadrilla.php">';
		} else {
			echo "<script>alert('No se logró agregar al integrante, por favor inténtalo de nuevo')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/cuadrilla.php">';
		}

	} else {
		echo "<script>alert('No se recibieron datos, por favor inténtalo de nuevo')</script>";
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/cuadrilla.php">';
	}
	
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>