<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin" ){ ?>
	
	<style>
	.page-header{
		display:none;
	}
	.dropdown-menu {
		position: absolute;
		top: 100%;
		left: -150%;
	}
	</style>
	<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
	
	<script language="javascript">
	$(document).ready(function(){
		$("#usuario_id").change(function () {
			$("#usuario_id option:selected").each(function () {
				id = $(this).val();
				$.post("get_soporte_usuario.php", { id: id }, function(data){
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
				$.post("get_soporte_usarea.php", { id: id }, function(data){
					$("#area").html(data);
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
	
	</script>
	<!--/////////////////////////////////////////////////////////-->
	
	
	
	<title>Equipo de Usuarios</title>
	<!--************************************ Page content******************************-->
	<div class="container">
	<div class="row">
	<div class="col-sm-12">
	<div class="page-header2">
	<h1 class="animated lightSpeedIn">Registro de Equipos de Usuarios</h1>
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
	
	</div>
	<div class="col-sm-9">
	<a href="./lib/pdf_mantenimiento.php" class="btn btn-sm btn-warning btn-sm pull-right"  target="_blank"><i class="fa fa-file-pdf-o" ></i>&nbsp;&nbsp;PDF Maquinaria Mantenimiento</a>

	<a href="./lib/pdf_equipo_civac.php" class="btn btn-sm btn-danger btn-sm pull-right"  target="_blank"><i class="fa fa-file-pdf-o" ></i>&nbsp;&nbsp;PDF VECO</a>

	<form method = "POST" action = "/admin/listado_devinsa.php">
						<input class="btn btn-sm btn-success btn-sm pull-right"  type ="submit" value = "Listado de equipos devinsa CSV" id = "listado_csv" name = "listado_csv" target="_blank">
				</form>
				
	<!--a href="#" class="btn btn-sm btn-success btn-sm pull-right" target="_blank"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;Listado de equipos devinsa CSV</a-->

	<!--a href="./lib/pdf_equipo_cdmx.php" class="btn btn-info btn-sm pull-right"  target="_blank"><i class="fa fa-file-pdf-o" ></i>&nbsp;&nbsp;PDF CDMX</a-->

	</div>
	</div>
	</div>
	<div class="container">
	<div class="row">
	<div class="col-sm-8">
	<div class="panel panel-success">
	<div class="panel-heading text-center"><strong>Para poder registrar un Equipo de algun usuario nuevo debes de llenar todos los campos de este formulario</strong></div>
	<div class="panel-body">
	<form role="form" action="add_equipo_soporte.php" method="POST">
	
	
	<div><label><i class="fa fa-user"></i>&nbsp;Usuario</label>
	<select class="form-control" name="usuario_id" id="usuario_id">
	<option class="form-control" required="" value="0">Seleccionar Usuario</option>
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
		<select class="form-control" required="" name="email_reg" id="email_reg" readonly="" ></select></div>
		<br>
		<div><label><i class="fa fa-hospital-o"></i>&nbsp;Area</label>
		<select class="form-control" required="" name="area" id="area" readonly="" ></select></div>
		<br>
		<div><label><i class="fa fa-hospital-o"></i>&nbsp;Ubicacion</label>
		<select class="form-control" required="" name="ubicacion" id="ubicacion" readonly="" ></select></div>
		<br>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Equipo</label>
		<select class="form-control" name="equipo" required="">          
		<option value="">Selecciona una equipo</option>
		<option value="Laptop">Laptop</option>
		<option value="PC">PC</option>
		<option value="Workstation">Workstation</option>
		<option value="Celular">Celular</option>
		<option value="Maquinaria">Maquinaria</option>
		</select>
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;No. Serie</label>
		<input type="text" class="form-control" name="num_serie" placeholder="# Serie Calidad" required="" maxlength="50">
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Marca</label>
		<input type="text" class="form-control" name="marca" placeholder="Ejemplo: HP, DELL, ASUS, etc" required="" maxlength="50">
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Tipo</label>
		<select class="form-control" name="tipo" required="">          
		<option value="">Selecciona una equipo</option>
		<option value="Laptop">Laptop</option>
		<option value="Desktop">Desktop</option>
		<option value="Celular">Celular</option>
		<option value="Maquinaria">Maquinaria</option>
		</select>
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Procesador</label>
		<input type="text" class="form-control" name="procesador" placeholder="Ejemplo: i5-650, R5 4200U, etc"  maxlength="50">
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Sistema Operativo</label>
		<select class="form-control" name="sis_ope" required="">          
		<option value="">Selecciona una Sistema Operativo</option>
		<option value="W7 Pro">W7 Pro</option>
		<option value="W7 H">W7 H</option>
		<option value="W8 Pro">W8 Pro</option>
		<option value="W8 H">W8 H</option>
		<option value="W8.1 Pro">W8.1 Pro</option>
		<option value="W8.1 H">W8.1 H</option>
		<option value="W10 Pro">W10 Pro</option>
		<option value="W10 H">W10 H</option>
		<option value="W11 Pro">W11 Pro</option>
		<option value="W11 H">W11 H</option>
		<option value="WS 2007">WS 2007</option>
		<option value="WS 2008">WS 2008</option>
		<option value="GNU/Linux">Distribución GNU/Linux</option>
		<option value="Android 8">Android 8</option>
		<option value="Android 9">Android 9</option>
		<option value="Android 10">Android 10</option>
		<option value="Android 11">Android 11</option>
		<option value="Android 12">Android 12</option>
		<option value="Android 13">Android 13</option>
		<option value="Android 14">Android 14</option>
		<option value="iOS 10">iOS 10</option>
		<option value="iOS 15">iOS 15</option>
		<option value="iOS 16">iOS 16</option>
		<option value="iOS 17">iOS 17</option>
		<option value="iOS 18">iOS 18</option>
		<option value="RDOS">RDOS</option>
		<option value="W 3.11">W 3.11</option>
		<option value="N/A">No aplica - Sin sistema operativo</option>
		</select>
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Disco Duro</label>
		<input type="text" class="form-control" name="disco" placeholder="Ejemplo: 120SSD, 500 GB, etc"  maxlength="20">
		</div>
		
		<div class="form-group">
		<label class="control-label">&nbsp;Ram</label>
		<input type="text" class="form-control" name="ram" placeholder="Ejemplo: 8 GB, 16 GB, etc"  maxlength="50" value=" GB">
		</div>
		
		
		
		<button type="submit" class="btn btn-danger">Asignar Equipo</button>
		</form>
		</div>
		</div>
		</div>
		
		<div class="col-sm-4 text-center hidden-xs">
		<img src="img/equipos.png" class="img-responsive" alt="Image">
		<h2 class="text-primary">¡Control de Equipos!</h2>
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