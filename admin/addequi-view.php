<?php
/*
 * @author: Meraz Prudencio Griselda  
 * ghriz2811@gmail.com
 * @version: 04/2020 v1
 */
 ?>
<?php
 include ("conexi.php");
  include "./inc/navbarsop.php";
  
    if(isset($_POST['usuario_id']) && isset($_POST['email_reg']) && isset($_POST['equipo'])){ 
		
		$usuario_id= $_POST['usuario_id'];
		$email_reg= $_POST['email_reg'];
		$equipo= $_POST['equipo'];
		
        //$usuario_id=MysqlQuery::RequestPost('usuario_id');
        //$email_reg=MysqlQuery::RequestPost('email_reg');
        //$equipo=MysqlQuery::RequestPost('equipo');
         
       // if(MysqlQuery::Guardar("equipo_usuario", "usuario, email_usuario, equipo", "'$usuario_id', '$email_reg', '$equipo'")){
    	$con=mysqli_connect($host,$user,$pw,$db);
			if(mysqli_query($con,(
			    "INSERT INTO equipo_usuario(usuario, email_usuario, equipo )VALUES('$usuario_id','$email_reg', '$equipo')"))){
		  echo '
              <script language="javascript">
				alert("Equipo asignado correctamente");
				window.location.href="equipo_view.php"</script>
            ';
        }else{
            echo '
               <script language="javascript">
				alert("Error al asignado equipo a usuario");
				window.location.href="equipo_view.php"</script>
            '; 
        }
    }
    
?>
