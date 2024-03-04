<?php

require '../../../../conexi.php';

$edificio_id = $_POST['id'];

$queryM = "SELECT id_edificio,empresa_id, descripcion FROM edificio WHERE empresa_id = '$edificio_id' ORDER BY descripcion";
$resultadoM = $mysqli->query($queryM);

$html= "<option value=''> - Seleccionar Edificio - </option>";

while($rowM = $resultadoM->fetch_assoc())
{
	$html.= "<option value='".$rowM['id_edificio']."'>".$rowM['descripcion']."</option>";
}

echo $html;

?>