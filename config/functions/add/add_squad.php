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
			echo "<script>alert('Registro exitoso, continúa agregando integrantes')</script>";

			/**************************************************
			Encontrar el nombre del vendedor en base al usuario
			**************************************************/
			$s_seller = $con->prepare("SELECT nombre FROM usuario_lev WHERE usuario = :usuario");
			$s_seller->bindValue(':usuario', $seller_gang);
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
				$up_lev->bindValue(':squad', $jefe);
				$up_lev->bindValue(':vendedor', $vendedor);
				$up_lev->execute();

				$up_company = $con->prepare("UPDATE empresas SET squad = :squad WHERE vendedor = :vendedor");
				$up_company->bindValue(':squad', $jefe);
				$up_company->bindValue(':vendedor', $vendedor);
				$up_company->execute();

				$up_building = $con->prepare("UPDATE edificio SET squad = :squad WHERE vendedor = :vendedor");
				$up_building->bindValue(':squad', $jefe);
				$up_building->bindValue(':vendedor', $vendedor);
				$up_building->execute();

				$up_location = $con->prepare("UPDATE ubicacion SET squad = :squad WHERE vendedor = :vendedor");
				$up_location->bindValue(':squad', $jefe);
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