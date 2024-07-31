<?php
/*
 * @author: Meraz Prudencio Griselda  
 * ghriz2811@gmail.com
 * @version: 08/2019 v1
 */
?>
<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin" ){ ?>

    <style>
        .page-header{
            display:none;
        }
        footer {
            display: none;
        }
        .fa-copyright:before {
            content: "\f1f9";
            display: none;
        }
    </style>

    <?php include "./inc/navbarsop.php"; 
    $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
    mysqli_set_charset($mysqli, "utf8");?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header2">
            <h1 class="animated lightSpeedIn">Tickets</h1>
            <span class="label label-danger">Sistemas</span>
            <p class="pull-right text-primary">
              <strong>
                  <?php include "./inc/timezone.php"; ?>
              </strong>
          </p>
      </div>
  </div>
</div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-2">
      <img src="./img/msj.png" alt="Image" class="img-responsive animated tada">
  </div>
  <div class="col-sm-10">
      <p class="lead text-info">Bienvenido <strong><?php echo $_SESSION['nombre_completo']; ?></strong>, aqui se muestran todos los Tickets, los cuales podrás modificar e imprimir.</p>
  </div>

  <!-- Buscador -------->
  <!-- Fechas -->
  <div>
    <form method="POST">
     <div class="pull-left">
        <input type="date" id="fecha1" name="fecha1">
        <input type="date" id="fecha2" name="fecha2">
        <input type="submit" id="fechas" name="fechas" value="Buscar" class="btn btn-success">
    </div>
</div>

<!-- Ticket, Usuario, Solucionador -->
<div class="pull-right col-sm-5">
    <input type="search" id="search" name="search" class="form-control" placeholder="Ingresa lo que desees buscar">
    <button type="submit" id="buscari" name="buscari" class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Técnico</button>
    <button type="submit" id="buscaru" name="buscaru" class="pull-right btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Usuario</button>
    <button type="submit" id="ticketc" name="ticketc" class="pull-right btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">Ticket</button>
</form>
</div>
<!-------------------->

</div>
</div><br>
<?php
if(isset($_POST['id_del'])){
    $id = MysqlQuery::RequestPost('id_del');
    if(MysqlQuery::Eliminar("ticket", "id='$id'")){
        echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center">Incidencias ELIMINADA</h4>
        <p class="text-center">
        La Incidencia fue eliminado del sistema con exito
        </p>
        </div>
        ';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
        <p class="text-center">
        No hemos podido eliminar la incidencia
        </p>
        </div>
        '; 
    }
}

$ubicacion= $_SESSION['ubi'];

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$regpagina = 20;
$ubicacion= $_SESSION['ubi'];
$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

/********************************************************************************************************************************
*                                 Buscar actividad de un Técnico en un rango de fechas determinado                              *
********************************************************************************************************************************/

if (isset($_POST['buscari']) && isset($_POST['search']) && isset($_POST['fecha1']) && isset($_POST['fecha2'])) {

    $tecnico = $_POST['search'];
    $fechaini = $_POST['fecha1'];
    $fechafin = $_POST['fecha2'];

    $consul_tec = "SELECT * FROM ticket WHERE ubicacion = '$ubicacion' AND observaciones LIKE '%$tecnico%' AND fecha_2 BETWEEN '$fechaini' AND '$fechafin'";

    $actividad_tec = mysqli_query($mysqli, $consul_tec);

    $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
    $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

    $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

    if(mysqli_num_rows($actividad_tec)>0): ?>

        <?php
        $query_num_show = "SELECT COUNT(*) FROM ticket WHERE ubicacion = '$ubicacion' AND observaciones LIKE '%$tecnico%' AND fecha_2 BETWEEN '$fechaini' AND '$fechafin'";
        $exec_num = mysqli_query($mysqli, $query_num_show);
        $array_num = mysqli_fetch_array($exec_num, MYSQLI_ASSOC);
        $show_num = $array_num['COUNT(*)'];
        ?>
  
</div>

<div class="container">
    <strong>Rango de fechas consultado: &nbsp;&nbsp;<span class="badge"><?php echo $fechaini; ?></span> - <span class="badge"><?php echo $fechafin; ?></span> para el Técnico: <span class="badge"><?php echo $tecnico; ?></span></strong><br>
    <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong><br>
</div>

<div class="col-sm-10">
    <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
</div>

<div class="container">
    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">Acción</th>
                <th class="text-center">Fecha</th>  
                <th class="text-center">Usuario</th>                                    
                <th class="text-center">Equipo</th>
                <th class="text-center">Serie</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Resolvió</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ct=$inicio+1;
            while ($row=mysqli_fetch_array($actividad_tec, MYSQLI_ASSOC)): 
                ?>
                <tr>
                    <td class="text-center">
                        <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="col-sm-10">
                            <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                        </div><br>
                        <h2 class="text-center">No se encontró actividad del técnico en el rango especificado</h2>
                    <?php endif; ?>
                </div>

            <?php }

