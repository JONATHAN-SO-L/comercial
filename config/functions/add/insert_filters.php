<?php 
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    require '../../conex.php';
    $uma = $_SERVER['QUERY_STRING'];
    //$etapas = $_SESSION['etapas'];

    if (isset($_POST['iniciar_levantamiento'])) {

        $filtros = $_POST['num_filtros'];
        $etapa = $_POST['etapa'];

        switch ($etapa) {
            case '1':
                $insert_filters_etp1 = $con->prepare("UPDATE levantamientos SET etapa_etp1 = :etapa, filtros_etp1 = :filtros WHERE uma = :uma");
                $insert_filters_etp1->bindValue(':etapa', $etapa);
                $insert_filters_etp1->bindValue(':filtros', $filtros);
                $insert_filters_etp1->bindValue(':uma', $uma);
                $insert_filters_etp1->execute();
        
                if ($insert_filters_etp1) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp1.php?'.$uma.'">';
                }
            break;

            case '2':
                $insert_filters_etp2 = $con->prepare("UPDATE levantamientos SET etapa_etp2 = :etapa, filtros_etp2 = :filtros WHERE uma = :uma");
                $insert_filters_etp2->bindValue(':etapa', $etapa);
                $insert_filters_etp2->bindValue(':filtros', $filtros);
                $insert_filters_etp2->bindValue(':uma', $uma);
                $insert_filters_etp2->execute();
        
                if ($insert_filters_etp2) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp2.php?'.$uma.'">';
                }
            break;

            case '3':
                $insert_filters_etp3 = $con->prepare("UPDATE levantamientos SET etapa_etp3 = :etapa, filtros_etp3 = :filtros WHERE uma = :uma");
                $insert_filters_etp3->bindValue(':etapa', $etapa);
                $insert_filters_etp3->bindValue(':filtros', $filtros);
                $insert_filters_etp3->bindValue(':uma', $uma);
                $insert_filters_etp3->execute();
        
                if ($insert_filters_etp3) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp3.php?'.$uma.'">';
                }
            break;

            case '4':
                $insert_filters_etp4 = $con->prepare("UPDATE levantamientos SET etapa_etp4 = :etapa, filtros_etp4 = :filtros WHERE uma = :uma");
                $insert_filters_etp4->bindValue(':etapa', $etapa);
                $insert_filters_etp4->bindValue(':filtros', $filtros);
                $insert_filters_etp4->bindValue(':uma', $uma);
                $insert_filters_etp4->execute();
        
                if ($insert_filters_etp4) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp4.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp4.php?'.$uma.'">';
                }
            break;

            case '5':
                $insert_filters_etp5 = $con->prepare("UPDATE levantamientos SET etapa_etp5 = :etapa, filtros_etp5 = :filtros WHERE uma = :uma");
                $insert_filters_etp5->bindValue(':etapa', $etapa);
                $insert_filters_etp5->bindValue(':filtros', $filtros);
                $insert_filters_etp5->bindValue(':uma', $uma);
                $insert_filters_etp5->execute();
        
                if ($insert_filters_etp5) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp5.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp5.php?'.$uma.'">';
                }
            break;

            case '6':
                $insert_filters_etp6 = $con->prepare("UPDATE levantamientos SET etapa_etp6 = :etapa, filtros_etp6 = :filtros WHERE uma = :uma");
                $insert_filters_etp6->bindValue(':etapa', $etapa);
                $insert_filters_etp6->bindValue(':filtros', $filtros);
                $insert_filters_etp6->bindValue(':uma', $uma);
                $insert_filters_etp6->execute();
        
                if ($insert_filters_etp6) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp6.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp6.php?'.$uma.'">';
                }
            break;

            case '7':
                $insert_filters_etp7 = $con->prepare("UPDATE levantamientos SET etapa_etp7 = :etapa, filtros_etp7 = :filtros WHERE uma = :uma");
                $insert_filters_etp7->bindValue(':etapa', $etapa);
                $insert_filters_etp7->bindValue(':filtros', $filtros);
                $insert_filters_etp7->bindValue(':uma', $uma);
                $insert_filters_etp7->execute();
        
                if ($insert_filters_etp7) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp7.php?'.$uma.'">';
                }
            break;

            case '8':
                $insert_filters_etp8 = $con->prepare("UPDATE levantamientos SET etapa_etp8 = :etapa, filtros_etp8 = :filtros WHERE uma = :uma");
                $insert_filters_etp8->bindValue(':etapa', $etapa);
                $insert_filters_etp8->bindValue(':filtros', $filtros);
                $insert_filters_etp8->bindValue(':uma', $uma);
                $insert_filters_etp8->execute();
        
                if ($insert_filters_etp8) {
                    echo '<script>alert("Se registraron exitosamente los filtros que tendrá la UMA: "'.$uma.'")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp8.php?'.$uma.'">';
                } else {
                    echo '<script>alert("Ocurrió un error intentándo guardar los filtros del levantamiento, por favor inténtalo de nuevo")</script>';
                    echo '<meta http-equiv="refresh" content="0;../../permissions/selector/filters_etp8.php?'.$uma.'">';
                }
            break;

            default:
                echo '<script>alert("Ocurrió un error al intentar guardar los datos de la etapa seleccioanda, reintentando")</script>';
                echo '<meta http-equiv="refresh" content="0;../../permissions/selector/insert_filters.php?'.$uma.'">';
            break;
        }

    } else {
        echo '<script>alert("No se detectó el accionador de eventos, por favor inténtalo de nuevo")</script>';
        echo '<meta http-equiv="refresh" content="0;../../permissions/selector/insert_filters.php?'.$uma.'">';
    }

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>