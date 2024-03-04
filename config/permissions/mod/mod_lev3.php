<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { 
	$uma = $_SERVER['QUERY_STRING'];

	require '../../conex.php';

	$q_lev1 = $con->prepare("SELECT * FROM levantamientos WHERE uma = :uma");
	$q_lev1->bindValue(':uma', $uma);
	$q_lev1->setFetchMode(PDO::FETCH_OBJ);
	$q_lev1->execute();

	$levantamientos_uno = $q_lev1->fetchAll();

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br>
		<div class="container col-sm-8 panel panel-body"><br><br>
			<img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Editar Levantamiento de UMA: <strong><?php echo $uma; ?></strong></h3><br>
			<div class="card">
				<div class="card bg-danger text-white"><center><h6><strong>Para poder editar un levantamiento existente debes de llenar todos los campos de este formulario</strong></h6></center></div>
			</div>

			<form method="POST" action="../../functions/mod/mod_lev3.php?<?php echo $uma;?>" class="border border-danger form-control">
				<center><h4 style="margin-top: 10px;">Etapa: <strong><?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $etapa) {
						echo $etapa -> etapa_etp3;
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?></strong></h4></center><br>

				<label><strong>Código:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $codigo) {
						echo '<input type="text" name="codigo_etp3" class="form-control"  placeholder="Ingresa el código del filtro" maxlength="25" value="'.$codigo->codigo_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Descripción corta:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $descripcion_corta) {
						echo '<input type="text" name="descripcion_corta_etp3" class="form-control"  placeholder="Añade una descripción" maxlength="90" value="'.$descripcion_corta->descripcion_corta_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Familia:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $familia) {
						echo '<select name="familia_etp3" class="form-control" >
						<option value="'.$familia -> familia_etp3.'">'.$familia -> familia_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Modelo:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $modelo) {
						echo '<select name="modelo_etp3" class="form-control" >
						<option value="'.$modelo -> modelo_etp3.'">'.$modelo -> modelo_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Tipo:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $tipo) {
						echo '<select name="tipo_etp3" class="form-control" >
						<option value="'.$tipo -> tipo_etp3.'">'.$tipo -> tipo_etp3.' - (Actual)</option>
						<option value="Cartucho / Rígido">Cartucho / Rígido</option>
						<option value="Bolsa">Bolsa</option>
						<option value="Prefiltro">Prefiltro</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Eficiencia:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $eficiencia) {
						echo '<select name="eficiencia_etp3" class="form-control" >
						<option value="'.$eficiencia -> eficiencia_etp3.'">'.$eficiencia -> eficiencia_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Gasto:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $gasto) {
						echo '<input type="text" name="gasto_etp3" class="form-control"  placeholder="Ingresa el gasto" maxlength="20" value="'.$gasto -> gasto_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>
				<label><strong>Alto Nominal:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $alto_nominal) {
						echo '<input type="number" step="any" name="alto_nom_etp3" class="form-control"  placeholder="Ingresa el alto" maxlength="10" value="'.$alto_nominal -> alto_nom_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Frente Nominal:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $frente_nominal) {
						echo '<input type="number" step="any" name="frente_nom_etp3" class="form-control"  placeholder="Ingresa el frente" maxlength="10" value="'.$frente_nominal -> frente_nom_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Fondo Nominal:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $fondo_nominal) {
						echo '<input type="number" step="any" name="fondo_nom_etp3" class="form-control"  placeholder="Ingresa el fondo" maxlength="10" value="'.$fondo_nominal -> fondo_nom_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Unidad de Medida Nominal:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $um_nominal) {
						echo '<select name="um_nominal_etp3" class="form-control" >
						<option value="'.$um_nominal -> um_nominal_etp3.'">'.$um_nominal -> um_nominal_etp3.' - (Actual)</option>
						<option value="in">Pulgadas</option>
						<option value="mm">Milímetros</option>
						<option value="cm">Centímetros</option>
						<option value="ft">Pies</option>
						<option value="m">Metros</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Material del marco:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $marco) {
						echo '<select name="marco_etp3" class="form-control" >
						<option value="'.$marco -> marco_etp3.'">'.$marco -> marco_etp3.' - (Actual)</option>
						<option value="Acero Inoxidable">Acero Inoxidable</option>
						<option value="Aluminio">Aluminio</option>
						<option value="Carton con cinta plastica">Cartón con cinta plástica</option>
						<option value="Lamina galvanizada">Lámina galvanizada</option>
						<option value="Carton">Cartón</option>
						<option value="Madera">Madera</option>
						<option value="Plastico">Plástico</option>
						<!--option value="Poliuretano">Poliuretano</option>
						<option value="Triplay">Triplay</option-->
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Espesor del marco:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $espesor) {
						echo '<input type="number" name="espesor_etp3" step="any" class="form-control"  placeholder="Agrega el espesor del marco" maxlength="10" value="'.$espesor -> espesor_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Unidad de Medida Espesor:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $um_espesor) {
						echo '<select name="um_espesor_etp3" class="form-control" >
						<option value="'.$um_espesor -> um_espesor_etp3.'">'.$um_espesor -> um_espesor_etp3.' - (Actual)</option>
						<option value="in">Pulgadas</option>
						<option value="mm">Milímetros</option>
						<option value="cm">Centímetros</option>
						<option value="ft">Pies</option>
						<option value="m">Metros</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Media Filtrante:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $media_fil) {
						echo '<select name="media_fil_etp3" class="form-control" >
						<option value="'.$media_fil -> media_fil_etp3.'">'.$media_fil -> media_fil_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Forma de la Media Filtrante:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $forma_media_fil) {
						echo '<select name="forma_media_fil_etp3" class="form-control" >
						<option value="'.$forma_media_fil -> forma_media_fil_etp3.'">'.$forma_media_fil -> forma_media_fil_etp3.' - (Actual)</option>
						<option value="Plegada">Plegada</option>
						<option value="Liso">Liso</option>
						<option value="Lisas y plegadas alternas verticales">Lisas y plegadas alternas verticales</option>
						<option value="Lisas y plegadas alternas horizontales">Lisas y plegadas alternas horizontales</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Color de la Media Filtrante:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $color_media_fil) {
						echo '<select name="color_media_fil_etp3" class="form-control" >
						<option value="'.$color_media_fil -> color_media_fil_etp3.'">'.$color_media_fil -> color_media_fil_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Bolsas:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $bolsas) {
						echo '<input type="number" name="bolsas_etp3" class="form-control"  placeholder="Ingresa el número de bolsas" maxlength="5" value="'.$bolsas -> bolsas_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Media adherida al marco:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $media_ad) {
						echo '<select name="media_ad_etp3" class="form-control" >
						<option value="'.$media_ad -> media_ad_etp3.'">'.$media_ad -> media_ad_etp3.' - (Actual)</option>
						<option value="No aplica">No aplica</option>
						<option value="Si">Si</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Número de Separadores:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $num_separadores) {
						echo '<input type="number" name="num_separadores_etp3" class="form-control"  placeholder="Ingresa el número de separadores" maxlength="5" value="'.$num_separadores -> num_separadores_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Separador:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $separador) {
						echo '<select name="separador_etp3" class="form-control" >
						<option value="'.$separador -> separador_etp3.'">'.$separador -> separador_etp3.' - (Actual)</option>
						<option value="N/A">No aplica</option>
						<option value="Minipleat">Minipleat</option>
						<option value="Kraft">Kraft</option>
						<option value="Aluminio">Aluminio</option>
						<option value="Plastico">Plástico</option>
						<option value="Peine Plastico">Peine Plástico</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Asa:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $asa) {
						echo '<select name="asa_etp3" class="form-control" >
						<option value="'.$asa -> asa_etp3.'">'.$asa -> asa_etp3.' - (Actual)</option>
						<option value="1">1</option>
						<option value="2">2</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Plenum:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $plenum) {
						echo '<select name="plenum_etp3" class="form-control" >
						<option value="'.$plenum -> plenum_etp3.'">'.$plenum -> plenum_etp3.' - (Actual)</option>
						<option value="N/A">No aplica</option>
						<option value="Entrada Aire">Entrada Aire</option>
						<option value="Salida Aire">Salida Aire</option>
						<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Postes:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $postes) {
						echo '<select name="postes_etp3" class="form-control" >
						<option value="'.$postes -> postes_etp3.'">'.$postes -> postes_etp3.' - (Actual)</option>
						<option value="Plastico">Plástico</option>
						<option value="Metalicos">Metálicos</option>
						<option value="Lamina Galvanizada">Lámina Galvanizada</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Rejilla:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $rejilla) {
						echo '<select name="rejilla_etp3" class="form-control" >
						<option value="'.$rejilla -> rejilla_etp3.'">'.$rejilla -> rejilla_etp3.' - (Actual)</option>
						<option value="No aplica">No aplica</option>
						<option value="Entrada Aire">Entrada Aire</option>
						<option value="Salida Aire">Salida Aire</option>
						<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Contramarco:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $contramarco) {
						echo '<select name="contramarco_etp3" class="form-control" >
						<option value="'.$contramarco -> contramarco_etp3.'">'.$contramarco -> contramarco_etp3.' - (Actual)</option>
						<option value="N/A">No aplica</option>
						<option value="Entrada Aire">Entrada Aire</option>
						<option value="Salida Aire">Salida Aire</option>
						<option value="Entrada y Salida de Aire">Entrada y Salida de Aire</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Construcción:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $construccion) {
						echo '<select name="construccion_etp3" class="form-control" >
						<option value="'.$construccion -> construccion_etp3.'">'.$construccion -> construccion_etp3.' - (Actual)</option>
						<option value="No aplica">No aplica</option>
						<option value="W">W</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Sello:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $sello) {
						echo '<select name="sello_etp3" class="form-control" >
						<option value="'.$sello -> sello_etp3.'">'.$sello -> sello_etp3.' - (Actual)</option>
						<option value="Neopreno">Neopreno</option>
						<option value="Gel">Gel</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Perfil del Gel:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $perfil_gel) {
						echo '<select name="perfil_gel_etp3" class="form-control" >
						<option value="'.$perfil_gel -> perfil_gel_etp3.'">'.$perfil_gel -> perfil_gel_etp3.' - (Actual):</option>
						<option value="No aplica">No aplica</option>
						<option value="Difusor">Difusor</option>
						<option value="Modulo">Módulo</option>
						<option value="Difusor tipo F">Difusor tipo F</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Ubicación del Gel:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $ubicacion_gel) {
						echo '<select name="ubicacion_gel_etp3" class="form-control" >
						<option value="'.$ubicacion_gel -> ubicacion_gel_etp3.'">'.$ubicacion_gel -> ubicacion_gel_etp3.' - (Actual)</option>
						<option value="N/A">No aplica</option>
						<option value="Entrada Aire">Entrada Aire</option>
						<option value="Salida Aire">Salida Aire</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Alta temperatura:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $temperatura) {
						echo '<select name="temperatura_etp3" class="form-control" >
						<option value="'.$temperatura -> temperatura_etp3.'">'.$temperatura -> temperatura_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Alma acero:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $alma_acero) {
						echo '<select name="alma_acero_etp3" class="form-control" >
						<option value="'.$alma_acero -> alma_acero_etp3.'">'.$alma_acero -> alma_acero_etp3.' - (Actual)</option>
						<option value="No aplica">No aplica</option>
						<option value="Si">Si</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Invertido:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $invertido) {
						echo '<select name="invertido_etp3" class="form-control" >
						<option value="'.$invertido -> invertido_etp3.'">'.$invertido -> invertido_etp3.' - (Actual)</option>
						<option value="No aplica">No aplica</option>
						<option value="Si">Si</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Alto Real:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $alto_real) {
						echo '<input type="number" step="any" name="alto_real_etp3" class="form-control"  placeholder="Ingresa el alto" maxlength="10" value="'.$alto_real -> alto_real_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Frente Real:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $frente_real) {
						echo '<input type="number" step="any" name="frente_real_etp3" class="form-control"  placeholder="Ingresa el frente" maxlength="10" value="'.$frente_real -> frente_real_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Fondo Real:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $fondo_real) {
						echo '<input type="number" step="any" name="fondo_real_etp3" class="form-control"  placeholder="Ingresa el fondo" maxlength="10" value="'.$fondo_real -> fondo_real_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Unidad de Medida Real:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $um_real) {
						echo '<select name="um_real_etp3" class="form-control" >
						<option value="'.$um_real -> um_real_etp3.'">'.$um_real -> um_real_etp3.' - (Actual)</option>
						<option value="in">Pulgadas</option>
						<option value="mm">Milímetros</option>
						<option value="cm">Centímetros</option>
						<option value="ft">Pies</option>
						<option value="m">Metros</option>
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>UM Venta:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $um_venta) {
						echo '<select name="um_venta_etp3" class="form-control" >
						<option value="'.$um_venta -> um_venta_etp3.'">'.$um_venta -> um_venta_etp3.' - (Actual)</option>
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
						</select><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Marca:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $marca) {
						echo '<input type="text" name="marca_etp3" class="form-control"  placeholder="Ingresa la marca" maxlength="10" value="'.$marca -> marca_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Capacidad:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $capacidad) {
						echo '<input type="number" name="capacidad_etp3" class="form-control"  placeholder="Ingresa la capacidad" maxlength="10" value="'.$capacidad -> capacidad_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>CPI:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $cpi) {
						echo '<input type="number" name="cpi_etp3" class="form-control"  placeholder="Anota el valor correspondiente" maxlength="10" value="'.$cpi -> cpi_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Capacidad Instalada:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $capcidad_instalada) {
						echo '<input type="number" name="capacidad_instalada_etp3" class="form-control"  placeholder="Ingresa la capacidad instalada" maxlength="10" value="'.$capcidad_instalada -> capacidad_instalada_etp3.'">';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<p class="alert alert-warinig"><center><u><strong>IMPORTANTE:</strong> No es posbile actualizar las fotos, solo la información complementaria.</u></p></center><br>

				<!--p class="alert alert-warinig"><center><strong>8 MB</strong> Es el tamaño máximo permitido para fotografías e imágenes.</p></center><br>

				<label><strong>Foto 1 <i>(Opcional | Esta será la que se muestra en el PDF)</i>:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $foto_1) {
						echo '<input type="file" name="foto_1_etp3" class="form-control" value="'.$foto_1 -> foto_1_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Foto 2 <i>(Opcional)</i>:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $foto_2) {
						echo '<input type="file" name="foto_2_etp3" class="form-control" value="'.$foto_2 -> foto_2_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Foto 3 <i>(Opcional)</i>:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $foto_3) {
						echo '<input type="file" name="foto_3_etp3" class="form-control" value="'.$foto_3 -> foto_3_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Foto 4 <i>(Opcional)</i>:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $foto_4) {
						echo '<input type="file" name="foto_4_etp3" class="form-control" value="'.$foto_4 -> foto_4_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?><-->

				<label><strong>Comentarios <i>(Opcional)</i>:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $comentarios) {
						echo '<input type="text" name="comentarios_etp3" class="form-control" placeholder="Agrega tus comentarios en este apartado" value="'.$comentarios -> comentarios_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<label><strong>Observaciones <i>(Opcional)</i>:</strong></label>
				<?php
				if ($q_lev1 -> rowCount() > 0) {
					foreach ($levantamientos_uno as $observaciones) {
						echo '<input type="text" name="observaciones_etp3" class="form-control" placeholder="Ingresa las observaciones pertinentes aquí" value="'.$observaciones -> observaciones_etp3.'"><br>';
					}
				} else {
					echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
					echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
					exit();
				}
				?>

				<center><input type="submit" class="btn btn-success" name="actualizar_levantamiento" value="Guardar Cambios"></center><br>
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