<?php
include '../conexi.php';
$delimiter = ",";
$filename = "Listado_Equipos_Devinsa_" . date('Y-m-d') . ".csv";

	//create a file pointer
$f = fopen('php://memory', 'a');

	//crea los encabezados de las columnas
$fields = array('Nombre de Usuario', 'Area', 'Ubicacion', 'Correo', 'Equipo', 'Serie Calidad','Marca', 'Tipo', 'Procesador', 'Sistema Operativo', 'Almacenamiento', 'Memoria RAM', 'Tipo de Usuario');
fputcsv($f, $fields, $delimiter);

	//extrae cada fila de datos, les da formato csv y los escribe en fichero creado

	$value="SELECT equipo_usuario.nombre_comp, equipo_usuario.area, equipo_usuario.ubicacion, equipo_usuario.email_usuario, equipo_usuario.equipo, equipo_usuario.num_serie, equipo_usuario.marca, equipo_usuario.tipo, equipo_usuario.procesador, equipo_usuario.sis_ope, equipo_usuario.disco, equipo_usuario.ram, usuario_sop.tipo_usuario FROM  equipo_usuario, usuario_sop WHERE equipo_usuario.nombre_comp = usuario_sop.nombre_comp ORDER BY equipo_usuario.num_serie, equipo_usuario.area;"; 
	$result = $mysqli->query($value);
	while($d = $result->fetch_assoc()){

		$lineData = array($d["nombre_comp"], $d["area"], $d["ubicacion"], $d["email_usuario"],  $d["equipo"], $d["num_serie"], $d["marca"], $d["tipo"], $d["procesador"], $d["sis_ope"], $d["disco"], $d['ram'], $d["tipo_usuario"]);
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
?>