<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	if (isset($_POST['actualizar_levantamiento'])) {

		require '../../conex.php';

		$uma = $_SERVER['QUERY_STRING'];

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
		$media_fil_etp2 = $_POST['media_fil_etp2'];
		$forma_media_fil_etp2 = $_POST['forma_media_fil_etp2'];
		$color_media_fil_etp2 = $_POST['color_media_fil_etp2'];
		$bolsas_etp2 = $_POST['bolsas_etp2'];
		$media_ad_etp2 = $_POST['media_ad_etp2'];
		$num_separadores_etp2 = $_POST['num_separadores_etp2'];
		$separador_etp2 = $_POST['separador_etp2'];
		$asa_etp2 = $_POST['asa_etp2'];
		$plenum_etp2 = $_POST['plenum_etp2'];
		$postes_etp2 = $_POST['postes_etp2'];
		$rejilla_etp2 = $_POST['rejilla_etp2'];
		$contramarco_etp2 = $_POST['contramarco_etp2'];
		$construccion_etp2 = $_POST['construccion_etp2'];
		$sello_etp2 = $_POST['sello_etp2'];
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
		$marca_etp2  = $_POST['marca_etp2'];
		$capacidad_etp2 = $_POST['capacidad_etp2'];
		$cpi_etp2 = $_POST['cpi_etp2'];
		$capacidad_instalada_etp2 = $_POST['capacidad_instalada_etp2'];
		$comentarios_etp2 = $_POST['comentarios_etp2'];
		$observaciones_etp2 = $_POST['observaciones_etp2'];

		$up_lev = $con->prepare("UPDATE levantamientos SET
			codigo_etp2 = ?, descripcion_corta_etp2 = ?, familia_etp2 = ?, modelo_etp2 = ?,
			tipo_etp2 = ?, eficiencia_etp2 = ?, gasto_etp2 = ?, alto_nom_etp2 = ?,
			frente_nom_etp2 = ?, fondo_nom_etp2 = ?, um_nominal_etp2 = ?, marco_etp2 = ?,
			espesor_etp2 = ?, um_espesor_etp2 = ?, media_fil_etp2 = ?, forma_media_fil_etp2 = ?,
			color_media_fil_etp2 = ?, bolsas_etp2 = ?, media_ad_etp2 = ?, num_separadores_etp2 = ?,
			separador_etp2 = ?, asa_etp2 = ?, plenum_etp2 = ?, postes_etp2 = ?,
			rejilla_etp2 = ?, contramarco_etp2 = ?, construccion_etp2 = ?, sello_etp2 = ?,
			perfil_gel_etp2 = ?, ubicacion_gel_etp2 = ?, temperatura_etp2 = ?, alma_acero_etp2 = ?,
			invertido_etp2 = ?, alto_real_etp2 = ?, frente_real_etp2 = ?, fondo_real_etp2 = ?,
			um_real_etp2 = ?, um_venta_etp2 = ?, marca_etp2 = ?, capacidad_etp2 = ?,
			cpi_etp2 = ?, capacidad_instalada_etp2 = ?, comentarios_etp2 = ?, observaciones_etp2 = ?
			WHERE uma = ?");

		$up_lev->execute([
			$codigo_etp2, $descripcion_corta_etp2, $familia_etp2, $modelo_etp2,
			$tipo_etp2, $eficiencia_etp2, $gasto_etp2, $alto_nom_etp2,
			$frente_nom_etp2, $fondo_nom_etp2, $um_nominal_etp2, $marco_etp2,
			$espesor_etp2, $um_espesor_etp2, $media_fil_etp2, $forma_media_fil_etp2,
			$color_media_fil_etp2, $bolsas_etp2, $media_ad_etp2, $num_separadores_etp2,
			$separador_etp2, $asa_etp2, $plenum_etp2, $postes_etp2,
			$rejilla_etp2, $contramarco_etp2, $construccion_etp2, $sello_etp2,
			$perfil_gel_etp2, $ubicacion_gel_etp2, $temperatura_etp2, $alma_acero_etp2,
			$invertido_etp2, $alto_nom_etp2, $frente_real_etp2, $fondo_nom_etp2,
			$um_nominal_etp2, $um_venta_etp2, $marca_etp2, $capacidad_etp2,
			$cpi_etp2, $capacidad_instalada_etp2, $comentarios_etp2, $observaciones_etp2,
			$uma]);

		if ($up_lev) {
			echo "<script>alert('Etapa 2 actualizada con éxito, continúa a la etapa 3')</script>";
			echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev3.php?'.$uma.'">';
		} else {
			echo "<script>alert('No fue posible recuperar la información para actualizar, por favor inténtalo de nuevo')</script>";
		echo "<script>console.log('Error al guardar la información en la DDBB')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev2.php?'.$uma.'">';
		}

	} else {
		echo "<script>alert('No fue posible recuperar la información para actualizar, por favor inténtalo de nuevo')</script>";
		echo "<script>console.log('Error al obtener datos a través del botón del formulario')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev2.php?'.$uma.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>