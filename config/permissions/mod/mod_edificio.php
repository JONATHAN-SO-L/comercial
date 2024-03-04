<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	require '../../conex.php';

	$edificio_id = $_SERVER['QUERY_STRING'];
	$vendedor = $_SESSION['nombre'];

	$build_search = $con->prepare("SELECT * FROM edificio WHERE id_edificio = :edificio_id");
	$build_search->bindValue(':edificio_id', $edificio_id);
	$build_search->setFetchMode(PDO::FETCH_OBJ);
	$build_search->execute();

	$build_found = $build_search->fetchAll();

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
			<img class="empresa_pic" src="../../../assets/img/edificio.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Editar Edificio Existente</h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Para poder editar un edificio debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>

			<form method="POST" action="../../functions/mod/mod_edificio.php?<?php echo $edificio_id; ?>" class="border border-danger form-control">
				<label class="form"><strong>Empresa:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $empresa) {

						$empresa_id = $empresa->empresa_id;
						$company_search = $con->prepare("SELECT * FROM empresas WHERE id = '$empresa_id'");
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
						echo '<input class="form form-control" type="text" readonly="" value="'.$rs->razon_social.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Descripción:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $descripcion) {

						echo '<input class="form form-control" type="text" name="descripcion_edificio" placeholder="Por ejemplo: Planta Cuernavaca / Oficinas CDMX"  maxlength="50" value="'.$descripcion->descripcion.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Calle:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $calle) {

						echo '<input class="form form-control" type="text" name="calle_edificio" placeholder="Por ejemplo: XXXX XXXX"  maxlength="80" value="'.$calle->calle.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Número Exterior:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $numero_exterior) {

						echo '<input class="form form-control" type="number" name="num_ext_edificio" placeholder="Por ejemplo: XXXX"  maxlength="10" value="'.$numero_exterior->numero_exterior.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Número Interior:</strong><i> (Opcional):</i></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $numero_interior) {

						echo '<input class="form form-control" type="number" name="num_int_edificio" placeholder="Por ejemplo: XXXX" maxlength="15" value="'.$numero_interior->numero_interior.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Colonia:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $colonia) {

						echo '<input class="form form-control" type="text" name="colonia_edificio" placeholder="Por ejemplo: XXX. XXXXX"  maxlength="40" value="'.$colonia->colonia.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Municipio:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $municipio) {

						echo '<input class="form form-control" type="text" name="municipio_edificio" placeholder="Por ejemplo: XXXXXXXX"  maxlength="40" value="'.$municipio->municipio.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Entidad Federativa:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $entidad_federativa) {

						echo '<input class="form form-control" type="text" name="entidad_federativa_edificio" placeholder="Por ejemplo: XXXXXX"  maxlength="40" value="'.$entidad_federativa->entidad_federativa.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Codigo Postal:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $codigo_postal) {

						echo '<input class="form form-control" type="number" name="cp_edificio" placeholder="Por ejemplo: XXXXX"  maxlength="10" value="'.$codigo_postal->codigo_postal.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Nombre del Contacto:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $contacto_nombre) {

						echo '<input class="form form-control" type="text" name="nombre_contacto_edificio" placeholder="Por ejemplo: XXXXXXXX XXXXXXX"  maxlength="30" value="'.$contacto_nombre->contacto_nombre.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Puesto del Contacto:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $contacto_puesto) {

						echo '<input class="form form-control" type="text" name="puesto_contacto_edificio" placeholder="Por ejemplo: XXXXXXXXX XX XXXXXXX"  maxlength="30" value="'.$contacto_puesto->contacto_puesto.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Correo del Contacto:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $contacto_email) {

						echo '<input class="form form-control" type="text" name="correo_contacto_edificio" placeholder="Por ejemplo: email@email.mx"  maxlength="100" value="'.$contacto_email->contacto_email.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Teléfono del Contacto:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $contacto_telefono) {

						echo '<input class="form form-control" type="number" name="telefono_contacto_edificio" placeholder="Por ejemplo: XXXXXXXXXX"  maxlength="50" value="'.$contacto_telefono->contacto_telefono.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Requisitos de acceso <i>(Opcional)</i>:</strong></label><br>
				<?php
				if ($build_search -> rowCount() > 0) {
					foreach ($build_found as $requisitos_acceso) {

						echo '<input class="form form-control" type="textarea" rows="3" name="req_acceso_edificio" placeholder="Por ejemplo: Cubrebocas, calzado de seguridad, tapones auditivos y cofia" value="'.$requisitos_acceso->requisitos_acceso.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay edificios a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<center><input type="submit" class="btn btn-success" name="guardar_edificio" value="Guardar"></center><br>
			</form>
		</div>
		<div><br></div>

	</body>
	</html>

	<?php include '../../../assets/subir.php';

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>
<script type="text/javascript" src="../../../js/subir.js"></script>