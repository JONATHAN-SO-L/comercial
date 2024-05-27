<?php 
session_start(); 

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	require '../../../config/conex.php';

/****************
Obtención de UMA
****************/
$uma = $_SERVER['QUERY_STRING'];
$_SESSION['uma'] = $uma;
$uma = $_SESSION['uma'];

//Buscar si ya están registrados todos los filtros capturados
$s_tapes = $con->prepare("SELECT filtros_etp1 FROM levantamientos WHERE uma = :uma");
$s_tapes->bindValue(':uma', $uma);
$s_tapes->setFetchMode(PDO::FETCH_OBJ);
$s_tapes->execute();
//Encontrar las etapas
$f_tapes = $s_tapes->fetchAll();
foreach ($f_tapes as $valor) {
	$filtros = $valor -> filtros_etp1;
}

//Buscar si el ciclo ya fue iniciado
$buscar_loop = $con->prepare("SELECT ciclos FROM levantamientos WHERE uma = :uma");
$buscar_loop->bindValue(':uma', $uma);
$buscar_loop->setFetchMode(PDO::FETCH_OBJ);
$buscar_loop->execute();
//Encontrar el valor del ciclo
$encontrar_loop = $buscar_loop->fetchAll();
foreach ($encontrar_loop as $item) {
	$ciclo = $item -> ciclos;

	if ($ciclo == NULL) {
		$ciclo = 1;
		$up_loop = $con->prepare("UPDATE levantamientos SET ciclos = ? WHERE uma = ?");
		$up_loop->execute([$ciclo, $uma]);
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
	} elseif ($ciclo <= $filtros) {
?>

<!DOCTYPE html>
<html>
<head>
	<?php include '../../../assets/navs/links.php'; 
	include '../../../assets/navs/nav_vendedor.php';?>
	<link rel="stylesheet" type="text/css" href="../../../css/company.css">
</head>
<body><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Registro de UMA: <strong><?php echo $uma; ?></strong></h1><br>
				</div>
			</div>
		</div>
		
		<?php
			switch ($ciclo) {
				case '1':
				//Buscar si ya existe una familia registrada
				$s_family = $con->prepare("SELECT familia_etp1 FROM levantamientos WHERE uma = :uma");
				$s_family->bindValue(':uma', $uma);
				$s_family->setFetchMode(PDO::FETCH_OBJ);
				$s_family->execute();

				//Encontar la familia existente
				$f_family = $s_family->fetchAll();

				foreach ($f_family as $item) {
				$familia = $item -> familia_etp1;
				}

				//Buscar modelo existente
				$s_model = $con->prepare("SELECT modelo_etp1 FROM levantamientos WHERE uma = :uma");
				$s_model->bindValue(':uma', $uma);
				$s_model->setFetchMode(PDO::FETCH_OBJ);
				$s_model->execute();

				//Encontrar el modelo existente
				$f_model = $s_model->fetchAll();

				foreach ($f_model as $value) {
				$modelo = $value -> modelo_etp1;
				}

				if ($familia == NULL) { ?>

				<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Selecciona la familia con la que trabajarás</strong></h6></center></div>
				</div>

				<!----------------------------
				LISTADO DE FAMILIAS DE FILTROS
				----------------------------->
				<div class="card bg-black text-white"><center><h6><strong><?php echo'Código de filtro '.$ciclo.' de '.$filtros.''; ?></strong></h6></center></div>
				<form class="border border-danger form-control"  method="POST" action="../../../config/functions/add/insert_fam.php?<?php echo $uma; ?>">
				<label><strong>Familia:</strong></label>
				<select name="familia" class="form-control" id="familia" required>
				<option value=""> - Selecciona la familia - </option>
				<option value="HEPA">ABS - Absolutos (HEPA)</option>
				</select><br>
				<input type="hidden" value="1" name="etapa">
				<input type="hidden" value="1" name="ciclo">
				<center><input class="btn btn-success" type="submit" value="Guardar" name="guardar_familia"></center>
				</form>

				<?php } elseif ($modelo == NULL) { ?>

				<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Selecciona el modelo con la que trabajarás</strong></h6></center></div>
				</div>

				<!------------------------------------------------
				LISTADO DE MODELOS DE FILTROS EN BASE A LA FAMILIA
				------------------------------------------------->
				<div class="card bg-black text-white"><center><h6><strong><?php echo'Código de filtro '.$ciclo.' de '.$filtros.''; ?></strong></h6></center></div>
				<form class="border border-danger form-control"  method="POST" action="../../../config/functions/add/insert_model.php?<?php echo $uma; ?>">
				<label><strong>Modelo:</strong></label>

				<?php
				switch ($familia) {
				case 'HEPA':?>
				<select name="modelo" class="form-control" required>
				<option value=""> - Selecciona el modelo - </option>
				<option value="HE95T22SMMAGDF4R">HE95T22SMMAGDF4R - (Modelo de prueba)</option>
				<option value="HET5WSMML2500">HET5WSMML2500 - (Modelo de prueba)</option>
				</select><br>
				<?php
				break;
				}
				?>

				<input type="hidden" value="1" name="etapa">
				<input type="hidden" value="1" name="ciclo">
				<center><input class="btn btn-success" type="submit" value="Guardar" name="guardar_modelo"></center>
				</form>

				<?php } else { ?>

				<div class="card">
				<div class="card bg-black text-white"><center><h6><strong><?php echo'Código de filtro '.$ciclo.' de '.$filtros.''; ?></strong></h6></center></div>
				<div class="card bg-danger text-white"><center><h6><strong>ETAPA 1</strong></h6></center></div>
				</div>

				<form class="border border-danger form-control"  method="POST" action="../../../config/permissions/add/add_stage1.php" enctype="multipart/form-data">
				<?php
				switch ($familia) {
				case 'HEPA': ?>
				<label><strong>Modelo:</strong></label><br>
				<label><strong><h3><u><?php echo $modelo; ?></u></h3></strong></label><br><br>

				<label><strong>Sello:</strong></label>
				<select name="sello_etp1" id="sello" class="form-control" required onclick="toggle(this)">
				<option value="0"> - Elige el tipo de sello - </option>
				<option value="Neopreno">Neopreno</option>
				<option value="Gel">Gel</option>
				</select><br>

				<!---------------------
				DESPLEGABLE DE NEOPRENO
				---------------------->
				<div class="neopreno">
				<label><strong>Código de Filtro:</strong></label>
				<input type="text" name="codigo_etp1_neopreno" class="form-control"  placeholder="Ingresa el código del filtro correspondiente" maxlength="50"><br>

				<label><strong>Eficiencia PAO:</strong></label>
				<select name="eficiencia_etp1_neopreno" class="form-control">
				<option> - Selecciona la eficiencia PAO - </option>
				<option value="99.97%">99.97% PAO</option>
				<option value="99.99%">99.99% PAO</option>
				<option value="99.995%">99.995% PAO</option>
				<option value="99.997%">99.997% PAO</option>
				<option value="99.999%">99.999% PAO</option>
				<option value="99.9995%">99.9995% PAO</option>
				</select><br>

				<label><strong>Plenum:</strong></label>
				<select name="plenum_etp1_neopreno" class="form-control" >
				<option> - Elige la opción adecuada - </option>
				<option value="N/A">No aplica | Sin plenum</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>

				<label><strong>Tipo de marco:</strong></label>
				<select name="marco_etp1_neopreno" class="form-control" >
				<option> - Elige el tipo de marco correcto - </option>
				<option value="Acero Inoxidable">Acero Inoxidable</option>
				<option value="Aluminio">Aluminio</option>
				<option value="Madera">Madera</option>
				<option value="Lamina galvanizada">Lámina galvanizada</option>
				</select><br>

				<label><strong>Tipo de Construcción:</strong></label>
				<select name="construccion_etp1_neopreno" class="form-control" >
				<option> - Selecciona el tipo de construcción - </option>
				<option value="No aplica">No aplica</option>
				<option value="Caja">Caja</option>
				<option value="W">W</option>
				</select><br>

				<label><strong>Tipo de Separador:</strong></label>
				<select name="separador_etp1_neopreno" class="form-control" >
				<option> - Selecciona el tipo de separador - </option>
				<option value="Minipleat">Minipleat</option>
				<option value="Aluminio">Aluminio</option>
				</select><br>

				<label><strong>Alta Capacidad:</strong></label>
				<select name="alta_capacidad_etp1_neopreno" class="form-control" onclick="alta_capa(this)">
				<option value="0"> - Elige el valor que consideres correcto - </option>
				<option value="Si">Si</option>
				<option value="No">No</option>
				</select><br>

				<div class="alta_capa">
				<input type="text" name="alta_capacidad_etp1_neopreno" class="form-control"  placeholder="Ingresa el valor correspondiente" maxlength="20"><br>
				</div>

				<label><strong>Rejilla:</strong></label>
				<select name="rejilla_etp1_neopreno" class="form-control" >
				<option> - Elige el tipo de rejilla - </option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>

				<label><strong>Fotos <i>(Opcional | La primera imagen será la que se muestre en el PDF)</i>:</strong></label>
				<input type="file" name="foto_1_etp1_neopreno[]" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple><br>
				</div>

				<!----------------
				DESPLEGABLE DE GEL
				----------------->
				<div class="gel">
				<label><strong>Código de Filtro:</strong></label>
				<input type="text" name="codigo_etp1_gel" class="form-control"  placeholder="Ingresa el código del filtro correspondiente" maxlength="50"><br>

				<label><strong>Eficiencia PAO:</strong></label>
				<select name="eficiencia_etp1_gel" class="form-control" >
				<option> - Selecciona la eficiencia PAO - </option>
				<option value="99.97%">99.97% PAO</option>
				<option value="99.99%">99.99% PAO</option>
				<option value="99.995%">99.995% PAO</option>
				<option value="99.997%">99.997% PAO</option>
				<option value="99.999%">99.999% PAO</option>
				<option value="99.9995%">99.9995% PAO</option>
				</select><br>

				<label><strong>Tipo de marco:</strong></label>
				<select name="marco_etp1_gel" class="form-control" >
				<option> - Elige el tipo de marco correcto - </option>
				<option value="Acero Inoxidable">Acero Inoxidable</option>
				<option value="Aluminio">Aluminio</option>
				</select><br>

				<label><strong>Tipo de Separador:</strong></label>
				<select name="separador_etp1_gel" class="form-control" >
				<option> - Selecciona el tipo de separador - </option>
				<option value="Minipleat">Minipleat</option>
				</select><br>

				<label><strong>Perfil del Gel:</strong></label>
				<select name="perfil_gel_etp1_gel" class="form-control" >
				<option> - Elige el perfil - </option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada de Aire">Entrada de Aire</option>
				<option value="Salida de Aire">Salida de Aire</option>
				</select><br>

				<label><strong>Fondo Nominal:</strong></label>
				<select name="fondo_nom_etp1_gel" class="form-control" >
				<option> - Elige las medidas correspondientes - </option>
				<option value="5">5</option>
				<option value="3.5">3.5</option>
				<option value="2.875">2.875</option>
				</select><br>

				<label><strong>Unidad de Medida Nominal:</strong></label>
				<select name="um_nominal_etp1_gel" class="form-control" >
				<option> - Selecciona la unidad de medida disponible - </option>
				<option value="in">Pulgadas</option>
				</select><br>

				<label><strong>Rejilla:</strong></label>
				<select name="rejilla_etp1_gel" class="form-control" >
				<option> - Elige el tipo de rejilla - </option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>

				<label><strong>Fotos <i>(Opcional | La primera imagen será la que se muestre en el PDF)</i>:</strong></label>
				<input type="file" name="foto_1_etp1_gel[]" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple><br>
				</div>

				<?php 
				break;
				}
				?>

				<center><button type="submit" class="btn btn-success" name="guardar_etp1"><strong>Guardar</strong></button></center><br>
				</form><br>

				<?php }?>

				</div>

				</body>
				</html>
					
				<?php break;

				case '2':
				//Buscar si ya existe una familia registrada
				$s_family = $con->prepare("SELECT familia_etp1_2 FROM levantamientos WHERE uma = :uma");
				$s_family->bindValue(':uma', $uma);
				$s_family->setFetchMode(PDO::FETCH_OBJ);
				$s_family->execute();

				//Encontar la familia existente
				$f_family = $s_family->fetchAll();

				foreach ($f_family as $item) {
				$familia = $item -> familia_etp1_2;
				}

				//Buscar modelo existente
				$s_model = $con->prepare("SELECT modelo_etp1_2 FROM levantamientos WHERE uma = :uma");
				$s_model->bindValue(':uma', $uma);
				$s_model->setFetchMode(PDO::FETCH_OBJ);
				$s_model->execute();

				//Encontrar el modelo existente
				$f_model = $s_model->fetchAll();

				foreach ($f_model as $value) {
				$modelo = $value -> modelo_etp1_2;
				}

				if ($familia == NULL) { ?>

				<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Selecciona la familia con la que trabajarás</strong></h6></center></div>
				</div>

				<!----------------------------
				LISTADO DE FAMILIAS DE FILTROS
				----------------------------->
				<div class="card bg-black text-white"><center><h6><strong><?php echo'Código de filtro '.$ciclo.' de '.$filtros.''; ?></strong></h6></center></div>
				<form class="border border-danger form-control"  method="POST" action="../../../config/functions/add/insert_fam.php?<?php echo $uma; ?>">
				<label><strong>Familia:</strong></label>
				<select name="familia" class="form-control" id="familia" required>
				<option value=""> - Selecciona la familia - </option>
				<option value="HEPA">ABS - Absolutos (HEPA)</option>
				</select><br>
				<input type="hidden" value="1" name="etapa">
				<input type="hidden" value="2" name="ciclo">
				<center><input class="btn btn-success" type="submit" value="Guardar" name="guardar_familia"></center>
				</form>

				<?php } elseif ($modelo == NULL) { ?>

				<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Selecciona el modelo con la que trabajarás</strong></h6></center></div>
				</div>

				<!------------------------------------------------
				LISTADO DE MODELOS DE FILTROS EN BASE A LA FAMILIA
				------------------------------------------------->
				<div class="card bg-black text-white"><center><h6><strong><?php echo'Código de filtro '.$ciclo.' de '.$filtros.''; ?></strong></h6></center></div>
				<form class="border border-danger form-control"  method="POST" action="../../../config/functions/add/insert_model.php?<?php echo $uma; ?>">
				<label><strong>Modelo:</strong></label>

				<?php
				switch ($familia) {
				case 'HEPA':?>
				<select name="modelo" class="form-control" required>
				<option value=""> - Selecciona el modelo - </option>
				<option value="HE95T22SMMAGDF4R">HE95T22SMMAGDF4R - (Modelo de prueba)</option>
				<option value="HET5WSMML2500">HET5WSMML2500 - (Modelo de prueba)</option>
				</select><br>
				<?php
				break;
				}
				?>

				<input type="hidden" value="1" name="etapa">
				<input type="hidden" value="2" name="ciclo">
				<center><input class="btn btn-success" type="submit" value="Guardar" name="guardar_modelo"></center>
				</form>

				<?php } else { ?>

				<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>ETAPA 1</strong></h6></center></div>
				</div>

				<form class="border border-danger form-control"  method="POST" action="../../../config/permissions/add/add_stage1.php" enctype="multipart/form-data">

				<?php
				switch ($familia) {
				case 'HEPA': ?>
				<label><strong>Modelo:</strong></label><br>
				<label><strong><h3><u><?php echo $modelo; ?></u></h3></strong></label><br><br>

				<label><strong>Sello:</strong></label>
				<select name="sello_etp1_2" id="sello" class="form-control" required onclick="toggle(this)">
				<option value="0"> - Elige el tipo de sello - </option>
				<option value="Neopreno">Neopreno</option>
				<option value="Gel">Gel</option>
				</select><br>

				<!---------------------
				DESPLEGABLE DE NEOPRENO
				---------------------->
				<div class="neopreno">
				<label><strong>Código de Filtro:</strong></label>
				<input type="text" name="codigo_etp1_2_neopreno" class="form-control"  placeholder="Ingresa el código del filtro correspondiente" maxlength="50"><br>

				<label><strong>Eficiencia PAO:</strong></label>
				<select name="eficiencia_etp1_2_neopreno" class="form-control">
				<option> - Selecciona la eficiencia PAO - </option>
				<option value="99.97%">99.97% PAO</option>
				<option value="99.99%">99.99% PAO</option>
				<option value="99.995%">99.995% PAO</option>
				<option value="99.997%">99.997% PAO</option>
				<option value="99.999%">99.999% PAO</option>
				<option value="99.9995%">99.9995% PAO</option>
				</select><br>

				<label><strong>Plenum:</strong></label>
				<select name="plenum_etp1_2_neopreno" class="form-control" >
				<option> - Elige la opción adecuada - </option>
				<option value="N/A">No aplica | Sin plenum</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>

				<label><strong>Tipo de marco:</strong></label>
				<select name="marco_etp1_2_neopreno" class="form-control" >
				<option> - Elige el tipo de marco correcto - </option>
				<option value="Acero Inoxidable">Acero Inoxidable</option>
				<option value="Aluminio">Aluminio</option>
				<option value="Madera">Madera</option>
				<option value="Lamina galvanizada">Lámina galvanizada</option>
				</select><br>

				<label><strong>Tipo de Construcción:</strong></label>
				<select name="construccion_etp1_2_neopreno" class="form-control" >
				<option> - Selecciona el tipo de construcción - </option>
				<option value="No aplica">No aplica</option>
				<option value="Caja">Caja</option>
				<option value="W">W</option>
				</select><br>

				<label><strong>Tipo de Separador:</strong></label>
				<select name="separador_etp1_2_neopreno" class="form-control" >
				<option> - Selecciona el tipo de separador - </option>
				<option value="Minipleat">Minipleat</option>
				<option value="Aluminio">Aluminio</option>
				</select><br>

				<label><strong>Alta Capacidad:</strong></label>
				<select name="alta_capacidad_etp1_2_neopreno" class="form-control" onclick="alta_capa(this)">
				<option value="0"> - Elige el valor que consideres correcto - </option>
				<option value="Si">Si</option>
				<option value="No">No</option>
				</select><br>

				<div class="alta_capa">
				<input type="text" name="alta_capacidad_etp1_2_neopreno" class="form-control"  placeholder="Ingresa el valor correspondiente" maxlength="20"><br>
				</div>

				<label><strong>Rejilla:</strong></label>
				<select name="rejilla_etp1_2_neopreno" class="form-control" >
				<option> - Elige el tipo de rejilla - </option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>

				<label><strong>Fotos <i>(Opcional | La primera imagen será la que se muestre en el PDF)</i>:</strong></label>
				<input type="file" name="foto_1_etp1_2_neopreno[]" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple><br>
				</div>

				<!----------------
				DESPLEGABLE DE GEL
				----------------->
				<div class="gel">
				<label><strong>Código de Filtro:</strong></label>
				<input type="text" name="codigo_etp1_2_gel" class="form-control"  placeholder="Ingresa el código del filtro correspondiente" maxlength="50"><br>

				<label><strong>Eficiencia PAO:</strong></label>
				<select name="eficiencia_etp1_2_gel" class="form-control" >
				<option> - Selecciona la eficiencia PAO - </option>
				<option value="99.97%">99.97% PAO</option>
				<option value="99.99%">99.99% PAO</option>
				<option value="99.995%">99.995% PAO</option>
				<option value="99.997%">99.997% PAO</option>
				<option value="99.999%">99.999% PAO</option>
				<option value="99.9995%">99.9995% PAO</option>
				</select><br>

				<label><strong>Tipo de marco:</strong></label>
				<select name="marco_etp1_2_gel" class="form-control" >
				<option> - Elige el tipo de marco correcto - </option>
				<option value="Acero Inoxidable">Acero Inoxidable</option>
				<option value="Aluminio">Aluminio</option>
				</select><br>

				<label><strong>Tipo de Separador:</strong></label>
				<select name="separador_etp1_2_gel" class="form-control" >
				<option> - Selecciona el tipo de separador - </option>
				<option value="Minipleat">Minipleat</option>
				</select><br>

				<label><strong>Perfil del Gel:</strong></label>
				<select name="perfil_gel_etp1_2_gel" class="form-control" >
				<option> - Elige el perfil - </option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada de Aire">Entrada de Aire</option>
				<option value="Salida de Aire">Salida de Aire</option>
				</select><br>

				<label><strong>Fondo Nominal:</strong></label>
				<select name="fondo_nom_etp1_2_gel" class="form-control" >
				<option> - Elige las medidas correspondientes - </option>
				<option value="5">5</option>
				<option value="3.5">3.5</option>
				<option value="2.875">2.875</option>
				</select><br>

				<label><strong>Unidad de Medida Nominal:</strong></label>
				<select name="um_nominal_etp1_2_gel" class="form-control" >
				<option> - Selecciona la unidad de medida disponible - </option>
				<option value="in">Pulgadas</option>
				</select><br>

				<label><strong>Rejilla:</strong></label>
				<select name="rejilla_etp1_2_gel" class="form-control" >
				<option> - Elige el tipo de rejilla - </option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>

				<label><strong>Fotos <i>(Opcional | La primera imagen será la que se muestre en el PDF)</i>:</strong></label>
				<input type="file" name="foto_1_etp1_2_gel[]" class="form-control" accept="image/png, image/jpg, image/jpeg" multiple><br>
				</div>

				<?php 
				break;
				}
				?>

				<center><button type="submit" class="btn btn-success" name="guardar_etp1"><strong>Guardar</strong></button></center><br>
				</form><br>

				<?php }?>

				</div>

				</body>
				</html>

				<?php
				break;

				default:
				echo '<script>alert("No hay valor en el ciclo: '.$ciclo.'. Por favor contácta al soporte técnico e inténtalo de nuevo")</script>';
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/sel_tape.php?'.$uma.'">';
				break;
			}

	} else {
		echo '<script>alert("La cantidad de filtros son: '.$filtros.' y el ciclo lleva '.$ciclo.' ciclos")</script>';
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/sel_tape.php?'.$uma.'">';
	}
}
		
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>
<script type="text/javascript" src="../../../js/limite_img.js"></script>
<script type="text/javascript" src="../../../js/functions.js"></script>