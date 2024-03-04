<?php
require "../fpdf/fpdf.php";
require '../../../config/conex.php';

header ('Content-Type: text/html; charset=utf-8');

/****************************************************
ALIMENTACIÓN DEL FORMATO DE DDBB
****************************************************/
$uma = $_SERVER['QUERY_STRING'];
$data = $con->prepare("SELECT * FROM levantamientos WHERE uma = :uma");
$data->bindValue(':uma', $uma);
$data->setFetchMode(PDO::FETCH_OBJ);
$data->execute();

$lev = $data->fetchAll();

if ($data -> rowCount() > 0) {
	foreach ($lev as $value) {
		$value -> etapa_etp1;
	}
} else {
	echo "<script>console.log('No se logró obtener la información del sistema')</script>";
	echo "<script>alert('No se logró obtener la información del sistema, por favor, contácta al soporte técnico')</script>";

}

class PDF extends FPDF
{
/****************************************************
HEADER
****************************************************/
function Header () {
	$this->SetTextColor(2,5,6);
	$this->SetFillColor(203, 208, 211);
	$this->SetDrawColor(0,0,0);
	$this->SetFont("Arial","b",20);
	$this->SetXY(10,5);
	$this->Cell(50,15,'',0,0,'C');
	$this->Image('../../img/vecoo.png',23,3.3,25);
	$this->SetXY(60,5);
	$this->Cell(100,15,'',0,0,'C');
	$this->SetXY(15,8);
	$this->Cell (0,15,utf8_decode('LEVANTAMIENTO'),0,0,'C');
}

/****************************************************
FOOTER
****************************************************/
function Footer() {
	$this->SetY(-15);
	$this->SetFont("Arial","",8);
	$this->Cell(0,10,'REV.0;01/22 FV-06-8-010',0,0,'R');
}

}

