<?php session_start(); 
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	require '../../../config/conex.php';
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_jefatura.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>
		<div class="container col-sm-8 panel panel-body"><br><br>
			<a href="../jefatura/index.php" class="btn btn-primary volver"><img class="volver_pic" src="../../../assets/img/volver.png"><strong style="margin-left: 5px;">Volver al inicio</strong></a>
			<img class="empresa_pic" src="../../../assets/img/edificio.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Agregar Edificio Nuevo</h3><br>
			<div class="card">
				<div class="card bg-primary text-white"><center><h6><strong>Para poder registrar un edificio nuevo debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>
			<form method="POST" action="../../../config/permissions/add/add_building.php" class="border border-primary form-control">
				<label class="form"><strong>Empresa:</strong></label><br>
				<select class="form form-control" name="empresa">
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
				<label class="form"><strong>Descripción:</strong></label><br>
				<input class="form form-control" type="text" name="descripcion_edificio" placeholder="Por ejemplo: Planta Cuernavaca / Oficinas CDMX" required maxlength="50"><br>
				<label class="form"><strong>Calle:</strong></label><br>
				<input class="form form-control" type="text" name="calle_edificio" placeholder="Por ejemplo: XXXX XXXX" required maxlength="80"><br>
				<label class="form"><strong>Número Exterior:</strong></label><br>
				<input class="form form-control" type="number" name="num_ext_edificio" placeholder="Por ejemplo: XXXX" required maxlength="10"><br>
				<label class="form"><strong>Número Interior:</strong><i> (Opcional):</i></label><br>
				<input class="form form-control" type="number" name="num_int_edificio" placeholder="Por ejemplo: XXXX" maxlength="15"><br>
				<label class="form"><strong>Colonia:</strong></label><br>
				<input class="form form-control" type="text" name="colonia_edificio" placeholder="Por ejemplo: XXX. XXXXX" required maxlength="40"><br>
				<label class="form"><strong>Municipio:</strong></label><br>
				<input class="form form-control" type="text" name="municipio_edificio" placeholder="Por ejemplo: XXXXXXXX" required maxlength="40"><br>
				<label class="form"><strong>Entidad Federativa:</strong></label><br>
				<input class="form form-control" type="text" name="entidad_federativa_edificio" placeholder="Por ejemplo: XXXXXX" required maxlength="40"><br>
				<label class="form"><strong>Codigo Postal:</strong></label><br>
				<input class="form form-control" type="number" name="cp_edificio" placeholder="Por ejemplo: XXXXX" required maxlength="10"><br>
				<label class="form"><strong>Nombre del Contacto:</strong></label><br>
				<input class="form form-control" type="text" name="nombre_contacto_edificio" placeholder="Por ejemplo: XXXXXXXX XXXXXXX" required maxlength="30"><br>
				<label class="form"><strong>Puesto del Contacto:</strong></label><br>
				<input class="form form-control" type="text" name="puesto_contacto_edificio" placeholder="Por ejemplo: XXXXXXXXX XX XXXXXXX" required maxlength="30"><br>
				<label class="form"><strong>Correo del Contacto:</strong></label><br>
				<input class="form form-control" type="text" name="correo_contacto_edificio" placeholder="Por ejemplo: email@email.mx" required maxlength="100"><br>
				<label class="form"><strong>Teléfono del Contacto:</strong></label><br>
				<input class="form form-control" type="number" name="telefono_contacto_edificio" placeholder="Por ejemplo: XXXXXXXXXX" required maxlength="50"><br>
				<label class="form"><strong>Requisitos de acceso <i>(Opcional)</i>:</strong></label><br>
				<textarea class="form form-control" type="textarea" rows="3" name="req_acceso_edificio" placeholder="Por ejemplo: Cubrebocas, calzado de seguridad, tapones auditivos y cofia"></textarea><br>
				<center><input type="submit" class="btn btn-success" name="guardar_edificio" value="Guardar"></center><br>
			</form>
		</div>
		<div><br></div>

	</body>
	</html>

	<?php include '../../../assets/subir.php'; 
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}?>
<script type="text/javascript" src="../../../js/subir.js"></script>