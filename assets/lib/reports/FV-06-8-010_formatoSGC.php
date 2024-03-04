<?php
require "../fpdf/fpdf.php";

header ('Content-Type: text/html; charset=utf-8');


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
	$this->Image('../../../../img/vecoo.png',23,3.3,25);
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
$pdf->Cell(15,5, '',1,1,'C'); // Campo vacío
$pdf->SetXY(47,28);
$pdf->Cell(15,5, 'Eficiencia',1,1,'C');
$pdf->SetXY(62,28);
$pdf->Cell(15,5, '',1,1,'C'); // Campo vacío

// Dimensiones
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
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(47,38);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(62,38);
$pdf->Cell(15,5, '',1,1,'C');

// Nominales
$pdf->Cell(17,5, 'Nominales',1,1,'C');
$pdf->SetXY(32,43);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(47,43);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(62,43);
$pdf->Cell(15,5, '',1,1,'C');

// Marco
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

// Separador
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
$pdf->Cell(17,5, 'Contramarco',1,1,'C');
$pdf->SetXY(32,73);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(47,73);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(62,73);
$pdf->Cell(15,5, '',1,1,'C');

// Rejilla
$pdf->Cell(17,5, 'Rejilla',1,1,'C');
$pdf->SetXY(32,78);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(47,78);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(62,78);
$pdf->Cell(15,5, '',1,1,'C');

// Plenum
$pdf->Cell(17,5, 'Plenum',1,1,'C');
$pdf->SetXY(32,83);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(47,83);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(62,83);
$pdf->Cell(15,5, '',1,1,'C');

// Empaque
$pdf->Cell(17,5, 'Empaque',1,1,'C');
$pdf->SetXY(32,88);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(47,88);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(62,88);
$pdf->Cell(15,5, '',1,1,'C');

// Neopreno
$pdf->Cell(17,10, 'Neopreno',1,1,'C');
$pdf->SetXY(32,93);
$pdf->Cell(15,10, '',1,1,'C');

// Gel
$pdf->SetXY(47,93);
$pdf->Cell(15,10, 'Gel',1,1,'C');
$pdf->SetXY(62,93);
$pdf->Cell(15,10, '',1,1,'C');

