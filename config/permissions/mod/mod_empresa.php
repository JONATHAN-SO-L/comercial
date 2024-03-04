<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	require '../../conex.php';

	$empresa_id = $_SERVER['QUERY_STRING'];
	$vendedor = $_SESSION['nombre'];

	$company_search = $con->prepare("SELECT * FROM empresas WHERE id = :empresa_id");
	$company_search->bindValue(':empresa_id', $empresa_id);
	$company_search->setFetchMode(PDO::FETCH_OBJ);
	$company_search->execute();

	$company_found = $company_search->fetchAll();

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
			<img class="empresa_pic" src="../../../assets/img/empresa.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Editar Empresa Existente</h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Para poder editar una empresa existente debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>

			<form method="POST" action="../../functions/mod/mod_empresa.php?<?php echo $empresa_id; ?>" class="border border-danger form-control">
				<label class="form"><strong>Razón Social:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $rs) {

						echo '<input class="form form-control" type="text" name="razon_social" placeholder="Por ejemplo: VECO S.A. de C.V."  maxlength="100" readonly="" value="'.$rs->razon_social.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>RFC</strong><i> (Opcional):</i></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $rfc) {

						echo '<input class="form form-control" type="text" name="rfc" placeholder="Por ejemplo: XAXX010101000" maxlength="20" value="'.$rfc->rfc.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Calle:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $calle) {

						echo '<input class="form form-control" type="text" name="calle_empresa" placeholder="Por ejemplo: XXXX XXXX"  maxlength="80" value="'.$calle->calle.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Número Exterior:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $numero_exterior) {

						echo '<input class="form form-control" type="number" name="num_ext_empresa" placeholder="Por ejemplo: XXXX"  maxlength="10" value="'.$numero_exterior->numero_exterior.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Número Interior:</strong><i> (Opcional):</i></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $numero_interior) {

						echo '<input class="form form-control" type="number" name="num_int_empresa" placeholder="Por ejemplo: XXXX" maxlength="15" value="'.$numero_interior->numero_interior.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Colonia:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $colonia) {

						echo '<input class="form form-control" type="text" name="colonia_empresa" placeholder="Por ejemplo: XXX. XXXXX"  maxlength="40" value="'.$colonia->colonia.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Municipio:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $municipio) {

						echo '<input class="form form-control" type="text" name="municipio_empresa" placeholder="Por ejemplo: XXXXXXXX"  maxlength="40" value="'.$municipio->municipio.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Entidad Federativa:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $entidad_federativa) {

						echo '<input class="form form-control" type="text" name="entidad_federativa_empresa" placeholder="Por ejemplo: XXXXXX"  maxlength="40" value="'.$entidad_federativa->entidad_federativa.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Codigo Postal:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $codigo_postal) {

						echo '<input class="form form-control" type="number" name="cp_empresa" placeholder="Por ejemplo: XXXXX"  maxlength="10" value="'.$codigo_postal->codigo_postal.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Nombre del Contacto:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $contacto_nombre) {

						echo '<input class="form form-control" type="text" name="nombre_contacto_empresa" placeholder="Por ejemplo: XXXXXXXX XXXXXXX"  maxlength="30" value="'.$contacto_nombre->contacto_nombre.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Puesto del Contacto:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $contacto_puesto) {

						echo '<input class="form form-control" type="text" name="puesto_contacto_empresa" placeholder="Por ejemplo: XXXXXXXXX XX XXXXXXX"  maxlength="30" value="'.$contacto_puesto->contacto_puesto.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Correo del Contacto:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $contacto_email) {

						echo '<input class="form form-control" type="text" name="correo_contacto_empresa" placeholder="Por ejemplo: email@email.mx"  maxlength="100" value="'.$contacto_email->contacto_email.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label class="form"><strong>Teléfono del Contacto:</strong></label><br>
				<?php
				if ($company_search -> rowCount() > 0) {
					foreach ($company_found as $contacto_telefono) {

						echo '<input class="form form-control" type="number" name="telefono_contacto_empresa" placeholder="Por ejemplo: XXXXXXXXXX"  maxlength="50" value="'.$contacto_telefono->contacto_telefono.'"><br>';

					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<center><input type="submit" class="btn btn-success" name="guardar_empresa" value="Guardar"></center><br>
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