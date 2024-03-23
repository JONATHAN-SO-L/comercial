<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {

    /********************************
    OBTENCIÓN DE DATOS PARA SOLICITUD
    ********************************/
    $uma = $_SERVER['QUERY_STRING']; // UMA del Levantamiento
    $solicitante = $_SESSION['nombre'];

    require '../../conex.php';

    $solicitud = $con->prepare("UPDATE levantamientos SET sol_mod = :solicitante WHERE uma = :uma");
    $solicitud->bindValue(':solicitante', $solicitante);
    $solicitud->bindValue(':uma', $uma);
    $solicitud->execute();

    if ($solicitud) {
        # code...
    } else {
        # code...
    }

} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}

?>