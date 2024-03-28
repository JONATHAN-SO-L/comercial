<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    
    require '../../conex.php';
    
    $uma = $_SERVER['QUERY_STRING'];
    $vendedor = $_SESSION['nombre'];
?>

<!DOCTYPE html>
    <html>
    <head>
    <?php include '../../../assets/navs/links.php';
    include '../../../assets/navs/nav_modify.php';?>
    <link rel="stylesheet" type="text/css" href="../../../css/company.css">
    </head>
    <body><br><br>

    <?php
    /**********************************************************************
    Validación de ausencia de autorización en modificación de levantamiento
    **********************************************************************/
    $s_auth = $con->prepare("SELECT sol_mod, mod_auth FROM levantamientos WHERE vendedor = :vendedor AND uma = :uma");
    $s_auth->bindValue(':vendedor', $vendedor);
    $s_auth->bindValue(':uma', $uma);
    $s_auth->setFetchMode(PDO::FETCH_OBJ);
    $s_auth->execute();

    $f_auth = $s_auth->fetchAll();

    if ($s_auth -> rowCount() > 0) {
        foreach ($f_auth as $item) {
            $solicitud = $item -> sol_mod;
            $autorizacion = $item -> mod_auth;
        }

        if ($solicitud == '' && $autorizacion == '') {
            echo '
            <!----------------------------------------
            SOLICITUD DE MODIFICACIÓN DE LEVANTAMIENTO
            ----------------------------------------->
            <div class="container col-sm-8 panel panel-body"><br><br>
                <img class="empresa_pic" src="../../../assets/img/usuario.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Solictud para Editar el Levantamiento de la UMA: <strong>'.$uma.'</strong></h3><br>
                <div class="card">
                <div class="card bg-danger text-white"><center><h6><strong><br></strong></h6></center></div>
                </div>
            
                <form method="POST" action="../../../config/functions/request/mod_lev.php?'.$uma.'" class="border border-danger form-control">
            
                <center>
                    <h4 class="modal-title">Solicitud para editar UMA: '.$uma.'</h4><br>
            
                    <div class="modal-body">
                    <strong>¿Quieres solicitar a tu jefe directo el permiso para modificar?</strong><br>
                        <i>En caso de ser aprobado, te llegará la notificación por correo</i><br>
                    </div>
                </center><br>
            
                <center>
                    <input type="submit" class="btn btn-success" name="solcitar_aprobacion" value="Solicitar aprobación">
                    <a class="btn btn-danger" href="../../../admin/views/vendedor/index.php"> No, volver al Inicio</a>
                </center><br>
                </form>
                </div>
                <div><br>
            </div>';
        } elseif ($solicitud != '' && $autorizacion == 'Pendiente') {
            echo '
            <!----------------------------------------
            MENSAJE DE APROBACIÓN PENDIENTE
            ----------------------------------------->
            <div class="container col-sm-8 panel panel-body"><br><br>
                <img class="empresa_pic" src="../../../assets/img/usuario.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Solictud para Editar el Levantamiento de la UMA: <strong>'.$uma.'</strong></h3><br>
                <div class="card">
                <div class="card bg-danger text-white"><center><h6><strong><br></strong></h6></center></div>
                </div>
            
                <form class="border border-danger form-control">
            
                <center>
                    <h4 class="modal-title">En Espera de Aprobación UMA: '.$uma.'</h4><br>
            
                    <div class="modal-body">
                    La aprobación está en proceso por parte del Jefe Directo, en cuanto esté aprobado se te hará llegar por correo<br><br>
                    <a class="btn btn-success" href="../../../admin/views/vendedor/index.php"> Enterado, volver al Inicio</a>
                    </div>
                </center><br>
                
                </div>
                <div><br>
            </div>';
        } else {
            echo '<meta http-equiv="refresh" content="0;../../../config/permissions/mod/mod_lev.php?'.$uma.'">';
        }

    } else {
        echo '<script>console.log("No hay autorizaciones ni solicitudes")</script>';
    }
    ?>
 
    </body>
    </html>
    
    <?php include '../../../assets/subir.php';
    
} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>
<script type="text/javascript" src="../../../js/subir.js"></script>