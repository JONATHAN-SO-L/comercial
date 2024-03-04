<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<?php require '../../../assets/navs/nav_vendedor.php'; ?>
	<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	<link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
</head>
<body><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header"><br>
					<a href="../vendedor/index.php" class="btn btn-primary volver"><img class="volver_pic" src="../../../assets/img/volver.png"><strong style="margin-left: 5px;">Volver al inicio</strong></a>
					<img class="empresa_pic" src="../../../assets/img/listado.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Listado de empresas</h1><br>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-3 table-responsive">     
		<table class="table table-striped table-hover table-bordered">
			<thead class="table-primary">
				<tr>
					<th>Acción</th>
					<th>Empresa</th>
					<th>Edificio</th>
					<th>Ubicación</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-center">
							<a href="mod_empresa.php" class="btn btn-sm btn-success" target="_blank" title="Editar empresa"><img class="edit" src="../../../assets/img/empresa.png"></a>
							<a href="mod_edificio.php" class="btn btn-sm btn-warning" target="_blank" title="Editar edificio"><img class="edit" src="../../../assets/img/edificio.png"></a>
							<a href="mod_ubicacion.php" class="btn btn-sm btn-danger" target="_blank" title="Editar ubicación"><img class="edit" src="../../../assets/img/ubicacion.png"></a></td>
						<td>VECO S.A. de C.V.</td>
						<td>Planta</td>
						<td>Oficinas Administrativas</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
	</html>

	<?php include '../../../assets/subir.php'; ?>
	<script type="text/javascript" src="../../../js/subir.js"></script>