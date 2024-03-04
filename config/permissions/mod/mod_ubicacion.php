<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { 

	require '../../conex.php';

	$ubicacion_id = $_SERVER['QUERY_STRING'];
	$vendedor = $_SESSION['nombre'];

	$locate_search = $con->prepare("SELECT * FROM ubicacion WHERE id_ubicacion = :ubicacion_id");
	$locate_search->bindValue(':ubicacion_id', $ubicacion_id);
	$locate_search->setFetchMode(PDO::FETCH_OBJ);
	$locate_search->execute();

	$locate_found = $locate_search->fetchAll();

	?>

	<!DOCTYPE html>
	<html>
	<head><br><br>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body>
		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/ubicacion.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Editar Ubicación Exitente</h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Para poder editar una ubicación debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>
			<form method="POST" action=".../../../../functions/mod/mod_ubicacion.php?<?php echo $ubicacion_id ?>" class="border border-danger form-control">
				<label class="form"><strong>Empresa:</strong></label><br>
				<?php
				if ($locate_search -> rowCount() > 0) {
					foreach ($locate_found as $empresa) {

						$empresa_id = $empresa->empresa_id;
						$company_search = $con->prepare("SELECT * FROM empresas WHERE id = '$empresa_id';");
						$company_search->setFetchMode(PDO::FETCH_OBJ);
						$company_search->execute();

						$company_found = $company_search->fetchAll();

						if ($company_search -> rowCount() > 0) {
							foreach ($company_found as $rs) {
								$rs->razon_social;
							}
						} else {
							echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
							echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
							exit();
						}

						echo '<input class="form form-control" type="hidden" name="empresa" placeholder="Por ejemplo: VECO S.A. de C.V."  maxlength="100" readonly="" value="'.$empresa->empresa_id.'">';
						echo '<input class="form form-control" type="text" readonly="" value="'.$rs->razon_social.'">';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>
				<br>
				<label class="form"><strong>Edificio:</strong></label><br>
				<?php
				if ($locate_search -> rowCount() > 0) {
					foreach ($locate_found as $edificio) {

						$id_edificio = $edificio->edificio_id;
						$build_search = $con->prepare("SELECT * FROM edificio WHERE id_edificio = '$id_edificio';");
						$build_search->setFetchMode(PDO::FETCH_OBJ);
						$build_search->execute();

						$build_found = $build_search->fetchAll();

						if ($build_search -> rowCount() > 0) {
							foreach ($build_found as $edi) {
								$edi->descripcion;
							}
						} else {
							echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
							echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
							exit();
						}

						echo '<input class="form form-control" type="hidden" name="edificio" placeholder="Por ejemplo: VECO S.A. de C.V."  maxlength="100" readonly="" value="'.$edificio->edificio_id.'">';
						echo '<input class="form form-control" type="text" readonly="" value="'.$edi->descripcion.'">';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>
				<br>
				<label class="form"><strong>Descripción:</strong></label><br>
				<?php
				if ($locate_search -> rowCount() > 0) {
					foreach ($locate_found as $descripcion) {

						echo '<input class="form form-control" type="text" name="descripcion_ubicacion" placeholder="Por ejemplo: Planta Cuernavaca / Oficinas CDMX"  maxlength="30" value="'.$descripcion->ubicacion.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Requisitos de acceso <i>(Opcional)</i>:</strong></label><br>
				<?php
				if ($locate_search -> rowCount() > 0) {
					foreach ($locate_found as $requisitos_acceso) {

						echo '<input class="form form-control" type="textarea" rows="3" name="req_acceso_ubicacion" placeholder="Por ejemplo: Cubrebocas, calzado de seguridad, tapones auditivos y cofia" value="'.$requisitos_acceso->requisitos_acc.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

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