<?php
session_start();

if ($_SESSION['nombre'] && $_SESSION['tipo']) {
    
    require '../../conex.php';
    
    $usuario = $_SERVER['QUERY_STRING'];
    
    $user_search = $con->prepare("SELECT * FROM usuario_lev WHERE usuario = :usuario");
    $user_search->bindValue(':usuario', $usuario);
    $user_search->setFetchMode(PDO::FETCH_OBJ);
    $user_search->execute();
    
    $user_found = $user_search->fetchAll();
    
    if ($user_search -> rowCount() > 0) {
        
        foreach ($user_found as $value) {
            $user = $value -> usuario;
            $name = $value -> nombre;
            $mail = $value -> correo;
            $area = $value -> area;
            $type_user = $value -> tipo_usuario;
            $gang = $value -> squad;
        }
        
    } else {
        echo '<br><div class="alert alert-danger container"><center><strong><h3>No hay usuarios para editar</h3></strong></center></div>';
    }
    
    ?>
    
    <!DOCTYPE html>
    <html>
    <head>
    <?php include '../../../assets/navs/links.php';
    include '../../../assets/navs/nav_modify.php';?>
    <link rel="stylesheet" type="text/css" href="../../../css/company.css">
    </head>
    <body><br><br>
    <div class="container col-sm-8 panel panel-body"><br><br>
    <img class="empresa_pic" src="../../../assets/img/usuario.png" style="margin-right: 15px;"><h3 style="margin-top: 10px;">Editar Usuario Existente</h3><br>
    <div class="card">
    <div class="card bg-danger text-white"><center><h6><strong>Para poder editar un usuario debes de llenar los campos correpondientes de este formulario</strong></h6></center></div>
    </div>
    
    <form method="POST" action="../../functions/mod/user_edit.php?<?php echo $usuario; ?>" class="border border-danger form-control">
    
    <label class="form"><strong>Usuario:</strong></label><br>
    <?php echo '<input name="usuario" class="form-control" type="text" value="'.$user.'" readonly><br>'; ?>
    
    <label class="form"><strong>Nombre Completo:</strong></label><br>
    <?php echo '<input name="nombre" class="form-control" type="text" value="'.$name.'"><br>'; ?>
    
    <label class="form"><strong>Correo Electrónico:</strong></label><br>
    <?php echo '<input name="correo" class="form-control" type="email" value="'.$mail.'"><br>'; ?>
    
    <label class="form"><strong>Área:</strong></label><br>
    <select name="area" class="form-control">
    <?php echo '<option class="form-control" value="'.$area.'">'.$area.' - (Actual)</option>'; ?>
    <option value="Direccion General">Dirección General</option>
    <option value="Gerencia General">Gerencia General</option>
    <option value="Ventas">Ventas</option>
    <option value="Sistemas">Sistemas</option>
    </select><br>
    
    <label class="form"><strong>Tipo de Usuario:</strong></label><br>
    <select name="tipo" class="form-control">
    <?php echo '<option value="'.$type_user.'">'.$type_user.' - (Actual)</option>'; ?>
    <option value="A">Administrador</option>
    <option value="G">Gerente</option>
    <option value="J">Jefatura</option>
    <option value="V">Vendedor</option>
    </select><br>
    
    <center><input type="submit" class="btn btn-success" name="guadar_cambios" value="Guardar"></center><br>
    </form>
    </div>
    <div><br></div>
    
    </body>
    </html>
    
    <?php include '../../../assets/subir.php';
    
} else {
    echo '<meta http-equiv="refresh" content="0;../../../index.php">';
}

?>
<script type="text/javascript" src="../../../js/subir.js"></script>