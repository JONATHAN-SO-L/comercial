<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { 
    switch ($_SESSION['tipo']) {
        case 'J':
        echo '<meta http-equiv="refresh" content="0;../jefatura/index.php">'; 
        break;

        case 'V':
        echo '<meta http-equiv="refresh" content="0;../vendedor/index.php">'; 
        break;
    }?>

    <!DOCTYPE html>
    <html>
    <head>
        <?php require '../../../assets/navs/nav_gerente.php'; ?>
        <link rel="stylesheet" type="text/css" href="../../../css/dashboard_vendedor.css">
        <link rel="stylesheet" type="text/css" href="../../../css/company.css">
    </head>
    <body><br><br>
        <a href="jefes.php" class="btn btn-primary nuevo_lev"><img class="agregar" src="../../../assets/img/agregar.png"> <strong>Nuevo Jefe</strong></a>

        <div class="container" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header2"><br>
                        <img class="empresa_pic" src="../../../assets/img/jefes.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Jefes del Área Comercial</h1>
                    </div>
                </div>
            </div>
        </div><br>

    <!------------------------------
        Tabla de datos | Dashboard
        ------------------------------->
        <?php 
        require '../../../config/conex.php';

        //Preparación de consulta
        $data = $con->prepare("SELECT * FROM usuario_lev WHERE tipo_usuario = 'J' ORDER BY nombre ASC");
        $data->setFetchMode(PDO::FETCH_OBJ);
        $data->execute();

        $show_data = $data->fetchAll();

        if ($data -> rowCount() > 0) {
            echo "<div class='container table-responsive'>     
            <table class='table table-striped table-hover table-bordered'>
            <thead class='table-primary'>
            <tr>
            <th>Acción</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Área</th>
            </tr>
            </thead>";
            foreach ($show_data as $value) {
                echo 
                "<tbody>
                <tr>
                <th><a href='../../../config/permissions/drop/drop_boss_admin.php?".$value -> usuario."' class='btn btn-sm btn-danger' title='Eliminar jefe'><img class='edit' src='../../../assets/img/borrar.png'></a></td>
                <th>".$value -> usuario."</th>
                <th>".$value -> nombre."</th>
                <th>".$value -> correo."</th>
                <th>".$value -> area."</th>
                </tr>
                </tbody>";
            }
            echo "</table>
            </div>";
        } else {
            echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay jefes registrados</h3></strong></center></div>';
            echo '<script>console.log("ERROR 100: Fallo al mostrar datos, no hay datos")</script>';
            exit();
        } ?>

    </body>
    </html>

    <?php include '../../../assets/subir.php'; 
} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">'; 
}
?>
<script type="text/javascript" src="../../../js/subir.js"></script>