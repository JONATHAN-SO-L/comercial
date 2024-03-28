<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

    /********************************
    OBTENCIÓN DE DATOS PARA APROBACIÓN
    ********************************/
    $uma = $_SERVER['QUERY_STRING']; // UMA del Levantamiento
    $aprobador = $_SESSION['nombre'];
    $solicitante = NULL;
    $fecha_solicitud = NULL;
    $fecha_denied = date('Y-m-d H:i:s');

    require '../../conex.php';

    $aprobacion = $con->prepare("UPDATE levantamientos SET sol_mod = :solicitante, fecha_solicitud = :fecha_solicitud WHERE uma = :uma");
    $aprobacion->bindValue(':solicitante', $solicitante);
    $aprobacion->bindValue(':fecha_solicitud', $fecha_solicitud);
    $aprobacion->bindValue(':uma', $uma);
    $aprobacion->execute();

    if ($aprobacion) {

        // Busqueda de vendedor
        $s_seller = $con->prepare("SELECT vendedor FROM levantamientos WHERE uma = :uma");
        $s_seller->bindValue(':uma', $uma);
        $s_seller->setFetchMode(PDO::FETCH_OBJ);
        $s_seller->execute();

        $f_seller = $s_seller -> fetchAll();

        if ($s_seller -> rowCount() > 0) {

            foreach ($f_seller as $item) {
                $vendedor = $item -> vendedor;
            }
            
            $get_mail = $con->prepare("SELECT nombre, correo, usuario FROM usuario_lev WHERE nombre = :vendedor");
            $get_mail->bindValue(':vendedor', $vendedor);
            $get_mail->setFetchMode(PDO::FETCH_OBJ);
            $get_mail->execute();

            $mail_obtained = $get_mail -> fetchAll();

            if ($get_mail -> rowCount() > 0) {

                foreach ($mail_obtained as $result) {
                    $nombre_vendedor = $result -> nombre;
                    $correo_vendedor = $result -> correo;
                    $usuario_vendedor = $result -> usuario; 
                }

            } else {
                echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay vendedores registrados para esta UMA</h3></strong></center></div>';
                echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
                exit();
            }

        } else {
            echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay vendedores registrados para esta UMA</h3></strong></center></div>';
            echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
            exit();
        }

        echo '<script>alert("Rechazo realizado, llegará por correo electrónico la notificación al vendedor")</script>';
        /****************************
        ENVÍO DE CORREO DE RECHAZO
        ****************************/
        $cabecera = "From: Levantamientos <tecnicos@veco.lat>";
        $asunto = "Solicitud rechazada de modificación para UMA: ".$uma." -> ".$fecha_denied."";
        $destinatario = $correo_vendedor;
        $mensaje = utf8_decode("Estimado(a) Vendedor ".$nombre_vendedor."\r\n
        Su Jefe Directo ".$solicitante." rechazó su solicitud para modificar el levantamiento de la UMA: ".$uma."\r\n\r\n
        Puede validarlo a través de su panel de levantamientos.\r\n\r\n
        Saludos Cordiales\r\n Área de Sistemas\r\n tecnicos@veco.lat");
        mail($destinatario, $asunto, $mensaje, $cabecera);

        echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/aprobaciones.php">';
    } else {
        echo '<script>alert("No se logró aprobar correctamente, inténtalo de nuevo por favor")</script>';
        echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}

?>