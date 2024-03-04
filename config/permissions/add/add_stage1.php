<?php
session_start();
require '../../conex.php';

if (isset($_POST['guardar_etp1'])) {
	/************************
	Recepción de datos
	************************/
	$codigo_etp1 = $_POST['codigo_etp1'];
	$descripcion_corta_etp1 = $_POST['descripcion_corta_etp1'];
	$familia_etp1 = $_POST['familia_etp1'];
	$modelo_etp1 = $_POST['modelo_etp1'];
	$tipo_etp1 = $_POST['tipo_etp1'];

	$eficiencia_etp1 = $_POST['eficiencia_etp1'];
	$gasto_etp1 = $_POST['gasto_etp1'];
	$alto_nom_etp1 = $_POST['alto_nom_etp1'];
	$frente_nom_etp1 = $_POST['frente_nom_etp1'];
	$fondo_nom_etp1 = $_POST['fondo_nom_etp1'];

	$um_nominal_etp1 = $_POST['um_nominal_etp1'];
	$marco_etp1 = $_POST['marco_etp1'];
	$espesor_etp1 = $_POST['espesor_etp1'];
	$um_espesor_etp1 = $_POST['um_espesor_etp1'];
	$num_separadores_etp1 = $_POST['num_separadores_etp1'];

	$media_fil_etp1 = $_POST['media_fil_etp1'];
	$forma_media_fil_etp1 = $_POST['forma_media_fil_etp1'];
	$color_media_fil_etp1 = $_POST['color_media_fil_etp1'];
	$bolsas_etp1 = $_POST['bolsas_etp1'];
	$media_ad_etp1 = $_POST['media_ad_etp1'];

	$separador_etp1 = $_POST['separador_etp1'];
	$asa_etp1 = $_POST['asa_etp1'];
	$sello_etp1 = $_POST['sello_etp1'];
	$plenum_etp1 = $_POST['plenum_etp1'];
	$postes_etp1 = $_POST['postes_etp1'];

	$rejilla_etp1 = $_POST['rejilla_etp1'];
	$contramarco_etp1 = $_POST['contramarco_etp1'];
	$construccion_etp1 = $_POST['construccion_etp1'];
	$perfil_gel_etp1 = $_POST['perfil_gel_etp1'];
	$ubicacion_gel_etp1 = $_POST['ubicacion_gel_etp1'];

	$temperatura_etp1 = $_POST['temperatura_etp1'];
	$alma_acero_etp1 = $_POST['alma_acero_etp1'];
	$invertido_etp1 = $_POST['invertido_etp1'];
	$alto_real_etp1 = $_POST['alto_real_etp1'];
	$frente_real_etp1 = $_POST['frente_real_etp1'];

	$fondo_real_etp1 = $_POST['fondo_real_etp1'];
	$um_real_etp1 = $_POST['um_real_etp1'];
	$um_venta_etp1 = $_POST['um_venta_etp1'];
	$marca_etp1 = $_POST['marca_etp1'];
	$capacidad_etp1 = $_POST['capacidad_etp1'];

	$cpi_etp1 = $_POST['cpi_etp1'];
	$capacidad_instalada_etp1 = $_POST['capacidad_instalada_etp1'];
	$comentarios_etp1 = $_POST['comentarios_etp1'];
	$observaciones_etp1 = $_POST['observaciones_etp1'];

	/************************
	Obtención de imágenes
	************************/
	$size_max = 8388608; // Definición de tamaño máximo de imagen / fotografía (8 MB)
	$folder1 = '../../../assets/img_lev'; // Se define directorio donde se guarda la imagen en el servidor
	$folder2 = '../../../assets/img_lev'; // Se indica directorio de imagen guardada para captura en ddbb

	// Fotografía 1
	$imagen1 = $_FILES['foto_1_etp1']['name']; // Obtención de la imagen
	$temp1 = $_FILES['foto_1_etp1']['tmp_name']; // Se genera archivo temporal
	move_uploaded_file($temp1, $folder1.'/'.$imagen1); // Instrucción para almacenar fotografía en directorio
	$foto_1_etp1 = $folder2.'/'.$imagen1; // Texto capturado en DDBB
	$size1 = $_FILES['foto_1_etp1']['size']; // Obtención de tamaño de la imagen / fotografía

	// Fotografía 2
	$imagen2 = $_FILES['foto_2_etp1']['name'];
	$temp2 = $_FILES['foto_2_etp1']['tmp_name'];
	move_uploaded_file($temp2, $folder1.'/'.$imagen2);
	$foto_2_etp1 = $folder2.'/'.$imagen2;
	$size2 = $_FILES['foto_2_etp1']['size'];

	// Fotografía 3
	$imagen3 = $_FILES['foto_3_etp1']['name'];
	$temp3 = $_FILES['foto_3_etp1']['tmp_name'];
	move_uploaded_file($temp3, $folder1.'/'.$imagen3);
	$foto_3_etp1 = $folder2.'/'.$imagen3;
	$size3 = $_FILES['foto_3_etp1']['size'];

	// Fotografía 4
	$imagen4 = $_FILES['foto_4_etp1']['name'];
	$temp4 = $_FILES['foto_4_etp1']['tmp_name'];
	move_uploaded_file($temp4, $folder1.'/'.$imagen4);
	$foto_4_etp1 = $folder2.'/'.$imagen4;
	$size4 = $_FILES['foto_4_etp1']['size'];

	/************************
	Obtención de UMA
	************************/
	$uma = $_SESSION['uma'];

	/************************
	Número de Etapa
	************************/
	$etapa_etp1 = '1';

	/***********************************
	Almacenamiento de datos sin imágenes
	***********************************/
	$up_data = $con->prepare("UPDATE levantamientos SET etapa_etp1 = ?,
		codigo_etp1 = ?, descripcion_corta_etp1 = ?, familia_etp1 = ?, modelo_etp1 = ?,
		tipo_etp1 = ?, eficiencia_etp1 = ?, gasto_etp1 = ?, alto_nom_etp1 = ?,
		frente_nom_etp1 = ?, fondo_nom_etp1 = ?, um_nominal_etp1 = ?, marco_etp1 = ?,
		espesor_etp1 = ?, um_espesor_etp1 = ?, num_separadores_etp1 = ?, media_fil_etp1 = ?,
		forma_media_fil_etp1 = ?, color_media_fil_etp1 = ?, bolsas_etp1 = ?, media_ad_etp1 = ?,
		separador_etp1 = ?, asa_etp1 = ?, sello_etp1 = ?, plenum_etp1 = ?,
		postes_etp1 = ?, rejilla_etp1 = ?,	contramarco_etp1 = ?, construccion_etp1 = ?,
		perfil_gel_etp1 = ?, ubicacion_gel_etp1 = ?, temperatura_etp1 = ?, alma_acero_etp1 = ?,
		invertido_etp1 = ?, alto_real_etp1 = ?, frente_real_etp1 = ?, fondo_real_etp1 = ?,
		um_real_etp1 = ?, um_venta_etp1 = ?, marca_etp1 = ?, capacidad_etp1 = ?,
		cpi_etp1 = ?, capacidad_instalada_etp1 = ?, comentarios_etp1 = ?,observaciones_etp1 = ?
		WHERE uma = ?;");

	$val_up_data = $up_data->execute([$etapa_etp1,
		$codigo_etp1, $descripcion_corta_etp1, $familia_etp1, $modelo_etp1,
		$tipo_etp1, $eficiencia_etp1, $gasto_etp1, $alto_nom_etp1,
		$frente_nom_etp1, $fondo_nom_etp1, $um_nominal_etp1, $marco_etp1,
		$espesor_etp1, $um_espesor_etp1, $num_separadores_etp1, $media_fil_etp1,
		$forma_media_fil_etp1, $color_media_fil_etp1, $bolsas_etp1, $media_ad_etp1,
		$separador_etp1, $asa_etp1, $sello_etp1, $plenum_etp1,
		$postes_etp1, $rejilla_etp1, $contramarco_etp1, $construccion_etp1,
		$perfil_gel_etp1, $ubicacion_gel_etp1, $temperatura_etp1, $alma_acero_etp1,
		$invertido_etp1, $alto_real_etp1, $frente_real_etp1, $fondo_real_etp1,
		$um_real_etp1, $um_venta_etp1, $marca_etp1, $capacidad_etp1,
		$cpi_etp1, $capacidad_instalada_etp1, $comentarios_etp1, $observaciones_etp1,
		$uma]);

	/***********************************
	Almacenamiento de datos con imágenes
	***********************************/
	$up_data_w_pic = $con->prepare("UPDATE levantamientos SET etapa_etp1 = ?,
		codigo_etp1 = ?, descripcion_corta_etp1 = ?, familia_etp1 = ?, modelo_etp1 = ?,
		tipo_etp1 = ?, eficiencia_etp1 = ?, gasto_etp1 = ?, alto_nom_etp1 = ?,
		frente_nom_etp1 = ?, fondo_nom_etp1 = ?, um_nominal_etp1 = ?, marco_etp1 = ?,
		espesor_etp1 = ?, um_espesor_etp1 = ?, num_separadores_etp1 = ?, media_fil_etp1 = ?,
		forma_media_fil_etp1 = ?, color_media_fil_etp1 = ?, bolsas_etp1 = ?, media_ad_etp1 = ?,
		separador_etp1 = ?, asa_etp1 = ?, sello_etp1 = ?, plenum_etp1 = ?,
		postes_etp1 = ?, rejilla_etp1 = ?,	contramarco_etp1 = ?, construccion_etp1 = ?,
		perfil_gel_etp1 = ?, ubicacion_gel_etp1 = ?, temperatura_etp1 = ?, alma_acero_etp1 = ?,
		invertido_etp1 = ?, alto_real_etp1 = ?, frente_real_etp1 = ?, fondo_real_etp1 = ?,
		um_real_etp1 = ?, um_venta_etp1 = ?, marca_etp1 = ?, capacidad_etp1 = ?,
		cpi_etp1 = ?, capacidad_instalada_etp1 = ?, foto_1_etp1 = ?, foto_2_etp1 = ?,
		foto_3_etp1 = ?, foto_4_etp1 = ?, comentarios_etp1 = ?,observaciones_etp1 = ?
		WHERE uma = ?;");

	$val_up_data_w_pic = $up_data_w_pic->execute([$etapa_etp1,
		$codigo_etp1, $descripcion_corta_etp1, $familia_etp1, $modelo_etp1,
		$tipo_etp1, $eficiencia_etp1, $gasto_etp1, $alto_nom_etp1,
		$frente_nom_etp1, $fondo_nom_etp1, $um_nominal_etp1, $marco_etp1,
		$espesor_etp1, $um_espesor_etp1, $num_separadores_etp1, $media_fil_etp1,
		$forma_media_fil_etp1, $color_media_fil_etp1, $bolsas_etp1, $media_ad_etp1,
		$separador_etp1, $asa_etp1, $sello_etp1, $plenum_etp1,
		$postes_etp1, $rejilla_etp1, $contramarco_etp1, $construccion_etp1,
		$perfil_gel_etp1, $ubicacion_gel_etp1, $temperatura_etp1, $alma_acero_etp1,
		$invertido_etp1, $alto_real_etp1, $frente_real_etp1, $fondo_real_etp1,
		$um_real_etp1, $um_venta_etp1, $marca_etp1, $capacidad_etp1,
		$cpi_etp1, $capacidad_instalada_etp1, $foto_1_etp1, $foto_2_etp1,
		$foto_3_etp1, $foto_4_etp1, $comentarios_etp1, $observaciones_etp1,
		$uma]);

	/***********************************************************************************
	Si se detecta alguna imagen se detecta el tamaño y se valida que no supere el tamaño
	***********************************************************************************/

	if ($imagen1 || $imagen2 || $imagen3 || $imagen4) {
		if ($size1 || $size2 || $size3 || $size4) {
			if ($size1 || $size2 || $size3 || $size4 <= $size_max) {
				$val_up_data_w_pic;
				echo "<script>alert('Captura de datos exitosa')</script>";
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
			} else {
				echo "<script>alert('ERROR 004: No se logró capturar la información, se superó el espacio máximo de 8 MB para imágenes')</script>";
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
			}
		} else {
			$val_up_data;
			echo "<script>alert('Captura de datos exitosa')</script>";
			echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
		}
	} else {
		$val_up_data;
		echo "<script>alert('Captura de datos exitosa')</script>";
		echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
	}

} else {
	header('Location: ../../../index.php');
}

?>