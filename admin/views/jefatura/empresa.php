<?php session_start(); 
if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php require '../../../assets/navs/nav_jefatura.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>
		<div class="container col-sm-8 panel panel-body"><br><br>
			<a href="../vendedor/index.php" class="btn btn-primary volver"><img class="volver_pic" src="../../../assets/img/volver.png"><strong style="margin-left: 5px;">Volver al inicio</strong></a>
			<img class="empresa_pic" src="../../../assets/img/empresa.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Agregar Empresa Nueva</h3><br>
			<div class="card">
				<div class="card bg-primary text-white"><center><h6><strong>Para poder registrar una empresa nueva debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>
			<form method="POST" action="../../../config/permissions/add/add_company.php" class="border border-primary form-control">
				<label class="form"><strong>Razón Social:</strong></label><br>
				<input class="form form-control" type="text" name="razon_social" placeholder="Por ejemplo: VECO S.A. de C.V." required maxlength="100"><br>
				<label class="form"><strong>RFC</strong><i> (Opcional):</i></label><br>
				<input class="form form-control" type="text" name="rfc" placeholder="Por ejemplo: XAXX010101000" maxlength="20"><br>
				<label class="form"><strong>Calle:</strong></label><br>
				<input class="form form-control" type="text" name="calle_empresa" placeholder="Por ejemplo: XXXX XXXX" required maxlength="80"><br>
				<label class="form"><strong>Número Exterior:</strong></label><br>
				<input class="form form-control" type="number" name="num_ext_empresa" placeholder="Por ejemplo: XXXX" required maxlength="10"><br>
				<label class="form"><strong>Número Interior:</strong><i> (Opcional):</i></label><br>
				<input class="form form-control" type="number" name="num_int_empresa" placeholder="Por ejemplo: XXXX" maxlength="15"><br>
				<label class="form"><strong>Colonia:</strong></label><br>
				<input class="form form-control" type="text" name="colonia_empresa" placeholder="Por ejemplo: XXX. XXXXX" required maxlength="40"><br>
				<label class="form"><strong>Municipio:</strong></label><br>
				<input class="form form-control" type="text" name="municipio_empresa" placeholder="Por ejemplo: XXXXXXXX" required maxlength="40"><br>
				<label class="form"><strong>Entidad Federativa:</strong></label><br>
				<input class="form form-control" type="text" name="entidad_federativa_empresa" placeholder="Por ejemplo: XXXXXX" required maxlength="40"><br>
				<label class="form"><strong>Codigo Postal:</strong></label><br>
				<input class="form form-control" type="number" name="cp_empresa" placeholder="Por ejemplo: XXXXX" required maxlength="10"><br>
				<label class="form"><strong>Nombre del Contacto:</strong></label><br>
				<input class="form form-control" type="text" name="nombre_contacto_empresa" placeholder="Por ejemplo: XXXXXXXX XXXXXXX" required maxlength="30"><br>
				<label class="form"><strong>Puesto del Contacto:</strong></label><br>
				<input class="form form-control" type="text" name="puesto_contacto_empresa" placeholder="Por ejemplo: XXXXXXXXX XX XXXXXXX" required maxlength="30"><br>
				<label class="form"><strong>Correo del Contacto:</strong></label><br>
				<input class="form form-control" type="text" name="correo_contacto_empresa" placeholder="Por ejemplo: email@email.mx" required maxlength="100"><br>
				<label class="form"><strong>Teléfono del Contacto:</strong></label><br>
				<input class="form form-control" type="number" name="telefono_contacto_empresa" placeholder="Por ejemplo: XXXXXXXXXX" required maxlength="50"><br>
				<center><input type="submit" class="btn btn-success" name="guardar_empresa" value="Guardar"></center><br>
			</form>
		</div>
		<div><br></div>

	</body>
	</html>

	<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
} ?>
<script type="text/javascript" src="../../../js/subir.js"></script>