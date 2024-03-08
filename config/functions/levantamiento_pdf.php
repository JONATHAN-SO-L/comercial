<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
	switch ($_SESSION['tipo']) {
		case 'V':
		echo '<meta http-equiv="refresh" content="0;../../admin/views/vendedor">';
		break;
	}

	if (isset($_POST['levantamientos_pdf'])) {

		require "../../assets/lib/fpdf/fpdf.php";
		header ('Content-Type: text/html; charset=utf-8');

		$fecha1 = $_POST['fecha1_pdf'];
		$fecha2 = $_POST['fecha2_pdf'];

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
				$this->Image('../../../img/vecoo.png',23,3.3,25);
				$this->SetXY(60,5);
				$this->Cell(100,15,'',0,0,'C');
				$this->SetXY(15,8);
				$this->Cell (0,15,utf8_decode('Resúmen de Levantamientos'),0,0,'C');

				$this->SetFont("Arial","b",10);
				$this->Ln(); $this->Ln(5);
				$this->Cell(30,5, 'Empresa',1,0,'C', true);
				$this->Cell(30,5, 'Edificio',1,0,'C', true);
				$this->Cell(30,5, 'Ubicacion',1,0,'C', true);
				$this->Cell(30,5, 'UMA',1,0,'C', true);
				$this->Cell(40,5, 'Comentarios Etapa 3',1,0,'C', true);
				$this->Cell(40,5, 'Observaciones Etapa 3',1,0,'C', true);
				$this->Cell(40,5, 'Fecha y Hora de Inicio',1,0,'C', true);
				$this->Cell(50,5, 'Fecha y Hora de Modificacion',1,0,'C', true);
				$this->Cell(50,5, 'Fecha y Hora de Finalizacion',1,0,'C', true);
				$this->Cell(40,5, 'Vendedor',1,0,'C', true);
			}

			/****************************************************
			FOOTER
			****************************************************/
			function Footer() {
				$this->SetY(-15);
				$this->SetFont("Arial","",10);
				$this->Cell(0,10, utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'C');
				//$this->Cell(0,10,'REV.0;01/22 FV-06-8-010',0,0,'R');
			}

		}

		/****************************************************
		CREACIÓN DE NUEVA HOJA
		****************************************************/
		$pdf=new PDF('L','mm','A3');
		$pdf->SetMargins(15,20);
		$pdf->AliasNbPages();
		$pdf->AddPage();

		/****************************************************
		MAQUETA DE PRESENTACIÓN
		****************************************************/
		$pdf->SetFont("Arial","",10);
		$pdf->Cell(0,5,'',0,1,'C');

		// Consultas a DDBB
		require '../conex.php';

		// q_ = Query / Consulta
		$q_lev = $con->prepare("SELECT * FROM levantamientos");
		$q_lev->setFetchMode(PDO::FETCH_OBJ);
		$q_lev->execute();

		// r_ = Result / Resultado
		$r_lev = $q_lev->fetchAll();

		/****************************************************
		MUESTREO DE DATOS
		****************************************************/
		if ($q_lev -> rowCount() > 0) {

			foreach ($r_lev as $value) {

				$search_company = $con->prepare("SELECT razon_social FROM empresas, levantamientos WHERE empresas.id = levantamientos.empresa AND levantamientos.empresa = ".$value->empresa."");
				$search_company->setFetchMode(PDO::FETCH_OBJ);
				$search_company->execute();
				$company = $search_company->fetchAll();

				if ($search_company -> rowCount() > 0) {
					foreach ($company as $rel) {
						$rel -> razon_social;
					}
				}

				//Búsqueda de edificio en base al ID de la empresa
				$search_build = $con->prepare("SELECT descripcion FROM edificio, levantamientos WHERE edificio.id_edificio = levantamientos.edificio AND levantamientos.edificio = ".$value->edificio."");
				$search_build->setFetchMode(PDO::FETCH_OBJ);
				$search_build->execute();
				$build = $search_build->fetchAll();

				if ($search_build -> rowCount() > 0) {
					foreach ($build as $edi) {
						$edi -> descripcion;
					}
				}

				//Búsqueda de la ubicación en base al ID del edificio
				$search_location = $con->prepare("SELECT ubicacion.ubicacion FROM ubicacion, levantamientos WHERE ubicacion.id_ubicacion = levantamientos.ubicacion AND levantamientos.ubicacion = ".$value->ubicacion."");
				$search_location->setFetchMode(PDO::FETCH_OBJ);
				$search_location->execute();
				$locate = $search_location->fetchAll();

				if ($search_location -> rowCount() > 0) {
					foreach ($locate as $local) {
						$local -> ubicacion;
					}
				}

				/**********************************************
				AJUSTE DE VALORES EN CAMPO DE ACUERDO AL TAMAÑO
				**********************************************/
				$empresa = ucfirst($rel -> razon_social);
				$empresa_wrap = wordwrap($empresa, 25, "\n", false);
				$empresa_sub = substr($empresa_wrap, 0, 12);

				$comentarios = ucfirst($value -> comentarios_etp3);
				$cometarios_wrap = wordwrap($comentarios, 50, "\n", false);
				$comentarios_sub = substr($cometarios_wrap, 0, 25);

				$observaciones = ucfirst($value -> observaciones_etp3);
				$observaciones_wrap = wordwrap($observaciones, 50, "\n", false);
				$observaciones_sub = substr($observaciones_wrap, 0, 25);

				$pdf->Cell(30,5, $empresa_sub,1,0,'C');
				$pdf->Cell(30,5, $edi -> descripcion,1,0,'C');
				$pdf->Cell(30,5, $local -> ubicacion,1,0,'C');
				$pdf->Cell(30,5, $value -> uma,1,0,'C');
				$pdf->Cell(40,5, $comentarios_sub,1,0,'C');
				$pdf->Cell(40,5, $observaciones_sub,1,0,'C');
				$pdf->Cell(40,5, $value -> fecha_hora_inicio,1,0,'C');
				$pdf->Cell(50,5, $value -> fecha_hora_modificacion,1,0,'C');
				$pdf->Cell(50,5, $value -> fecha_hora_fin,1,0,'C');
				$pdf->Cell(40,5, $value -> vendedor,1,0,'C');
				$pdf->Ln();
			}
			
		} else {
			echo "<script>console.log('No hay levantamientos registrados')</script>";
			echo "<script>alert('No hay levantamientos registrados')</script>";
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

		/****************************************************
		SALIDA DE PDF
		****************************************************/
		$pdf->Ln();
		$pdf->output('I','Levantamientos del '.$fecha1.' al '.$fecha2.'.pdf');

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