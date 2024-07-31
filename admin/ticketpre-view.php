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
    <?php include "./inc/navbarsop.php"; ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header2">
            <h1 class="animated lightSpeedIn">Tickets Mantenimientos Programados</h1>
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
      <p class="lead text-info">Bienvenido <strong><?php echo $_SESSION['nombre_completo']; ?></strong>, aqui se muestran todos los Tickets para los mantenimientos programados, los cuales podras modificar e imprimir.</p>
  </div>
  
  <!-- Buscador -->
  <div class="container">
    <!-- Rango de fechas -->
    <div class="pull-left col-sm-4">
        <form method="POST" action="#">
            <input type="date" name="fecha1">
            <input type="date" name="fecha2">
            <input type="submit" name="buscar" value="Buscar" class="btn btn-success">
        </form>
    </div>

    <!-- Usuario y ticket -->
    <div class="pull-right col-sm-4">
        <form method="POST" action="#">
            <input type="search" id="search" name="search" class="form-control" placeholder="Ingresa al usuario o el ticket que deseas buscar">
            <button type="submit" id="buscarprev" name="buscarprev" class="pull-right btn btn-success btn-sm">Buscar</button>
        </form>
    </div>
</div>

</div>
</div>
<?php
if(isset($_POST['id_del'])){
    $id = MysqlQuery::RequestPost('id_del');
    if(MysqlQuery::Eliminar("ticket", "id='$id'")){
        echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">��</span></button>
        <h4 class="text-center">Incidencias ELIMINADA</h4>
        <p class="text-center">
        La Incidencia fue eliminado del sistema con exito
        </p>
        </div>
        ';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">��</span></button>
        <h4 class="text-center">OCURRI�0�7 UN ERROR</h4>
        <p class="text-center">
        No hemos podido eliminar la incidencia
        </p>
        </div>
        '; 
    }
}

                /* Todos los tickets
                $num_ticket_all=Mysql::consulta("SELECT * FROM sop_preventivo");
                $num_total_all=mysqli_num_rows($num_ticket_all);*/

                /* Tickets resueltos*/
                $email= $_SESSION['email'];
                $num_ticket_res=Mysql::consulta("SELECT * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id
                 where estado_ticket='Resuelto' AND solucion_admin='$email'  ");
                $num_total_res=mysqli_num_rows($num_ticket_res);

                /* Tickets programados*/
                $num_ticket_pro=Mysql::consulta("SELECT * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                    WHERE estado_ticket='Programado' AND solucion_admin='$email'");
                $num_total_pro=mysqli_num_rows($num_ticket_pro);

                /* Tickets reprogramados*/
                $num_ticket_rep=Mysql::consulta("SELECT * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                    WHERE estado_ticket='Reprogramar' AND solucion_admin='$email'");
                $num_total_rep=mysqli_num_rows($num_ticket_rep);

                /* Tickets en proceso*/
                $num_ticket_ini=Mysql::consulta("SELECT * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                    WHERE estado_ticket='Inicio' AND solucion_admin='$email'");
                $num_total_ini=mysqli_num_rows($num_ticket_ini);

                $ubicacion= $_SESSION['ubi'];

                /* B�squeda de preventivo por rango de fechas */
                if (isset($_POST['buscar'])) {
                    $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                    mysqli_set_charset($mysqli, "utf8");

                    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    $regpagina = 20;
                    $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                    $fecha1 = $_POST['fecha1'];
                    $fecha2 = $_POST['fecha2'];

                    $buscar = Mysql::consulta("SELECT * FROM sop_preventivo WHERE fecha BETWEEN '$fecha1' AND '$fecha2'");

                    if (mysqli_num_rows($buscar)>0): ?>

                        <?php
                        $query_num_show = Mysql::consulta("SELECT COUNT(*) FROM sop_preventivo WHERE fecha BETWEEN '$fecha1' AND '$fecha2'");
                        $array_num = mysqli_fetch_array($query_num_show, MYSQLI_ASSOC);
                        $show_num = $array_num['COUNT(*)'];
                        ?>

                        <div class="container"><br>
                            <strong>Rango de fechas consultado: &nbsp;&nbsp;<span class="badge"><?php echo $fecha1; ?></span> - <span class="badge"><?php echo $fecha2; ?></span></strong><br>
                            <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong>
                        </div>

                        <div class="col-sm-10">
                            <a href="./admin.php?view=ticketpre&ticket=pro" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Programados</a>
                        </div>

                        <div class="container">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Accion</th>
                                        <th class="text-center">Fecha de Levantamiento</th> 
                                        <th class="text-center">Usuario</th>                                    
                                        <th class="text-center">Equipo</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Ubicacion</th>
                                        <th class="text-center">Fecha de Mantenimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ct=$inicio+1;
                                    while ($row=mysqli_fetch_array($buscar, MYSQLI_ASSOC)): 
                                        ?>
                                        <tr>
                                         <td class="text-center">
                                            <a href="./admin.php?view=ticketpredit&id=<?php echo $row['serie']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <!--a href="ticketpre_edit2.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a-->
                                            <a href="./lib/Planta_pdf_prev.php?id=<?php echo $row['serie']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        </td>
                                        <!--td class="text-center"><?php //echo $ct; ?></td-->
                                        <?php
                                        $originalDate1 = $row['fecha_lev'];
                                        $original1 = date("d/m/Y", strtotime($originalDate1));
                                        $fecha1 = $original1;
                                        ?>
                                        <td class="text-center"><?php echo $fecha1 ?></td>
                                        <td class="text-center"><?php echo $row['usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['equipo']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                        <td class="text-center"><?php echo $row['fecha_mant']; ?></td>

                                    </tr>
                                    <?php
                                    $ct++;
                                endwhile; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="col-sm-10">
                        <a href="./admin.php?view=ticketpre&ticket=pro" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Programados</a>
                    </div><br>
                    <h2 class="text-center">No se encontraron Tickets registrados en el sistema con el rango especificado</h2>
                <?php endif; ?>
            </div>
        <?php }

        /* B�squeda de ticket preentivo para usuario o serie */
        elseif (isset($_POST['buscarprev'])) {
            $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
            mysqli_set_charset($mysqli, "utf8");

            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $regpagina = 20;
            $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

            $word = $_POST['search'];
            $buscarprev = Mysql::consulta("SELECT * FROM sop_preventivo WHERE serie LIKE '%$word%' OR usuario LIKE '%$word%'");

            if (mysqli_num_rows($buscarprev)>0): ?>

                <?php
                $query_num_show = Mysql::consulta("SELECT COUNT(*) FROM sop_preventivo WHERE serie LIKE '%$word%' OR usuario LIKE '%$word%'");
                $array_num = mysqli_fetch_array($query_num_show, MYSQLI_ASSOC);
                $show_num = $array_num['COUNT(*)'];
                ?>
                <div class="container"><br>
                    <strong>Mantenimientos preventivos consultados: &nbsp;&nbsp;<span class="badge"><?php echo $word; ?></strong><br>
                        <strong>Tickets Encontrados: &nbsp;&nbsp;<span class="badge"><?php echo $show_num; ?></span></strong>
                    </div>

                    <div class="col-sm-10">
                        <a href="./admin.php?view=ticketpre&ticket=pro" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Programados</a>
                    </div>

                    <div class="container">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Accion</th>
                                    <th class="text-center">Fecha de Levantamiento</th> 
                                    <th class="text-center">Usuario</th>                                    
                                    <th class="text-center">Equipo</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Ubicacion</th>
                                    <th class="text-center">Fecha de Mantenimiento</th>
                                    <th class="text-center">Quien Soluciona</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ct=$inicio+1;
                                while ($row=mysqli_fetch_array($buscarprev, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                     <td class="text-center">
                                        <a href="./admin.php?view=ticketpredit&id=<?php echo $row['serie']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <!--a href="ticketpre_edit2.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a-->
                                        <a href="./lib/Planta_pdf_prev.php?id=<?php echo $row['serie']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    </td>
                                    <!--td class="text-center"><?php //echo $ct; ?></td-->
                                    <?php
                                    $originalDate1 = $row['fecha_lev'];
                                    $original1 = date("d/m/Y", strtotime($originalDate1));
                                    $fecha1 = $original1;
                                    ?>
                                    <td class="text-center"><?php echo $fecha1 ?></td>
                                    <td class="text-center"><?php echo $row['usuario']; ?></td>
                                    <td class="text-center"><?php echo $row['equipo']; ?></td>
                                    <td class="text-center"><?php echo $row['serie']; ?></td>
                                    <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                    <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                    <td class="text-center"><?php echo $row['fecha_mant']; ?></td>
                                    <td class="text-center"><?php echo $row['solucion_admin']; ?></td>
                                </tr>
                                <?php
                                $ct++;
                            endwhile; 
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="col-sm-10">
                    <a href="./admin.php?view=ticketpre&ticket=pro" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a Programados</a>
                </div><br>
                <h2 class="text-center">No se encontraron Tickets registrados en el sistema</h2>
            <?php endif; ?>
        </div>

    <?php } elseif (!isset($_POST['buscarprev'])) {?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-justified">
                     <li><a href="./admin.php?view=ticketpre&ticket=pro"><i class="fa fa-calendar-times-o"></i>&nbsp;&nbsp;Programados&nbsp;&nbsp;<span class="badge"><?php echo $num_total_pro; ?></span></a></li>
                     <li><a href="./admin.php?view=ticketpre&ticket=rep"><i class="fa fa-forward" aria-hidden="true"></i></i>&nbsp;&nbsp;Reprogramados&nbsp;&nbsp;<span class="badge"><?php echo $num_total_rep; ?></span></a></li>
                     <li><a href="./admin.php?view=ticketpre&ticket=ini"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;Iniciados&nbsp;&nbsp;<span class="badge"><?php echo $num_total_ini; ?></span></a></li>
                     <li><a href="./admin.php?view=ticketpre&ticket=res"><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Resueltos&nbsp;&nbsp;<span class="badge"><?php echo $num_total_res; ?></span></a></li>
                 </ul>
             </div>
         </div>
         <br>
         <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <?php
                    $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                    mysqli_set_charset($mysqli, "utf8");

                    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    $regpagina = 20;
                    $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                    $email= $_SESSION['email'];
                    if(isset($_GET['ticket'])){
                                   // if($_GET['ticket']=="all"){
                                     //   $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo LIMIT $inicio, $regpagina";
                                    //}else
                        if($_GET['ticket']=="res"){
                            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                            WHERE estado_ticket='Resuelto' AND solucion_admin='$email' LIMIT $inicio, $regpagina";
                        }elseif($_GET['ticket']=="ini"){
                            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                            WHERE estado_ticket='Inicio' AND solucion_admin='$email' LIMIT $inicio, $regpagina";
                        }elseif($_GET['ticket']=="pro"){
                            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                            WHERE estado_ticket='Programado' AND solucion_admin='$email' LIMIT $inicio, $regpagina";
                        }elseif($_GET['ticket']=="rep"){
                            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                            WHERE estado_ticket='Reprogramar' AND solucion_admin='$email' LIMIT $inicio, $regpagina";
                        }else{
                            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                            WHERE estado_ticket='Programado' AND solucion_admin='$email' LIMIT $inicio, $regpagina";
                        }
                    }else{
                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM sop_preventivo inner join usuario_sop on sop_preventivo.nombre_usuario=usuario_sop.id 
                        WHERE estado_ticket='Programado' AND solucion_admin='$email' LIMIT $inicio, $regpagina";
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
                                    <th class="text-center">Accion</th>
                                    <th class="text-center">Fecha de Levantamiento</th>
                                    <th class="text-center">Fecha Programada</th>
                                    <th class="text-center">Usuario</th>                                    
                                    <th class="text-center">Equipo</th>
                                    <th class="text-center">Serie</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Ubicacion</th>
                                    <th class="text-center">Fecha de Mantenimiento Realizado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ct=$inicio+1;
                                while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                     <td class="text-center">
                                        <a href="./admin.php?view=ticketpredit&id=<?php echo $row['serie']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <!--a href="ticketpre_edit2.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a-->
                                        <a href="./lib/Planta_pdf_prev.php?id=<?php echo $row['serie']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    </td>
                                    <!--td class="text-center"><?php //echo $ct; ?></td-->
                                    <?php
                                    $originalDate1 = $row['fecha_lev'];
                                    $original1 = date("d/m/Y", strtotime($originalDate1));
                                    $fecha1 = $original1;
                                    ?>
                                    <td class="text-center"><?php echo $fecha1 ?></td>
                                    <td class="text-center"><?php echo $row['fecha']; ?></td>
                                    <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                    <td class="text-center"><?php echo $row['equipo']; ?></td>
                                    <td class="text-center"><?php echo $row['serie']; ?></td>
                                    <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                    <td class="text-center"><?php echo $row['ubicacion']; ?></td>
                                    <td class="text-center"><?php echo $row['fecha_mant']; ?></td>

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
                                <a href="./admin.php?view=ticketpre&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="./admin.php?view=ticketpre&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="./admin.php?view=ticketpre&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                <a href="./admin.php?view=ticketpre&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
}else{
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>

            </div>
            <div class="col-sm-7 animated flip">
                <h1 class="text-danger">Lo sentimos esta p�gina es solamente para administradores del Sistema</h1>
                <h3 class="text-info text-center">Inicia sesi�n como administrador para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>

    <?php
}
}
?>