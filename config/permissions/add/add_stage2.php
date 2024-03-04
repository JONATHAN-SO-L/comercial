<?php
session_start();
require '../../conex.php';

if (isset($_POST['guardar_etp2'])) {
	/************************
	Recepción de datos
	************************/
	$codigo_etp2 = $_POST['codigo_etp2'];
	$descripcion_corta_etp2 = $_POST['descripcion_corta_etp2'];
	$familia_etp2 = $_POST['familia_etp2'];
	$modelo_etp2 = $_POST['modelo_etp2'];
	$tipo_etp2 = $_POST['tipo_etp2'];

	$eficiencia_etp2 = $_POST['eficiencia_etp2'];
	$gasto_etp2 = $_POST['gasto_etp2'];
	$alto_nom_etp2 = $_POST['alto_nom_etp2'];
	$frente_nom_etp2 = $_POST['frente_nom_etp2'];
	$fondo_nom_etp2 = $_POST['fondo_nom_etp2'];

	$um_nominal_etp2 = $_POST['um_nominal_etp2'];
	$marco_etp2 = $_POST['marco_etp2'];
	$espesor_etp2 = $_POST['espesor_etp2'];
	$um_espesor_etp2 = $_POST['um_espesor_etp2'];
	$num_separadores_etp2 = $_POST['num_separadores_etp2'];

	$media_fil_etp2 = $_POST['media_fil_etp2'];
	$forma_media_fil_etp2 = $_POST['forma_media_fil_etp2'];
	$color_media_fil_etp2 = $_POST['color_media_fil_etp2'];
	$bolsas_etp2 = $_POST['bolsas_etp2'];
	$media_ad_etp2 = $_POST['media_ad_etp2'];

	$separador_etp2 = $_POST['separador_etp2'];
	$asa_etp2 = $_POST['asa_etp2'];
	$sello_etp2 = $_POST['sello_etp2'];
	$plenum_etp2 = $_POST['plenum_etp2'];
	$postes_etp2 = $_POST['postes_etp2'];

	$rejilla_etp2 = $_POST['rejilla_etp2'];
	$contramarco_etp2 = $_POST['contramarco_etp2'];
	$construccion_etp2 = $_POST['construccion_etp2'];
	$perfil_gel_etp2 = $_POST['perfil_gel_etp2'];
	$ubicacion_gel_etp2 = $_POST['ubicacion_gel_etp2'];

	$temperatura_etp2 = $_POST['temperatura_etp2'];
	$alma_acero_etp2 = $_POST['alma_acero_etp2'];
	$invertido_etp2 = $_POST['invertido_etp2'];
	$alto_real_etp2 = $_POST['alto_real_etp2'];
	$frente_real_etp2 = $_POST['frente_real_etp2'];

	$fondo_real_etp2 = $_POST['fondo_real_etp2'];
	$um_real_etp2 = $_POST['um_real_etp2'];
	$um_venta_etp2 = $_POST['um_venta_etp2'];
	$marca_etp2 = $_POST['marca_etp2'];
	$capacidad_etp2 = $_POST['capacidad_etp2'];

	$cpi_etp2 = $_POST['cpi_etp2'];
	$capacidad_instalada_etp2 = $_POST['capacidad_instalada_etp2'];
	$comentarios_etp2 = $_POST['comentarios_etp2'];
	$observaciones_etp2 = $_POST['observaciones_etp2'];

	/************************
	Obtención de imágenes
	************************/
	$size_max = 8388608; // Definición de tamaño máximo de imagen / fotografía (8 MB)
	$folder1 = '../../../assets/img_lev'; // Se define directorio donde se guarda la imagen en el servidor
	$folder2 = '../../../assets/img_lev'; // Se indica directorio de imagen guardada para captura en ddbb

	// Fotografía 1
	$imagen1 = $_FILES['foto_1_etp2']['name']; // Obtención de la imagen
	$temp1 = $_FILES['foto_1_etp2']['tmp_name']; // Se genera archivo temporal
	move_uploaded_file($temp1, $folder1.'/'.$imagen1); // Instrucción para almacenar fotografía en directorio
	$foto_1_etp2 = $folder2.'/'.$imagen1; // Texto capturado en DDBB
	$size1 = $_FILES['foto_1_etp2']['size']; // Obtención de tamaño de la imagen / fotografía

	// Fotografía 2
	$imagen2 = $_FILES['foto_2_etp2']['name'];
	$temp2 = $_FILES['foto_2_etp2']['tmp_name'];
	move_uploaded_file($temp2, $folder1.'/'.$imagen2);
	$foto_2_etp2 = $folder2.'/'.$imagen2;
	$size2 = $_FILES['foto_2_etp2']['size'];

	// Fotografía 3
	$imagen3 = $_FILES['foto_3_etp2']['name'];
	$temp3 = $_FILES['foto_3_etp2']['tmp_name'];
	move_uploaded_file($temp3, $folder1.'/'.$imagen3);
	$foto_3_etp2 = $folder2.'/'.$imagen3;
	$size3 = $_FILES['foto_3_etp2']['size'];

	// Fotografía 4
	$imagen4 = $_FILES['foto_4_etp2']['name'];
	$temp4 = $_FILES['foto_4_etp2']['tmp_name'];
	move_uploaded_file($temp4, $folder1.'/'.$imagen4);
	$foto_4_etp2 = $folder2.'/'.$imagen4;
	$size4 = $_FILES['foto_4_etp2']['size'];

	/************************
	Obtención de UMA
	************************/
	$uma = $_SESSION['uma'];

	/************************
	Número de Etapa
	************************/
	$etapa_etp2 = '2';

	/***********************************
	Almacenamiento de datos sin imágenes
	***********************************/
	$up_data = $con->prepare("UPDATE levantamientos SET etapa_etp2 = ?,
		codigo_etp2 = ?, descripcion_corta_etp2 = ?, familia_etp2 = ?, modelo_etp2 = ?,
		tipo_etp2 = ?, eficiencia_etp2 = ?, gasto_etp2 = ?, alto_nom_etp2 = ?,
		frente_nom_etp2 = ?, fondo_nom_etp2 = ?, um_nominal_etp2 = ?, marco_etp2 = ?,
		espesor_etp2 = ?, um_espesor_etp2 = ?, num_separadores_etp2 = ?, media_fil_etp2 = ?,
		forma_media_fil_etp2 = ?, color_media_fil_etp2 = ?, bolsas_etp2 = ?, media_ad_etp2 = ?,
		separador_etp2 = ?, asa_etp2 = ?, sello_etp2 = ?, plenum_etp2 = ?,
		postes_etp2 = ?, rejilla_etp2 = ?,	contramarco_etp2 = ?, construccion_etp2 = ?,
		perfil_gel_etp2 = ?, ubicacion_gel_etp2 = ?, temperatura_etp2 = ?, alma_acero_etp2 = ?,
		invertido_etp2 = ?, alto_real_etp2 = ?, frente_real_etp2 = ?, fondo_real_etp2 = ?,
		um_real_etp2 = ?, um_venta_etp2 = ?, marca_etp2 = ?, capacidad_etp2 = ?,
		cpi_etp2 = ?, capacidad_instalada_etp2 = ?, comentarios_etp2 = ?,observaciones_etp2 = ?
		WHERE uma = ?;");

	$val_up_data = $up_data->execute([$etapa_etp2,
		$codigo_etp2, $descripcion_corta_etp2, $familia_etp2, $modelo_etp2,
		$tipo_etp2, $eficiencia_etp2, $gasto_etp2, $alto_nom_etp2,
		$frente_nom_etp2, $fondo_nom_etp2, $um_nominal_etp2, $marco_etp2,
		$espesor_etp2, $um_espesor_etp2, $num_separadores_etp2, $media_fil_etp2,
		$forma_media_fil_etp2, $color_media_fil_etp2, $bolsas_etp2, $media_ad_etp2,
		$separador_etp2, $asa_etp2, $sello_etp2, $plenum_etp2,
		$postes_etp2, $rejilla_etp2, $contramarco_etp2, $construccion_etp2,
		$perfil_gel_etp2, $ubicacion_gel_etp2, $temperatura_etp2, $alma_acero_etp2,
		$invertido_etp2, $alto_real_etp2, $frente_real_etp2, $fondo_real_etp2,
		$um_real_etp2, $um_venta_etp2, $marca_etp2, $capacidad_etp2,
		$cpi_etp2, $capacidad_instalada_etp2, $comentarios_etp2, $observaciones_etp2,
		$uma]);

	/***********************************
	Almacenamiento de datos con imágenes
	***********************************/
	$up_data_w_pic = $con->prepare("UPDATE levantamientos SET etapa_etp2 = ?,
		codigo_etp2 = ?, descripcion_corta_etp2 = ?, familia_etp2 = ?, modelo_etp2 = ?,
		tipo_etp2 = ?, eficiencia_etp2 = ?, gasto_etp2 = ?, alto_nom_etp2 = ?,
		frente_nom_etp2 = ?, fondo_nom_etp2 = ?, um_nominal_etp2 = ?, marco_etp2 = ?,
		espesor_etp2 = ?, um_espesor_etp2 = ?, num_separadores_etp2 = ?, media_fil_etp2 = ?,
		forma_media_fil_etp2 = ?, color_media_fil_etp2 = ?, bolsas_etp2 = ?, media_ad_etp2 = ?,
		separador_etp2 = ?, asa_etp2 = ?, sello_etp2 = ?, plenum_etp2 = ?,
		postes_etp2 = ?, rejilla_etp2 = ?,	contramarco_etp2 = ?, construccion_etp2 = ?,
		perfil_gel_etp2 = ?, ubicacion_gel_etp2 = ?, temperatura_etp2 = ?, alma_acero_etp2 = ?,
		invertido_etp2 = ?, alto_real_etp2 = ?, frente_real_etp2 = ?, fondo_real_etp2 = ?,
		um_real_etp2 = ?, um_venta_etp2 = ?, marca_etp2 = ?, capacidad_etp2 = ?,
		cpi_etp2 = ?, capacidad_instalada_etp2 = ?, foto_1_etp2 = ?, foto_2_etp2 = ?,
		foto_3_etp2 = ?, foto_4_etp2 = ?, comentarios_etp2 = ?,observaciones_etp2 = ?
		WHERE uma = ?;");

	$val_up_data_w_pic = $up_data_w_pic->execute([$etapa_etp2,
		$codigo_etp2, $descripcion_corta_etp2, $familia_etp2, $modelo_etp2,
		$tipo_etp2, $eficiencia_etp2, $gasto_etp2, $alto_nom_etp2,
		$frente_nom_etp2, $fondo_nom_etp2, $um_nominal_etp2, $marco_etp2,
		$espesor_etp2, $um_espesor_etp2, $num_separadores_etp2, $media_fil_etp2,
		$forma_media_fil_etp2, $color_media_fil_etp2, $bolsas_etp2, $media_ad_etp2,
		$separador_etp2, $asa_etp2, $sello_etp2, $plenum_etp2,
		$postes_etp2, $rejilla_etp2, $contramarco_etp2, $construccion_etp2,
		$perfil_gel_etp2, $ubicacion_gel_etp2, $temperatura_etp2, $alma_acero_etp2,
		$invertido_etp2, $alto_real_etp2, $frente_real_etp2, $fondo_real_etp2,
		$um_real_etp2, $um_venta_etp2, $marca_etp2, $capacidad_etp2,
		$cpi_etp2, $capacidad_instalada_etp2, $foto_1_etp2, $foto_2_etp2,
		$foto_3_etp2, $foto_4_etp2, $comentarios_etp2, $observaciones_etp2,
		$uma]);

	/***********************************************************************************
	Si se detecta alguna imagen se detecta el tamaño y se valida que no supere el tamaño
	***********************************************************************************/

	if ($imagen1 || $imagen2 || $imagen3 || $imagen4) {
		if ($size1 || $size2 || $size3 || $size4) {
			if ($size1 || $size2 || $size3 || $size4 <= $size_max) {
				$val_up_data_w_pic;
				echo "<script>alert('Captura de datos exitosa')</script>";
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
			} else {
				echo "<script>alert('ERROR 004: No se logró capturar la información, se superó el espacio máximo de 8 MB para imágenes')</script>";
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
			}
		} else {
			$val_up_data;
			echo "<script>alert('Captura de datos exitosa')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
		}
	} else {
		$val_up_data;
		echo "<script>alert('Captura de datos exitosa')</script>";
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
	}

} else {
	header('Location: ../../../index.php');
}

?>