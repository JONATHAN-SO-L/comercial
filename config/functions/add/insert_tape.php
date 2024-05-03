<?php 
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    require '../../conex.php';
    $uma = $_SERVER['QUERY_STRING'];

    if (isset($_POST['iniciar_levantamiento'])) {

        $etapas = $_POST['num_etapas'];

        if ($etapas > 8) {
            echo '<script>alert("Ocurrió un error intentándo guardar las etapas del levantamiento, las registradas superan las permitidas, por favor inténtalo de nuevo")</script>';
            echo '<meta http-equiv="refresh" content="0;../../permissions/selector/etp.php?'.$uma.'">';
        } else {
            $insert_tape = $con->prepare("UPDATE levantamientos SET etapas = :etapas WHERE uma = :uma");
            $insert_tape->bindValue(':etapas', $etapas);
            $insert_tape->bindValue(':uma', $uma);
            $insert_tape->execute();

            if ($insert_tape) {
            //echo '<script>alert("Se registraron exitosamente las etapas que tendrá la UMA: '.$uma.'")</script>';
            echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/sel_tape.php?'.$uma.'">';
            } else {
            echo '<script>alert("Ocurrió un error intentándo guardar las etapas del levantamiento, por favor inténtalo de nuevo")</script>';
            echo '<meta http-equiv="refresh" content="0;../../permissions/selector/etp.php?'.$uma.'">';
            }
        }

    } else {
        echo '<script>alert("No se detectó el accionador de eventos, por favor inténtalo de nuevo")</script>';
        echo '<meta http-equiv="refresh" content="0;../../permissions/selector/etp.php?'.$uma.'">';
    }

} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>