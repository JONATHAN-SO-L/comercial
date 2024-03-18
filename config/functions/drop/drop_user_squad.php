<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	
	switch ($_SESSION['tipo']) {
		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
		break;
	}

	$usuario = $_SERVER['QUERY_STRING'];echo $usuario;
	$squad = '';

	require '../../conex.php';

	$d_seller_squad = $con->prepare("UPDATE usuario_lev SET squad = :squad WHERE usuario = :usuario");
	$d_seller_squad->bindValue(':squad', $squad);
	$d_seller_squad->bindValue(':usuario', $usuario);
	$d_seller_squad->execute();

	if ($d_seller_squad) {
		echo "<script>alert('Borrado ejecutado con éxito')</script>";

		/**************************************************
		Encontrar el nombre del vendedor en base al usuario
		**************************************************/
		$s_seller = $con->prepare("SELECT nombre FROM usuario_lev WHERE usuario = :usuario");
		$s_seller->bindValue(':usuario', $usuario);
		$s_seller->setFetchMode(PDO::FETCH_OBJ);
		$s_seller->execute();

		$f_seller = $s_seller->fetchAll();

		if ($s_seller -> rowCount() > 0) {

			foreach ($f_seller as $value) {
				$vendedor = $value -> nombre;
				echo $vendedor;

			/****************************************************************************************
			ACTUALIZACIÓN DE LEVANTAMIENTO, EMPRESA, EDIFICIO Y UBICACIÓN EN BASE AL USUARIO/VENDEDOR
			****************************************************************************************/
			$up_lev = $con->prepare("UPDATE levantamientos SET squad = :squad WHERE vendedor = :vendedor");
			$up_lev->bindValue(':squad', $squad);
			$up_lev->bindValue(':vendedor', $vendedor);
			$up_lev->execute();

			$up_company = $con->prepare("UPDATE empresas SET squad = :squad WHERE vendedor = :vendedor");
			$up_company->bindValue(':squad', $squad);
			$up_company->bindValue(':vendedor', $vendedor);
			$up_company->execute();

			$up_building = $con->prepare("UPDATE edificio SET squad = :squad WHERE vendedor = :vendedor");
			$up_building->bindValue(':squad', $squad);
			$up_building->bindValue(':vendedor', $vendedor);
			$up_building->execute();

			$up_location = $con->prepare("UPDATE ubicacion SET squad = :squad WHERE vendedor = :vendedor");
			$up_location->bindValue(':squad', $squad);
			$up_location->bindValue(':vendedor', $vendedor);
			$up_location->execute();

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