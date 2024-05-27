<?php
session_start();

if (isset($_POST['guardar_etp1'])) {
	require '../../conex.php';
	$uma = $_SESSION['uma'];
	$ciclo = 2;

	//Recepción de variable de la familia buscando en DDBB
	$s_familia = $con->prepare("SELECT * FROM levantamientos WHERE uma = :uma");
	$s_familia->bindValue(':uma', $uma);
	$s_familia->setFetchMode(PDO::FETCH_OBJ);
	$s_familia->execute();

	$f_familia = $s_familia->fetchAll();

	foreach ($f_familia as $item) {
		$familia = $item -> familia_etp1;
		$modelo = $item -> modelo_etp1;
		$bucle = $item -> ciclos;
	}

	/************************
	Recepción de datos
	************************/
	//Obtención de imágenes
	$size_max = 8388608; // Definición de tamaño máximo de imagen / fotografía (8 MB)
	$folder = '../../../assets/img_lev'; // Se define directorio donde se guarda la imagen en el servidor

	switch ($bucle) {
		case '1':
			switch ($familia) {
				case 'HEPA':
				$sello_etp1 = $_POST['sello_etp1'];
		
				switch ($sello_etp1) {
					case 'Neopreno':
					/****************
					DATOS DE NEOPRENO
					****************/
					$codigo_etp1_neopreno = $_POST['codigo_etp1_neopreno'];
					$eficiencia_etp1_neopreno = $_POST['eficiencia_etp1_neopreno'];
					$plenum_etp1_neopreno = $_POST['plenum_etp1_neopreno'];
					$marco_etp1_neopreno = $_POST['marco_etp1_neopreno'];
					$construccion_etp1_neopreno = $_POST['construccion_etp1_neopreno'];
					$separador_etp1_neopreno = $_POST['separador_etp1_neopreno'];
					$alta_capacidad_etp1_neopreno = $_POST['alta_capacidad_etp1_neopreno'];
					$rejilla_etp1_neopreno = $_POST['rejilla_etp1_neopreno']; '<br>';
		
					//Permitir solo hasta 8 imágenes
					$file = $_FILES['foto_1_etp1_neopreno']['name'];
					$temp_file = $_FILES['foto_1_etp1_neopreno']['tmp_name'];
		
					/***********************************
					Almacenamiento de datos sin imágenes
					***********************************/
					$up_data_neo = $con->prepare("UPDATE levantamientos SET sello_etp1= ?, codigo_etp1 = ?, eficiencia_etp1 = ?, plenum_etp1 = ?,
					marco_etp1 = ?, construccion_etp1 = ?, separador_etp1 = ?, alta_capacidad_etp1 = ?,
					rejilla_etp1 = ?, ciclos = ? WHERE uma = ?");
					$val_data_neo = $up_data_neo->execute([$sello_etp1, $codigo_etp1_neopreno, $eficiencia_etp1_neopreno, $plenum_etp1_neopreno, $marco_etp1_neopreno,
					$construccion_etp1_neopreno, $separador_etp1_neopreno, $alta_capacidad_etp1_neopreno, $rejilla_etp1_neopreno, $ciclo, $uma]);
		
					/***********************************
					Almacenamiento de datos con imágenes
					***********************************/
					
					if ($val_data_neo) {
						echo '<script>alert("Se guardó con exito la etapa 1 de la UMA: '.$uma.'")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					} else {
						echo '<script>alert("Existió un error al guardar la etapa 1 de la UMA: '.$uma.', inténtalo de nuevo")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					}
		
					break;
		
					case 'Gel':
					/***********
					DATOS DE GEL
					***********/
					$codigo_etp1_gel = $_POST['codigo_etp1_gel'];
					$eficiencia_etp1_gel = $_POST['eficiencia_etp1_gel'];
					$marco_etp1_gel = $_POST['marco_etp1_gel'];
					$separador_etp1_gel = $_POST['separador_etp1_gel'];
					$perfil_gel_etp1_gel = $_POST['perfil_gel_etp1_gel'];
					$fondo_nom_etp1_gel = $_POST['fondo_nom_etp1_gel'];
					$um_nominal_etp1_gel = $_POST['um_nominal_etp1_gel'];
					$rejilla_etp1_gel = $_POST['rejilla_etp1_gel'];
		
					/***********************************
					Almacenamiento de datos sin imágenes
					***********************************/
					$up_data_gel = $con->prepare("UPDATE levantamientos SET sello_etp1 = ?, codigo_etp1 = ?, eficiencia_etp1 = ?,
					marco_etp1 = ?, separador_etp1 = ?, perfil_gel_etp1 = ?, fondo_nom_etp1 = ?,
					um_nominal_etp1 = ?, rejilla_etp1 = ?, ciclos = ? WHERE uma = ?");
					
					$val_data_gel = $up_data_gel->execute([$sello_etp1, $codigo_etp1_gel, $eficiencia_etp1_gel, $marco_etp1_gel,
					$separador_etp1_gel, $perfil_gel_etp1_gel, $fondo_nom_etp1_gel, $um_nominal_etp1_gel,
					$rejilla_etp1_gel, $ciclo, $uma]);
		
					/***********************************
					Almacenamiento de datos con imágenes
					***********************************/
		
					if ($val_data_gel) {
						echo '<script>alert("Se guardó con exito la etapa 1 de la UMA: '.$uma.'")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					} else {
						echo '<script>alert("Existió un error al guardar la etapa 1 de la UMA: '.$uma.', inténtalo de nuevo")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					}
		
					break;
		
					default:
					echo "<script>alert('ERROR 004: No se validó la selección de Neopreno o Gel, inténtalo de nuevo por favor')</script>";
						switch ($_SESSION['tipo']) {
							case 'J':
							echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/levantamiento_etp1.php?'.$uma.'">';
							break;
		
							case 'V':
							echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
							break;
						}
					break;
				}
		
				break;
			}
		break;

		case '2':
			switch ($familia) {
				case 'HEPA':
				$sello_etp1 = $_POST['sello_etp1_2'];
		
				switch ($sello_etp1) {
					case 'Neopreno':
					/****************
					DATOS DE NEOPRENO
					****************/
					$codigo_etp1_neopreno = $_POST['codigo_etp1_2_neopreno'];
					$eficiencia_etp1_neopreno = $_POST['eficiencia_etp1_2_neopreno'];
					$plenum_etp1_neopreno = $_POST['plenum_etp1_2_neopreno'];
					$marco_etp1_neopreno = $_POST['marco_etp1_2_neopreno'];
					$construccion_etp1_neopreno = $_POST['construccion_etp1_2_neopreno'];
					$separador_etp1_neopreno = $_POST['separador_etp1_2_neopreno'];
					$alta_capacidad_etp1_neopreno = $_POST['alta_capacidad_etp1_2_neopreno'];
					$rejilla_etp1_neopreno = $_POST['rejilla_etp1_2_neopreno']; '<br>';
		
					//Permitir solo hasta 8 imágenes
					$file = $_FILES['foto_1_etp1_2_neopreno']['name'];
					$temp_file = $_FILES['foto_1_etp1_2_neopreno']['tmp_name'];
		
					/***********************************
					Almacenamiento de datos sin imágenes
					***********************************/
					$up_data_neo = $con->prepare("UPDATE levantamientos SET sello_etp1_2= ?, codigo_etp1_2 = ?, eficiencia_etp1_2 = ?, plenum_etp1_2 = ?,
					marco_etp1_2 = ?, construccion_etp1_2 = ?, separador_etp1_2 = ?, alta_capacidad_etp1_2 = ?,
					rejilla_etp1_2 = ?, ciclos = ? WHERE uma = ?");
					$val_data_neo = $up_data_neo->execute([$sello_etp1, $codigo_etp1_neopreno, $eficiencia_etp1_neopreno, $plenum_etp1_neopreno, $marco_etp1_neopreno,
					$construccion_etp1_neopreno, $separador_etp1_neopreno, $alta_capacidad_etp1_neopreno, $rejilla_etp1_neopreno, $ciclo, $uma]);
		
					/***********************************
					Almacenamiento de datos con imágenes
					***********************************/
					
					if ($val_data_neo) {
						echo '<script>alert("Se guardó con exito la etapa 1 de la UMA: '.$uma.'")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					} else {
						echo '<script>alert("Existió un error al guardar la etapa 1 de la UMA: '.$uma.', inténtalo de nuevo")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					}
		
					break;
		
					case 'Gel':
					/***********
					DATOS DE GEL
					***********/
					$codigo_etp1_gel = $_POST['codigo_etp1_2_gel'];
					$eficiencia_etp1_gel = $_POST['eficiencia_etp1_2_gel'];
					$marco_etp1_gel = $_POST['marco_etp1_2_gel'];
					$separador_etp1_gel = $_POST['separador_etp1_2_gel'];
					$perfil_gel_etp1_gel = $_POST['perfil_gel_etp1_2_gel'];
					$fondo_nom_etp1_gel = $_POST['fondo_nom_etp1_2_gel'];
					$um_nominal_etp1_gel = $_POST['um_nominal_etp1_2_gel'];
					$rejilla_etp1_gel = $_POST['rejilla_etp1_2_gel'];
		
					/***********************************
					Almacenamiento de datos sin imágenes
					***********************************/
					$up_data_gel = $con->prepare("UPDATE levantamientos SET sello_etp1_2 = ?, codigo_etp1_2 = ?, eficiencia_etp1_2 = ?,
					marco_etp1_2 = ?, separador_etp1_2 = ?, perfil_gel_etp1_2 = ?, fondo_nom_etp1_2 = ?,
					um_nominal_etp1_2 = ?, rejilla_etp1_2 = ?, ciclos = ? WHERE uma = ?");
					
					$val_data_gel = $up_data_gel->execute([$sello_etp1, $codigo_etp1_gel, $eficiencia_etp1_gel, $marco_etp1_gel,
					$separador_etp1_gel, $perfil_gel_etp1_gel, $fondo_nom_etp1_gel, $um_nominal_etp1_gel,
					$rejilla_etp1_gel, $ciclo, $uma]);
		
					/***********************************
					Almacenamiento de datos con imágenes
					***********************************/
		
					if ($val_data_gel) {
						echo '<script>alert("Se guardó con exito la etapa 1 de la UMA: '.$uma.'")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					} else {
						echo '<script>alert("Existió un error al guardar la etapa 1 de la UMA: '.$uma.', inténtalo de nuevo")</script>';
						echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					}
		
					break;
		
					default:
					echo "<script>alert('ERROR 004: No se validó la selección de Neopreno o Gel, inténtalo de nuevo por favor')</script>";
						switch ($_SESSION['tipo']) {
							case 'J':
							echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/levantamiento_etp1.php?'.$uma.'">';
							break;
		
							case 'V':
							echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
							break;
						}
					break;
				}
		
				break;
			}
		break;
	}

	/***********************************************************************************
	Si se detecta alguna imagen se detecta el tamaño y se valida que no supere el tamaño
	***********************************************************************************/

	/*if ($imagen1 || $imagen2 || $imagen3 || $imagen4) {
		if ($size1 || $size2 || $size3 || $size4) {
			if ($size1 || $size2 || $size3 || $size4 <= $size_max) {
				$val_up_data_w_pic;
				echo "<script>alert('Captura de datos exitosa')</script>";
				switch ($_SESSION['tipo']) {
					case 'J':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/levantamiento_etp2.php?'.$uma.'">';
					break;

					case 'V':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
					break;
				}
			} else {
				echo "<script>alert('ERROR 004: No se logró capturar la información, se superó el espacio máximo de 8 MB para imágenes')</script>";
				switch ($_SESSION['tipo']) {
					case 'J':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/levantamiento_etp1.php?'.$uma.'">';
					break;

					case 'V':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
					break;
				}
			}
		} else {
			$val_up_data;
			echo "<script>alert('Captura de datos exitosa')</script>";
			switch ($_SESSION['tipo']) {
					case 'J':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/levantamiento_etp2.php?'.$uma.'">';
					break;

					case 'V':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
					break;
				}
		}
	} else {
		$val_up_data;
		echo "<script>alert('Captura de datos exitosa')</script>";
		switch ($_SESSION['tipo']) {
					case 'J':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/levantamiento_etp2.php?'.$uma.'">';
					break;

					case 'V':
					echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
					break;
				}
	}*/

} else {
	header('Location: ../../../index.php');
}

?>