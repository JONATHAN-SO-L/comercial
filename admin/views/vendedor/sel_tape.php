<?php 
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    require '../../../config/conex.php';

    $uma = $_SERVER['QUERY_STRING'];

    /*******************************
    Validación de etapas registradas
    *******************************/
    $q_etapa = $con->prepare("SELECT etapas FROM levantamientos WHERE uma = :uma");
    $q_etapa->bindValue(':uma', $uma);
    $q_etapa->setFetchMode(PDO::FETCH_OBJ);
    $q_etapa->execute();

    $show_etapa = $q_etapa->fetchAll();

    if ($q_etapa -> rowCount() > 0) {
        foreach ($show_etapa as $rel) {
            $etapas = $rel -> etapas;
            $_SESSION['etapas'] = $etapas;
            $etapas = $_SESSION['etapas'];
        }
    } else {
    echo '<br><div class="alert alert-danger container"><center><strong><h3>No existen etapas registradas</h3></strong></center></div>';
    echo '<script>console.log("ERROR 100: Fallo al mostrar datos")</script>';
    exit();
    }

?>

<!DOCTYPE html>
<head>
    <?php require '../../../assets/navs/nav_vendedor.php'; ?>
    <link rel="stylesheet" type="text/css" href="../../../css/company.css">
</head>
<body><br>

<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="page-header"><br>
            <img class="empresa_pic" src="../../../assets/img/etapas.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Elige la etapa para la UMA: <i><u><?php echo $uma; ?></u></i></h1><br>
        </div>
    </div>
</div>

<div class="card">
    <div class="card bg-primary text-white"><center><strong>Elige la etapa con la que deseas iniciar</strong></center></div>
    </div>
</div>

<div class="container">
    <center>
        <form class="border border-primary form-control">
            <?php
            /******************************
            SOLO SE PERMITEN HASTA 8 ETAPAS
            ******************************/
                switch ($etapas) {
                case '1':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                    ';
                break;

                case '2':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                    ';
                break;

                case '3':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp3.php?'.$uma.'" class="btn btn-info"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 3"> Etapa 3</a>
                        </div>
                    ';
                break;

                case '4':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp3.php?'.$uma.'" class="btn btn-info"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 3"> Etapa 3</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp4.php?'.$uma.'" class="btn btn-warning"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 4"> Etapa 4</a>
                        </div>
                    ';
                break;

                case '5':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp3.php?'.$uma.'" class="btn btn-info"><img  style="height: 20px; border-radius: 50px; border: solid;" src="../../../assets/img/agregar.png" alt="Etapa 3"> Etapa 3</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp4.php?'.$uma.'" class="btn btn-warning"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 4"> Etapa 4</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp5.php?'.$uma.'" class="btn btn-danger"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 5"> Etapa 5</a>
                        </div>
                    ';
                break;

                case '6':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp3.php?'.$uma.'" class="btn btn-info"><img  style="height: 20px; border-radius: 50px; border: solid;" src="../../../assets/img/agregar.png" alt="Etapa 3"> Etapa 3</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp4.php?'.$uma.'" class="btn btn-warning"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 4"> Etapa 4</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp5.php?'.$uma.'" class="btn btn-danger"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 5"> Etapa 5</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp6.php?'.$uma.'" class="btn btn-secondary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 6"> Etapa 6</a>
                        </div>
                    ';
                break;

                case '7':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp3.php?'.$uma.'" class="btn btn-info"><img  style="height: 20px; border-radius: 50px; border: solid;" src="../../../assets/img/agregar.png" alt="Etapa 3"> Etapa 3</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp4.php?'.$uma.'" class="btn btn-warning"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 4"> Etapa 4</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp5.php?'.$uma.'" class="btn btn-danger"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 5"> Etapa 5</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp6.php?'.$uma.'" class="btn btn-secondary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 6"> Etapa 6</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp7.php?'.$uma.'" class="btn btn-dark"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 7"> Etapa 7</a>
                        </div>
                    ';
                break;

                case '8':
                    echo '
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp1.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 1"> Etapa 1</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp2.php?'.$uma.'" class="btn btn-success"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 2"> Etapa 2</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp3.php?'.$uma.'" class="btn btn-info"><img  style="height: 20px; border-radius: 50px; border: solid;" src="../../../assets/img/agregar.png" alt="Etapa 3"> Etapa 3</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp4.php?'.$uma.'" class="btn btn-warning"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 4"> Etapa 4</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp5.php?'.$uma.'" class="btn btn-danger"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 5"> Etapa 5</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp6.php?'.$uma.'" class="btn btn-secondary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 6"> Etapa 6</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp7.php?'.$uma.'" class="btn btn-dark"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 7"> Etapa 7</a>
                        </div>
                        <div class="btn-group">
                        <a href="../../../config/permissions/selector/filters_etp8.php?'.$uma.'" class="btn btn-primary"><img style="height: 20px; border-radius: 50px; border: solid;"  src="../../../assets/img/agregar.png" alt="Etapa 8"> Etapa 8</a>
                        </div>
                    ';
                break;

                default:
                    echo '<br><div class="alert alert-danger container"><center><strong><h3>No existen etapas registradas</h3></strong></center></div>';
                    echo '<script>console.log("ERROR 100: Fallo al mostrar datos")</script>';
                    exit();
                break;
                }
            ?>
        </form>
    </center>
</div>

</body>
</html>

<?php include '../../../assets/subir.php';
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>