<?php
session_start();

if ($_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../admin/views/vendedor">';
		break;
	}

	if (isset($_POST['levantamientos_csv'])) {

		include '../conexi.php';
		$delimiter = ",";

		$fecha1 = $_POST['fecha1_csv'];
		$fecha2 = $_POST['fecha2_csv'];

		$filename = "Levantamientos del ".$fecha1." al ".$fecha2.".csv";

    //create a file pointer
		$f = fopen('php://memory', 'a');

    //crea los encabezados de las columnas
		$fields = array('Empresa', 'Edificio', 'Ubicacion', 'UMA', 'Comentarios Etapa 3', 'Observaciones Etapa 3', 'Fecha y Hora de Inicio', 'Fecha y Hora de la Ultima Modificacion', 'Fecha y Hora de Finalizacion', 'Vendedor');
		fputcsv($f, $fields, $delimiter);

    //extrae cada fila de datos, les da formato csv y los escribe en fichero creado
		$value="SELECT * FROM levantamientos WHERE fecha_hora_inicio BETWEEN '$fecha1' AND '$fecha2'";
		$result = $mysqli->query($value);
		while($d = $result->fetch_assoc()){

			$com = $d['empresa'];
			$empresa = "SELECT razon_social FROM empresas, levantamientos WHERE empresas.id = levantamientos.empresa AND levantamientos.empresa = '$com'";
			$empresa = $mysqli->query($empresa);
			while ($company = $empresa->fetch_assoc()) {
				$empre = $company['razon_social'];
			}

			$build = $d['edificio'];
			$edificio = "SELECT descripcion FROM edificio, levantamientos WHERE edificio.id_edificio = levantamientos.edificio AND levantamientos.edificio = '$build'";
			$edificio = $mysqli->query($edificio);
			while ($building = $edificio->fetch_assoc()) {
				$edif = $building['descripcion'];
			}

			$loc = $d['ubicacion'];
			$ubicacion = "SELECT ubicacion.ubicacion FROM ubicacion, levantamientos WHERE ubicacion.id_ubicacion = levantamientos.ubicacion AND levantamientos.ubicacion = '$loc'";
			$ubicacion = $mysqli->query($ubicacion);
			while ($locate = $ubicacion->fetch_assoc()) {
				$ubi = $locate['ubicacion'];
			}

			$lineData = array($empre, $edif, $ubi, $d["uma"], $d["comentarios_etp3"], $d["observaciones_etp3"], $d["fecha_hora_inicio"], $d["fecha_hora_modificacion"], $d["fecha_hora_fin"], $d["vendedor"]);
			fputcsv($f, $lineData, $delimiter);
		}

        //vuelve al principio de cada fila
		fseek($f, 0);    
     //crea las cabeceras para la exportacion para descarga del archivo con el nombre y fecha
		header('Content-Type: text/csv');
		header("Content-Disposition: attachment; filename=\"$filename\";");

    //Escribe toda la informacion restante de un puntero a un archivo 
		fpassthru($f);
		exit;

	} else {
		echo '<script>console.log("ERROR 500: No se registró la acción")</script>';
		echo '<script>alert("No hay levantamientos registrados")</script>';
		switch ($_SESSION['tipo']) {
			case 'A':
			echo '<meta http-equiv="refresh" content="0;../../admin/views/admin">';
			break;

			case 'G':
			echo '<meta http-equiv="refresh" content="0;../../admin/views/gerencia">';
			break;

			case 'J':
			echo '<meta http-equiv="refresh" content="0;../../admin/views/jefatura">';
			break;

			case 'V':
			echo '<meta http-equiv="refresh" content="0;../../admin/views/vendedor">';
			break;
			
			default:
			echo '<meta http-equiv="refresh" content="0;../../index.php">';
			break;
		}
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../index.php">';
}

?>