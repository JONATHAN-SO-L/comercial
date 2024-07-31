<?php
/*
 * @author: Meraz Prudencio Griselda  
 * ghriz2811@gmail.com
 * @version: 10/2020 v1
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

<title>Checador Devinsa</title>

        <!--************************************ Page content******************************-->
		<div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header2">
                <h1 class="animated lightSpeedIn">Entrada</h1>
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
 <!--	
	<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
	
	<title>Geolocalizacion</title>	
</head>
<body>
	<button class="btn btn-danger" onclick="findMe()" style="margin-left: 100px;">Da clic para los datos faltantes</button>
	<div id="map"style="margin-left: 100px;"></div>
	
	<script>
		function findMe(){
			var output = document.getElementById('map');

			// Verificar si soporta geolocalizacion
			if (navigator.geolocation) {
				output.innerHTML = "<p>Tu navegador soporta</p>";
			}else{
				output.innerHTML = "<p>Tu navegador no soporta</p>";
			}

			//Obtenemos latitud y longitud
			function localizacion(posicion){

				var latitude = posicion.coords.latitude;
				var longitude = posicion.coords.longitude;				
				output.innerHTML = "<p> L1: "+latitude+"<br> L2: "+longitude+"</p>";	
				//var imgURL = "https://maps.googleapis.com/maps/api/staticmap?center="+latitude+","+longitude+"&size=600x300&markers=color:red%7C"+latitude+","+longitude+"&key=YOUR_API_KEY";
				//output.innerHTML ="<img src='"+imgURL+"'>";

						}
			function error(){
				output.innerHTML = "<p>No se pudo obtener tu ubicación</p>";
			}
			navigator.geolocation.getCurrentPosition(localizacion,error);
		}
	</script>
</body>
</html>
**-->	
<?php
 include ("conexi.php");
	

	if(isset($_POST['name_usuario']) && isset($_POST['fecha_checador'])){ 
			
			$nombre= $_POST['name_usuario'];
			$fecha= $_POST['fecha_checador'];
		    $ubicacion= $_POST['ubicacion'];
			$hora_entrada= $_POST['hora_checador'];
			$hora_salida= "";
			$salida_comer= "";
			$entrada_comer= "";
			$sis_func= $_POST['sis_func'];
			
			$con=mysqli_connect($host,$user,$pw,$db);
			if(mysqli_query($con,("INSERT INTO reg_checador2(usuario, ubicacion, fecha, hora_entrada, hora_salida,salida_comer,entrada_comer,sis_funcionando)
			VALUES('$nombre','$ubicacion', '$fecha','$hora_entrada','$hora_salida','$salida_comer','$entrada_comer','$sis_func')"))){
			
		
			echo  '<script language="javascript">
				alert("Se ha checado su entrada. Gracias");
				window.location.href="admin.php?view=checador"</script>';
		}else{
			echo '<script language="javascript">
				alert("Su checada fue incorrecta favor de intentarlo. Gracias");
				window.location.href="admin.php?view=checador1"</script>';
		}
	}
?>	
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>Seleccione el dato que falta:</strong></div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
                          <fieldset>
                      <div class="form-group">
                            <label class="col-sm-2 control-label">Hora</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="hora_checador"  readonly value="<?php echo date("h:i A");?>">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="fecha_checador"  readonly value="<?php echo date("Y-m-d");?>">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        
                       <div class="form-group">
                          <label  class="col-sm-2 control-label">Usuario</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" readonly="" value="<?php echo $_SESSION['nombre_completo']; ?>" name="name_usuario" >
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Ubicacion</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" readonly="" value="<?php echo $_SESSION['ubi']; ?>" name="ubicacion" >
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                              </div>
                          </div>
                        </div>
                        
                         <div class="form-group">
                            <label  class="col-sm-2 control-label">Sistemas Funcionando Correctamente</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <select class="form-control" name="sis_func" required="">            
										<option value=""></option>                                      
                                        <option value="Si">Si</option>                               
                                <option value="No">No - Favor de levantar un ticket</option>  
                                      </select>
                                      <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                </div>
                            </div>
                        </div>   
                        <!--div class="form-group">
                          <label  class="col-sm-2 control-label">L1</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" name="latitud_entrada" required="">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label  class="col-sm-2 control-label">L2</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" name="longitud_entrada" required="">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div-->
			 <fieldset>
            </div>
            <center><button type="submit" class="btn btn-success">Guardar</button>
            <input type="button" class="btn btn-danger" name="cancel" value="Cancelar" onClick="window.location='admin.php?view=checador';" /></center>
          </form>
        </div>
      </div>
    <div class="col-sm-4 text-center hidden-xs">
      <img src="img/horarios.png" class="img-responsive" alt="Image">
      <h2 class="text-primary">¡Gracias por Checar!</h2>
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
                    <h1 class="text-danger">Lo sentimos esta pagina es solamente para Usuarios del Sistema</h1>
                    <h3 class="text-info text-center">Inicia sesion para poder acceder</h3>
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