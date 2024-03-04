<?php
session_start();
require '../../conex.php';

if (isset($_POST['guardar_etp3'])) {
	/************************
	Recepción de datos
	************************/
	$codigo_etp3 = $_POST['codigo_etp3'];
	$descripcion_corta_etp3 = $_POST['descripcion_corta_etp3'];
	$familia_etp3 = $_POST['familia_etp3'];
	$modelo_etp3 = $_POST['modelo_etp3'];
	$tipo_etp3 = $_POST['tipo_etp3'];

	$eficiencia_etp3 = $_POST['eficiencia_etp3'];
	$gasto_etp3 = $_POST['gasto_etp3'];
	$alto_nom_etp3 = $_POST['alto_nom_etp3'];
	$frente_nom_etp3 = $_POST['frente_nom_etp3'];
	$fondo_nom_etp3 = $_POST['fondo_nom_etp3'];

	$um_nominal_etp3 = $_POST['um_nominal_etp3'];
	$marco_etp3 = $_POST['marco_etp3'];
	$espesor_etp3 = $_POST['espesor_etp3'];
	$um_espesor_etp3 = $_POST['um_espesor_etp3'];
	$num_separadores_etp3 = $_POST['num_separadores_etp3'];

	$media_fil_etp3 = $_POST['media_fil_etp3'];
	$forma_media_fil_etp3 = $_POST['forma_media_fil_etp3'];
	$color_media_fil_etp3 = $_POST['color_media_fil_etp3'];
	$bolsas_etp3 = $_POST['bolsas_etp3'];
	$media_ad_etp3 = $_POST['media_ad_etp3'];

	$separador_etp3 = $_POST['separador_etp3'];
	$asa_etp3 = $_POST['asa_etp3'];
	$sello_etp3 = $_POST['sello_etp3'];
	$plenum_etp3 = $_POST['plenum_etp3'];
	$postes_etp3 = $_POST['postes_etp3'];

	$rejilla_etp3 = $_POST['rejilla_etp3'];
	$contramarco_etp3 = $_POST['contramarco_etp3'];
	$construccion_etp3 = $_POST['construccion_etp3'];
	$perfil_gel_etp3 = $_POST['perfil_gel_etp3'];
	$ubicacion_gel_etp3 = $_POST['ubicacion_gel_etp3'];

	$temperatura_etp3 = $_POST['temperatura_etp3'];
	$alma_acero_etp3 = $_POST['alma_acero_etp3'];
	$invertido_etp3 = $_POST['invertido_etp3'];
	$alto_real_etp3 = $_POST['alto_real_etp3'];
	$frente_real_etp3 = $_POST['frente_real_etp3'];

	$fondo_real_etp3 = $_POST['fondo_real_etp3'];
	$um_real_etp3 = $_POST['um_real_etp3'];
	$um_venta_etp3 = $_POST['um_venta_etp3'];
	$marca_etp3 = $_POST['marca_etp3'];
	$capacidad_etp3 = $_POST['capacidad_etp3'];

	$cpi_etp3 = $_POST['cpi_etp3'];
	$capacidad_instalada_etp3 = $_POST['capacidad_instalada_etp3'];
	$comentarios_etp3 = $_POST['comentarios_etp3'];
	$observaciones_etp3 = $_POST['observaciones_etp3'];

	/************************
	Obtención de imágenes
	************************/
	$size_max = 8388608; // Definición de tamaño máximo de imagen / fotografía (8 MB)
	$folder1 = '../../../assets/img_lev'; // Se define directorio donde se guarda la imagen en el servidor
	$folder2 = '../../../assets/img_lev'; // Se indica directorio de imagen guardada para captura en ddbb

	// Fotografía 1
	$imagen1 = $_FILES['foto_1_etp3']['name']; // Obtención de la imagen
	$temp1 = $_FILES['foto_1_etp3']['tmp_name']; // Se genera archivo temporal
	move_uploaded_file($temp1, $folder1.'/'.$imagen1); // Instrucción para almacenar fotografía en directorio
	$foto_1_etp3 = $folder2.'/'.$imagen1; // Texto capturado en DDBB
	$size1 = $_FILES['foto_1_etp3']['size']; // Obtención de tamaño de la imagen / fotografía

	// Fotografía 2
	$imagen2 = $_FILES['foto_2_etp3']['name'];
	$temp2 = $_FILES['foto_2_etp3']['tmp_name'];
	move_uploaded_file($temp2, $folder1.'/'.$imagen2);
	$foto_2_etp3 = $folder2.'/'.$imagen2;
	$size2 = $_FILES['foto_2_etp3']['size'];

	// Fotografía 3
	$imagen3 = $_FILES['foto_3_etp3']['name'];
	$temp3 = $_FILES['foto_3_etp3']['tmp_name'];
	move_uploaded_file($temp3, $folder1.'/'.$imagen3);
	$foto_3_etp3 = $folder2.'/'.$imagen3;
	$size3 = $_FILES['foto_3_etp3']['size'];

	// Fotografía 4
	$imagen4 = $_FILES['foto_4_etp3']['name'];
	$temp4 = $_FILES['foto_4_etp3']['tmp_name'];
	move_uploaded_file($temp4, $folder1.'/'.$imagen4);
	$foto_4_etp3 = $folder2.'/'.$imagen4;
	$size4 = $_FILES['foto_4_etp3']['size'];

	/************************
	Obtención de UMA
	************************/
	$uma = $_SESSION['uma'];

	/************************
	Número de Etapa
	************************/
	$etapa_etp3 = '3';

	/*****************************
	Finalización del Levantamiento
	*****************************/
	$fecha_hora_fin = date("Y-m-d H:i:s");

	/***********************************
	Almacenamiento de datos sin imágenes
	***********************************/
	$up_data = $con->prepare("UPDATE levantamientos SET etapa_etp3 = ?,
		codigo_etp3 = ?, descripcion_corta_etp3 = ?, familia_etp3 = ?, modelo_etp3 = ?,
		tipo_etp3 = ?, eficiencia_etp3 = ?, gasto_etp3 = ?, alto_nom_etp3 = ?,
		frente_nom_etp3 = ?, fondo_nom_etp3 = ?, um_nominal_etp3 = ?, marco_etp3 = ?,
		espesor_etp3 = ?, um_espesor_etp3 = ?, num_separadores_etp3 = ?, media_fil_etp3 = ?,
		forma_media_fil_etp3 = ?, color_media_fil_etp3 = ?, bolsas_etp3 = ?, media_ad_etp3 = ?,
		separador_etp3 = ?, asa_etp3 = ?, sello_etp3 = ?, plenum_etp3 = ?,
		postes_etp3 = ?, rejilla_etp3 = ?,	contramarco_etp3 = ?, construccion_etp3 = ?,
		perfil_gel_etp3 = ?, ubicacion_gel_etp3 = ?, temperatura_etp3 = ?, alma_acero_etp3 = ?,
		invertido_etp3 = ?, alto_real_etp3 = ?, frente_real_etp3 = ?, fondo_real_etp3 = ?,
		um_real_etp3 = ?, um_venta_etp3 = ?, marca_etp3 = ?, capacidad_etp3 = ?,
		cpi_etp3 = ?, capacidad_instalada_etp3 = ?, comentarios_etp3 = ?,observaciones_etp3 = ?,
		fecha_hora_fin = ?
		WHERE uma = ?;");

	$val_up_data = $up_data->execute([$etapa_etp3,
		$codigo_etp3, $descripcion_corta_etp3, $familia_etp3, $modelo_etp3,
		$tipo_etp3, $eficiencia_etp3, $gasto_etp3, $alto_nom_etp3,
		$frente_nom_etp3, $fondo_nom_etp3, $um_nominal_etp3, $marco_etp3,
		$espesor_etp3, $um_espesor_etp3, $num_separadores_etp3, $media_fil_etp3,
		$forma_media_fil_etp3, $color_media_fil_etp3, $bolsas_etp3, $media_ad_etp3,
		$separador_etp3, $asa_etp3, $sello_etp3, $plenum_etp3,
		$postes_etp3, $rejilla_etp3, $contramarco_etp3, $construccion_etp3,
		$perfil_gel_etp3, $ubicacion_gel_etp3, $temperatura_etp3, $alma_acero_etp3,
		$invertido_etp3, $alto_real_etp3, $frente_real_etp3, $fondo_real_etp3,
		$um_real_etp3, $um_venta_etp3, $marca_etp3, $capacidad_etp3,
		$cpi_etp3, $capacidad_instalada_etp3, $comentarios_etp3, $observaciones_etp3,
		$fecha_hora_fin,
		$uma]);

	/***********************************
	Almacenamiento de datos con imágenes
	***********************************/
	$up_data_w_pic = $con->prepare("UPDATE levantamientos SET etapa_etp3 = ?,
		codigo_etp3 = ?, descripcion_corta_etp3 = ?, familia_etp3 = ?, modelo_etp3 = ?,
		tipo_etp3 = ?, eficiencia_etp3 = ?, gasto_etp3 = ?, alto_nom_etp3 = ?,
		frente_nom_etp3 = ?, fondo_nom_etp3 = ?, um_nominal_etp3 = ?, marco_etp3 = ?,
		espesor_etp3 = ?, um_espesor_etp3 = ?, num_separadores_etp3 = ?, media_fil_etp3 = ?,
		forma_media_fil_etp3 = ?, color_media_fil_etp3 = ?, bolsas_etp3 = ?, media_ad_etp3 = ?,
		separador_etp3 = ?, asa_etp3 = ?, sello_etp3 = ?, plenum_etp3 = ?,
		postes_etp3 = ?, rejilla_etp3 = ?,	contramarco_etp3 = ?, construccion_etp3 = ?,
		perfil_gel_etp3 = ?, ubicacion_gel_etp3 = ?, temperatura_etp3 = ?, alma_acero_etp3 = ?,
		invertido_etp3 = ?, alto_real_etp3 = ?, frente_real_etp3 = ?, fondo_real_etp3 = ?,
		um_real_etp3 = ?, um_venta_etp3 = ?, marca_etp3 = ?, capacidad_etp3 = ?,
		cpi_etp3 = ?, capacidad_instalada_etp3 = ?, foto_1_etp3 = ?, foto_2_etp3 = ?,
		foto_3_etp3 = ?, foto_4_etp3 = ?, comentarios_etp3 = ?,observaciones_etp3 = ?,
		fecha_hora_fin = ?
		WHERE uma = ?;");

	$val_up_data_w_pic = $up_data_w_pic->execute([$etapa_etp3,
		$codigo_etp3, $descripcion_corta_etp3, $familia_etp3, $modelo_etp3,
		$tipo_etp3, $eficiencia_etp3, $gasto_etp3, $alto_nom_etp3,
		$frente_nom_etp3, $fondo_nom_etp3, $um_nominal_etp3, $marco_etp3,
		$espesor_etp3, $um_espesor_etp3, $num_separadores_etp3, $media_fil_etp3,
		$forma_media_fil_etp3, $color_media_fil_etp3, $bolsas_etp3, $media_ad_etp3,
		$separador_etp3, $asa_etp3, $sello_etp3, $plenum_etp3,
		$postes_etp3, $rejilla_etp3, $contramarco_etp3, $construccion_etp3,
		$perfil_gel_etp3, $ubicacion_gel_etp3, $temperatura_etp3, $alma_acero_etp3,
		$invertido_etp3, $alto_real_etp3, $frente_real_etp3, $fondo_real_etp3,
		$um_real_etp3, $um_venta_etp3, $marca_etp3, $capacidad_etp3,
		$cpi_etp3, $capacidad_instalada_etp3, $foto_1_etp3, $foto_2_etp3,
		$foto_3_etp3, $foto_4_etp3, $comentarios_etp3, $observaciones_etp3,
		$fecha_hora_fin,
		$uma]);

	/***********************************************************************************
	Si se detecta alguna imagen se detecta el tamaño y se valida que no supere el tamaño
	***********************************************************************************/

	if ($imagen1 || $imagen2 || $imagen3 || $imagen4) {
		if ($size1 || $size2 || $size3 || $size4) {
			if ($size1 || $size2 || $size3 || $size4 <= $size_max) {
				$val_up_data_w_pic;
				echo "<script>alert('Captura de datos exitosa')</script>";
				echo '<meta http-equiv="refresh" content="0;../../../index.php">';
			} else {
				echo "<script>alert('ERROR 004: No se logró capturar la información, se superó el espacio máximo de 8 MB para imágenes')</script>";
				echo '<meta http-equiv="refresh" content="0;../../../index.php">';
			}
		} else {
			$val_up_data;
			echo "<script>alert('Captura de datos exitosa')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../index.php">';
		}
	} else {
		$val_up_data;
		echo "<script>alert('Captura de datos exitosa')</script>";
		echo '<meta http-equiv="refresh" content="0;../../../index.php">';
	}

} else {
	header('Location: ../../../index.php');
}

?>