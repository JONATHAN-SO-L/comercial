<?php
/*
 * @author: Meraz Prudencio Griselda  
 * ghriz2811@gmail.com
 * @version: 05/2020 v1
 */
?>
<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin" ){ ?>
<?php

?>

<style>
.page-header{
display:none;
}
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
 
<title>Mantenimiento Preventivo</title>

        <!--************************************ Page content******************************-->
		<div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn">Registro de Mantenimiento Preventivo</h1>
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
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Para poder registrar un mantenimeto nuevo debes de llenar todos los campos de este formulario</strong></div>
        <div class="panel-body">
            <form role="form" action="ticket_add_prev.php" method="POST">
			
			<input type="hidden" readonly="" name="anio" readonly="" value="<?php echo date("Y");?>">
			
            <div class="form-group">
                    <label class="col-sm-222 control-label">Fecha Levantamiento</label>
                        <div class='col-sm-110'>
                        <div class="input-group">
                            <input class="form-control" type="text"  name="fecha_lev" value="<?php echo date("Y-m-d");?>" readonly>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                        </div>
                   </div>
			
            <div><label><i class="fa fa-user"></i>&nbsp;Usuario del Equipo</label>
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
                    <label class="col-sm-222 control-label">Fecha</label>
                        <div class='col-sm-110'>
                        <div class="input-group">
                            <input class="form-control" type="date" id="fechainput" placeholder="Fecha" name="fecha" required="" >
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                        </div>
                   </div>
			
			<div><label><i class="fa fa-desktop"></i>&nbsp;Equipo</label>
			<select class="form-control" required="" name="equipo" id="equipo"></select></div>
			<br>
			
			<div class="form-group">
                <label class="col-sm-222 control-label">Mantenimiento a Realizar</label>
                    <div class='col-sm-110'>
                        <div class="input-group">
						<textarea class="form-control" rows="8" name="mantenimiento" style="width: 580px;" required="" minlength="0" maxlength="300" readonly="">Limpieza de Hardware
Eliminar Archivos Temporales en Disco Local, Historiales y Cookies de Navegadores Web
Ejecución de Análisis Completo con Antivirus
Comprobación de Estado del Equipo
Verificación de Estado de Periféricos
Revisión de OneDrive sincronizado
Limpieza de Teléfono IP
Limpieza de Impresora
Mantenimiento a Celular Empresarial
Validación de buen estado de etiqueta de identificación
Revisión de cableado estructurado</textarea>
                        </div>
                    </div>
                </div>
            <br>
            
			 <div><label><i class="fa fa-user"></i>&nbsp;Administrador asignado</label>
						<select class="form-control" name="solucion_admin" id="solucion_admin">
				<option class="form-control" required="" value="">Seleccionar Usuario</option>
				<?php
								$connect = mysqli_connect("localhost","veco_dvi", "Vec83Dv19iSa@", "veco_sims_devecchi");
								$query = "SELECT * FROM admin_soporte ORDER BY ubicacion DESC";
								$result = mysqli_query($connect, $query);
								?>	
				<?php foreach($result as $row){ ?> 
					<option value="<?php echo $row['email_admin']; ?>"><?php echo $row['nombre']; ?></option>
				<?php } ?>
            </select>
            </div>
             <br>
            <button type="submit" class="btn btn-danger">Guardar</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-sm-4 text-center hidden-xs">
      <img src="img/equipos.png" class="img-responsive" alt="Image">
      <h2 class="text-primary">¡Mantenimiento Preventivo!</h2>
    </div>

  </div>
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
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores del Sistema</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>
<script type="text/javascript">
  $(document).ready(function(){
      $("#fechainput").datepicker();
  });
</script>