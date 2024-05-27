<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

    if (isset($_POST['guardar_modelo'])) {
        $uma = $_SESSION['uma'];
        $etapa = $_POST['etapa'];
        $ciclo = $_POST['ciclo'];
        $modelo = $_POST['modelo'];
    
        require '../../conex.php';
    
        //Actualizar registro del modelo
        switch ($etapa) {
            case '1':
            
            switch ($ciclo) {
                case '1':
                    $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp1 = ? WHERE uma = ?");
                    $up_model->execute([$modelo, $uma]);

                    if ($up_model) {
                        echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    } else {
                        echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    }
                break;

                case '2':
                    $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp1_2 = ? WHERE uma = ?");
                    $up_model->execute([$modelo, $uma]);

                    if ($up_model) {
                        echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    } else {
                        echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    }
                break;
                
                case '3':
                    $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp1_3 = ? WHERE uma = ?");
                    $up_model->execute([$modelo, $uma]);

                    if ($up_model) {
                        echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    } else {
                        echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    }
                break;

                case '4':
                    $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp1_4 = ? WHERE uma = ?");
                    $up_model->execute([$modelo, $uma]);

                    if ($up_model) {
                        echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    } else {
                        echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    }
                break;

                case '5':
                    $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp1_5 = ? WHERE uma = ?");
                    $up_model->execute([$modelo, $uma]);

                    if ($up_model) {
                        echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    } else {
                        echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    }
                break;

                case '6':
                    $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp1_6 = ? WHERE uma = ?");
                    $up_model->execute([$modelo, $uma]);

                    if ($up_model) {
                        echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    } else {
                        echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                        echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp1.php?'.$uma.'">';
                    }
                break;
            }
    
            break;
    
            case '2':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp2 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp2.php?'.$uma.'">';
            }
            break;
    
            case '3':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp3 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp3.php?'.$uma.'">';
            }
            break;
    
            case '4':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp4 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp4.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp4.php?'.$uma.'">';
            }
            break;
    
            case '5':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp5 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp5.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp5.php?'.$uma.'">';
            }
            break;
    
            case '6':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp6 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp6.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp6.php?'.$uma.'">';
            }
            break;
    
            case '7':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp7 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
            }
            break;
    
            case '8':
            $up_model = $con->prepare("UPDATE levantamientos SET modelo_etp8 = ? WHERE uma = ?");
            $up_model->execute([$modelo, $uma]);
            
            if ($up_model) {
                echo '<script>alert("Se guardó correctamente el modelo seleccionado: '.$modelo.'")</script>';
                echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp8.php?'.$uma.'">';
            } else {
                echo '<script>alert("Ocurrió un problema al intentar guardar el modelo seleccioanda: '.$modelo.'. Por favor inténtalo de nuevo")</script>';
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