<?php
session_start();

require '../conex.php';

if (isset($_POST['acceder'])) {
	$user = strip_tags($_POST['user']);
	$pass = strip_tags(md5($_POST['pwd']));

	/**********************************
	Validación existencia de usuario
	**********************************/
	$val_user = $con->prepare("SELECT * FROM usuario_lev WHERE usuario = :user AND pwd = :pass");
	$val_user->bindValue(':user', $user);
	$val_user->bindValue(':pass', $pass);
	$val_user->setFetchMode(PDO::FETCH_OBJ);
	$val_user->execute();

	$validate = $val_user->fetchAll();

	/**********************************
	Asignación de datos
	*********************************/
	if ($val_user -> rowCount() > 0) {
		foreach ($validate as $value) {
        	$id_user = $value->id;
			$nombre_user = $value->nombre;
			$correo_user = $value->correo;
			$usuario_user = $value->usuario;
			$pass_user = $value->pwd;
			$area_user = $value->area;
			$tipo_user = $value->tipo_usuario;
		}
	} else {
		header('Location: 404_error_login.php');
	}

	/**************************************
	Redirección en base al tipo de usuario
	**************************************/
	switch ($tipo_user) {
		case 'A':
    	$_SESSION['id'] = $id_user;
		$_SESSION['nombre'] = $nombre_user;
		$_SESSION['correo'] = $correo_user;
		$_SESSION['usuario'] = $usuario_user;
		$_SESSION['area'] = $area_user;
		$_SESSION['tipo'] = $tipo_user;
		header('Location: ../../admin/views/admin/');
		break;

		case 'G':
    	$_SESSION['id'] = $id_user;
		$_SESSION['nombre'] = $nombre_user;
		$_SESSION['correo'] = $correo_user;
		$_SESSION['usuario'] = $usuario_user;
		$_SESSION['area'] = $area_user;
		$_SESSION['tipo'] = $tipo_user;
		header('Location: ../../admin/views/gerencia/');
		break;

		case 'J':
    	$_SESSION['id'] = $id_user;
		$_SESSION['nombre'] = $nombre_user;
		$_SESSION['correo'] = $correo_user;
		$_SESSION['usuario'] = $usuario_user;
		$_SESSION['area'] = $area_user;
		$_SESSION['tipo'] = $tipo_user;
		header('Location: ../../admin/views/jefatura/');
		break;

		case 'V':
    	$_SESSION['id'] = $id_user;
		$_SESSION['nombre'] = $nombre_user;
		$_SESSION['correo'] = $correo_user;
		$_SESSION['usuario'] = $usuario_user;
		$_SESSION['area'] = $area_user;
		$_SESSION['tipo'] = $tipo_user;
		header('Location: ../../admin/views/vendedor/');
		break;

		default:
		echo '<meta http-equiv="refresh" content="0;../../">';
		break;
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../">';
}

?>