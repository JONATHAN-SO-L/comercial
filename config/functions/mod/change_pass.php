<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	if (isset($_POST['cambiar_contrasena'])) {

		require '../../conex.php';

		$id_user = $_SESSION['id'];
		$user = $_SESSION['usuario'];

		$actual_pass = strip_tags($_POST['actual_pass']);
		$new_pass = strip_tags($_POST['new_pass']); echo $new_pass; echo "<br>";
		$new_pass_repeat = strip_tags($_POST['new_pass_repeat']); echo $new_pass_repeat;

		/*******************************************
		Validar que las contraseñas sean distintas
		******************************************/
		if ($actual_pass == $new_pass) {
			echo "<script>alert('La nueva contraseña no puede ser igual a la anterior')</script>";
			echo '<meta http-equiv="refresh" content="0;../../permissions/mod/change_pass.php">';
		} elseif ($actual_pass != $new_pass && $new_pass != $new_pass_repeat) {
			echo "<script>alert('Las contraseñas nuevas no coinciden, inténtalo de nuevo')</script>";
			echo '<meta http-equiv="refresh" content="0;../../permissions/mod/change_pass.php">';
		} elseif ($actual_pass != $new_pass && $new_pass == $new_pass_repeat) {

			/**********************************************************
			Validar que la contraseña actual sea la que está registrada
			**********************************************************/
			$actual_pass_auth = md5($actual_pass);

			$search_pw = $con->prepare("SELECT id, usuario, pwd FROM usuario_lev WHERE usuario = :user AND pwd = :actual_pass_auth AND id = :id_user");
			$search_pw->bindValue(':user', $user);
			$search_pw->bindValue(':actual_pass_auth', $actual_pass_auth);
			$search_pw->bindValue(':id_user', $id_user);
			$search_pw->setFetchMode(PDO::FETCH_OBJ);
			$search_pw->execute();

			$val_pw = $search_pw->fetchAll();

			if ($search_pw -> rowCount() > 0) {
				foreach ($val_pw as $pw_auth) {
					$pw_auth -> usuario;
					$pw_auth -> pwd;
				}
			} else {
				echo "<script>alert('La contraseña actual es incorrecta, por favor inténtalo de nuevo')</script>";
				echo '<meta http-equiv="refresh" content="0;../../permissions/mod/change_pass.php">';
			}

			/*****************
			Cifrar contraseñas
			*****************/
			$new_pass_repeat_auth = md5($new_pass_repeat);

			/********************
			Actualizar contraseña
			********************/
			$up_pass = $con->prepare("UPDATE usuario_lev SET pwd = ? WHERE usuario_lev.usuario = '$user' AND usuario_lev.id = '$id_user'");

			$val_up_pass = $up_pass->execute([$new_pass_repeat_auth]);

			if ($val_up_pass) {
				echo "<script>alert('Contarseña actualizada con éxito, por favor inicia sesión de nuevo')</script>";
				echo '<meta http-equiv="refresh" content="0;../../sessions/logout.php">';
			} else {
				echo "<script>alert('No fue posible actualizar la contraseña, por favor, contacta al soporte técnico')</script>";
				echo '<meta http-equiv="refresh" content="0;../../permissions/mod/change_pass.php">';
			}

		} else {
			echo "<script>alert('No se logró obtener la información para cambiar la contraseña, por favor, contacta al soporte técnico')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../index.php">';
		}

	}} else {
		echo '<meta http-equiv="refresh" content="0;../../../index.php">';
	}

	?>