/****************************************************
CREACIÓN DE NUEVA HOJA
****************************************************/
$pdf=new PDF('L','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

/****************************************************
MAQUETA DE PRESENTACIÓN
****************************************************/
$pdf->SetFont("Arial","",8);
$pdf->Cell(0,5,'',0,1,'C');

/****************************************************
ETAPA 1
****************************************************/
// Etapa - Eficiencia
$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->Cell(17,5, 'Etapa',1,1,'C');
$pdf->SetXY(32,28);
$pdf->Cell(15,5, $value->etapa_etp1,1,1,'C');
$pdf->SetXY(47,28);
$pdf->Cell(15,5, 'Eficiencia',1,1,'C');
$pdf->SetFont("Arial","",6);
$pdf->SetXY(62,28);
$pdf->Cell(15,5, $value->eficiencia_etp1,1,1,'C');

// Dimensiones
$pdf->SetFont("Arial","",8);
$pdf->Cell(17,5, 'Dimensiones',1,1,'C');
$pdf->SetXY(32,33);
$pdf->Cell(15,5, 'Alto',1,1,'C');
$pdf->SetXY(47,33);
$pdf->Cell(15,5, 'Frente',1,1,'C');
$pdf->SetXY(62,33);
$pdf->Cell(15,5, 'Fondo',1,1,'C');

// Reales
$pdf->Cell(17,5, 'Reales',1,1,'C');
$pdf->SetXY(32,38);
$pdf->Cell(15,5, $value->alto_real_etp1.' '.$value->um_real_etp1,1,1,'C');
$pdf->SetXY(47,38);
$pdf->Cell(15,5, $value->frente_real_etp1.' '.$value->um_real_etp1,1,1,'C');
$pdf->SetXY(62,38);
$pdf->Cell(15,5, $value->fondo_real_etp1.' '.$value->um_real_etp1,1,1,'C');

// Nominales
$pdf->Cell(17,5, 'Nominales',1,1,'C');
$pdf->SetXY(32,43);
$pdf->Cell(15,5, $value->alto_nom_etp1.' '.$value->um_nominal_etp1,1,1,'C');
$pdf->SetXY(47,43);
$pdf->Cell(15,5, $value->frente_nom_etp1.' '.$value->um_nominal_etp1,1,1,'C');
$pdf->SetXY(62,43);
$pdf->Cell(15,5, $value->fondo_nom_etp1.' '.$value->um_nominal_etp1,1,1,'C');

// Marco
switch ($value->marco_etp1) {
	case 'Madera':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Carton':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Carton con cinta plastica':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Plastico':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Lamina galvanizada':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Aluminio':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Acero Inoxidable':
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(32,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(32,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(39.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(47,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(54.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(62,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(69.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;
}

// Separador
switch ($value->separador_etp1) {
	case 'N/A':
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Kraft':
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Aluminio':
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Minipleat':
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Plastico':
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Peine Plastico':
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(32,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(32,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(39.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(39.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(47,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(47,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(54.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(54.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(62,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(62,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(69.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(69.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;
}

// Entrada // Salida de Aire
$pdf->Cell(17,5, '',1,1,'C');
$pdf->SetXY(32,68);
$pdf->Cell(15,5, 'N/A',1,1,'C');
$pdf->SetXY(47,68);
$pdf->SetFont("Arial","",7.3);
$pdf->Cell(15,5, 'Entrada Aire',1,1,'C');
$pdf->SetXY(62,68);
$pdf->SetFont("Arial","",8);
$pdf->Cell(15,5, 'Salida Aire',1,1,'C');

// Contramarco
switch ($value->contramarco_etp1) {
	case 'N/A':
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(32,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(47,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(32,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(32,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(32,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(32,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Rejilla
switch ($value->rejilla_etp1) {
	case 'N/A':
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(32,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(47,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(32,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(32,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(32,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(32,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Plenum
switch ($value->plenum_etp1) {
	case 'N/A':
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(32,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(47,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(32,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(32,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(32,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(32,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Empaque
switch ($value->ubicacion_gel_etp1) {
	case 'N/A':
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(32,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(47,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(32,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(32,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(32,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(62,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(32,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(47,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(62,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Neopreno - Gel
switch ($value->sello_etp1) {
	case 'Neopreno':
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(32,93);
	$pdf->Cell(15,10, 'X',1,1,'C');$pdf->SetXY(47,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(62,93);
	$pdf->Cell(15,10, '',1,1,'C');
	break;

	case 'Gel':
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(32,93);
	$pdf->Cell(15,10, '',1,1,'C');$pdf->SetXY(47,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(62,93);
	$pdf->Cell(15,10, 'X',1,1,'C');
	break;
	
	default:
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(32,93);
	$pdf->Cell(15,10, '',1,1,'C');$pdf->SetXY(47,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(62,93);
	$pdf->Cell(15,10, '',1,1,'C');
	break;
}

// Espesor contramarco
$pdf->SetFont("Arial","",7.6);
$pdf->Multicell(17,5, 'Espesor contramarco',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(32,103);
$pdf->Cell(15,10, $value->espesor_etp1.' '.$value->um_espesor_etp1,1,1,'C');

// # Separadores
$pdf->SetXY(47,103);
$pdf->SetFont("Arial","",6.4);
$pdf->Multicell(15,5, '# Separadores',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(62,103);
$pdf->Cell(15,10, $value->num_separadores_etp1,1,1,'C');

// # Bolsas
$pdf->Cell(17,10, '# Bolsas',1,1,'C');
$pdf->SetXY(32,113);
$pdf->Cell(15,10, $value->bolsas_etp1,1,1,'C');

// Marca
$pdf->SetXY(47,113);
$pdf->Cell(15,10, 'Marca',1,1,'C');
$pdf->SetXY(62,113);
$pdf->Cell(15,10, $value->marca_etp1,1,1,'C');

// Capacidad
$pdf->Cell(17,10, 'Capacidad',1,1,'C');
$pdf->SetXY(32,123);
$pdf->Cell(15,10, $value->capacidad_etp1,1,1,'C');

// CPI
$pdf->SetXY(47,123);
$pdf->Cell(15,10, 'CPI',1,1,'C');
$pdf->SetXY(62,123);
$pdf->Cell(15,10, $value->cpi_etp1,1,1,'C');

// Capacidad Instalada
$pdf->Multicell(17,5, 'Capacidad Instalada',1,'C');
$pdf->SetXY(32,133);
$pdf->Cell(15,10, $value->capacidad_instalada_etp1,1,1,'C');

// Foto
$pdf->SetXY(47,133);
$pdf->Cell(15,10, 'Foto',1,1,'C');
$pdf->SetXY(62,133);
$foto1 = $value->foto_1_etp1;

if ($foto1 === NULL || $foto1 === '../../../assets/img_lev/') {
	$pdf->Cell(15,10, 'N/A',1,1,'C');
} else {
	$pdf->Cell(15,10,$pdf->Image($foto1,$pdf->GetX(), $pdf->GetY(),13.5,10),1);
	$pdf->Ln();
}

// Comentarios
$pdf->Multicell(20,5, 'Comentarios:',0,'L');
$pdf->SetXY(15,143);
$pdf->Multicell(62,15, '',1,'L');
$comentarios = $value->comentarios_etp1;
$comentarios = wordwrap($comentarios,50, "\n", false);
$comentarios = substr($comentarios,0,100);
if ($comentarios != '') {
	$pdf->SetXY(15,148);
	$pdf->Multicell(62,5, utf8_decode($comentarios),0,'L');
} else {
	$pdf->SetXY(15,148);
	$pdf->Multicell(62,5, 'N/A',0,'L');
}

/****************************************************
ETAPA 2
****************************************************/
// Etapa - Eficiencia
$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->SetXY(82,28);
$pdf->Cell(17,5, 'Etapa',1,1,'C');
$pdf->SetXY(99,28);
$pdf->Cell(15,5, $value->etapa_etp2,1,1,'C');
$pdf->SetXY(114,28);
$pdf->Cell(15,5, 'Eficiencia',1,1,'C');
$pdf->SetXY(129,28);
$pdf->SetFont("Arial","",6);
$pdf->Cell(15,5, $value->eficiencia_etp2,1,1,'C');

// Dimensiones
$pdf->SetXY(82,33);
$pdf->SetFont("Arial","",8);
$pdf->Cell(17,5, 'Dimensiones',1,1,'C');
$pdf->SetXY(99,33);
$pdf->Cell(15,5, 'Alto',1,1,'C');
$pdf->SetXY(114,33);
$pdf->Cell(15,5, 'Frente',1,1,'C');
$pdf->SetXY(129,33);
$pdf->Cell(15,5, 'Fondo',1,1,'C');

// Reales
$pdf->SetXY(82,38);
$pdf->Cell(17,5, 'Reales',1,1,'C');
$pdf->SetXY(99,38);
$pdf->Cell(15,5, $value->alto_real_etp2.' '.$value->um_real_etp2,1,1,'C');
$pdf->SetXY(114,38);
$pdf->Cell(15,5, $value->frente_real_etp2.' '.$value->um_real_etp2,1,1,'C');
$pdf->SetXY(129,38);
$pdf->Cell(15,5, $value->fondo_real_etp2.' '.$value->um_real_etp2,1,1,'C');

// Nominales
$pdf->SetXY(82,43);
$pdf->Cell(17,5, 'Nominales',1,1,'C');
$pdf->SetXY(99,43);
$pdf->Cell(15,5, $value->alto_nom_etp2.' '.$value->um_nominal_etp2,1,1,'C');
$pdf->SetXY(114,43);
$pdf->Cell(15,5, $value->frente_nom_etp2.' '.$value->um_nominal_etp2,1,1,'C');
$pdf->SetXY(129,43);
$pdf->Cell(15,5, $value->fondo_nom_etp2.' '.$value->um_nominal_etp2,1,1,'C');

// Marco
switch ($value->marco_etp2) {
	case 'Madera':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Carton':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Carton con cinta plastica':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Plastico':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Lamina galvanizada':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Aluminio':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Acero Inoxidable':
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(99,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(99,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(106.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(114,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(121.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(129,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(136.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;
}

// Separador
switch ($value->separador_etp2) {
	case 'N/A':
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Kraft':
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Aluminio':
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Minipleat':
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Plastico':
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Peine Plastico':
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(99,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(99,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(106.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(106.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(114,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(114,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(121.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(121.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(129,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(129,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(136.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(136.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;
}

// Entrada // Salida de Aire
$pdf->SetXY(82,68);
$pdf->Cell(17,5, '',1,1,'C');
$pdf->SetXY(99,68);
$pdf->Cell(15,5, 'N/A',1,1,'C');
$pdf->SetXY(114,68);
$pdf->SetFont("Arial","",7.3);
$pdf->Cell(15,5, 'Entrada Aire',1,1,'C');
$pdf->SetXY(129,68);
$pdf->SetFont("Arial","",8);
$pdf->Cell(15,5, 'Salida Aire',1,1,'C');

// Contramarco
switch ($value->contramarco_etp2) {
	case 'N/A':
	$pdf->SetXY(82,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(99,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(114,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(82,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(99,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(82,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(99,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(82,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(99,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(99,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Rejilla
switch ($value->rejilla_etp2) {
	case 'N/A':
	$pdf->SetXY(82,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(99,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(114,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(82,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(99,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(82,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(99,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(82,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(99,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(99,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Plenum
switch ($value->plenum_etp2) {
	case 'N/A':
	$pdf->SetXY(82,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(99,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(114,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(82,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(99,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(82,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(99,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(82,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(99,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(99,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Empaque
switch ($value->ubicacion_gel_etp2) {
	case 'N/A':
	$pdf->SetXY(82,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(99,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(114,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(82,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(99,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(82,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(99,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(82,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(99,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(129,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(99,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(114,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(129,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Neopreno - Gel
switch ($value->sello_etp2) {
	case 'Neopreno':
	$pdf->SetXY(82,93);
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(99,93);
	$pdf->Cell(15,10, 'X',1,1,'C');
	$pdf->SetXY(114,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(129,93);
	$pdf->Cell(15,10, '',1,1,'C');
	break;

	case 'Gel':
	$pdf->SetXY(82,93);
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(99,93);
	$pdf->Cell(15,10, '',1,1,'C');
	$pdf->SetXY(114,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(129,93);
	$pdf->Cell(15,10, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(82,93);
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(99,93);
	$pdf->Cell(15,10, '',1,1,'C');
	$pdf->SetXY(114,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(129,93);
	$pdf->Cell(15,10, '',1,1,'C');
	break;
}

// Espesor contramarco
$pdf->SetXY(82,103);
$pdf->SetFont("Arial","",7.6);
$pdf->Multicell(17,5, 'Espesor contramarco',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(99,103);
$pdf->Cell(15,10, $value->espesor_etp2.' '.$value->um_espesor_etp2,1,1,'C');

// # Separadores
$pdf->SetXY(114,103);
$pdf->SetFont("Arial","",6.4);
$pdf->Multicell(15,5, '# Separadores',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(129,103);
$pdf->Cell(15,10, $value->num_separadores_etp2,1,1,'C');

// # Bolsas
$pdf->SetXY(82,113);
$pdf->Cell(17,10, '# Bolsas',1,1,'C');
$pdf->SetXY(99,113);
$pdf->Cell(15,10, $value->bolsas_etp2,1,1,'C');

// Marca
$pdf->SetXY(114,113);
$pdf->Cell(15,10, 'Marca',1,1,'C');
$pdf->SetXY(129,113);
$pdf->Cell(15,10, $value->marca_etp2,1,1,'C');

// Capacidad
$pdf->SetXY(82,123);
$pdf->Cell(17,10, 'Capacidad',1,1,'C');
$pdf->SetXY(99,123);
$pdf->Cell(15,10, $value->capacidad_etp2,1,1,'C');

// CPI
$pdf->SetXY(114,123);
$pdf->Cell(15,10, 'CPI',1,1,'C');
$pdf->SetXY(129,123);
$pdf->Cell(15,10, $value->cpi_etp2,1,1,'C');

// Capacidad Instalada
$pdf->SetXY(82,133);
$pdf->Multicell(17,5, 'Capacidad Instalada',1,'C');
$pdf->SetXY(99,133);
$pdf->Cell(15,10, $value->capacidad_instalada_etp2,1,1,'C');

// Foto
$pdf->SetXY(114,133);
$pdf->Cell(15,10, 'Foto',1,1,'C');
$pdf->SetXY(129,133);
$foto2 = $value->foto_1_etp2;

if ($foto2 == NULL || $foto2 === '../../../assets/img_lev/') {
	$pdf->Cell(15,10, 'N/A',1,1,'C');
} else {
	$pdf->Cell(15,10,$pdf->Image($foto2,$pdf->GetX(), $pdf->GetY(),13.5,10),1);
	$pdf->Ln();
}

// Comentarios
$pdf->SetXY(82,143);
$pdf->Multicell(20,5, 'Comentarios:',0,'L');
$pdf->SetXY(82,143);
$pdf->Multicell(62,15, '',1,'L');
$comentarios2 = $value->comentarios_etp2;
$comentarios2 = wordwrap($comentarios2,45, "\n", false);
$comentarios2 = substr($comentarios2,0,100);
if ($comentarios2 != '') {
	$pdf->SetXY(82,148);
	$pdf->Multicell(100,5, utf8_decode($comentarios2),0,'L');
} else {
	$pdf->SetXY(82,148);
	$pdf->Multicell(62,5, 'N/A',0,'L');
}

/****************************************************
ETAPA 3
****************************************************/
// Etapa - Eficiencia
$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->SetXY(149,28);
$pdf->Cell(17,5, 'Etapa',1,1,'C');
$pdf->SetXY(166,28);
$pdf->Cell(15,5, $value->etapa_etp3,1,1,'C');
$pdf->SetXY(181,28);
$pdf->Cell(15,5, 'Eficiencia',1,1,'C');
$pdf->SetFont("Arial","",6);
$pdf->SetXY(196,28);
$pdf->Cell(15,5, $value->eficiencia_etp3,1,1,'C');

// Dimensiones
$pdf->SetXY(149,33);
$pdf->SetFont("Arial","",8);
$pdf->Cell(17,5, 'Dimensiones',1,1,'C');
$pdf->SetXY(166,33);
$pdf->Cell(15,5, 'Alto',1,1,'C');
$pdf->SetXY(181,33);
$pdf->Cell(15,5, 'Frente',1,1,'C');
$pdf->SetXY(196,33);
$pdf->Cell(15,5, 'Fondo',1,1,'C');

// Reales
$pdf->SetXY(149,38);
$pdf->Cell(17,5, 'Reales',1,1,'C');
$pdf->SetXY(166,38);
$pdf->Cell(15,5, $value->alto_real_etp3.' '.$value->um_real_etp3,1,1,'C');
$pdf->SetXY(181,38);
$pdf->Cell(15,5, $value->frente_real_etp3.' '.$value->um_real_etp3,1,1,'C');
$pdf->SetXY(196,38);
$pdf->Cell(15,5, $value->fondo_real_etp3.' '.$value->um_real_etp3,1,1,'C');

// Nominales
$pdf->SetXY(149,43);
$pdf->Cell(17,5, 'Nominales',1,1,'C');
$pdf->SetXY(166,43);
$pdf->Cell(15,5, $value->alto_nom_etp3.' '.$value->um_nominal_etp3,1,1,'C');
$pdf->SetXY(181,43);
$pdf->Cell(15,5, $value->frente_nom_etp3.' '.$value->um_nominal_etp3,1,1,'C');
$pdf->SetXY(196,43);
$pdf->Cell(15,5, $value->fondo_nom_etp3.' '.$value->um_nominal_etp3,1,1,'C');

// Marco
switch ($value->marco_etp3) {
	case 'Madera':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Carton':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Carton con cinta plastica':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Plastico':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Lamina galvanizada':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Aluminio':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Acero Inoxidable':
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,48);
	$pdf->Cell(17,10, 'Marco',1,1,'C');
	$pdf->SetXY(166,48);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(166,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,48);
	$pdf->Cell(7.5,5, 'C',1,1,'C');
	$pdf->SetXY(173.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,48);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(181,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,48);
	$pdf->Cell(7.5,5, 'LG',1,1,'C');
	$pdf->SetXY(188.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,48);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(196,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,48);
	$pdf->Cell(7.5,5, 'SS',1,1,'C');
	$pdf->SetXY(203.5,53);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;
}

// Separador
switch ($value->separador_etp3) {
	case 'N/A':
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Kraft':
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Aluminio':
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Minipleat':
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Plastico':
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;

	case 'Peine Plastico':
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,58);
	$pdf->Cell(17,10, 'Separador',1,1,'C');
	$pdf->SetXY(166,58);
	$pdf->Cell(7.5,5, 'N/A',1,1,'C');
	$pdf->SetXY(166,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(173.5,58);
	$pdf->Cell(7.5,5, 'K',1,1,'C');
	$pdf->SetXY(173.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(181,58);
	$pdf->Cell(7.5,5, 'A',1,1,'C');
	$pdf->SetXY(181,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(188.5,58);
	$pdf->Cell(7.5,5, 'M',1,1,'C');
	$pdf->SetXY(188.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(196,58);
	$pdf->Cell(7.5,5, 'P',1,1,'C');
	$pdf->SetXY(196,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	$pdf->SetXY(203.5,58);
	$pdf->Cell(7.5,5, 'PP',1,1,'C');
	$pdf->SetXY(203.5,63);
	$pdf->Cell(7.5,5, '',1,1,'C');
	break;
}

// Entrada // Salida de Aire
$pdf->SetXY(149,68);
$pdf->Cell(17,5, '',1,1,'C');
$pdf->SetXY(166,68);
$pdf->Cell(15,5, 'N/A',1,1,'C');
$pdf->SetXY(181,68);
$pdf->SetFont("Arial","",7.3);
$pdf->Cell(15,5, 'Entrada Aire',1,1,'C');
$pdf->SetXY(196,68);
$pdf->SetFont("Arial","",8);
$pdf->Cell(15,5, 'Salida Aire',1,1,'C');

// Contramarco
switch ($value->contramarco_etp3) {
	case 'N/A':
	$pdf->SetXY(149,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(166,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(181,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(149,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(166,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(149,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(166,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(149,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(166,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,73);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,73);
	$pdf->Cell(17,5, 'Contramarco',1,1,'C');
	$pdf->SetXY(166,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,73);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,73);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Rejilla
switch ($value->rejilla_etp3) {
	case 'N/A':
	$pdf->SetXY(149,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(166,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(181,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(149,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(166,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(149,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(166,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(149,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(166,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,78);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,78);
	$pdf->Cell(17,5, 'Rejilla',1,1,'C');
	$pdf->SetXY(166,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,78);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,78);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Plenum
switch ($value->plenum_etp3) {
	case 'N/A':
	$pdf->SetXY(149,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(166,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(181,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(149,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(166,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(149,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(166,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(149,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(166,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,83);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,83);
	$pdf->Cell(17,5, 'Plenum',1,1,'C');
	$pdf->SetXY(166,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,83);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,83);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Empaque
switch ($value->ubicacion_gel_etp3) {
	case 'N/A':
	$pdf->SetXY(149,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(166,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(181,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Entrada Aire':
	$pdf->SetXY(149,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(166,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;

	case 'Salida Aire':
	$pdf->SetXY(149,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(166,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;

	case 'Entrada y Salida de Aire':
	$pdf->SetXY(149,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(166,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	$pdf->SetXY(196,88);
	$pdf->Cell(15,5, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,88);
	$pdf->Cell(17,5, 'Empaque',1,1,'C');
	$pdf->SetXY(166,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(181,88);
	$pdf->Cell(15,5, '',1,1,'C');
	$pdf->SetXY(196,88);
	$pdf->Cell(15,5, '',1,1,'C');
	break;
}

// Neopreno - Gel
switch ($value->sello_etp3) {
	case 'Neopreno':
	$pdf->SetXY(149,93);
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(166,93);
	$pdf->Cell(15,10, 'X',1,1,'C');
	$pdf->SetXY(181,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(196,93);
	$pdf->Cell(15,10, '',1,1,'C');
	break;

	case 'Gel':
	$pdf->SetXY(149,93);
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(166,93);
	$pdf->Cell(15,10, '',1,1,'C');
	$pdf->SetXY(181,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(196,93);
	$pdf->Cell(15,10, 'X',1,1,'C');
	break;
	
	default:
	$pdf->SetXY(149,93);
	$pdf->Cell(17,10, 'Neopreno',1,1,'C');
	$pdf->SetXY(166,93);
	$pdf->Cell(15,10, '',1,1,'C');
	$pdf->SetXY(181,93);
	$pdf->Cell(15,10, 'Gel',1,1,'C');
	$pdf->SetXY(196,93);
	$pdf->Cell(15,10, '',1,1,'C');
	break;
}

// Espesor contramarco
$pdf->SetXY(149,103);
$pdf->SetFont("Arial","",7.6);
$pdf->Multicell(17,5, 'Espesor contramarco',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(166,103);
$pdf->Cell(15,10, $value->espesor_etp3.' '.$value->um_espesor_etp3,1,1,'C');

// # Separadores
$pdf->SetXY(181,103);
$pdf->SetFont("Arial","",6.4);
$pdf->Multicell(15,5, '# Separadores',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(196,103);
$pdf->Cell(15,10, $value->num_separadores_etp3,1,1,'C');

// # Bolsas
$pdf->SetXY(149,113);
$pdf->Cell(17,10, '# Bolsas',1,1,'C');
$pdf->SetXY(166,113);
$pdf->Cell(15,10, $value->bolsas_etp3,1,1,'C');

// Marca
$pdf->SetXY(181,113);
$pdf->Cell(15,10, 'Marca',1,1,'C');
$pdf->SetXY(196,113);
$pdf->Cell(15,10, $value->marca_etp3,1,1,'C');

// Capacidad
$pdf->SetXY(149,123);
$pdf->Cell(17,10, 'Capacidad',1,1,'C');
$pdf->SetXY(166,123);
$pdf->Cell(15,10, $value->capacidad_etp3,1,1,'C');

// CPI
$pdf->SetXY(181,123);
$pdf->Cell(15,10, 'CPI',1,1,'C');
$pdf->SetXY(196,123);
$pdf->Cell(15,10, $value->cpi_etp3,1,1,'C');

// Capacidad Instalada
$pdf->SetXY(149,133);
$pdf->Multicell(17,5, 'Capacidad Instalada',1,'C');
$pdf->SetXY(166,133);
$pdf->Cell(15,10, $value->capacidad_instalada_etp3,1,1,'C');

// Foto
$pdf->SetXY(181,133);
$pdf->Cell(15,10, 'Foto',1,1,'C');
$pdf->SetXY(196,133);
$foto3 = $value->foto_1_etp3;

if ($foto3 == NULL || $foto3 === '../../../assets/img_lev/') {
	$pdf->Cell(15,10, 'N/A',1,1,'C');
} else {
	$pdf->Cell(15,10,$pdf->Image($foto3,$pdf->GetX(), $pdf->GetY(),13.5,10),1);
	$pdf->Ln();
}

// Comentarios
$pdf->SetXY(149,143);
$pdf->Multicell(20,5, 'Comentarios:',0,'L');
$pdf->SetXY(149,143);
$pdf->Multicell(62,15, '',1,'L');
$comentarios3 = $value->comentarios_etp3;
$comentarios3 = wordwrap($comentarios3,45, "\n", false);
$comentarios3 = substr($comentarios3,0,100);
if ($comentarios3 != '') {
	$pdf->SetXY(149,148);
	$pdf->Multicell(200,5, utf8_decode($comentarios3),0,'L');
} else {
	$pdf->SetXY(149,148);
	$pdf->Multicell(62,5, 'N/A',0,'L');
}

/****************************************************
CUADROS DE DIBUJO
****************************************************/
// ETAPA 1
$pdf->SetXY(32,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(39.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(47,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(54.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(62,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(69.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(32,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(39.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(47,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(54.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(62,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(69.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(32,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(39.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(47,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(54.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(62,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(69.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(32,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(39.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(47,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(54.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(62,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(69.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(32,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(39.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(47,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(54.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(62,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(69.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');

// ETAPA 2
$pdf->SetXY(99,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(106.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(114,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(121.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(129,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(136.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(99,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(106.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(114,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(121.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(129,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(136.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(99,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(106.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(114,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(121.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(129,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(136.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(99,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(106.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(114,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(121.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(129,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(136.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(99,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(106.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(114,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(121.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(129,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(136.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');

//ETAPA 3
$pdf->SetXY(166,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(173.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(181,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(188.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(196,162);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(203.5,162);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(166,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(173.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(181,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(188.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(196,167);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(203.5,167);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(166,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(173.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(181,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(188.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(196,172);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(203.5,172);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(166,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(173.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(181,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(188.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(196,177);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(203.5,177);
$pdf->Cell(7.5,5,'',1,1,'C');

$pdf->SetXY(166,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(173.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(181,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(188.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(196,182);
$pdf->Cell(7.5,5,'',1,1,'C');
$pdf->SetXY(203.5,182);
$pdf->Cell(7.5,5,'',1,1,'C');

/****************************************************
CUADRO DE TERMINOLOGÍA
****************************************************/
$pdf->Ln(3.5);
$pdf->SetFont("Arial","",8);
$pdf->Cell(250,5, utf8_decode('M:Madera,Minipleat ; C:Cartón ; P:Plástico ; LG: Lamina Galvanizada ; A: Aluminio ; SS: Acero Inoxidable ; K:Kraft ; PP:Peine Plástico N/A:No Aplica ; CPI: Caída de presión inicial'),1,1,'C');

/****************************************************
SALIDA DE PDF
****************************************************/
$vendedor = $value->vendedor;
$pdf->Ln();
$pdf->output('I','FV-06-8-010 Folio='.$uma.' Vendedor='.$vendedor.'.pdf');