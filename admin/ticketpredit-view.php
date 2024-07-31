<?php
/*
 * @author: Meraz Prudencio Griselda  
 * ghriz2811@gmail.com
 * @version: 08/2019 v1
 */
?>
<?php
if($_SESSION['nombre']!="" && $_SESSION['tipo']=="admin"){
    include ("./conexi.php");
    header('Content-Type: text/html; charset=UTF-8');

    $id = MysqlQuery::RequestGet('id');
    $sql = Mysql::consulta("SELECT * FROM sop_preventivo WHERE serie = '$id' ");
    $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
    
    if(isset($_POST['id_edit']) && isset($_POST['serie_ticket'])){
		$id_edit=MysqlQuery::RequestPost('id_edit');
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');
		$solucion_edit=  MysqlQuery::RequestPost('observaciones');
		$fecha_mant=  MysqlQuery::RequestPost('fecha_mant');
		$email=  MysqlQuery::RequestPost('email_ticket');
		$serie_ticket=  MysqlQuery::RequestPost('serie_ticket');
        $requisiciones = MysqlQuery::RequestPost('requisiciones');
		if(isset($_POST['id_edit'])){
			$id_edit= $_POST['id_edit'];
		}else{
			$id_edit="";
		}
		if(isset($_POST['estado_ticket'])){
			$estado_edit= $_POST['estado_ticket'];
		}else{
			$estado_edit="";
		}
		if(isset($_POST['observaciones'])){
			$solucion_edit= $_POST['observaciones'];
		}else{
			$solucion_edit="";
		}
		if(isset($_POST['fecha_mant'])){
			$fecha_mant= $_POST['fecha_mant'];
		}else{
			$fecha_mant="";
		}
        if(isset($_POST['requisiciones'])){
            $requisiciones= $_POST['requisiciones'];
        }else{
            $requisiciones= NULL;
        }
        if(isset($_POST['serie_ticket'])){
            $serie_ticket= $_POST['serie_ticket'];
        }else{
            $serie_ticket= NULL;
        }
        if(isset($_POST['solucion_admin'])){
            $ing_soporte= $_POST['solucion_admin'];
        }else{
            $ing_soporte= NULL;
        }
        $radio_email=  MysqlQuery::RequestPost('optionsRadios');
        if(isset($_POST['seguimiento'])){
            $seguimiento= $_POST['seguimiento'];
        }else{
            $seguimiento= NULL;
        }
        if(isset($_POST['name_equipo'])){
            $equipo= $_POST['name_equipo'];
        }else{
            $equipo= NULL;
        }


/***************************************************************************************************
 *                           Condicional de Estado de Mantenimiento                                *
 * ************************************************************************************************/

switch ($_POST['estado_ticket']) {
    case 'Programado':
    echo '
    <div class="alert alert-warning">
    <strong>¡Programado!</strong> Este mantenimiento ya está programado, por favor, selecciona la opción de Reprogramar, Iniciar o Resolver.
    </div>';
    break;

    case 'Reprogramar':
        $fecha_seg = date('Y-m-d H:i:s');
        setlocale(LC_TIME,"es_MX.UTF-8");
        date_default_timezone_set ('America/Mexico_City');
        $datetime_inicio_sgc = strftime('%d%b%y');
        if(MysqlQuery::Actualizar("sop_preventivo", "estado_ticket='$estado_edit', seguimiento='$seguimiento', fecha_hora_seg='$fecha_seg'", "id='$id_edit'")){

     $cabecera="From: Soporte Devinsa <tecnicos@veco.lat>";
     $asunto="Mantenimiento ".$serie_ticket." reprogramado";
     $email_root="a.lorenzana@devinsa.com";
     $email_jefe="s.gonzalez@veco.com.mx";
     $email= $reg['email_cliente'];
     $email_soporte= $reg['solucion_admin'];
     
     $mensaje_reprog=utf8_decode("Se ha reprogramado el mantenimiento ".$serie_ticket." del equipo ".$equipo."con el seguimiento mencionado a continuación: \r\n \r\n ".$seguimiento." \r\n \r\n 
     Saludos Cordiales\r\n Área de sistemas \r\n soporte_tecnico@veco.lat \r\n \r\n 
     Por favor, responda de conformidad a este correo");
     $mensaje_reprog=wordwrap($mensaje_reprog, 70, "\r\n");

     $mensaje_user_reprog=utf8_decode("Estimado usuario.\r\n\r\n
     Se ha reprogramado el mantenimiento ".$serie_ticket." del equipo ".$equipo."con el seguimiento mencionado a continuación: \r\n \r\n ".$seguimiento." \r\n\r\n 
     Saludos Cordiales\r\n Área de sistemas \r\n soporte_tecnico@veco.lat \r\n \r\n 
     Por favor, responda de conformidad a este correo");

     mail($email_root, $asunto, $mensaje_reprog, $cabecera);
     mail($email_jefe, $asunto, $mensaje_reprog, $cabecera);
     mail($email_soporte, $asunto, $mensaje_reprog, $cabecera);
     mail($email, $asunto, $mensaje_user_reprog, $cabecera);

     echo '
     <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
     <h4 class="text-center">Mantenimiento Actualizado</h4>
     <p class="text-center">
     Se ha actualizado el seguimiento del mantenimiento
     </p>
     </div>
     ';

 }else{
     echo '
     <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
     <h4 class="text-center">OCURRIÓ UN ERROR</h4>
     </div>
     '; 
 }
 break;

 case 'Inicio':
 $begin = date('Y-m-d H:i:s');
 if(MysqlQuery::Actualizar("sop_preventivo", "estado_ticket='$estado_edit', observaciones='$solucion_edit', fecha_hora='$begin'", "id='$id_edit'")){

     echo '
     <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
     <h4 class="text-center">Mantenimiento Actualizado</h4>
     <p class="text-center">
     Se ha iniciado el contador de tiempo para ejecutar el mantenimiento
     </p>
     </div>
     ';

 }else{
     echo '
     <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
     <h4 class="text-center">OCURRIÓ UN ERROR</h4>
     <p class="text-center">
     No se pudo iniciar el cronómetro del mantenimiento
     </p>
     </div>
     '; 
 }
 break;

 case 'Resuelto':
    $resuelto = date('Y-m-d H:i:s');
    setlocale(LC_TIME,"es_MX.UTF-8");
    date_default_timezone_set ('America/Mexico_City');
    $date_hecho_sgc = strftime('%d%b%y');
  //fecha_hora_sol='$resuelto',
    if(MysqlQuery::Actualizar("sop_preventivo", "estado_ticket='$estado_edit', observaciones='$solucion_edit', fecha_mant='$fecha_mant', requisiciones='$requisiciones', date_hecho_sgc='$date_hecho_sgc'", "id='$id_edit'")){

     echo '
     <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
     <h4 class="text-center">Mantenimiento Finalizado</h4>
     <p class="text-center">
     Se ha cerrado el contador de tiempo del mantenimiento
     </p><br>
     <center><a href="./lib/Planta_pdf_prev.php?id='.$reg['serie'].'" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> IMPRIMIR</a></center>
     </div>
     ';
     if($radio_email=="option2"){

        $from="Soporte Devinsa <tecnicos@veco.lat>";
        $cabecera="From:".$from;
        $asunto="Mantenimiento ".$serie_ticket." llevado en tiempo y forma";
        $email= $reg['email_cliente'];
        $mensaje_mail=utf8_decode("Estimado usuario se ha realizado el mantenimiento ".$serie_ticket." correspondiente a su equipo ".$equipo." con las siguientes observaciones: ".$solucion_edit." \r\n \r\n 
        Saludos Cordiales\r\n Área de sistemas \r\n soporte_tecnico@veco.lat \r\n \r\n
        Por favor, ES IMPORTANTE RESPONDA EL CORREO CON SU CONFORMIDAD DE LA SOLUCIÓN.");
        $mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");

        $email_root="a.lorenzana@devinsa.com";
        $mensaje_root=utf8_decode("Estimado Gerente se ha realizado el mantenimiento correspondiente al ticket #".$serie_ticket." con las siguientes observaciones: ".$solucion_edit." \r\n \r\n
        Solicitud de mejora (Requisiciones): ".$requisiciones." \r\n \r\n
        Saludos Cordiales\r\n Área de sistemas \r\n soporte_tecnico@veco.lat \r\n \r\n 
        Por favor, NO responda a este mensaje, es un envio automatico");
        $mensaje_root=wordwrap($mensaje_root, 70, "\r\n");

        $email_jefe = "s.gonzalez@veco.com.mx";
        $mensaje_jefe=utf8_decode("Se ha realizado el mantenimiento correspondiente al ticket #".$serie_ticket." del equipo ".$equipo." con las siguientes observaciones: ".$solucion_edit." \r\n \r\n
        Solicitud de mejora (Requisiciones): ".$requisiciones." \r\n \r\n
        Saludos Cordiales\r\n Área de sistemas \r\n soporte_tecnico@veco.lat \r\n \r\n 
        Por favor, NO responda a este mensaje, es un envio automatico");
        $mensaje_jefe=wordwrap($mensaje_jefe, 70, "\r\n");

        mail($email, $asunto, $mensaje_mail, $cabecera);
        mail($email_root, $asunto, $mensaje_root, $cabecera);
        mail($email_jefe, $asunto, $mensaje_jefe, $cabecera);
        mail($ing_soporte, $asunto, $mensaje_jefe, $cabecera);
    }

}else{
 echo '
 <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
 <h4 class="text-center">OCURRIÓ UN ERROR</h4>
 <p class="text-center">
 No se pudo cerrar el mantenimiento, error en la conexión a la base de datos
 </p>
 </div>
 '; 
}
break;

default:
echo '
<div class="alert alert-info">
<strong>¡Finalizado!</strong> El Mantenimiento se concluyó satisfactoriamente.
</div>';
break;
}
}     

?>

<!--************************************ Page content******************************-->
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
<?php include "./inc/navbarsop.php";?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="page-header2">
        <h1 class="animated lightSpeedIn">Actualización de mantenimiento</h1>
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
<!--************************************ Page content******************************-->

<div class="container">
  <div class="row">
    <div class="col-sm-3">
        <img src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
    </div>
    <div class="col-sm-9">
        <a href="admin.php?view=ticketpre" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Ticket</a>
    </div>
</div>
</div>

<div class="container">
    <div class="col-sm-12">
        <form class="form-horizontal" role="form" action="" method="POST">
          <input type="hidden" name="id_edit" value="<?php echo $reg['id']?>">
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha Matenimiento</label>
            <div class='col-sm-10'>
                <div class="input-group">
                    <input class="form-control" readonly="" type="hidden" name="fecha_ticket" readonly="" value="<?php echo $reg['fecha']?>">
                    <?php
                    $originalDate1 = $reg['fecha'];
                    $original1 = date("d/m/Y", strtotime($originalDate1));
                    $fecha1 = $original1;
                    ?>
                    <input class="form-control" readonly="" type="text" readonly="" value="<?php echo $fecha1 ?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Serie</label>
            <div class='col-sm-10'>
                <div class="input-group">
                    <input class="form-control" readonly="" type="text" name="serie_ticket" readonly="" value="<?php echo $reg['serie']?>">
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Estado</label>
            <div class='col-sm-10'>
                <div class="input-group">
                    <select class="form-control" name="estado_ticket">
                        <option value="<?php echo $reg['estado_ticket']?>"><?php echo $reg['estado_ticket']?> (Actual)</option>
                        <option value="Programado">Programado</option>
                        <option value="Reprogramar">Reprogramar</option>
                        <option value="Inicio">Inicio</option>
                        <option value="Resuelto">Resuelto</option>
                    </select>
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>
        </div>

                        <!--div class="form-group">
                          <label  class="col-sm-2 control-label">Usuario</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="name_usuario" readonly="" value="<?php echo $reg['nombre_usuario']?>">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                      </div-->

                      <div class="form-group">
                          <label  class="col-sm-2 control-label">Equipo</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                  <input type="text" readonly="" class="form-control"  name="name_equipo" readonly="" value="<?php echo $reg['equipo']?>">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                               <input type="email" readonly="" class="form-control"  name="email_ticket" readonly="" value="<?php echo $reg['email_cliente']?>">
                               <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                           </div> 
                       </div>
                   </div>

                   <div class="form-group">
                      <label  class="col-sm-2 control-label">Asunto</label>
                      <div class="col-sm-10">
                          <div class='input-group'>
                              <input type="text" readonly="" class="form-control"  name="asunto_ticket" readonly="" value="<?php echo utf8_decode($reg['asunto'])?>">
                              <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                          </div> 
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-2 control-label">Mantenimiento</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="3"  name="mantenimiento" readonly="" required=""><?php echo utf8_decode($reg['mantenimiento'])?></textarea>
                    </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-2 control-label">Seguimiento</label>
                  <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="seguimiento" placeholder="De ser necesario, agrega el seguimiento que se esté dando al mantenimiento programado, si el usuario está fuera o ausente, el técnico está indispuesto, etc"><?php echo $reg['seguimiento']?></textarea>
                </div>
            </div>

            <div class="form-group">
              <label  class="col-sm-2 control-label">Observaciones del mantenimiento</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3"  name="observaciones" placeholder="Por favor agrega las observaciones que tuviste durante el mantenimiento"><?php echo $reg['observaciones']?></textarea>
            </div>
        </div>

        <div class="form-group">
          <label  class="col-sm-2 control-label">Solicitud de mejora</label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Sin requisiciones" name="requisiciones" id="requisiciones"><?php echo $reg['requisiciones']?></textarea>
        </div>
    </div>

    <div class="form-group">
      <label  class="col-sm-2 control-label">Fecha Mantenimiento</label>
      <div class="col-sm-10">
         <input type="text" readonly="" class="form-control"  name="fecha_mant" readonly="" value="<?php echo date("d/m/Y");?>">
     </div>
 </div>

 <div class="form-group">
  <label  class="col-sm-2 control-label">Encargado de Mantenimiento:</label>
  <div class="col-sm-10">
      <div class='input-group'>
          <input type="text" readonly="" class="form-control"  name="solucion_admin" readonly="" value="<?php echo $reg['solucion_admin']?>">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
      </div>
  </div>
</div>

<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10 text-center">
      <button type="submit" class="btn btn-info">Actualizar Mantenimiento</button>
  </div>
</div>

<div class="row">
    <div class="col-sm-offset-5">

        <div class="radio">
            <label>
                <input type="radio" name="optionsRadios" value="option2" checked>
                Enviar email de solución del mantenieminto al usuario
            </label>
        </div>

        <div class="radio">
            <label>
                <input type="radio" name="optionsRadios" value="option1" >
                No enviar email de solución del mantenieminto al usuario
            </label>
        </div>

    </div>
</div>

<br>


</form>
</div><!--col-md-12-->
</div><!--container-->

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
                <h1 class="text-danger">Lo sentimos esta página es solamente para administradores de Veco</h1>
                <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
    <?php
}
?>