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

	if (isset($_POST['drop_edificio'])) {
		
		$edificio = $_SERVER['QUERY_STRING'];

		require '../../conex.php';

		$d_lev = $con->prepare("DELETE FROM edificio WHERE edificio.id_edificio = :edificio");
		$d_lev->bindValue(':edificio', $edificio);
		$d_lev->execute();

		if ($d_lev) {
			echo "<script>alert('Borrado ejecutado con éxito')</script>";
			switch ($_SESSION['tipo']) {
				case 'A':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/edificios_lista.php">';
				break;

				case 'G':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/edificios_lista.php">';
				break;
			}
		} else {
			echo "<script>alert('Ocurrió un error al intentar borrar, contácte al soporte técnico')</script>";
			echo "<script>console.log('No se ejecutó correctamente la solicitud')</script>";
			switch ($_SESSION['tipo']) {
				case 'A':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/edificios_lista.php">';
				break;

				case 'G':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/edificios_lista.php">';
				break;
			}
		}
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>