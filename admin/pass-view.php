<?php
/*
 * @author: Meraz Prudencio Griselda  
 * ghriz2811@gmail.com
 * @version: 05/2021 v1
 */
 ?>
<?php if($_SESSION['nombre']!="" && $_SESSION['tipo']=="admin"){ 

          /* Actualizar cuenta admin */
        
         if(isset($_POST['email_reg']) && isset($_POST['usuario'])){
            $email_reg=MysqlQuery::RequestPost('email_reg');
            $usuario=MysqlQuery::RequestPost('usuario');
            $pass_new=MysqlQuery::RequestPost('admin_clave_up');
            $pass_admin_update=md5(MysqlQuery::RequestPost('admin_clave_up'));

            $sql=Mysql::consulta("SELECT * FROM usuario_sop WHERE nombre_comp= '$usuario' AND email_usuario='$email_reg'");
            if(mysqli_num_rows($sql)>=1){
                if(MysqlQuery::Actualizar("usuario_sop", "clave='$pass_admin_update' ", "nombre_comp='$usuario' and email_usuario='$email_reg'")){
                    
                    //$_SESSION['clave']=$pass_admin_update;
                    echo '
                        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">PASSWORD ACTUALIZADO</h4>
                            <p class="text-center">
                                La contraseña se actualizo con exito
                            </p>
                        </div>
                    ';

                    /*******************************************************************
                    ENVÍO DE CORREO CON NUEVA CONTRASEÑA CAMBIADA POR EL SOPORTE TÉCNICO
                    *******************************************************************/
                    $from="Soporte Devinsa <tecnicos@veco.lat>";
                    $cabecera="From:".$from;
                    $mensaje=utf8_decode("Estimado usuario, el soporte técnico a cambiado su contraseña de acceso.\r\n Link: https://veco.lat/soporte.php 
                    \r\n Sus nuevas credenciales de acceso son: \r\n \r\n Correo: ".$email_reg." \r\n  Contraseña:  ".$pass_new." \r\n\r\n En cualquier momento puede cambiar su contraseña. \r\n \r\n
                    Saludos Cordiales\r\n Área de sistemas \r\n Ext. 250 \r\n   tecnicos@veco.mx \r\n \r\n Por favor, responda de RECIBIDO a este mensaje");
                    $mensaje=wordwrap($mensaje, 70, "\r\n");
                    $asunto_admin= utf8_decode("Actualización de contraseña | PORTAL DEVINSA");

                    mail($email_reg, $asunto_admin, $mensaje, $cabecera);

                }else{
                    echo '
                        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                            <p class="text-center">
                                No hemos podido actualizar la contraseña
                            </p>
                        </div>
                    ';
                }
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Usuario y clave incorrectos
                        </p>
                    </div>
                ';
           }
        }
        
   
        ?>
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
</style>
<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#usuario_id").change(function () {
					$("#usuario_id option:selected").each(function () {
						id = $(this).val();
						$.post("get_ticket3.php", { id: id }, function(data){
							$("#email_reg").html(data);
						});            
					});
				})
			});
			$(document).ready(function(){
				$("#usuario_id").change(function () {
					$("#usuario_id option:selected").each(function () {
						id = $(this).val();
						$.post("get_soporte_usnom.php", { id: id }, function(data){
							$("#usuario").html(data);
						});            
					});
				})
			});
			$(document).ready(function(){
				$("#usuario_id").change(function () {
					$("#usuario_id option:selected").each(function () {
						id = $(this).val();
						$.post("get_soporte_usubi.php", { id: id }, function(data){
							$("#ubicacion").html(data);
						});            
					});
				})
			});
			$(document).ready(function(){
				$("#usuario_id").change(function () {
					$("#usuario_id option:selected").each(function () {
						id = $(this).val();
						$.post("get_ticket2.php", { id: id }, function(data){
							$("#equipo").html(data);
						});            
					});
				})
			});
			
		</script>
 <!--/////////////////////////////////////////////////////////-->
<?php include "./inc/navbarsop.php"; ?>
<div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn">Actualización de contraseña</h1>
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
            <div class="col-sm-3">
              <img src="./img/config.png" alt="Image" class="img-responsive">
            </div>
            <div class="col-sm-9">
              <p class="lead text-info">Bienvenido Administrador, aqui podra actualizar la contraseña de cualquier usuario si lo desea.</p>
            </div>
          </div><!--fin row-->
          
          <br><br>        
          
              <div class="col-sm-4">
                  <div class="row">
                      <div class="cool-sm-12"  style="width: 250%;">
                        <div class="panel panel-info">
                         <div class="panel-heading text-center"><i class="fa fa-refresh"></i>&nbsp;<strong>Actualizar Contraseña</strong></div>
                         <div class="panel-body">
                            <?php
                            $idad=$_SESSION['id'];                                
							$usuario = "veco_dvi";
							$password = "Vec83Dv19iSa@";
							$servidor = "localhost";
							$basededatos = "veco_sims_devecchi";							
							$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");
							$conexion ->set_charset('utf8');
							$conexion->query("SET NAMES UTF8");
							$conexion->query("SET CHARACTER SET utf8");							
							$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
								$consulta = "SELECT * FROM admin_soporte WHERE id='$idad'";
							$resultado = mysqli_query( $conexion, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");

							while ($reg1 = mysqli_fetch_array( $resultado )){
                            ?>
                             <form role="form" action="" method="POST">
                              <div><label><i class="fa fa-user"></i>&nbsp;Usuario</label>
						<select class="form-control" name="usuario_id" id="usuario_id">
				<option class="form-control" required="" value="">Seleccionar Usuario</option>
				<?php
								$connect = mysqli_connect("localhost","veco_dvi", "Vec83Dv19iSa@", "veco_sims_devecchi");
								$query = "SELECT * FROM usuario_sop Order by nombre_comp ASC";
								$result = mysqli_query($connect, $query);
								?>	
				<?php foreach($result as $row){ ?> 
					<option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_comp']; ?></option>
				<?php } ?>
            </select>
            </div>
            <br>
			<div><label><i class="fa fa-user"></i>&nbsp;Nombre</label>
			<select class="form-control" required="" name="usuario" id="usuario" readonly="" ></select></div>
			<br>
			<div><label><i class="fa fa-envelope"></i>&nbsp;Email</label>
			<select class="form-control" required="" name="email_reg" id="email_reg" readonly></select></div>
			<br>
			<div><label><i class="fa fa-hospital-o"></i>&nbsp;Ubicacion</label>
			<select class="form-control" required="" name="ubicacion" id="ubicacion" readonly="" ></select></div>
			<br>
                                 <div class="form-group">
                               <label><i class="fa fa-unlock-alt"></i>&nbsp;Nueva contraseña</label>
                               <input type="text" class="form-control" name="admin_clave_up" placeholder="Nueva contraseña" required="">
                             </div>
                             <button type="submit" class="btn btn-info">Actualizar Contraseña</button>
                           </form>
	<?php } ?>
                         </div>
                       </div>
                       </div>
                  </div><!--Fin row-->
              </div><!--Fin class col-md-4-->
          </div><!-- Fin row-->
          
        </div>
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
                <h1 class="text-danger">Lo sentimos esta página es solamente para SuperUsuarios de Veco</h1>
                <h3 class="text-info text-center">Inicia sesión como SuperUsuarios para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>