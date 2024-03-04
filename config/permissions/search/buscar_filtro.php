<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	require '../../conex.php'; ?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_busqueda.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>

		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/filtro.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Buscar Filtro</h3><br>
			<div class="card">
				<div class="card bg-secondary text-white"><center><h6><strong>Para poder realizar la búsqueda un filtro debes de llenar alguno de los campos de este formulario</strong></h6></center></div>
			</div>

			<form method="POST" action="#" class="border border-secondary form-control">
				<label><strong>Número de Filtros:</strong></label>
				<select class="form-control">
					<option value="igual">Igual a</option>
					<option value="rango">En Rango</option>
				</select><br>
				<input type="text" name="no_filtros" class="form-control"  placeholder="Ingresa el valor solicitado" maxlength="25"><br>
				<label><strong>Código:</strong></label>
				<input type="text" name="codigo" class="form-control"  placeholder="Ingresa el código del filtro" maxlength="25"><br>
				<label><strong>Descripción corta:</strong></label>
				<input type="text" name="descripcion_corta" class="form-control"  placeholder="Añade una descripción" maxlength="90"><br>
				<label><strong>Familia:</strong></label>
				<select name="familia" class="form-control" >
					<option> - Selecciona la familia - </option>
					<option value="ABS - Absolutos">ABS - Absolutos</option>
					<option value="AT - Alta temperatura">AT - Alta temperatura</option>
					<option value="AV - Bolsa">AV - Bolsa</option>
					<option value="CU - Cubo">CU - Cubo</option>
					<option value="FDV - Eficiencia ASHRAE">FDV - Eficiencia ASHRAE</option>
					<option value="HB - Eliminador de humedad">HB - Eliminador de humedad</option>
					<option value="JA - Aluminio">JA - Aluminio</option>
					<option value="JAM - Multicapas">JAM - Multicapas</option>
					<option value="JC - Cartón">JC - Cartón</option>
					<option value="JG - Galvanizado">JG - Galvanizado</option>
					<option value="JI - Inoxidable">JI - Inoxidable</option>
					<option value="JM - Lavable">JM - Lavable</option>
					<option value="JP - Plástico">JP - Plástico</option>
					<option value="PAD - Prefiltro sin marco">PAD - Prefiltro sin marco</option>
					<option value="PRE - Rollo">PRE - Rollo</option>
					<option value="RO - Rollo">RO - Rollo</option>
					<option value="Accesorio">Accesorio</option>
					<option value="Equipo">Equipo</option>
					<option value="Servicio">Servicio</option>
					<option value="Componente">Componente</option>
					<option value="Empaque">Empaque</option>
				</select><br>
				<label><strong>Modelo:</strong></label>
				<select name="modelo" class="form-control" >
					<option> - Selecciona el modelo - </option>
					<option value="A - Filtro">A - Filtro</option>
					<option value="HEPA - Filtro">HEPA - Filtro</option>
					<option value="AT300 - Filtro">AT300 - Filtro</option>
					<option value="AV - Filtro">AV - Filtro</option>
					<option value="RV - Filtro">RV - Filtro</option>
					<option value="RVAV - Filtro">RVAV - Filtro</option>
					<option value="FSAV - Filtro">FSAV - Filtro</option>
					<option value="CU - Filtro">CU - Filtro</option>
					<option value="FDV - Filtro">FDV - Filtro</option>
					<option value="HB - Filtro">HB - Filtro</option>
					<option value="JA - Filtro">JA - Filtro</option>
					<option value="JABR - Filtro">JABR - Filtro</option>
					<option value="JAM - Filtro">JAM - Filtro</option>
					<option value="JC - Filtro">JC - Filtro</option>
					<option value="JCBR - Filtro">JCBR - Filtro</option>
					<option value="JCCAI - Filtro">JCCAI - Filtro</option>
					<option value="JCFV - Filtro">JCFV - Filtro</option>
					<option value="JCM - Filtro">JCM - Filtro</option>
					<option value="JG - Filtro">JG - Filtro</option>
					<option value="JGBR - Filtro">JGBR - Filtro</option>
					<option value="JGCAG - Filtro">JGCAG - Filtro</option>
					<option value="JGCAI - Filtro">JGCAI - Filtro</option>
					<option value="JGFV - Filtro">JGFV - Filtro</option>
					<option value="JGM - Filtro">JGM - Filtro</option>
					<option value="JGPER - Filtro">JGPER - Filtro</option>
					<option value="JIBR - Filtro">JIBR - Filtro</option>
					<option value="JICAI - Filtro">JICAI - Filtro</option>
					<option value="JIFV - Filtro">JIFV - Filtro</option>
					<option value="JM - Filtro">JM - Filtro</option>
					<option value="JMA - Filtro">JMA - Filtro</option>
					<option value="JMAFS - Filtro">JMAFS - Filtro</option>
					<option value="JMFS - Filtro">JMFS - Filtro</option>
					<option value="JMTC - Filtro">JMTC - Filtro</option>
					<option value="JP - Filtro">JP - Filtro</option>
					<option value="JPBR - Filtro">JPBR - Filtro</option>
					<option value="JPFV - Filtro">JPFV - Filtro</option>
					<option value="JPM - Filtro">JPM - Filtro</option>
					<option value="640R2 - Filtro">640R2 - Filtro</option>
					<option value="PAD - Filtro">PAD - Filtro</option>
					<option value="PADPANE - Filtro">PADPANE - Filtro</option>
					<option value="J10 - Filtro">J10 - Filtro</option>
					<option value="PREJ - Filtro">PREJ - Filtro</option>
					<option value="PREJB2 - Filtro">PREJB2 - Filtro</option>
					<option value="PREJC - Fitro">PREJC - Fitro</option>
					<option value="PREJM - Filtro">PREJM - Filtro</option>
					<option value="PREJS - Filtro">PREJS - Filtro</option>
					<option value="PREJS2 - Filtro">PREJS2 - Filtro</option>
					<option value="PRESPER - Filtro">PRESPER - Filtro</option>
					<option value="RO - Filtro">RO - Filtro</option>
					<option value="ROCAI - Filtro">ROCAI - Filtro</option>
					<option value="ROPAFV - Filtro">ROPAFV - Filtro</option>
				</select><br>
				<label><strong>Tipo:</strong></label>
				<select name="tipo" class="form-control" >
					<option> - Selecciona el tipo - </option>
					<option value="Cartucho / Rígido">Cartucho / Rígido</option>
					<option value="Bolsa">Bolsa</option>
					<option value="Prefiltro">Prefiltro</option>
				</select><br>
				<label><strong>Eficiencia:</strong></label>
				<select name="eficiencia" class="form-control" >
					<option> - Selecciona la eficiencia - </option>
					<option value="30-35% ASHRAE">30-35% ASHRAE</option>
					<option value="30-50% ASHRAE">30-50% ASHRAE</option>
					<option value="40-45% ASHRAE">40-45% ASHRAE</option>
					<option value="40% ASHRAE">40% ASHRAE</option>
					<option value="45% ASHRAE">45% ASHRAE</option>
					<option value="50-55% ASHRAE">50-55% ASHRAE</option>
					<option value="60-65% ASHRAE">60-65% ASHRAE</option>
					<option value="70% Gravimétrica">70% Gravimétrica</option>
					<option value="70-75% ASHRAE">70-75% ASHRAE</option>
					<option value="80% Gravimétrica">80% Gravimétrica</option>
					<option value="80-85% ASHRAE">80-85% ASHRAE</option>
					<option value="85% Gravimétrica">85% Gravimétrica</option>
					<option value="90-95% ASHRAE">90-95% ASHRAE</option>
					<option value="95% PAO">95% PAO</option>
					<option value="98% ASHRAE">98% ASHRAE</option>
					<option value="98% PAO">98% PAO</option>
					<option value="99% en separación gotas de agua >= 10 micras">99% en separación gotas de agua >= 10 micras</option>
					<option value="99.90% en Polvo Fino, 99.95% en Polvo Grueso">99.90% en Polvo Fino, 99.95% en Polvo Grueso</option>
					<option value="99.97% PAO">99.97% PAO</option>
					<option value="99.99% PAO">99.99% PAO</option>
					<option value="Alta colección de partículas de 2 a 3 micras">Alta colección de partículas de 2 a 3 micras</option>
					<option value="EU5">EU5</option>
					<option value="99.995% PAO">99.995% PAO</option>
					<option value="99.997% PAO">99.997% PAO</option>
					<option value="99.998% PAO">99.998% PAO</option>
					<option value="99.999% PAO">99.999% PAO</option>
					<option value="99.9995% PAO">99.9995% PAO</option>
				</select><br>
				<label><strong>Gasto:</strong></label>
				<input type="text" name="gasto" class="form-control"  placeholder="Ingresa el gasto" maxlength="20"><br>
				<label><strong>Alto Nominal:</strong></label>
				<input type="number" name="alto_nom" class="form-control"  placeholder="Ingresa el alto" maxlength="10"><br>
				<label><strong>Frente Nominal:</strong></label>
				<input type="number" name="frente_nom" class="form-control"  placeholder="Ingresa el frente" maxlength="10"><br>
				<label><strong>Fondo Nominal:</strong></label>
				<input type="number" name="fondo_nom" class="form-control"  placeholder="Ingresa el fondo" maxlength="10"><br>
				<label><strong>Unidad de Medida Nominal:</strong></label>
				<select name="um_nominal" class="form-control" >
					<option> - Selecciona la unidad de medida nominal - </option>
					<option value="in">Pulgadas</option>
					<option value="mm">Milímetros</option>
					<option value="cm">Centímetros</option>
					<option value="ft">Pies</option>
					<option value="m">Metros</option>
				</select><br>
				<label><strong>Material del marco:</strong></label>
				<select name="marco" class="form-control" >
					<option> - Selecciona el material del marco - </option>
					<option value="Acero Inoxidable">Acero Inoxidable</option>
					<option value="Aluminio">Aluminio</option>
					<option value="Cartón con cinta plástica">Cartón con cinta plástica</option>
					<option value="Lámina galvanizada">Lámina galvanizada</option>
					<option value="Cartón">Cartón</option>
					<option value="Madera">Madera</option>
					<option value="Plástico">Plástico</option>
					<option value="Poliuretano">Poliuretano</option>
					<option value="Triplay">Triplay</option>
				</select><br>
				<label><strong>Espesor del marco:</strong></label>
				<input type="number" name="espesor" class="form-control"  placeholder="Agrega el espesor del marco" maxlength="10"><br>
				<label><strong>Unidad de Medida Espesor:</strong></label>
				<select name="um_espesor" class="form-control" >
					<option> - Selecciona la unidad de medida del espesor - </option>
					<option value="in">Pulgadas</option>
					<option value="mm">Milímetros</option>
					<option value="cm">Centímetros</option>
					<option value="ft">Pies</option>
					<option value="m">Metros</option>
				</select><br>
				<label><strong>Media Filtrante:</strong></label>
				<select name="media_fil" class="form-control" >
					<option> - Selecciona la media filtrante - </option>
					<option value="Aluminio multicapas">Aluminio multicapas</option>
					<option value="Borosilicato">Borosilicato</option>
					<option value="Carbón activado granulado">Carbón activado granulado</option>
					<option value="Carbón activado impregnado">Carbón activado impregnado</option>
					<option value="Carbón activado y permanganato de potasio">Carbón activado y permanganato de potasio</option>
					<option value="Celulosa">Celulosa</option>
					<option value="Fibra de vidrio">Fibra de vidrio</option>
					<option value="Fibra de vidrio con solución tackifier impregnada">Fibra de vidrio con solución tackifier impregnada</option>
					<option value="Fibra de vidrio intercambiable">Fibra de vidrio intercambiable</option>
					<option value="Fibra sintética">Fibra sintética</option>
					<option value="Fibra sintética autosoportable">Fibra sintética autosoportable</option>
					<option value="Fibra sintética con malla desplegada">Fibra sintética con malla desplegada</option>
					<option value="Fibra sintética con solución tackifier impregnada">Fibra sintética con solución tackifier impregnada</option>
					<option value="Fibra sintética impregnada con carbón activado">Fibra sintética impregnada con carbón activado</option>
					<option value="Fibra sintética intercambiable">Fibra sintética intercambiable</option>
					<option value="Fibra sintética y fibra de vidrio">Fibra sintética y fibra de vidrio</option>
					<option value="HOGHAIR">HOGHAIR</option>
					<option value="Mallas de acero inoxidable">Mallas de acero inoxidable</option>
					<option value="Mallas de aluminio">Mallas de aluminio</option>
					<option value="Mallas de aluminio y fibra sintética intermedia">Mallas de aluminio y fibra sintética intermedia</option>
					<option value="Mallas de lámina galvanizada">Mallas de lámina galvanizada</option>
					<option value="Mallas metálicas y fibra sintética intermedia">Mallas metálicas y fibra sintética intermedia</option>
					<option value="Mallas metálicas y fibra sintética intercambiable">Mallas metálicas y fibra sintética intercambiable</option>
					<option value="Microfibra de vidrio">Microfibra de vidrio</option>
					<option value="Paint arrestor de fibra de vidrio">Paint arrestor de fibra de vidrio</option>
					<option value="Paint arrestor sintético ">Paint arrestor sintético </option>
					<option value="Permanganato de potasio">Permanganato de potasio</option>
					<option value="Poroflex">Poroflex</option>
				</select><br>
				<label><strong>Forma de la Media Filtrante:</strong></label>
				<select name="forma_media_fil" class="form-control" >
					<option> - Selecciona la forma de la media filtrante - </option>
					<option value="Plegada">Plegada</option>
					<option value="Liso">Liso</option>
					<option value="Lisas y plegadas alternas verticales">Lisas y plegadas alternas verticales</option>
					<option value="Lisas y plegadas alternas horizontales">Lisas y plegadas alternas horizontales</option>
				</select><br>
				<label><strong>Color de la Media Filtrante:</strong></label>
				<select name="color_media_fil" class="form-control" >
					<option> - Selecciona el color de la media filtrante - </option>
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
				<input type="number" name="bolsas" class="form-control"  placeholder="Ingresa el número de bolsas" maxlength="5"><br>
				<label><strong>Media adherida al marco:</strong></label>
				<select name="media_ad" class="form-control" >
					<option> - Selecciona la media adherida al marco - </option>
					<option value="No aplica">No aplica</option>
					<option value="Si">Si</option>
				</select><br>
				<label><strong>Separador:</strong></label>
				<select name="separador" class="form-control" >
					<option> - Selecciona el tipo de separador - </option>
					<option value="Minipleat">Minipleat</option>
					<option value="Kraft">Kraft</option>
					<option value="Aluminio">Aluminio</option>
					<option value="Plástico">Plástico</option>
				</select><br>
				<label><strong>Asa:</strong></label>
				<select name="asa" class="form-control" >
					<option> - Selecciona la cantidad de asas - </option>
					<option value="1">1</option>
					<option value="2">2</option>
				</select><br>
				<label><strong>Sello:</strong></label>
				<select name="sello" class="form-control" >
					<option> - Selecciona el tipo de sello - </option>
					<option value="Neopreno">Neopreno</option>
					<option value="Gel">Gel</option>
				</select><br>
				<label><strong>Plenum:</strong></label>
				<select name="plenum" class="form-control" >
					<option> - Selecciona el tipo de plenum - </option>
					<option value="No aplica">No aplica</option>
					<option value="Entrada Aire">Entrada Aire</option>
					<option value="Salida Aire">Salida Aire</option>
					<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>
				<label><strong>Postes:</strong></label>
				<select name="postes" class="form-control" >
					<option> - Selecciona el tipo de poste - </option>
					<option value="Plástico">Plástico</option>
					<option value="Metálicos">Metálicos</option>
					<option value="Lámina Galvanizada">Lámina Galvanizada</option>
				</select><br>
				<label><strong>Rejilla:</strong></label>
				<select name="rejilla" class="form-control" >
					<option> - Selecciona el tipo de rejilla - </option>
					<option value="No aplica">No aplica</option>
					<option value="Entrada Aire">Entrada Aire</option>
					<option value="Salida Aire">Salida Aire</option>
					<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>
				<label><strong>Contramarco:</strong></label>
				<select name="contramarco" class="form-control" >
					<option> - Selecciona el tipo de contramarco - </option>
					<option value="No aplica">No aplica</option>
					<option value="Entrada Aire">Entrada Aire</option>
					<option value="Salida Aire">Salida Aire</option>
					<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
				</select><br>
				<label><strong>Construcción:</strong></label>
				<select name="construccion" class="form-control" >
					<option> - Selecciona el tipo de construcción - </option>
					<option value="No aplica">No aplica</option>
					<option value="W">W</option>
				</select><br>
				<label><strong>Perfil del Gel:</strong></label>
				<select name="perfil_gel" class="form-control" >
					<option> - Selecciona el tipo de gel - </option>
					<option value="No aplica">No aplica</option>
					<option value="Difusor">Difusor</option>
					<option value="Módulo">Módulo</option>
					<option value="Difusor tipo F">Difusor tipo F</option>
				</select><br>
				<label><strong>Ubicación del Gel:</strong></label>
				<select name="ubicacion_gel" class="form-control" >
					<option> - Selecciona la ubicación del gel - </option>
					<option value="No aplica">No aplica</option>
					<option value="Entrada Aire">Entrada Aire</option>
					<option value="Salida Aire">Salida Aire</option>
				</select><br>
				<label><strong>Alta temperatura:</strong></label>
				<select name="temperatura" class="form-control" >
					<option> - Selecciona la temperatura - </option>
					<option value="No aplica">No aplica</option>
					<option value="Hasta 160 Grados centígrados">Hasta 160 Grados centígrados</option>
					<option value="Hasta 260 Grados centígrados">Hasta 260 Grados centígrados</option>
					<option value="Hasta 100 Grados centígrados">Hasta 100 Grados centígrados</option>
					<option value="Hasta 120 Grados centígrados">Hasta 120 Grados centígrados</option>
					<option value="Hasta 250 Grados centígrados">Hasta 250 Grados centígrados</option>
					<option value="220 Grados centígrados">220 Grados centígrados</option>
					<option value="750 Grados farenheit">750 Grados farenheit</option>
					<option value="AT16 - hasta 160 Grados centígrados">AT16 - hasta 160 Grados centígrados</option>
					<option value="ATFDV - hasta 220 Grados centígrados">ATFDV - hasta 220 Grados centígrados</option>
					<option value="AT12 - hasta 120 Grados centígrados">AT12 - hasta 120 Grados centígrados</option>
					<option value="900 Grados farenheit">900 Grados farenheit</option>
					<option value="AT10 – hasta 100 Grados centígrados">AT10 – hasta 100 Grados centígrados</option>
					<option value="AT – hasta 160 Grados centígrados">AT – hasta 160 Grados centígrados</option>
				</select><br>
				<label><strong>Alma acero:</strong></label>
				<select name="alma_acero" class="form-control" >
					<option> - Selecciona el alma de acero - </option>
					<option value="No aplica">No aplica</option>
					<option value="Si">Si</option>
				</select><br>
				<label><strong>Invertido:</strong></label>
				<select name="invertido" class="form-control" >
					<option> - Selecciona si es invertido - </option>
					<option value="No aplica">No aplica</option>
					<option value="Si">Si</option>
				</select><br>
				<label><strong>Alto Real:</strong></label>
				<input type="number" name="alto_real" class="form-control"  placeholder="Ingresa el alto" maxlength="10"><br>
				<label><strong>Frente Real:</strong></label>
				<input type="number" name="frente_real" class="form-control"  placeholder="Ingresa el frente" maxlength="10"><br>
				<label><strong>Fondo Real:</strong></label>
				<input type="number" name="fondo_real" class="form-control"  placeholder="Ingresa el fondo" maxlength="10"><br>
				<label><strong>Unidad de Medida Real:</strong></label>
				<select name="um_real" class="form-control" >
					<option> - Selecciona la unidad de medida real - </option>
					<option value="in">Pulgadas</option>
					<option value="mm">Milímetros</option>
					<option value="cm">Centímetros</option>
					<option value="ft">Pies</option>
					<option value="m">Metros</option>
				</select><br>
				<label><strong>UM Venta:</strong></label>
				<select name="um_venta" class="form-control" >
					<option> - Selecciona la unidad de medida de venta - </option>
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
				<label><strong>Ordenar por:</strong></label>
				<select name="orden" class="form-control">
					<option value="no_filtros">No_Filtros</option>
					<option value="codigo">Código</option>
					<option value="descripcion_corta">Descripción Corta</option>
					<option value="familia">Familia</option>
					<option value="modelo">Modelo</option>
					<option value="tipo">Tipo</option>
					<option value="eficiencia">Eficiencia</option>
					<option value="gasto">Gasto</option>
					<option value="alto">Alto</option>
					<option value="frente">Frente</option>
					<option value="fondo">Fondo</option>
				</select>
				<br>
				<center><input type="submit" class="btn btn-success" name="buscar_filtro" value="Buscar"></center><br>
			</form><br>
		</div>

	</body>
	</html>

<?php include '../../../assets/subir.php';

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>
<script type="text/javascript" src="../../../js/subir.js"></script>