/********************************************************************************************************************************
*                                   Buscar tickets por un rango de fechas determinado                                           *
********************************************************************************************************************************/
            if (isset($_POST['fechas']) && isset($_POST['fecha1']) && isset($_POST['fecha2'])) {

                $fecha_start = $_POST['fecha1'];
                $fecha_end = $_POST['fecha2'];

                $query_dates = "SELECT * FROM ticket WHERE fecha_2 BETWEEN '$fecha_start' AND '$fecha_end'";
                $date = mysqli_query($mysqli, $query_dates);

                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                if(mysqli_num_rows($date)>0): ?>

                    <?php
                    $query_num_show = "SELECT COUNT(*) FROM ticket WHERE fecha_2 BETWEEN '$fecha_start' AND '$fecha_end'";
                    $exec_num = mysqli_query($mysqli, $query_num_show);
                    $array_num = mysqli_fetch_array($exec_num, MYSQLI_ASSOC);
                    $show_num = $array_num['COUNT(*)'];
                    ?>
                    <div class="container">
                        <strong>Rango de fechas consultado:&nbsp;&nbsp;<span class="badge"><?php echo $fecha_start; ?></span> - <span class="badge"><?php echo $fecha_end; ?></span></strong><br>
                        <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong>
                    </div>

                    <div class="col-sm-10">
                        <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                    </div>

                    <div class="container">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Acción</th>
                                    <th class="text-center">Fecha</th>  
                                    <th class="text-center">Usuario</th>                                    
                                    <th class="text-center">Equipo</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Ubicación</th>
                                    <th class="text-center">Resolvió</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ct=$inicio+1;
                                while ($row=mysqli_fetch_array($date, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="col-sm-10">
                            <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                        </div><br>
                        <h2 class="text-center">No se encontraron tickets registrados en el rango especificado</h2>
                    <?php endif; ?>
                </div>

            <?php }

/********************************************************************************************************************************
*                                    Buscar todos los tickets que ha resulto un Técnico                                         *
********************************************************************************************************************************/

            elseif (isset($_POST['buscari'])) {

                    $tecnico = $_POST['buscari'];

                $consulta_ing = "SELECT * FROM ticket WHERE observaciones LIKE '%$tecnico%'";
                    $rel_ing = mysqli_query($mysqli, $consulta_ing);

                    $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                    $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                    $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                    if(mysqli_num_rows($rel_ing)>0):

                        $tecnico = $_POST['buscari'];
                        $query_num_show = "SELECT COUNT(*) FROM ticket WHERE observaciones LIKE '%$tecnico%'";
                        $exec_num = mysqli_query($mysqli, $query_num_show);
                        $array_num = mysqli_fetch_array($exec_num, MYSQLI_ASSOC);
                        $show_num = $array_num['COUNT(*)'];
                        ?>
                       <div class="container">
                        <strong>Todos los Tickets Resueltos por: &nbsp;<span class="badge"><?php echo $tecnico; ?></span></strong><br>
                        <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong>
                    </div>

                    <div class="col-sm-10">
                        <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                    </div>

                        <div class="container">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Acción</th>
                                        <th class="text-center">Fecha</th>  
                                        <th class="text-center">Usuario</th>                                    
                                        <th class="text-center">Equipo</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Ubicación</th>
                                        <th class="text-center">Resolvió</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ct=$inicio+1;
                                    while ($row=mysqli_fetch_array($rel_ing, MYSQLI_ASSOC)): 
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                            <!--form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form-->
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="col-sm-10">
                            <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                        </div><br>
                        <h2 class="text-center">No se encontraron tickets resueltos por el Técnico en el sistema</h2><br>
                    <?php endif;?>
                </div>

            <?php

            } elseif (isset($_POST['fecha1']) && isset($_POST['fecha2']) && isset($_POST['buscari'])) {

                $tecnico = $_POST['buscari'];
                $fecha_start = $_POST['fecha1'];
                $fecha_end = $_POST['fecha2'];

                $consulta_ing = "SELECT * FROM ticket WHERE fecha_2 BETWEEN $fecha_start AND $fecha_end AND observaciones LIKE '%$tecnico%'";
                    $rel_ing = mysqli_query($mysqli, $consulta_ing);

                    $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                    $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                    $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                    if(mysqli_num_rows($rel_ing)>0): ?>

                        <?php
                        $query_num_show = "SELECT COUNT(*) FROM ticket WHERE fecha_2 BETWEEN $fecha_start AND $fecha_end AND observaciones LIKE '%$tecnico%'";
                        $exec_num = mysqli_query($mysqli, $query_num_show);
                        $array_num = mysqli_fetch_array($exec_num, MYSQLI_ASSOC);
                        $show_num = $array_num['COUNT(*)'];
                        ?>
                       <div class="container">
                        <strong>Todos los Tickets Resuelto por: &nbsp;<span class="badge"><?php echo $tecnico; ?></span></strong><br>
                        <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong>
                    </div>

                    <div class="col-sm-10">
                        <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                    </div>

                        <div class="container">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Acción</th>
                                        <th class="text-center">Fecha</th>  
                                        <th class="text-center">Usuario</th>                                    
                                        <th class="text-center">Equipo</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Ubicación</th>
                                        <th class="text-center">Resolvió</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ct=$inicio+1;
                                    while ($row=mysqli_fetch_array($rel_ing, MYSQLI_ASSOC)): 
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                            <!--form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form-->
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="col-sm-10">
                            <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                        </div><br>
                        <h2 class="text-center">No se encontraron tickets resueltos por el Técnico en el sistema</h2><br>
                    <?php endif;?>
                </div>

            <?php }

/********************************************************************************************************************************
*                          Buscar todos los tickets que ha resulto un Técnico en un rango de fechas                             *
********************************************************************************************************************************/



/********************************************************************************************************************************
*                                          Condicional para buscar en distintos casos                                           *
********************************************************************************************************************************/

            elseif (isset($_POST['search'])) {

                $word = $_POST['search'];

                switch ($word != "") {

/********************************************************************************************************************************
*                                    Buscar todos los tickets que ha levantado un Usuario                                       *
********************************************************************************************************************************/

                case isset($_POST['buscaru']):

                $consulta_user = "SELECT * FROM ticket WHERE nombre_usuario LIKE '%$word%'";
                $rel_user = mysqli_query($mysqli, $consulta_user);

                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                if(mysqli_num_rows($rel_user)>0): ?>

                    <?php
                    $query_num_show = "SELECT COUNT(*) FROM ticket WHERE nombre_usuario LIKE '%$word%'";
                    $exec_num = mysqli_query($mysqli, $query_num_show);
                    $array_num = mysqli_fetch_array($exec_num, MYSQLI_ASSOC);
                    $show_num = $array_num['COUNT(*)'];
                    ?>
                    <div class="container">
                        <strong>Tickets Consultados del Usuario: &nbsp;<span class="badge"><?php echo $word; ?></span></strong><br>
                        <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong>
                    </div>

                    <div class="col-sm-10">
                        <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                    </div>

                    <div class="container">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Acción</th>
                                    <th class="text-center">Fecha</th>  
                                    <th class="text-center">Usuario</th>                                    
                                    <th class="text-center">Equipo</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Ubicación</th>
                                    <th class="text-center">Resolvió</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ct=$inicio+1;
                                while ($row=mysqli_fetch_array($rel_user, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="col-sm-10">
                            <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                        </div><br>
                        <h2 class="text-center">No se encontraron tickets registrados en el sistema</h2>
                    <?php endif; ?>
                </div>

                <?php break;

/********************************************************************************************************************************
*                                    Buscar un ticket por número de serie o palabra clave                                       *
********************************************************************************************************************************/

                case isset($_POST['ticketc']):

                $consulta_ticket = "SELECT * FROM ticket WHERE serie LIKE '%$word%' OR asunto LIKE '%$word%'";
                $rel_ticket = mysqli_query($mysqli, $consulta_ticket);

                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                if(mysqli_num_rows($rel_ticket)>0): ?>

                    <?php
                    $query_num_show = "SELECT COUNT(*) FROM ticket WHERE serie LIKE '%$word%' OR asunto LIKE '%$word%'";
                    $exec_num = mysqli_query($mysqli, $query_num_show);
                    $array_num = mysqli_fetch_array($exec_num, MYSQLI_ASSOC);
                    $show_num = $array_num['COUNT(*)'];
                    ?>
                    <div class="container">
                        <strong>Dato de Ticket Consultado: &nbsp;<span class="badge"><?php echo $word; ?></span></strong><br>
                        <!--strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php //echo $show_num; ?></span></strong-->
                    </div>

                    <div class="col-sm-10">
                        <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                    </div>

                    <div class="container">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Acción</th>
                                    <th class="text-center">Fecha</th>  
                                    <th class="text-center">Usuario</th>                                    
                                    <th class="text-center">Equipo</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Ubicación</th>
                                    <th class="text-center">Asesor Técnico</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ct=$inicio+1;
                                while ($row=mysqli_fetch_array($rel_ticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="col-sm-10">
                            <a href="admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Pendientes</a>
                        </div><br>
                        <h2 class="text-center">No se encontraron tickets registrados en el sistema</h2>
                    <?php endif; ?>
                </div>

                <?php break;

                default:?>
                <h2 class="text-center">Por favor ingresa algo en el buscador</h2>

                <?php break;
            }}

            else {
                /* Todos los tickets
                $num_ticket_all=Mysql::consulta("SELECT * FROM sop_preventivo");
                $num_total_all=mysqli_num_rows($num_ticket_all);*/
                /* Tickets pendientes Hardware*/
                $num_ticket_pend=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Pendiente' AND tipo='Hardware' AND ubicacion = '$ubicacion'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets pendientes Software*/
                $num_ticket_pendsoft=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Pendiente' AND tipo='Software'");
                $num_total_pendsoft=mysqli_num_rows($num_ticket_pendsoft);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='En proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);
                
                /* Tickets compra*/
                $num_ticket_compra=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Requisicion de compra'");
                $num_total_compra=mysqli_num_rows($num_ticket_compra);
                
                /* Tickets garantia*/
                $num_ticket_gara=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Reparacion en Garantia'");
                $num_total_gara=mysqli_num_rows($num_ticket_gara);

                /* Tickets cancelados */
                $num_ticket_cancel=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Cancelado'");
                $num_total_cancel=mysqli_num_rows($num_ticket_cancel);

                /* Tickets Por compra */
                $num_ticket_entrega=Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Resuelto compra'");
                $num_total_entrega=mysqli_num_rows($num_ticket_entrega);
                ?>


                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills nav-justified">

                                <li><a href="./admin.php?view=ticketadmin&ticket=pending"><i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;&nbsp;Hardware&nbsp;&nbsp;<span class="badge"><?php echo $num_total_pend; ?></span></a></li>

                                <li><a href="./admin.php?view=ticketadmin&ticket=pendingsoft"><i class="fa fa-code" aria-hidden="true"></i>&nbsp;&nbsp;Software&nbsp;&nbsp;<span class="badge"><?php echo $num_total_pendsoft; ?></span></a></li>

                                <li><a href="./admin.php?view=ticketadmin&ticket=process"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Tickets en proceso&nbsp;&nbsp;<span class="badge"><?php echo $num_total_proceso; ?></span></a></li>
                                <li><a href="./admin.php?view=ticketadmin&ticket=compra"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Requisicion de compra&nbsp;&nbsp;<span class="badge"><?php  echo $num_total_compra; ?></span></a></li>
                                <li><a href="./admin.php?view=ticketadmin&ticket=gara"><i class="fa fa-shield"></i>&nbsp;&nbsp;Reparacion en Garantia&nbsp;&nbsp;<span class="badge"><?php  echo $num_total_gara; ?></span></a></li>
                                <li><a href="./admin.php?view=ticketadmin&ticket=resolved"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Tickets resueltos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_res; ?></span></a></li>
                                <li><a href="./admin.php?view=ticketadmin&ticket=canceled"><i class="fa fa-window-close"></i>&nbsp;&nbsp;Tickets cancelados&nbsp;&nbsp;<span class="badge"><?php echo $num_total_cancel; ?></span></a></li>
                                <li><a href="./admin.php?view=ticketadmin&ticket=entrega"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Tickets por compra&nbsp;&nbsp;<span class="badge"><?php echo $num_total_entrega; ?></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <?php

                                if(isset($_GET['ticket'])){
                                   // if($_GET['ticket']=="all"){
                                     //   $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo LIMIT $inicio, $regpagina";
                                    //}else

                                    if($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' AND tipo = 'Hardware' AND ubicacion = '$ubicacion' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pendingsoft"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' AND tipo = 'Software'LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='En proceso' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="compra"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Requisicion de compra' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="gara"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Reparacion en Garantia' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Resuelto' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="canceled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Cancelado' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="entrega"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Resuelto compra' LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' AND tipo = 'Hardware' AND ubicacion = '$ubicacion' LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                                    ?>
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Acción</th>
                                                <!--th class="text-center">Semáforo</th-->
                                                <th class="text-center">Fecha</th>  
                                                <th class="text-center">Usuario</th>                                    
                                                <th class="text-center">Equipo</th>
                                                <th class="text-center">Serie</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Ubicación</th>
                                                <th class="text-center">Asesor Técnico</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ct=$inicio+1;
                                            while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <a href="./lib/Planta_pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                            <!--form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form-->
                                        </td>
                                        <!--td class="text-center"><img src="./img/sema_verde.png" height="30px" width="30px"></td-->
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['tipo']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['observaciones']; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h2 class="text-center">No hay Tickets registrados en el sistema</h2>
                    <?php endif; ?>
                </div>
                <?php 
                if($numeropaginas>=1):
                    if(isset($_GET['ticket'])){
                        $ticketselected=$_GET['ticket'];
                    }else{
                        $ticketselected="all";
                    }
                    ?>
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <?php if($pagina == 1): ?>
                                <li class="disabled">
                                    <a aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>


                            <?php
                            for($i=1; $i <= $numeropaginas; $i++ ){
                                if($pagina == $i){
                                    echo '<li class="active"><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                }else{
                                    echo '<li><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                }
                            }
                            ?>


                            <?php if($pagina == $numeropaginas): ?>
                                <li class="disabled">
                                    <a aria-label="Previous">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div><!--container principal-->
    <?php include "./inc/foother.php"; ?>
    <?php
}}else{
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>

            </div>
            <div class="col-sm-7 animated flip">
                <h1 class="text-danger">Lo sentimos esta página es solamente para administradores del Sistema</h1>
                <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
    <?php
}

?>