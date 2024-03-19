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

	$jefe = $_SERVER['QUERY_STRING'];
	$squad = '';

	require '../../conex.php';
    
    /***********************************************
    Se cambia el tipo de usuario de Jefe -> Vendedor
    ***********************************************/
	$d_seller_squad = $con->prepare("UPDATE usuario_lev SET tipo_usuario = 'V' WHERE usuario = :usuario");
	$d_seller_squad->bindValue(':usuario', $jefe);
	$d_seller_squad->execute();

	if ($d_seller_squad) {
		echo "<script>alert('Borrado ejecutado con éxito, ahora el usuario es vendedor')</script>";

		/**************************************************
		Encontrar el nombre del vendedor en base al usuario
		**************************************************/
		$s_seller = $con->prepare("SELECT nombre FROM usuario_lev WHERE usuario = :usuario");
		$s_seller->bindValue(':usuario', $jefe);
		$s_seller->setFetchMode(PDO::FETCH_OBJ);
		$s_seller->execute();

		$f_seller = $s_seller->fetchAll();

		if ($s_seller -> rowCount() > 0) {

			foreach ($f_seller as $value) {
				$squad_boss = $value -> nombre;

			/********************************************************************************************************************
			ACTUALIZACIÓN DE CUADRILLA, LEVANTAMIENTO, EMPRESA, EDIFICIO Y UBICACIÓN EN BASE AL JEFE, SE ELIMINA LA CUADRILLA PERETENECIENTE
			********************************************************************************************************************/
			$up_lev = $con->prepare("UPDATE levantamientos SET squad = :squad WHERE squad = :squad_boss");
			$up_lev->bindValue(':squad', $squad);
			$up_lev->bindValue(':squad_boss', $squad_boss);
			$up_lev->execute();

			$up_company = $con->prepare("UPDATE empresas SET squad = :squad WHERE squad = :squad_boss");
			$up_company->bindValue(':squad', $squad);
			$up_company->bindValue(':squad_boss', $squad_boss);
			$up_company->execute();

			$up_building = $con->prepare("UPDATE edificio SET squad = :squad WHERE squad = :squad_boss");
			$up_building->bindValue(':squad', $squad);
			$up_building->bindValue(':squad_boss', $squad_boss);
			$up_building->execute();

			$up_location = $con->prepare("UPDATE ubicacion SET squad = :squad WHERE squad = :squad_boss");
			$up_location->bindValue(':squad', $squad);
			$up_location->bindValue(':squad_boss', $squad_boss);
			$up_location->execute();

            $up_seller = $con->prepare("UPDATE usuario_lev SET squad = :squad WHERE squad = :squad_boss");
            $up_seller->bindValue(':squad', $squad);
			$up_seller->bindValue(':squad_boss', $squad_boss);
			$up_seller->execute();

		}

	} else {
		echo "<script>alert('Ocurrió un error al intentar borrar, contácte al soporte técnico')</script>";
		echo "<script>console.log('No se ejecutó correctamente la solicitud')</script>";
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/jefes_lista.php">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/jefes_lista.php">';
			break;
		}
	}

	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/jefes_lista.php">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/jefes_lista.php">';
		break;
	}
} else {
	echo "<script>alert('Ocurrió un error al intentar borrar, contácte al soporte técnico')</script>";
	echo "<script>console.log('No se ejecutó correctamente la solicitud')</script>";
	switch ($_SESSION['tipo']) {
		case 'A':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/jefes_lista.php">';
		break;

		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/jefes_lista.php">';
		break;
	}
}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>