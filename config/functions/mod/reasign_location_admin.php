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

	require '../../conex.php';

	$ubicacion = $_SERVER['QUERY_STRING'];
	$new_seller = $_POST['new_seller'];

	$s_seller = $con->prepare("SELECT nombre FROM usuario_lev WHERE usuario = :new_seller");
	$s_seller->bindValue(':new_seller', $new_seller);
	$s_seller->setFetchMode(PDO::FETCH_OBJ);
	$s_seller->execute();

	$f_seller = $s_seller->fetchAll();

	if ($s_seller -> rowCount() > 0) {
		foreach ($f_seller as $value) {
			$seller = $value -> nombre;
		}

	} else {
		echo "<script>alert('No se encontraron vendedores que coincidan con el usuario, por favor inténtalo de nuevo')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/reasign_location_admin.php?'.$ubicacion.'">';
	}

	$up_lev = $con->prepare("UPDATE ubicacion SET vendedor = :seller WHERE id_ubicacion = :ubicacion");
	$up_lev->bindValue(':seller', $seller);
	$up_lev->bindValue(':ubicacion', $ubicacion);
	$up_lev->execute();

	if ($up_lev) {
		echo "<script>alert('Reasignación exitosa')</script>";
		
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/ubicaciones_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/ubicaciones_lista.php">';
			break;
		}

	} else {
		echo "<script>alert('No se logró realizar la reasignación, por favor inténtalo de nuevo')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/reasign_location_admin.php?'.$ubicacion.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>