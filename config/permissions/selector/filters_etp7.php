<?php session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { 
$uma = $_SERVER['QUERY_STRING'];

/******************************************
Validación de existencia de filtros y etapa
******************************************/
require '../../conex.php';
// $s_ -> search
$s_tape_fil = $con->prepare("SELECT etapa_etp7, filtros_etp7 FROM levantamientos WHERE uma = :uma");
$s_tape_fil->bindValue(':uma', $uma);
$s_tape_fil->setFetchMode(PDO::FETCH_OBJ);
$s_tape_fil->execute();

//$f_ _> found
$f_tape_fil = $s_tape_fil->fetchAll();

foreach ($f_tape_fil as $item) {
    $f_tape = $item -> etapa_etp7;
    $f_fil = $item -> filtros_etp7;
}

if ($f_tape && $f_fil != '') {
    echo '<meta http-equiv="refresh" content="0;../../../admin/views/vendedor/levantamiento_etp7.php?'.$uma.'">';
} else { ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php require '../../../assets/navs/nav_modify.php'; ?>
    <link rel="stylesheet" type="text/css" href="../../../css/company.css">
</head>
<body><br><br><br>

<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="page-header"><br>
            <img class="empresa_pic" src="../../../assets/img/filtro.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">ETAPA 7 | Filtros para UMA: <i><u><?php echo $uma; ?></u></i></h1><br>
        </div>
    </div>
</div>

<div class="card">
    <div class="card bg-primary text-white"><br></div>
    </div>
</div>

<div class="container">
    <center>
        <form class="border border-primary form-control" method="POST" action="../../functions/add/insert_filters.php?<?php echo $uma; ?>" >
            <label for="num_filtros"><strong>Indica el número de códigos de filtros con los que deseas trabajar</strong> <i><u>(Se permiten hasta 6)</u></i></label><br><br>
            <input type="number" name="num_filtros" min="1" max="6"><br><br>
            <input type="hidden" name="etapa" value=7>
            <input type="submit" name="iniciar_levantamiento" value="Iniciar" class="btn btn-success">
        </form>       
    </center>
</div>
    
</body>
</html>

<?php include '../../../assets/subir.php';
}
} else {
	echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>