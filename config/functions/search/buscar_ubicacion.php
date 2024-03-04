<?php
require '../../../../conexi.php';

$id_estado = $_POST['id'];

$queryM = "SELECT id_ubicacion,edificio_id, ubicacion FROM ubicacion WHERE edificio_id = '$id_estado' ORDER BY ubicacion ASC";
$resultadoM = $mysqli->query($queryM);

$html= "<option value=''> - Seleccionar Ubicación - </option>";

while($rowM = $resultadoM->fetch_assoc())
{
	$html.= "<option value='".$rowM['id_ubicacion']."'>".$rowM['ubicacion']."</option>";
}

echo $html;

?>