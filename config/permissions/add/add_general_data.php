<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

require '../../conex.php';

/************************
Recepción de datos
************************/
$empresa = $_POST['empresa_lev'];
$edificio = $_POST['edificio_lev'];
$ubicacion = $_POST['ubicacion_lev'];
$uma = $_POST['uma_lev'];
$_SESSION['uma'] = $uma;
$uma_global = $_SESSION['uma'];
$vendedor = $_SESSION['nombre'];

/************************
Obtención de Hora y Fecha
************************/
setlocale(LC_TIME,"es_MX.UTF-8");
date_default_timezone_set ('America/Mexico_City');
$fecha_hora_inicio = date('Y-m-d H:i:s');

/*******************************
Validación de dato no almacenado
*******************************/
$search_data = $con->query("SELECT * FROM levantamientos WHERE uma = '$uma';");
$val_search = $search_data->fetch();

if ($val_search['uma'] == '') {
	/***************
	Caputra de datos
	****************/
	$up_data = $con->prepare("INSERT INTO levantamientos (empresa, edificio, ubicacion, uma, fecha_hora_inicio, vendedor) VALUES (?, ?, ?, ?, ?, ?);");
	$val_up_data = $up_data->execute([$empresa, $edificio, $ubicacion, $uma, $fecha_hora_inicio, $vendedor]);
	echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma_global.'">';
} else {
	/*****************************************
	Redirección al ya estar registrada la UMA
	*****************************************/
	include '../../../assets/navs/links.php'; ?>
	<br><div class="container-sm alert alert-danger">
		<center><strong>ERROR 001:</strong> La UMA <strong><?php echo $uma; ?></strong> ya existe, por favor verifica que la información sea correcta.</center><br>
		<center><a href="../../../admin/views/vendedor/levantamiento.php" class="btn btn-sm btn-danger"><strong>Verificar datos</strong></a></center>
	</div>
<?php } }else {
		echo '<meta http-equiv="refresh" content="0;../../../../index.php">';
	}

include '../../../assets/spinner.php';

?>