// Espesor contramarco
$pdf->SetFont("Arial","",7.6);
$pdf->Multicell(17,5, 'Espesor contramarco',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(32,103);
$pdf->Cell(15,10, '',1,1,'C');

// # Separadores
$pdf->SetXY(47,103);
$pdf->SetFont("Arial","",6.4);
$pdf->Multicell(15,5, '# Separadores',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(62,103);
$pdf->Cell(15,10, '',1,1,'C');

// # Bolsas
$pdf->Cell(17,10, '# Bolsas',1,1,'C');
$pdf->SetXY(32,113);
$pdf->Cell(15,10, '',1,1,'C');

// Marca
$pdf->SetXY(47,113);
$pdf->Cell(15,10, 'Marca',1,1,'C');
$pdf->SetXY(62,113);
$pdf->Cell(15,10, '',1,1,'C');

// Capacidad
$pdf->Cell(17,10, 'Capacidad',1,1,'C');
$pdf->SetXY(32,123);
$pdf->Cell(15,10, '',1,1,'C');

// CPI
$pdf->SetXY(47,123);
$pdf->Cell(15,10, 'CPI',1,1,'C');
$pdf->SetXY(62,123);
$pdf->Cell(15,10, '',1,1,'C');

// Capacidad Instalada
$pdf->Multicell(17,5, 'Capacidad Instalada',1,'C');
$pdf->SetXY(32,133);
$pdf->Cell(15,10, '',1,1,'C');

// Foto
$pdf->SetXY(47,133);
$pdf->Cell(15,10, 'Foto',1,1,'C');
$pdf->SetXY(62,133);
$pdf->Cell(15,10, '',1,1,'C');

// Comentarios
$pdf->Multicell(20,5, 'Comentarios:',0,'L');
$pdf->SetXY(15,143);
$pdf->Multicell(62,15, '',1,'L');

/****************************************************
ETAPA 2
****************************************************/
// Etapa - Eficiencia
$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->SetXY(82,28);
$pdf->Cell(17,5, 'Etapa',1,1,'C');
$pdf->SetXY(99,28);
$pdf->Cell(15,5, '',1,1,'C'); // Campo vacío
$pdf->SetXY(114,28);
$pdf->Cell(15,5, 'Eficiencia',1,1,'C');
$pdf->SetXY(129,28);
$pdf->Cell(15,5, '',1,1,'C'); // Campo vacío

// Dimensiones
$pdf->SetXY(82,33);
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
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(114,38);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(129,38);
$pdf->Cell(15,5, '',1,1,'C');

// Nominales
$pdf->SetXY(82,43);
$pdf->Cell(17,5, 'Nominales',1,1,'C');
$pdf->SetXY(99,43);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(114,43);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(129,43);
$pdf->Cell(15,5, '',1,1,'C');

// Marco
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

// Separador
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
$pdf->SetXY(82,73);
$pdf->Cell(17,5, 'Contramarco',1,1,'C');
$pdf->SetXY(99,73);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(114,73);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(129,73);
$pdf->Cell(15,5, '',1,1,'C');

// Rejilla
$pdf->SetXY(82,78);
$pdf->Cell(17,5, 'Rejilla',1,1,'C');
$pdf->SetXY(99,78);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(114,78);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(129,78);
$pdf->Cell(15,5, '',1,1,'C');

// Plenum
$pdf->SetXY(82,83);
$pdf->Cell(17,5, 'Plenum',1,1,'C');
$pdf->SetXY(99,83);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(114,83);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(129,83);
$pdf->Cell(15,5, '',1,1,'C');

// Empaque
$pdf->SetXY(82,88);
$pdf->Cell(17,5, 'Empaque',1,1,'C');
$pdf->SetXY(99,88);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(114,88);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(129,88);
$pdf->Cell(15,5, '',1,1,'C');

// Neopreno
$pdf->SetXY(82,93);
$pdf->Cell(17,10, 'Neopreno',1,1,'C');
$pdf->SetXY(99,93);
$pdf->Cell(15,10, '',1,1,'C');

// Gel
$pdf->SetXY(114,93);
$pdf->Cell(15,10, 'Gel',1,1,'C');
$pdf->SetXY(129,93);
$pdf->Cell(15,10, '',1,1,'C');

// Espesor contramarco
$pdf->SetXY(82,103);
$pdf->SetFont("Arial","",7.6);
$pdf->Multicell(17,5, 'Espesor contramarco',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(99,103);
$pdf->Cell(15,10, '',1,1,'C');

// # Separadores
$pdf->SetXY(114,103);
$pdf->SetFont("Arial","",6.4);
$pdf->Multicell(15,5, '# Separadores',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(129,103);
$pdf->Cell(15,10, '',1,1,'C');

// # Bolsas
$pdf->SetXY(82,113);
$pdf->Cell(17,10, '# Bolsas',1,1,'C');
$pdf->SetXY(99,113);
$pdf->Cell(15,10, '',1,1,'C');

// Marca
$pdf->SetXY(114,113);
$pdf->Cell(15,10, 'Marca',1,1,'C');
$pdf->SetXY(129,113);
$pdf->Cell(15,10, '',1,1,'C');

// Capacidad
$pdf->SetXY(82,123);
$pdf->Cell(17,10, 'Capacidad',1,1,'C');
$pdf->SetXY(99,123);
$pdf->Cell(15,10, '',1,1,'C');

// CPI
$pdf->SetXY(114,123);
$pdf->Cell(15,10, 'CPI',1,1,'C');
$pdf->SetXY(129,123);
$pdf->Cell(15,10, '',1,1,'C');

// Capacidad Instalada
$pdf->SetXY(82,133);
$pdf->Multicell(17,5, 'Capacidad Instalada',1,'C');
$pdf->SetXY(99,133);
$pdf->Cell(15,10, '',1,1,'C');

// Foto
$pdf->SetXY(114,133);
$pdf->Cell(15,10, 'Foto',1,1,'C');
$pdf->SetXY(129,133);
$pdf->Cell(15,10, '',1,1,'C');

// Comentarios
$pdf->SetXY(82,143);
$pdf->Multicell(20,5, 'Comentarios:',0,'L');
$pdf->SetXY(82,143);
$pdf->Multicell(62,15, '',1,'L');

/****************************************************
ETAPA 3
****************************************************/
// Etapa - Eficiencia
$pdf->Ln();$pdf->Ln();$pdf->Ln();
$pdf->SetXY(149,28);
$pdf->Cell(17,5, 'Etapa',1,1,'C');
$pdf->SetXY(166,28);
$pdf->Cell(15,5, '',1,1,'C'); // Campo vacío
$pdf->SetXY(181,28);
$pdf->Cell(15,5, 'Eficiencia',1,1,'C');
$pdf->SetXY(196,28);
$pdf->Cell(15,5, '',1,1,'C'); // Campo vacío

// Dimensiones
$pdf->SetXY(149,33);
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
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(181,38);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(196,38);
$pdf->Cell(15,5, '',1,1,'C');

// Nominales
$pdf->SetXY(149,43);
$pdf->Cell(17,5, 'Nominales',1,1,'C');
$pdf->SetXY(166,43);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(181,43);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(196,43);
$pdf->Cell(15,5, '',1,1,'C');

// Marco
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

// Separador
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
$pdf->SetXY(149,73);
$pdf->Cell(17,5, 'Contramarco',1,1,'C');
$pdf->SetXY(166,73);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(181,73);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(196,73);
$pdf->Cell(15,5, '',1,1,'C');

// Rejilla
$pdf->SetXY(149,78);
$pdf->Cell(17,5, 'Rejilla',1,1,'C');
$pdf->SetXY(166,78);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(181,78);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(196,78);
$pdf->Cell(15,5, '',1,1,'C');

// Plenum
$pdf->SetXY(149,83);
$pdf->Cell(17,5, 'Plenum',1,1,'C');
$pdf->SetXY(166,83);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(181,83);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(196,83);
$pdf->Cell(15,5, '',1,1,'C');

// Empaque
$pdf->SetXY(149,88);
$pdf->Cell(17,5, 'Empaque',1,1,'C');
$pdf->SetXY(166,88);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(181,88);
$pdf->Cell(15,5, '',1,1,'C');
$pdf->SetXY(196,88);
$pdf->Cell(15,5, '',1,1,'C');

// Neopreno
$pdf->SetXY(149,93);
$pdf->Cell(17,10, 'Neopreno',1,1,'C');
$pdf->SetXY(166,93);
$pdf->Cell(15,10, '',1,1,'C');

// Gel
$pdf->SetXY(181,93);
$pdf->Cell(15,10, 'Gel',1,1,'C');
$pdf->SetXY(196,93);
$pdf->Cell(15,10, '',1,1,'C');

// Espesor contramarco
$pdf->SetXY(149,103);
$pdf->SetFont("Arial","",7.6);
$pdf->Multicell(17,5, 'Espesor contramarco',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(166,103);
$pdf->Cell(15,10, '',1,1,'C');

// # Separadores
$pdf->SetXY(181,103);
$pdf->SetFont("Arial","",6.4);
$pdf->Multicell(15,5, '# Separadores',1,'C');
$pdf->SetFont("Arial","",8);
$pdf->SetXY(196,103);
$pdf->Cell(15,10, '',1,1,'C');

// # Bolsas
$pdf->SetXY(149,113);
$pdf->Cell(17,10, '# Bolsas',1,1,'C');
$pdf->SetXY(166,113);
$pdf->Cell(15,10, '',1,1,'C');

// Marca
$pdf->SetXY(181,113);
$pdf->Cell(15,10, 'Marca',1,1,'C');
$pdf->SetXY(196,113);
$pdf->Cell(15,10, '',1,1,'C');

// Capacidad
$pdf->SetXY(149,123);
$pdf->Cell(17,10, 'Capacidad',1,1,'C');
$pdf->SetXY(166,123);
$pdf->Cell(15,10, '',1,1,'C');

// CPI
$pdf->SetXY(181,123);
$pdf->Cell(15,10, 'CPI',1,1,'C');
$pdf->SetXY(196,123);
$pdf->Cell(15,10, '',1,1,'C');

// Capacidad Instalada
$pdf->SetXY(149,133);
$pdf->Multicell(17,5, 'Capacidad Instalada',1,'C');
$pdf->SetXY(166,133);
$pdf->Cell(15,10, '',1,1,'C');

// Foto
$pdf->SetXY(181,133);
$pdf->Cell(15,10, 'Foto',1,1,'C');
$pdf->SetXY(196,133);
$pdf->Cell(15,10, '',1,1,'C');

// Comentarios
$pdf->SetXY(149,143);
$pdf->Multicell(20,5, 'Comentarios:',0,'L');
$pdf->SetXY(149,143);
$pdf->Multicell(62,15, '',1,'L');

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
$pdf->Ln();
$pdf->output('I','FV-06-8-010.pdf');