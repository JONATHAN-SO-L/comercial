<?php session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) { 
$uma = $_SERVER['QUERY_STRING']; ?>

<!DOCTYPE html>
<head>
    <?php require '../../../assets/navs/nav_modify.php'; ?>
    <link rel="stylesheet" type="text/css" href="../../../css/company.css">
</head>
<body><br><br><br>

<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="page-header"><br>
            <img class="empresa_pic" src="../../../assets/img/opciones.png" style="margin-right: 15px;"><h1 class="animated lightSpeedIn">Etapas para UMA: <i><u><?php echo $uma; ?></u></i></h1><br>
        </div>
    </div>
</div>

<div class="card">
    <div class="card bg-danger text-white"><br></div>
    </div>
</div>

<div class="container">
    <center>
        <form class="border border-danger form-control" method="POST" action="../../functions/add/insert_tape.php?<?php echo $uma; ?>" >
            <label for="num_etapas"><strong>Indica el número de etapas con las que deseas trabajar</strong> <i><u>(Se permiten hasta 8)</u></i></label><br><br>
            <input type="number" name="num_etapas" min="3" max="8"><br><br>
            <input type="submit" name="iniciar_levantamiento" value="Iniciar" class="btn btn-success">
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