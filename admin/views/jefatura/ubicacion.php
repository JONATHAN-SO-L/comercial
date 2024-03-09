<?php session_start();
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	require '../../../config/conex.php';
	$vendedor = $_SESSION['nombre'];
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_jefatura.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>
		<div class="container col-sm-8 panel panel-body"><br><br>
			<a href="../vendedor/index.php" class="btn btn-primary volver"><img class="volver_pic" src="../../../assets/img/volver.png"><strong style="margin-left: 5px;">Volver al inicio</strong></a>
			<img class="empresa_pic" src="../../../assets/img/ubicacion.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Agregar Ubicación Nueva</h3><br>
			<div class="card">
				<div class="card bg-primary text-white"><center><h6><strong>Para poder registrar una ubicación nueva debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>
			<form method="POST" action="../../../config/permissions/add/add_location.php" class="border border-primary form-control">
				<label class="form"><strong>Empresa:</strong></label><br>
				<select class="form form-control" name="empresa_lev" id="empresa_lev" required>
					<option> - Selecciona una empresa -</option>
					<?php
					$query = $con->prepare("SELECT * FROM empresas ORDER BY razon_social ASC");
					$query->setFetchMode(PDO::FETCH_OBJ);
					$query->execute();

					$show_companys = $query->fetchAll();

					if($query -> rowCount() > 0) { 
						foreach($show_companys as $result) { 
							echo "<tr>
							<option value=".$result -> id.">".$result -> razon_social."</option>
							</tr>";

						}
					} else {
						echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas registradas</h3></strong></center></div>';
						echo '<script>console.log("ERROR 100: Fallo al mostrar datos")</script>';
						exit();
					} ?>
				</select>
				<br>
				<label class="form"><strong>Edificio:</strong></label><br>
				<select class="form form-control" name="edificio_lev" id="edificio_lev" required>
					<option> - Selecciona un edificio de la empresa -</option>
					<?php
					$query = $con->prepare("SELECT * FROM edificio ORDER BY descripcion ASC");
					$query->setFetchMode(PDO::FETCH_OBJ);
					$query->execute();

					$show_companys = $query->fetchAll();

					if($query -> rowCount() > 0) { 
						foreach($show_companys as $result) { 
							echo "<tr>
							<option value=".$result -> id_edificio.">".$result -> descripcion."</option>
							</tr>";

						}
					} else {
						echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas registradas</h3></strong></center></div>';
						echo '<script>console.log("ERROR 100: Fallo al mostrar datos")</script>';
						exit();
					}?>
				</select>
				<br>
				<label class="form"><strong>Descripción:</strong></label><br>
				<input class="form form-control" type="text" name="descripcion_ubicacion" placeholder="Por ejemplo: Planta Cuernavaca / Oficinas CDMX" required maxlength="30"><br>
				<label class="form"><strong>Requisitos de acceso <i>(Opcional)</i>:</strong></label><br>
				<textarea class="form form-control" type="textarea" rows="3" name="req_acceso_ubicacion" placeholder="Por ejemplo: Cubrebocas, calzado de seguridad, tapones auditivos y cofia"></textarea><br>
				<center><input type="submit" class="btn btn-success" name="guardar_ubicacion" value="Guardar"></center><br>
			</form>
		</div>
	</body>
	</html>

	<?php include '../../../assets/subir.php'; 
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}?>
<script type="text/javascript" src="../../../js/subir.js"></script>
<script type="text/javascript" src="../../../js/busqueda_edificio.js"></script>