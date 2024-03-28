<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	if (isset($_POST['actualizar_levantamiento'])) {

		require '../../conex.php';

		$uma = $_SERVER['QUERY_STRING'];

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
		$media_fil_etp1 = $_POST['media_fil_etp1'];
		$forma_media_fil_etp1 = $_POST['forma_media_fil_etp1'];
		$color_media_fil_etp1 = $_POST['color_media_fil_etp1'];
		$bolsas_etp1 = $_POST['bolsas_etp1'];
		$media_ad_etp1 = $_POST['media_ad_etp1'];
		$num_separadores_etp1 = $_POST['num_separadores_etp1'];
		$separador_etp1 = $_POST['separador_etp1'];
		$asa_etp1 = $_POST['asa_etp1'];
		$plenum_etp1 = $_POST['plenum_etp1'];
		$postes_etp1 = $_POST['postes_etp1'];
		$rejilla_etp1 = $_POST['rejilla_etp1'];
		$contramarco_etp1 = $_POST['contramarco_etp1'];
		$construccion_etp1 = $_POST['construccion_etp1'];
		$sello_etp1 = $_POST['sello_etp1'];
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
		$marca_etp1  = $_POST['marca_etp1'];
		$capacidad_etp1 = $_POST['capacidad_etp1'];
		$cpi_etp1 = $_POST['cpi_etp1'];
		$capacidad_instalada_etp1 = $_POST['capacidad_instalada_etp1'];
		$comentarios_etp1 = $_POST['comentarios_etp1'];
		$observaciones_etp1 = $_POST['observaciones_etp1'];

		switch ($_SESSION['tipo']) {
			case 'V':
			$fecha_hora_modificacion = date('Y-m-d H:i:s');

			$up_lev = $con->prepare("UPDATE levantamientos SET
			codigo_etp1 = ?, descripcion_corta_etp1 = ?, familia_etp1 = ?, modelo_etp1 = ?,
			tipo_etp1 = ?, eficiencia_etp1 = ?, gasto_etp1 = ?, alto_nom_etp1 = ?,
			frente_nom_etp1 = ?, fondo_nom_etp1 = ?, um_nominal_etp1 = ?, marco_etp1 = ?,
			espesor_etp1 = ?, um_espesor_etp1 = ?, media_fil_etp1 = ?, forma_media_fil_etp1 = ?,
			color_media_fil_etp1 = ?, bolsas_etp1 = ?, media_ad_etp1 = ?, num_separadores_etp1 = ?,
			separador_etp1 = ?, asa_etp1 = ?, plenum_etp1 = ?, postes_etp1 = ?,
			rejilla_etp1 = ?, contramarco_etp1 = ?, construccion_etp1 = ?, sello_etp1 = ?,
			perfil_gel_etp1 = ?, ubicacion_gel_etp1 = ?, temperatura_etp1 = ?, alma_acero_etp1 = ?,
			invertido_etp1 = ?, alto_real_etp1 = ?, frente_real_etp1 = ?, fondo_real_etp1 = ?,
			um_real_etp1 = ?, um_venta_etp1 = ?, marca_etp1 = ?, capacidad_etp1 = ?,
			cpi_etp1 = ?, capacidad_instalada_etp1 = ?, comentarios_etp1 = ?, observaciones_etp1 = ?,
			fecha_hora_modificacion = ?
			WHERE uma = ?");

			$up_lev->execute([
			$codigo_etp1, $descripcion_corta_etp1, $familia_etp1, $modelo_etp1,
			$tipo_etp1, $eficiencia_etp1, $gasto_etp1, $alto_nom_etp1,
			$frente_nom_etp1, $fondo_nom_etp1, $um_nominal_etp1, $marco_etp1,
			$espesor_etp1, $um_espesor_etp1, $media_fil_etp1, $forma_media_fil_etp1,
			$color_media_fil_etp1, $bolsas_etp1, $media_ad_etp1, $num_separadores_etp1,
			$separador_etp1, $asa_etp1, $plenum_etp1, $postes_etp1,
			$rejilla_etp1, $contramarco_etp1, $construccion_etp1, $sello_etp1,
			$perfil_gel_etp1, $ubicacion_gel_etp1, $temperatura_etp1, $alma_acero_etp1,
			$invertido_etp1, $alto_nom_etp1, $frente_real_etp1, $fondo_nom_etp1,
			$um_nominal_etp1, $um_venta_etp1, $marca_etp1, $capacidad_etp1,
			$cpi_etp1, $capacidad_instalada_etp1, $comentarios_etp1, $observaciones_etp1,
			$fecha_hora_modificacion,
			$uma]);
			break;
			
			default:
			$up_lev = $con->prepare("UPDATE levantamientos SET
			codigo_etp1 = ?, descripcion_corta_etp1 = ?, familia_etp1 = ?, modelo_etp1 = ?,
			tipo_etp1 = ?, eficiencia_etp1 = ?, gasto_etp1 = ?, alto_nom_etp1 = ?,
			frente_nom_etp1 = ?, fondo_nom_etp1 = ?, um_nominal_etp1 = ?, marco_etp1 = ?,
			espesor_etp1 = ?, um_espesor_etp1 = ?, media_fil_etp1 = ?, forma_media_fil_etp1 = ?,
			color_media_fil_etp1 = ?, bolsas_etp1 = ?, media_ad_etp1 = ?, num_separadores_etp1 = ?,
			separador_etp1 = ?, asa_etp1 = ?, plenum_etp1 = ?, postes_etp1 = ?,
			rejilla_etp1 = ?, contramarco_etp1 = ?, construccion_etp1 = ?, sello_etp1 = ?,
			perfil_gel_etp1 = ?, ubicacion_gel_etp1 = ?, temperatura_etp1 = ?, alma_acero_etp1 = ?,
			invertido_etp1 = ?, alto_real_etp1 = ?, frente_real_etp1 = ?, fondo_real_etp1 = ?,
			um_real_etp1 = ?, um_venta_etp1 = ?, marca_etp1 = ?, capacidad_etp1 = ?,
			cpi_etp1 = ?, capacidad_instalada_etp1 = ?, comentarios_etp1 = ?, observaciones_etp1 = ?
			WHERE uma = ?");

			$up_lev->execute([
			$codigo_etp1, $descripcion_corta_etp1, $familia_etp1, $modelo_etp1,
			$tipo_etp1, $eficiencia_etp1, $gasto_etp1, $alto_nom_etp1,
			$frente_nom_etp1, $fondo_nom_etp1, $um_nominal_etp1, $marco_etp1,
			$espesor_etp1, $um_espesor_etp1, $media_fil_etp1, $forma_media_fil_etp1,
			$color_media_fil_etp1, $bolsas_etp1, $media_ad_etp1, $num_separadores_etp1,
			$separador_etp1, $asa_etp1, $plenum_etp1, $postes_etp1,
			$rejilla_etp1, $contramarco_etp1, $construccion_etp1, $sello_etp1,
			$perfil_gel_etp1, $ubicacion_gel_etp1, $temperatura_etp1, $alma_acero_etp1,
			$invertido_etp1, $alto_nom_etp1, $frente_real_etp1, $fondo_nom_etp1,
			$um_nominal_etp1, $um_venta_etp1, $marca_etp1, $capacidad_etp1,
			$cpi_etp1, $capacidad_instalada_etp1, $comentarios_etp1, $observaciones_etp1,
			$uma]);
			break;
		}

		if ($up_lev) {
			echo "<script>alert('Etapa 1 actualizada con éxito, continúa a la etapa 2')</script>";
			echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev2.php?'.$uma.'">';
		} else {
			echo "<script>alert('No fue posible recuperar la información para actualizar, por favor inténtalo de nuevo')</script>";
		echo "<script>console.log('Error al guardar la información en la DDBB')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev.php?'.$uma.'">';
		}

	} else {
		echo "<script>alert('No fue posible recuperar la información para actualizar, por favor inténtalo de nuevo')</script>";
		echo "<script>console.log('Error al obtener datos a través del botón del formulario')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev.php?'.$uma.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>