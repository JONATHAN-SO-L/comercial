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

	$jefe = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	// s_ = search / buscar
	$s_seller = $con->prepare("SELECT usuario FROM usuario_lev WHERE usuario = :jefe");
	$s_seller->bindValue(':jefe', $jefe);
	$s_seller->setFetchMode(PDO::FETCH_OBJ);
	$s_seller->execute();

	// f_ = found / encontrado
	$f_seller = $s_seller->fetchAll();

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
			<img class="empresa_pic" src="../../../assets/img/borrar2.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Eliminar Jefe Comercial: <strong><br><br>
				<?php

				if ($s_seller -> rowCount() > 0) {
					foreach ($f_seller as $value) {
						echo "<center>".$value -> usuario."</center>";
					}
				} else {
					echo "<br><br><div class='alert alert-danger'><center>No se encontraron jefes registrados</center></div>";
					echo "<script>console.log('Error al obtener datos de la consulta')</script>";
					exit();
				}

				?>					
			</strong></h3><br>
			<div class="card">
				<div class="card bg-danger text-white">
					<center>
						<h4><strong>¿Estás de acuerdo en eliminar este jefe comercial?</strong></h4>
					</center>
				</div>
			</div>

			<form method="POST" action="../../functions/drop/drop_boss_admin.php?<?php echo $jefe;?>" class="border border-danger form-control">
				<center><br>
					
					<?php
					switch ($_SESSION['tipo']) {
						case 'A':
						echo '<a class="btn btn-success" href="../../../admin/views/admin/jefes_lista.php">No, volver al listado</a>';
						break;

						case 'G':
						echo '<a class="btn btn-success" href="../../../admin/views/gerencia/jefes_lista.php">No, volver al listado</a>';
						break;
					}
					?>

					<input type="submit" name="drop_jefe" class="btn btn-danger" value="Eliminar jefe">
				</center><br>
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