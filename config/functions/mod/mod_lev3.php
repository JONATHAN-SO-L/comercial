<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

	if (isset($_POST['actualizar_levantamiento'])) {

		require '../../conex.php';

		$uma = $_SERVER['QUERY_STRING'];

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
		$media_fil_etp3 = $_POST['media_fil_etp3'];
		$forma_media_fil_etp3 = $_POST['forma_media_fil_etp3'];
		$color_media_fil_etp3 = $_POST['color_media_fil_etp3'];
		$bolsas_etp3 = $_POST['bolsas_etp3'];
		$media_ad_etp3 = $_POST['media_ad_etp3'];
		$num_separadores_etp3 = $_POST['num_separadores_etp3'];
		$separador_etp3 = $_POST['separador_etp3'];
		$asa_etp3 = $_POST['asa_etp3'];
		$plenum_etp3 = $_POST['plenum_etp3'];
		$postes_etp3 = $_POST['postes_etp3'];
		$rejilla_etp3 = $_POST['rejilla_etp3'];
		$contramarco_etp3 = $_POST['contramarco_etp3'];
		$construccion_etp3 = $_POST['construccion_etp3'];
		$sello_etp3 = $_POST['sello_etp3'];
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
		$marca_etp3  = $_POST['marca_etp3'];
		$capacidad_etp3 = $_POST['capacidad_etp3'];
		$cpi_etp3 = $_POST['cpi_etp3'];
		$capacidad_instalada_etp3 = $_POST['capacidad_instalada_etp3'];
		$comentarios_etp3 = $_POST['comentarios_etp3'];
		$observaciones_etp3 = $_POST['observaciones_etp3'];

		$up_lev = $con->prepare("UPDATE levantamientos SET
			codigo_etp3 = ?, descripcion_corta_etp3 = ?, familia_etp3 = ?, modelo_etp3 = ?,
			tipo_etp3 = ?, eficiencia_etp3 = ?, gasto_etp3 = ?, alto_nom_etp3 = ?,
			frente_nom_etp3 = ?, fondo_nom_etp3 = ?, um_nominal_etp3 = ?, marco_etp3 = ?,
			espesor_etp3 = ?, um_espesor_etp3 = ?, media_fil_etp3 = ?, forma_media_fil_etp3 = ?,
			color_media_fil_etp3 = ?, bolsas_etp3 = ?, media_ad_etp3 = ?, num_separadores_etp3 = ?,
			separador_etp3 = ?, asa_etp3 = ?, plenum_etp3 = ?, postes_etp3 = ?,
			rejilla_etp3 = ?, contramarco_etp3 = ?, construccion_etp3 = ?, sello_etp3 = ?,
			perfil_gel_etp3 = ?, ubicacion_gel_etp3 = ?, temperatura_etp3 = ?, alma_acero_etp3 = ?,
			invertido_etp3 = ?, alto_real_etp3 = ?, frente_real_etp3 = ?, fondo_real_etp3 = ?,
			um_real_etp3 = ?, um_venta_etp3 = ?, marca_etp3 = ?, capacidad_etp3 = ?,
			cpi_etp3 = ?, capacidad_instalada_etp3 = ?, comentarios_etp3 = ?, observaciones_etp3 = ?
			WHERE uma = ?");

		$up_lev->execute([
			$codigo_etp3, $descripcion_corta_etp3, $familia_etp3, $modelo_etp3,
			$tipo_etp3, $eficiencia_etp3, $gasto_etp3, $alto_nom_etp3,
			$frente_nom_etp3, $fondo_nom_etp3, $um_nominal_etp3, $marco_etp3,
			$espesor_etp3, $um_espesor_etp3, $media_fil_etp3, $forma_media_fil_etp3,
			$color_media_fil_etp3, $bolsas_etp3, $media_ad_etp3, $num_separadores_etp3,
			$separador_etp3, $asa_etp3, $plenum_etp3, $postes_etp3,
			$rejilla_etp3, $contramarco_etp3, $construccion_etp3, $sello_etp3,
			$perfil_gel_etp3, $ubicacion_gel_etp3, $temperatura_etp3, $alma_acero_etp3,
			$invertido_etp3, $alto_nom_etp3, $frente_real_etp3, $fondo_nom_etp3,
			$um_nominal_etp3, $um_venta_etp3, $marca_etp3, $capacidad_etp3,
			$cpi_etp3, $capacidad_instalada_etp3, $comentarios_etp3, $observaciones_etp3,
			$uma]);

		if ($up_lev) {
			echo "<script>alert('Etapa 3 actualizada con éxito')</script>";
			switch ($_SESSION['tipo']) {
				case 'A':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/admin/index.php">';
				break;

				case 'G':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/gerencia/index.php">';
				break;

				case 'J':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">';
				break;

				case 'V':
				echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/index.php">';
				break;
				
				default:
				echo '<meta http-equiv="refresh" content="0;../../../index.php">';
				break;
			}
			
		} else {
			echo "<script>alert('No fue posible recuperar la información para actualizar, por favor inténtalo de nuevo')</script>";
		echo "<script>console.log('Error al guardar la información en la DDBB')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev3.php?'.$uma.'">';
		}

	} else {
		echo "<script>alert('No fue posible recuperar la información para actualizar, por favor inténtalo de nuevo')</script>";
		echo "<script>console.log('Error al obtener datos a través del botón del formulario')</script>";
		echo '<meta http-equiv="refresh" content="0;../../permissions/mod/mod_lev3.php?'.$uma.'">';
	}

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>