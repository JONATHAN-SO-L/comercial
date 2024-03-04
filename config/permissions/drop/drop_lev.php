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

	$uma = $_SERVER['QUERY_STRING'];
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>
		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/borrar2.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Eliminar permanentemente Levantamiento de UMA: <strong><?php echo $uma; ?></strong></h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h4><strong>¿Estás de acuerdo en elminiar este registro?</strong></h4></center></div>
			</div>

			<form method="POST" action="../../functions/drop/drop_lev.php?<?php echo $uma;?>" class="border border-danger form-control">
				<center>
					<input type="submit" name="drop_lev" class="btn btn-danger" value="Si, eliminar">
					<?php
					switch ($_SESSION['tipo']) {
						case 'A':
						echo "<a href='../../../admin/views/admin/index.php' class='btn btn-success'>No, cancelar</a>";
						break;

						case 'G':
						echo "<a href='../../../admin/views/gerencia/index.php' class='btn btn-success'>No, cancelar</a>";
						break;
					}
					?>
				</center>
			</form>

			</div>

		</body>
		</html>

		<?php include '../../../assets/subir.php';
	} else {
		echo '<meta http-equiv="refresh" content="0;../../../index.php">';
	}
	?>
	<script type="text/javascript" src="../../../js/subir.js"></script>