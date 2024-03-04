<?php session_start();
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_vendedor.php'; ?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header"><br>
						<a href="../vendedor/index.php" class="btn btn-primary volver"><img class="volver_pic" src="../../../assets/img/volver.png"><strong style="margin-left: 5px;">Volver al inicio</strong></a>
						<img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Registrar Levantamiento</h1><br>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card bg-primary text-white"><center><h6><strong>Para poder registrar un levantamiento nuevo debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>

			<form class="border border-primary form-control" method="POST" action="../../../config/permissions/add/add_general_data.php">
		<!---------------
		DATOS GENERALES
		---------------->
		<?php require '../../../config/conex.php';
		$vendedor = $_SESSION['nombre'];
		?>
		<font size=4 color="green" FACE="arial" class="col-sm-222 control-label">DATOS GENERALES</font>
		<br>
		<label class="form"><strong>Empresa:</strong></label><br>
		<select class="form form-control" name="empresa_lev" id="empresa_lev" required>
			<option value="0"> - Selecciona una empresa -</option>
			<?php
			$query = $con->prepare("SELECT * FROM empresas WHERE vendedor = :vendedor ORDER BY razon_social ASC");
			$query->bindParam(':vendedor', $vendedor);
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
			}?>
		</select>
		<br>
		<label class="form"><strong>Edificio:</strong></label><br>
		<select class="form form-control" name="edificio_lev" id="edificio_lev" required>
		</select>
		<br>
		<label class="form"><strong>Ubicación:</strong></label><br>
		<select class="form form-control" name="ubicacion_lev" id="ubicacion_lev" required>
		</select>
		<br>
		<label class="form"><strong>UMA:</strong></label><br>
		<input class="form form-control" type="number" name="uma_lev" placeholder="Por ejemplo: XXXXX" required maxlength="100"><br>
		<center><button type="submit" class="btn btn-success"><strong>Guardar</strong></button></center><br>
	</form><br>
</div>
</body>
</html>

<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>
<script type="text/javascript" src="../../../js/busqueda_edificio.js"></script>
<script type="text/javascript" src="../../../js/busqueda_ubicacion.js"></script>