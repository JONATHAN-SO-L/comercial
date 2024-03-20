<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { ?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br>

		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/usuario.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Nuevo usuario</h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Para dar de alta un usuario nuevo debes llenar todos los campos del formulario</strong></h6></center></div>
			</div>
			<form method="POST" action="../../functions/add/add_user.php" class="border border-danger form-control">
				<label class="form"><strong>Nombre Completo </strong><i><u>(Evita usar acentos)</u></i><strong> :</strong></label><br>
				<input class="form form-control" type="text" name="nombre_completo" placeholder="Ingresa el nombre completo del usuario, por ejemplo: Juan Arras"  maxlength="100" required><br>

				<label class="form"><strong>Correo Electrónico:</strong></label><br>
				<input class="form form-control" type="email" name="correo" placeholder="Ingresa el correo del usuario, por ejemplo: j.arras@veco.mx"  maxlength="100" required><br>

				<label class="form"><strong>Nombre de Usuario:</strong></label><br>
				<input class="form form-control" type="text" name="username" placeholder="Ingresa el nombre de usuario, por ejemplo: JUANARRAS"  maxlength="15" required><br>

				<label class="form"><strong>Contraseña:</strong></label><br>
				<input class="form form-control" type="password" name="password" placeholder="Ingresa la contraseña del usuario, mínimo 8 caracteres"  maxlength="100" required minlength="8"><br>

				<label class="form"><strong>Área:</strong></label><br>
				<select class="form-control" name="area" required>
					<option value=""> - Selecciona el área -</option>
					<option value="Direccion General">Dirección General</option>
					<option value="Gerencia General">Gerencia General</option>
					<option value="Ventas">Ventas</option>
					<option value="Sistemas">Sistemas</option>
				</select><br>

				<label class="form"><strong>Tipo de Usuario:</strong></label><br>
				<select class="form-control" name="tipo_usuario" required>
					<option value=""> - Selecciona el tipo de usuario - </option>
					<option value="A">Administrador</option>
					<option value="G">Gerencia</option>
					<option value="J">Jefatura</option>
					<option value="V">Vendedor</option>
				</select><br>

				<center><input type="submit" class="btn btn-success" name="nuevo_usuario" value="Guardar"></center><br>
			</form>
		</div><br>

	</body>
	</html>

	<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>