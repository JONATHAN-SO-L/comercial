<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

    $uma = $_SERVER['QUERY_STRING'];
    
    require '../../conex.php';

    $q_lev1  = $con->prepare("SELECT * FROM levantamientos WHERE uma = :uma");
    $q_lev1->bindValue(':uma', $uma);
    $q_lev1->setFetchMode(PDO::FETCH_OBJ);
    $q_lev1->execute();

    $levantamientos_uno = $q_lev1 -> fetchAll(); ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
		<?php include '../../../assets/navs/links.php'; 
		include '../../../assets/navs/nav_modify.php';?>
		<link rel="stylesheet" type="text/css" href="../../../css/company.css">
	</head>
	<body><br><br><br>

    <div class="container col-sm-8 panel panel-body">

        <img class="empresa_pic" src="../../../assets/img/captura_informacion.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Levantamiento de UMA: <strong><?php echo $uma; ?></strong></h3><br><br>
        <div class="card bg-primary text-white"><center><h6><strong>Puedes solamente <u><i>visualizar</i></u> la información del levantamientos en este apartado </strong></h6></center></div>
			<div class="border border-primary form-control">
                <!---------------------------
                DATOS GENERALES DE LA EMPRESA
                ---------------------------->
                <center><h4 class="alert alert-success" style="margin-top: 10px;">DATOS GENERALES</h4><strong></center>

                <?php
                $vendedor = $_SESSION['nombre'];
                $data = $con->prepare("SELECT * FROM levantamientos WHERE vendedor = :vendedor AND uma = :uma");
                $data->bindValue(':vendedor', $vendedor);
                $data->bindValue(':uma', $uma);
                $data->setFetchMode(PDO::FETCH_OBJ);
                $data->execute();
        
                $show_data = $data->fetchAll();
                if ($data -> rowCount() > 0) {
                    foreach ($show_data as $value) {
                        //Búsqueda de empresa en base al ID
                        $search_company = $con->prepare("SELECT razon_social FROM empresas, levantamientos WHERE empresas.id = levantamientos.empresa AND levantamientos.empresa = ".$value->empresa." AND levantamientos.uma = :uma");
                        $search_company->bindValue(':uma', $uma);
                        $search_company->setFetchMode(PDO::FETCH_OBJ);
                        $search_company->execute();
                        $company = $search_company->fetchAll();
        
                        if ($search_company -> rowCount() > 0) {
                            foreach ($company as $rel) {
                                echo '<label><strong>Empresa:</strong></label>';
                                echo '<input type="text" class="form-control" placeholder="Ingresa el código del filtro" maxlength="25" value="'.$rel -> razon_social.'" readonly><br>';
                            }
                        }
        
                        //Búsqueda de edificio en base al ID de la empresa
                        $search_build = $con->prepare("SELECT descripcion FROM edificio, levantamientos WHERE edificio.id_edificio = levantamientos.edificio AND levantamientos.edificio = ".$value->edificio." AND levantamientos.uma = :uma");
                        $search_build->bindValue(':uma', $uma);
                        $search_build->setFetchMode(PDO::FETCH_OBJ);
                        $search_build->execute();
                        $build = $search_build->fetchAll();
        
                        if ($search_build -> rowCount() > 0) {
                            foreach ($build as $edi) {
                                echo '<label><strong>Edificio:</strong></label>';
                                echo '<input type="text" class="form-control" placeholder="Ingresa el código del filtro" maxlength="25" value="'.$edi -> descripcion.'" readonly><br>';
                            }
                        }
        
                        //Búsqueda de la ubicación en base al ID del edificio
                        $search_location = $con->prepare("SELECT ubicacion.ubicacion FROM ubicacion, levantamientos WHERE ubicacion.id_ubicacion = levantamientos.ubicacion AND levantamientos.ubicacion = ".$value->ubicacion." AND levantamientos.uma = :uma");
                        $search_location->bindValue(':uma', $uma);
                        $search_location->setFetchMode(PDO::FETCH_OBJ);
                        $search_location->execute();
                        $locate = $search_location->fetchAll();
        
                        if ($search_location -> rowCount() > 0) {
                            echo '<label><strong>Ubicación:</strong></label>';
                            foreach ($locate as $local) {
                                echo '<input type="text" class="form-control" placeholder="Ingresa el código del filtro" maxlength="25" value="'.$local -> ubicacion.'" readonly><br>';
                            }
                        }
                    }
                } else {
                    echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay levantamientos registrados</h3></strong></center></div>';
                    echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                    exit();
                }
                ?>

                <!-----
                ETAPA 1
                ------>
				
                <center><h4 class="alert alert-danger" style="margin-top: 10px;">Etapa: <strong><?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $etapa) {
                            echo $etapa -> etapa_etp1;
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?></strong></h4></center>

                    <label><strong>Código:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $codigo) {
                            echo '<input type="text" class="form-control" placeholder="Ingresa el código del filtro" maxlength="25" value="'.$codigo->codigo_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$descripcion_corta->descripcion_corta_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$familia -> familia_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$modelo -> modelo_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$tipo -> tipo_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$eficiencia -> eficiencia_etp1.'" readonly><br>';
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
                            echo '<input type="text" name="gasto_etp1" class="form-control"  placeholder="Ingresa el gasto" maxlength="20" value="'.$gasto -> gasto_etp1.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="alto_nom_etp1" class="form-control"  placeholder="Ingresa el alto" maxlength="10" value="'.$alto_nominal -> alto_nom_etp1.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="frente_nom_etp1" class="form-control"  placeholder="Ingresa el frente" maxlength="10" value="'.$frente_nominal -> frente_nom_etp1.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="fondo_nom_etp1" class="form-control"  placeholder="Ingresa el fondo" maxlength="10" value="'.$fondo_nominal -> fondo_nom_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_nominal -> um_nominal_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$marco -> marco_etp1.'" readonly><br>';
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
                            echo '<input type="number" name="espesor_etp1" step="any" class="form-control"  placeholder="Agrega el espesor del marco" maxlength="10" value="'.$espesor -> espesor_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_espesor -> um_espesor_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$media_fil -> media_fil_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$forma_media_fil -> forma_media_fil_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$color_media_fil -> color_media_fil_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$bolsas -> bolsas_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$media_ad -> media_ad_etp1.'" readonly><br>';
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
                            echo '<input type="number" name="num_separadores_etp1" class="form-control"  placeholder="Ingresa el número de separadores" maxlength="5" value="'.$num_separadores -> num_separadores_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$separador -> separador_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$asa -> asa_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$plenum -> plenum_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$postes -> postes_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$rejilla -> rejilla_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$contramarco -> contramarco_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$construccion -> construccion_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$sello -> sello_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$perfil_gel -> perfil_gel_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$ubicacion_gel -> ubicacion_gel_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$temperatura -> temperatura_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$alma_acero -> alma_acero_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$invertido -> invertido_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$alto_real -> alto_real_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$frente_real -> frente_real_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$fondo_real -> fondo_real_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_real -> um_real_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_venta -> um_venta_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$marca -> marca_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$capacidad -> capacidad_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$cpi -> cpi_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$capcidad_instalada -> capacidad_instalada_etp1.'" readonly>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                    <p class="alert alert-warinig"><center><u><strong>IMPORTANTE:</strong> A continuación se muestran las fotografías guardadas.</u></p></center><br>

                    <label><strong>Foto 1 <i>(Opcional | Esta será la que se muestra en el PDF)</i>:</strong></label><br><br>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $foto_1) {
                            if ($foto_1 -> foto_1_etp1 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_1 -> foto_1_etp1.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_2 -> foto_2_etp1 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_2 -> foto_2_etp1.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_3 -> foto_3_etp1 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_3 -> foto_3_etp1.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_4 -> foto_4_etp1 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_4 -> foto_4_etp1.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                    <label><strong>Comentarios <i>(Opcional)</i>:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $comentarios) {
                            echo '<input type="text" class="form-control" placeholder="No hay comentarios" maxlength="90" value="'.$comentarios -> comentarios_etp1.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="No hay observaciones" maxlength="90" value="'.$observaciones -> observaciones_etp1.'" readonly><br>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                <!-----
                ETAPA 2
                ------>    
                <center><h4 class="alert alert-danger" style="margin-top: 10px;">Etapa: <strong><?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $etapa) {
                            echo $etapa -> etapa_etp2;
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?></strong></h4></center>

                    <label><strong>Código:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $codigo) {
                            echo '<input type="text" class="form-control" placeholder="Ingresa el código del filtro" maxlength="25" value="'.$codigo->codigo_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$descripcion_corta->descripcion_corta_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$familia -> familia_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$modelo -> modelo_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$tipo -> tipo_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$eficiencia -> eficiencia_etp2.'" readonly><br>';
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
                            echo '<input type="text" name="gasto_etp1" class="form-control"  placeholder="Ingresa el gasto" maxlength="20" value="'.$gasto -> gasto_etp2.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="alto_nom_etp1" class="form-control"  placeholder="Ingresa el alto" maxlength="10" value="'.$alto_nominal -> alto_nom_etp2.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="frente_nom_etp1" class="form-control"  placeholder="Ingresa el frente" maxlength="10" value="'.$frente_nominal -> frente_nom_etp2.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="fondo_nom_etp1" class="form-control"  placeholder="Ingresa el fondo" maxlength="10" value="'.$fondo_nominal -> fondo_nom_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_nominal -> um_nominal_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$marco -> marco_etp2.'" readonly><br>';
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
                            echo '<input type="number" name="espesor_etp1" step="any" class="form-control"  placeholder="Agrega el espesor del marco" maxlength="10" value="'.$espesor -> espesor_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_espesor -> um_espesor_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$media_fil -> media_fil_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$forma_media_fil -> forma_media_fil_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$color_media_fil -> color_media_fil_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$bolsas -> bolsas_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$media_ad -> media_ad_etp2.'" readonly><br>';
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
                            echo '<input type="number" name="num_separadores_etp1" class="form-control"  placeholder="Ingresa el número de separadores" maxlength="5" value="'.$num_separadores -> num_separadores_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$separador -> separador_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$asa -> asa_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$plenum -> plenum_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$postes -> postes_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$rejilla -> rejilla_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$contramarco -> contramarco_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$construccion -> construccion_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$sello -> sello_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$perfil_gel -> perfil_gel_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$ubicacion_gel -> ubicacion_gel_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$temperatura -> temperatura_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$alma_acero -> alma_acero_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$invertido -> invertido_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$alto_real -> alto_real_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$frente_real -> frente_real_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$fondo_real -> fondo_real_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_real -> um_real_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_venta -> um_venta_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$marca -> marca_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$capacidad -> capacidad_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$cpi -> cpi_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$capcidad_instalada -> capacidad_instalada_etp2.'" readonly>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                    <p class="alert alert-warinig"><center><u><strong>IMPORTANTE:</strong> A continuación se muestran las fotografías guardadas.</u></p></center><br>

                    <label><strong>Foto 1 <i>(Opcional | Esta será la que se muestra en el PDF)</i>:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $foto_1) {
                            if ($foto_1 -> foto_1_etp2 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_1 -> foto_1_etp2.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_2 -> foto_2_etp2 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_2 -> foto_2_etp2.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_3 -> foto_3_etp2 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_3 -> foto_3_etp2.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_4 -> foto_4_etp2 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_4 -> foto_4_etp2.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                    <label><strong>Comentarios <i>(Opcional)</i>:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $comentarios) {
                            echo '<input type="text" class="form-control" placeholder="No hay comentarios" maxlength="90" value="'.$comentarios -> comentarios_etp2.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="No hay observaciones" maxlength="90" value="'.$observaciones -> observaciones_etp2.'" readonly><br>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                <!-----
                ETAPA 3
                ------>    
                <center><h4 class="alert alert-danger" style="margin-top: 10px;">Etapa: <strong><?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $etapa) {
                            echo $etapa -> etapa_etp3;
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?></strong></h4></center>

                    <label><strong>Código:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $codigo) {
                            echo '<input type="text" class="form-control" placeholder="Ingresa el código del filtro" maxlength="25" value="'.$codigo->codigo_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$descripcion_corta->descripcion_corta_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$familia -> familia_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$modelo -> modelo_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$tipo -> tipo_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$eficiencia -> eficiencia_etp3.'" readonly><br>';
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
                            echo '<input type="text" name="gasto_etp1" class="form-control"  placeholder="Ingresa el gasto" maxlength="20" value="'.$gasto -> gasto_etp3.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="alto_nom_etp1" class="form-control"  placeholder="Ingresa el alto" maxlength="10" value="'.$alto_nominal -> alto_nom_etp3.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="frente_nom_etp1" class="form-control"  placeholder="Ingresa el frente" maxlength="10" value="'.$frente_nominal -> frente_nom_etp3.'" readonly><br>';
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
                            echo '<input type="number" step="any" name="fondo_nom_etp1" class="form-control"  placeholder="Ingresa el fondo" maxlength="10" value="'.$fondo_nominal -> fondo_nom_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_nominal -> um_nominal_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$marco -> marco_etp3.'" readonly><br>';
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
                            echo '<input type="number" name="espesor_etp1" step="any" class="form-control"  placeholder="Agrega el espesor del marco" maxlength="10" value="'.$espesor -> espesor_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_espesor -> um_espesor_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$media_fil -> media_fil_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$forma_media_fil -> forma_media_fil_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$color_media_fil -> color_media_fil_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$bolsas -> bolsas_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$media_ad -> media_ad_etp3.'" readonly><br>';
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
                            echo '<input type="number" name="num_separadores_etp1" class="form-control"  placeholder="Ingresa el número de separadores" maxlength="5" value="'.$num_separadores -> num_separadores_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$separador -> separador_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$asa -> asa_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$plenum -> plenum_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$postes -> postes_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$rejilla -> rejilla_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$contramarco -> contramarco_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$construccion -> construccion_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$sello -> sello_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$perfil_gel -> perfil_gel_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$ubicacion_gel -> ubicacion_gel_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$temperatura -> temperatura_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$alma_acero -> alma_acero_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$invertido -> invertido_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$alto_real -> alto_real_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$frente_real -> frente_real_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$fondo_real -> fondo_real_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_real -> um_real_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$um_venta -> um_venta_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$marca -> marca_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$capacidad -> capacidad_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$cpi -> cpi_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="Añade una descripción" maxlength="90" value="'.$capcidad_instalada -> capacidad_instalada_etp3.'" readonly>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                    <p class="alert alert-warinig"><center><u><strong>IMPORTANTE:</strong> A continuación se muestran las fotografías guardadas.</u></p></center><br>

                    <label><strong>Foto 1 <i>(Opcional | Esta será la que se muestra en el PDF)</i>:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $foto_1) {
                            if ($foto_1 -> foto_1_etp3 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_1 -> foto_1_etp3.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_2 -> foto_2_etp3 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_2 -> foto_2_etp3.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_3 -> foto_3_etp3 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_3 -> foto_3_etp3.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
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
                            if ($foto_4 -> foto_4_etp3 != "") {
                                echo '<center><img class="img-responsive animated tada" width="20%" height="20%" alt="Imagen de apoyo" readonly style="border: 1px solid black;" src="'.$foto_4 -> foto_4_etp3.'"/></center><br>';
                              } else {
                                echo "<h8><i>--- No se encontró imagen adjunta ---</i></h8><br><br>";
                              }
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>

                    <label><strong>Comentarios <i>(Opcional)</i>:</strong></label>
                    <?php
                    if ($q_lev1 -> rowCount() > 0) {
                        foreach ($levantamientos_uno as $comentarios) {
                            echo '<input type="text" class="form-control" placeholder="No hay comentarios" maxlength="90" value="'.$comentarios -> comentarios_etp3.'" readonly><br>';
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
                            echo '<input type="text" class="form-control" placeholder="No hay observaciones" maxlength="90" value="'.$observaciones -> observaciones_etp3.'" readonly><br>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay empresas a modificar</h3></strong></center></div>';
                        echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                        exit();
                    }
                    ?>
			</div><br><br>

    </div>
        
    </body>
    </html>

	<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>