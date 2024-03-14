<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	switch ($_SESSION['tipo']) {
		case 'G':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
		break;

		case 'J':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">';
		break;

		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
		break;
	}

	if (isset($_POST['nuevo_usuario'])) {

		require '../../conex.php';

		/*****************
		OBTENCIÓN DE DATOS
		*****************/
		$nombre = $_POST['nombre_completo'];
		$correo = $_POST['correo'];
		$usuario = $_POST['username'];
		$pwd = $_POST['password'];
		$area = $_POST['area'];
		$tipo_usuario = $_POST['tipo_usuario'];
		$squad = '';

		/***************************
		LIMPIEZA DE STRINGS MANUALES
		***************************/
		$nombre = strip_tags($nombre);
		$correo = strip_tags($correo);
		$usuario = strip_tags($usuario);
		$pwd = strip_tags($pwd);

		/**************
		ENCODE PASSWORD
		**************/
		$pwd_parse = md5($pwd);

		/**************************************
		Validación de la existencia del usuario
		**************************************/
		$val_user = $con->prepare("SELECT usuario FROM usuario_lev WHERE usuario = :usuario");
		$val_user->bindValue(':usuario', $usuario);
		$val_user->setFetchMode(PDO::FETCH_OBJ);

		$user_validate = $val_user->fetchAll();

		if ($val_user -> rowCount() <= 0) {

			/***************
			REGISTRO EN DDBB
			***************/
			$reg_data = $con->prepare("INSERT INTO usuario_lev	(nombre, correo, usuario, pwd, area, tipo_usuario, squad) VALUES(?, ?, ?, ?, ?, ?, ?)");
			$reg_data->execute([$nombre, $correo, $usuario, $pwd_parse, $area, $tipo_usuario, $squad]);

			if ($reg_data) {
				echo "<script>alert('Registro exitoso')</script>";
				echo '<meta http-equiv="refresh" content="0;../../permissions/add/add_user.php">';
			} else {
				echo "<script>console.log('Fallo al registrar información en base de datos')</script>";
				echo "<script>alert('Ocurrió un error al guardar el nuevo usuario, inténtalo de nuevo')</script>";
				echo '<meta http-equiv="refresh" content="0;../../permissions/add/add_user.php">';
			}

		} else {
			echo "<script>console.log('Usuario registrado en la DDBB')</script>";
			echo "<script>alert('No es posible registrar el usuario ya que existe, por favor inténtelo de nuevo')</script>";
			echo '<meta http-equiv="refresh" content="0;../../permissions/add/add_user.php">';
		}

	} else {
		echo "<script>console.log('No se detectó la acción del bottón nuevo_usuario')</script>";
		echo "<script>alert('No se pulsó en guardar, inténtalo de nuevo')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/add/add_user.php">';
	}


} else {
	echo '<meta http-equiv="refresh" content="0;../../../../index.php">';
}

?>