<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

    /********************************
    OBTENCIÓN DE DATOS PARA SOLICITUD
    ********************************/
    $uma = $_SERVER['QUERY_STRING']; // UMA del Levantamiento
    $solicitante = $_SESSION['nombre'];
    $aprobador = $_SESSION['squad'];
    $autorizacion = "Pendiente";

    $fecha_sol = date('Y-m-d H:i:s'); // Fecha de modificación
    $fecha_solicitud = strftime('%d%b%y');// Fecha de modificación seteada para el SGC

    require '../../conex.php';

    $solicitud = $con->prepare("UPDATE levantamientos SET sol_mod = :solicitante, mod_auth = :autorizacion, fecha_solicitud = :fecha_solicitud WHERE uma = :uma");
    $solicitud->bindValue(':solicitante', $solicitante);
    $solicitud->bindValue(':autorizacion', $autorizacion);
    $solicitud->bindValue(':fecha_solicitud', $fecha_solicitud);
    $solicitud->bindValue(':uma', $uma);
    $solicitud->execute();

    if ($solicitud) {
        echo '<script>alert("Solicitud realizada, en cuanto el Jefe Directo la aprueba se te hará saber por correo electrónico")</script>';
        /***************************
        ENVÍO DE CORREO DE SOLICITUD
        ***************************/
        $cabecera = "From: Levantamientos <tecnicos@veco.lat>";
        $asunto = "Solicitud de Aprobación para UMA: ".$uma." -> ".$fecha_solicitud."";
        $destinatario = $aprobador;
        $mensaje = utf8_decode("Estimado(a) Jefe ".$aprobador."\r\n
        El vendedor ".$solicitante." solicita su aprobación para modificar el levantamiento de la UMA: ".$uma."\r\n\r\n
        Puede validarlo a través de su panel de aprobaciones.\r\n\r\n
        Saludos Cordiales\r\n Área de Sistemas\r\n tecnicos@veco.lat");
        mail($destinatario, $asunto, $mensaje, $cabecera);

        echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">';
    } else {
        echo '<script>alert("No se logró realizar la solicitud exitosamente, por favor inténtalo de nuevo")</script>';
        echo '<meta http-equiv="refresh" content="0;../../../admin/views/jefatura/index.php">';
    }
} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}

?>