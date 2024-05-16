<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    if (isset($_POST['guardar_familia'])) {
        $uma = $_SESSION['uma'];
        $etapa = $_POST['etapa'];
        $familia = $_POST['familia'];
    
        require '../../conex.php';
    
        //Actualizar registro de la familia
        switch ($etapa) {
            case '1':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp1 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
            }
    
            break;
    
            case '2':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp2 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
            }
            break;
    
            case '3':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp3 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
            }
            break;
    
            case '4':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp4 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp4.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp4.php?'.$uma.'">';
            }
            break;
    
            case '5':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp5 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp5.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp5.php?'.$uma.'">';
            }
            break;
    
            case '6':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp6 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp6.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp6.php?'.$uma.'">';
            }
            break;
    
            case '7':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp7 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
            }
            break;
    
            case '8':
            $up_fam = $con->prepare("UPDATE levantamientos SET familia_etp8 = ? WHERE uma = ?");
            $up_fam->execute([$familia, $uma]);
            
            if ($up_fam) {
                echo '<script>alert("Se guardó correctamente la familia seleccionada: '.$familia.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp8.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar la familia seleccioanda: '.$familia.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp8.php?'.$uma.'">';
            }
            break;
        }
    
    } else {
            echo '<script>alert("Ocurrió un problema, no se detectó el accionador. Por favor inténtalo de nuevo")</script>';
            switch ($etapa) {
                case '1':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                break;
    
                case '2':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
                break;
    
                case '3':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
                break;
    
                case '4':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp4.php?'.$uma.'">';
                break;
    
                case '5':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp5.php?'.$uma.'">';
                break;
    
                case '6':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp6.php?'.$uma.'">';
                break;
    
                case '7':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
                break;
    
                case '8':
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp8.php?'.$uma.'">';
                break;
            }
        }
} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>