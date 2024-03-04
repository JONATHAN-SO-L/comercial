<?php
session_start();
require '../../../config/conex.php';

/****************
Obtención de UMA
****************/
$uma = $_SERVER['QUERY_STRING'];
$_SESSION['uma'] = $uma;
$uma = $_SESSION['uma'];

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
		<div class="card">
			<div class="card bg-danger text-white"><center><h6><strong>ETAPA 2</strong></h6></center></div>
		</div>

		<form class="border border-danger form-control" required method="POST" action="../../../config/permissions/add/add_stage2.php" enctype="multipart/form-data">
			<!-------------
			ETAPA 2
			-------------->
			<label><strong>Código:</strong></label>
			<input type="text" name="codigo_etp2" class="form-control" required placeholder="Ingresa el código del filtro" maxlength="25"><br>
			<label><strong>Descripción corta:</strong></label>
			<input type="text" name="descripcion_corta_etp2" class="form-control" required placeholder="Añade una descripción" maxlength="90"><br>
			<label><strong>Familia:</strong></label>
			<select name="familia_etp2" class="form-control" required>
				<option></option>
				<option value="ABS">ABS - Absolutos</option>
				<option value="AT">AT - Alta temperatura</option>
				<option value="AV">AV - Bolsa</option>
				<option value="CU">CU - Cubo</option>
				<option value="FDV">FDV - Eficiencia ASHRAE</option>
				<option value="HB">HB - Eliminador de humedad</option>
				<option value="JA">JA - Aluminio</option>
				<option value="JAM">JAM - Multicapas</option>
				<option value="JC">JC - Cartón</option>
				<option value="JG">JG - Galvanizado</option>
				<option value="JI">JI - Inoxidable</option>
				<option value="JM">JM - Lavable</option>
				<option value="JP">JP - Plástico</option>
				<option value="PAD">PAD - Prefiltro sin marco</option>
				<option value="PRE">PRE - Rollo</option>
				<option value="RO">RO - Rollo</option>
				<option value="Accesorio">Accesorio</option>
				<option value="Equipo">Equipo</option>
				<option value="Servicio">Servicio</option>
				<option value="Componente">Componente</option>
				<option value="Empaque">Empaque</option>
			</select><br>
			<label><strong>Modelo:</strong></label>
			<select name="modelo_etp2" class="form-control" required>
				<option></option>
				<option value="A">A - Filtro</option>
				<option value="HEPA">HEPA - Filtro</option>
				<option value="AT300">AT300 - Filtro</option>
				<option value="AV">AV - Filtro</option>
				<option value="RV">RV - Filtro</option>
				<option value="RVAV">RVAV - Filtro</option>
				<option value="FSAV">FSAV - Filtro</option>
				<option value="CU">CU - Filtro</option>
				<option value="FDV">FDV - Filtro</option>
				<option value="HB">HB - Filtro</option>
				<option value="JA">JA - Filtro</option>
				<option value="JABR">JABR - Filtro</option>
				<option value="JAM">JAM - Filtro</option>
				<option value="JC">JC - Filtro</option>
				<option value="JCBR">JCBR - Filtro</option>
				<option value="JCCAI">JCCAI - Filtro</option>
				<option value="JCFV">JCFV - Filtro</option>
				<option value="JCM">JCM - Filtro</option>
				<option value="JG">JG - Filtro</option>
				<option value="JGBR">JGBR - Filtro</option>
				<option value="JGCAG">JGCAG - Filtro</option>
				<option value="JGCAI">JGCAI - Filtro</option>
				<option value="JGFV">JGFV - Filtro</option>
				<option value="JGM">JGM - Filtro</option>
				<option value="JGPER">JGPER - Filtro</option>
				<option value="JIBR">JIBR - Filtro</option>
				<option value="JICAI">JICAI - Filtro</option>
				<option value="JIFV">JIFV - Filtro</option>
				<option value="JM">JM - Filtro</option>
				<option value="JMA">JMA - Filtro</option>
				<option value="JMAFS">JMAFS - Filtro</option>
				<option value="JMFS">JMFS - Filtro</option>
				<option value="JMTC">JMTC - Filtro</option>
				<option value="JP">JP - Filtro</option>
				<option value="JPBR">JPBR - Filtro</option>
				<option value="JPFV">JPFV - Filtro</option>
				<option value="JPM">JPM - Filtro</option>
				<option value="640R2">640R2 - Filtro</option>
				<option value="PAD">PAD - Filtro</option>
				<option value="PADPANE">PADPANE - Filtro</option>
				<option value="J10">J10 - Filtro</option>
				<option value="PREJ">PREJ - Filtro</option>
				<option value="PREJB2">PREJB2 - Filtro</option>
				<option value="PREJC">PREJC - Fitro</option>
				<option value="PREJM">PREJM - Filtro</option>
				<option value="PREJS">PREJS - Filtro</option>
				<option value="PREJS2">PREJS2 - Filtro</option>
				<option value="PRESPER">PRESPER - Filtro</option>
				<option value="RO">RO - Filtro</option>
				<option value="ROCAI">ROCAI - Filtro</option>
				<option value="ROPAFV">ROPAFV - Filtro</option>
			</select><br>
			<label><strong>Tipo:</strong></label>
			<select name="tipo_etp2" class="form-control" required>
				<option></option>
				<option value="Cartucho / Rígido">Cartucho / Rígido</option>
				<option value="Bolsa">Bolsa</option>
				<option value="Prefiltro">Prefiltro</option>
			</select><br>
			<label><strong>Eficiencia:</strong></label>
			<select name="eficiencia_etp2" class="form-control" required>
				<option></option>
				<option value="30-35%">30-35% ASHRAE</option>
				<option value="30-50%">30-50% ASHRAE</option>
				<option value="40-45%">40-45% ASHRAE</option>
				<option value="40%">40% ASHRAE</option>
				<option value="45%">45% ASHRAE</option>
				<option value="50-55%">50-55% ASHRAE</option>
				<option value="60-65%">60-65% ASHRAE</option>
				<option value="70%">70% Gravimétrica</option>
				<option value="70-75%">70-75% ASHRAE</option>
				<option value="80%">80% Gravimétrica</option>
				<option value="80-85%">80-85% ASHRAE</option>
				<option value="85%">85% Gravimétrica</option>
				<option value="90-95%">90-95% ASHRAE</option>
				<option value="95%">95% PAO</option>
				<option value="98% ASHRAE">98% ASHRAE</option>
				<option value="98% PAO">98% PAO</option>
				<option value="99%">99% en separación gotas de agua >= 10 micras</option>
				<option value="99.90%">99.90% en Polvo Fino, 99.95% en Polvo Grueso</option>
				<option value="99.97%">99.97% PAO</option>
				<option value="99.99%">99.99% PAO</option>
				<!--option value="Alta colección de partículas de 2 a 3 micras">Alta colección de partículas de 2 a 3 micras</option-->
				<option value="EU5">EU5</option>
				<option value="99.995%">99.995% PAO</option>
				<option value="99.997%">99.997% PAO</option>
				<option value="99.998%">99.998% PAO</option>
				<option value="99.999%">99.999% PAO</option>
				<option value="99.9995%">99.9995% PAO</option>
			</select><br>
			<label><strong>Gasto:</strong></label>
			<input type="text" name="gasto_etp2" class="form-control" required placeholder="Ingresa el gasto" maxlength="20"><br>
			<label><strong>Alto Nominal:</strong></label>
			<input type="number" step="any" name="alto_nom_etp2" class="form-control" required placeholder="Ingresa el alto" maxlength="10"><br>
			<label><strong>Frente Nominal:</strong></label>
			<input type="number" step="any" name="frente_nom_etp2" class="form-control" required placeholder="Ingresa el frente" maxlength="10"><br>
			<label><strong>Fondo Nominal:</strong></label>
			<input type="number" step="any" name="fondo_nom_etp2" class="form-control" required placeholder="Ingresa el fondo" maxlength="10"><br>
			<label><strong>Unidad de Medida Nominal:</strong></label>
			<select name="um_nominal_etp2" class="form-control" required>
				<option></option>
				<option value="in">Pulgadas</option>
				<option value="mm">Milímetros</option>
				<option value="cm">Centímetros</option>
				<option value="ft">Pies</option>
				<option value="m">Metros</option>
			</select><br>
			<label><strong>Material del marco:</strong></label>
			<select name="marco_etp2" class="form-control" required>
				<option></option>
				<option value="Acero Inoxidable">Acero Inoxidable</option>
				<option value="Aluminio">Aluminio</option>
				<option value="Carton con cinta plastica">Cartón con cinta plástica</option>
				<option value="Lamina galvanizada">Lámina galvanizada</option>
				<option value="Carton">Cartón</option>
				<option value="Madera">Madera</option>
				<option value="Plastico">Plástico</option>
				<!--option value="Poliuretano">Poliuretano</option>
				<option value="Triplay">Triplay</option-->
			</select><br>
			<label><strong>Espesor del marco:</strong></label>
			<input type="number" name="espesor_etp2" step="any" class="form-control" required placeholder="Agrega el espesor del marco" maxlength="10"><br>
			<label><strong>Unidad de Medida Espesor:</strong></label>
			<select name="um_espesor_etp2" class="form-control" required>
				<option></option>
				<option value="in">Pulgadas</option>
				<option value="mm">Milímetros</option>
				<option value="cm">Centímetros</option>
				<option value="ft">Pies</option>
				<option value="m">Metros</option>
			</select><br>
			<label><strong>Media Filtrante:</strong></label>
			<select name="media_fil_etp2" class="form-control" required>
				<option></option>
				<option value="Aluminio multicapas">Aluminio multicapas</option>
				<option value="Borosilicato">Borosilicato</option>
				<option value="Carbon activado granulado">Carbón activado granulado</option>
				<option value="Carbon activado impregnado">Carbón activado impregnado</option>
				<option value="Carbon activado y permanganato de potasio">Carbón activado y permanganato de potasio</option>
				<option value="Celulosa">Celulosa</option>
				<option value="Fibra de vidrio">Fibra de vidrio</option>
				<option value="Fibra de vidrio con solucion tackifier impregnada">Fibra de vidrio con solución tackifier impregnada</option>
				<option value="Fibra de vidrio intercambiable">Fibra de vidrio intercambiable</option>
				<option value="Fibra sintetica">Fibra sintética</option>
				<option value="Fibra sintetica autosoportable">Fibra sintética autosoportable</option>
				<option value="Fibra sintetica con malla desplegada">Fibra sintética con malla desplegada</option>
				<option value="Fibra sintetica con solución tackifier impregnada">Fibra sintética con solución tackifier impregnada</option>
				<option value="Fibra sintetica impregnada con carbon activado">Fibra sintética impregnada con carbón activado</option>
				<option value="Fibra sintetica intercambiable">Fibra sintética intercambiable</option>
				<option value="Fibra sintetica y fibra de vidrio">Fibra sintética y fibra de vidrio</option>
				<option value="HOGHAIR">HOGHAIR</option>
				<option value="Mallas de acero inoxidable">Mallas de acero inoxidable</option>
				<option value="Mallas de aluminio">Mallas de aluminio</option>
				<option value="Mallas de aluminio y fibra sintetica intermedia">Mallas de aluminio y fibra sintética intermedia</option>
				<option value="Mallas de lamina galvanizada">Mallas de lámina galvanizada</option>
				<option value="Mallas metálicas y fibra sintetica intermedia">Mallas metálicas y fibra sintética intermedia</option>
				<option value="Mallas metalicas y fibra sintetica intercambiable">Mallas metálicas y fibra sintética intercambiable</option>
				<option value="Microfibra de vidrio">Microfibra de vidrio</option>
				<option value="Paint arrestor de fibra de vidrio">Paint arrestor de fibra de vidrio</option>
				<option value="Paint arrestor sintetico ">Paint arrestor sintético </option>
				<option value="Permanganato de potasio">Permanganato de potasio</option>
				<option value="Poroflex">Poroflex</option>
			</select><br>
			<label><strong>Forma de la Media Filtrante:</strong></label>
			<select name="forma_media_fil_etp2" class="form-control" required>
				<option></option>
				<option value="Plegada">Plegada</option>
				<option value="Liso">Liso</option>
				<option value="Lisas y plegadas alternas verticales">Lisas y plegadas alternas verticales</option>
				<option value="Lisas y plegadas alternas horizontales">Lisas y plegadas alternas horizontales</option>
			</select><br>
			<label><strong>Color de la Media Filtrante:</strong></label>
			<select name="color_media_fil_etp2" class="form-control" required>
				<option></option>
				<option value="Amarilla">Amarilla</option>
				<option value="Azul">Azul</option>
				<option value="Azul con blanco">Azul con blanco</option>
				<option value="Blanca">Blanca</option>
				<option value="Naranja (salmón)">Naranja (salmón)</option>
				<option value="Negra">Negra</option>
				<option value="Rojo con blanco">Rojo con blanco</option>
				<option value="Rosa">Rosa</option>
				<option value="Verde">Verde</option>
				<option value="Verde con blanco">Verde con blanco</option>
			</select><br>
			<label><strong>Bolsas:</strong></label>
			<input type="number" name="bolsas_etp2" class="form-control" required placeholder="Ingresa el número de bolsas" maxlength="5"><br>
			<label><strong>Media adherida al marco:</strong></label>
			<select name="media_ad_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="Si">Si</option>
			</select><br>
			<label><strong>Número de Separadores:</strong></label>
			<input type="number" name="num_separadores_etp2" class="form-control" required placeholder="Ingresa el número de separadores" maxlength="5"><br>
			<label><strong>Separador:</strong></label>
			<select name="separador_etp2" class="form-control" required>
				<option></option>
				<option value="N/A">No aplica</option>
				<option value="Minipleat">Minipleat</option>
				<option value="Kraft">Kraft</option>
				<option value="Aluminio">Aluminio</option>
				<option value="Plastico">Plástico</option>
				<option value="Peine Plastico">Peine Plástico</option>
			</select><br>
			<label><strong>Asa:</strong></label>
			<select name="asa_etp2" class="form-control" required>
				<option></option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select><br>
			<label><strong>Plenum:</strong></label>
			<select name="plenum_etp2" class="form-control" required>
				<option></option>
				<option value="N/A">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
			</select><br>
			<label><strong>Postes:</strong></label>
			<select name="postes_etp2" class="form-control" required>
				<option></option>
				<option value="Plastico">Plástico</option>
				<option value="Metalicos">Metálicos</option>
				<option value="Lamina Galvanizada">Lámina Galvanizada</option>
			</select><br>
			<label><strong>Rejilla:</strong></label>
			<select name="rejilla_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
			</select><br>
			<label><strong>Contramarco:</strong></label>
			<select name="contramarco_etp2" class="form-control" required>
				<option></option>
				<option value="N/A">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
				<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
			</select><br>
			<label><strong>Construcción:</strong></label>
			<select name="construccion_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="W">W</option>
			</select><br><label><strong>Sello:</strong></label>
			<select name="sello_etp2" class="form-control" required>
				<option></option>
				<option value="Neopreno">Neopreno</option>
				<option value="Gel">Gel</option>
			</select><br>
			<label><strong>Perfil del Gel:</strong></label>
			<select name="perfil_gel_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="Difusor">Difusor</option>
				<option value="Modulo">Módulo</option>
				<option value="Difusor tipo F">Difusor tipo F</option>
			</select><br>
			<label><strong>Ubicación del Gel:</strong></label>
			<select name="ubicacion_gel_etp2" class="form-control" required>
				<option></option>
				<option value="N/A">No aplica</option>
				<option value="Entrada Aire">Entrada Aire</option>
				<option value="Salida Aire">Salida Aire</option>
			</select><br>
			<label><strong>Alta temperatura:</strong></label>
			<select name="temperatura_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="160">Hasta 160 Grados centígrados</option>
				<option value="260">Hasta 260 Grados centígrados</option>
				<option value="100">Hasta 100 Grados centígrados</option>
				<option value="120">Hasta 120 Grados centígrados</option>
				<option value="250">Hasta 250 Grados centígrados</option>
				<option value="220">220 Grados centígrados</option>
				<option value="750">750 Grados farenheit</option>
				<option value="AT16">AT16 - hasta 160 Grados centígrados</option>
				<option value="ATFDV">ATFDV - hasta 220 Grados centígrados</option>
				<option value="AT12">AT12 - hasta 120 Grados centígrados</option>
				<option value="900">900 Grados farenheit</option>
				<option value="AT10">AT10 – hasta 100 Grados centígrados</option>
				<option value="AT">AT – hasta 160 Grados centígrados</option>
			</select><br>
			<label><strong>Alma acero:</strong></label>
			<select name="alma_acero_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="Si">Si</option>
			</select><br>
			<label><strong>Invertido:</strong></label>
			<select name="invertido_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="Si">Si</option>
			</select><br>
			<label><strong>Alto Real:</strong></label>
			<input type="number" step="any" name="alto_real_etp2" class="form-control" required placeholder="Ingresa el alto" maxlength="10"><br>
			<label><strong>Frente Real:</strong></label>
			<input type="number" step="any" name="frente_real_etp2" class="form-control" required placeholder="Ingresa el frente" maxlength="10"><br>
			<label><strong>Fondo Real:</strong></label>
			<input type="number" step="any" name="fondo_real_etp2" class="form-control" required placeholder="Ingresa el fondo" maxlength="10"><br>
			<label><strong>Unidad de Medida Real:</strong></label>
			<select name="um_real_etp2" class="form-control" required>
				<option></option>
				<option value="in">Pulgadas</option>
				<option value="mm">Milímetros</option>
				<option value="cm">Centímetros</option>
				<option value="ft">Pies</option>
				<option value="m">Metros</option>
			</select><br>
			<label><strong>UM Venta:</strong></label>
			<select name="um_venta_etp2" class="form-control" required>
				<option></option>
				<option value="No aplica">No aplica</option>
				<option value="Horas">Horas</option>
				<option value="Juego">Juego</option>
				<option value="Kilos">Kilos</option>
				<option value="Metros">Metros</option>
				<option value="Pies">Pies</option>
				<option value="Piezas">Piezas</option>
				<option value="Servicio">Servicio</option>
				<option value="Metros cuadrados">Metros cuadrados</option>
				<option value="Pies cuadrados">Pies cuadrados</option>
			</select><br>
			<label><strong>Marca:</strong></label>
			<input type="text" name="marca_etp2" class="form-control" required placeholder="Ingresa la marca" maxlength="10"><br>
			<label><strong>Capacidad:</strong></label>
			<input type="number" name="capacidad_etp2" class="form-control" required placeholder="Ingresa la capacidad" maxlength="10"><br>
			<label><strong>CPI:</strong></label>
			<input type="number" name="cpi_etp2" class="form-control" required placeholder="Anota el valor correspondiente" maxlength="10"><br>
			<label><strong>Capacidad Instalada:</strong></label>
			<input type="number" name="capacidad_instalada_etp2" class="form-control" required placeholder="Ingresa la capacidad instalada" maxlength="10"><br>

			<p class="alert alert-warinig"><center><strong>8 MB</strong> Es el tamaño máximo permitido para fotografías e imágenes.</p></center><br>

			<label><strong>Foto 1 <i>(Opcional | Esta será la que se muestra en el PDF)</i>:</strong></label>
			<input type="file" name="foto_1_etp2" class="form-control"><br>
			<label><strong>Foto 2 <i>(Opcional)</i>:</strong></label>
			<input type="file" name="foto_2_etp2" class="form-control"><br>
			<label><strong>Foto 3 <i>(Opcional)</i>:</strong></label>
			<input type="file" name="foto_3_etp2" class="form-control"><br>
			<label><strong>Foto 4 <i>(Opcional)</i>:</strong></label>
			<input type="file" name="foto_4_etp2" class="form-control"><br><br>
			<label><strong>Comentarios <i>(Opcional)</i>:</strong></label>
			<textarea name="comentarios_etp2" class="form-control" placeholder="Agrega tus comentarios en este apartado"></textarea><br>
			<label><strong>Observaciones <i>(Opcional)</i>:</strong></label>
			<textarea name="observaciones_etp2" class="form-control" placeholder="Ingresa las observaciones pertinentes aquí"></textarea><br>
			<center><button type="submit" class="btn btn-success" name="guardar_etp2"><strong>Guardar</strong></button></center><br>
		</form><br>
	</div>

</body>
</html>

<?php include '../../../assets/subir.php'; ?>
<script type="text/javascript" src="../../../js/subir.js"></script>