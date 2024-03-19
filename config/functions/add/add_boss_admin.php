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

	if (isset($_POST['alta_boss'])) {

		require '../../conex.php';

		/*****************
		RECEPCIÓN DE DATOS
		*****************/
		$vendedor = $_POST['seller_gang'];

		$up_boss = $con->prepare("UPDATE usuario_lev SET tipo_usuario = 'J' where usuario = :vendedor");
		$up_boss->bindValue(':vendedor', $vendedor);
		$up_boss->execute();

		if ($up_boss) {
			echo "<script>alert('Registro exitoso, continúa dando de alta jefes comerciales')</script>";

            switch ($_SESSION['tipo']) {
                case 'A':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/jefes.php">';
                break;
                case 'G':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/jefes.php">';
                break;
            }

		} else {
			echo "<script>alert('No se logró agregar al integrante, por favor inténtalo de nuevo')</script>";

            switch ($_SESSION['tipo']) {
                case 'A':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/jefes.php">';
                break;
                case 'G':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/jefes.php">';
                break;
            }
			
		}

	} else {
		echo "<script>alert('No se recibieron datos, por favor inténtalo de nuevo')</script>";

        switch ($_SESSION['tipo']) {
            case 'A':
            echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/jefes.php">';
            break;
            case 'G':
            echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/jefes.php">';
            break;
        }
		
	}
	
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>