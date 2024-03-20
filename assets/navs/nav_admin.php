<?php session_start();
include 'links.php'; ?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
	<div class="container-fluid">
		<div>
			<a class="navbar-brand">
				<img src="../../../assets/img/admin_profile.png" alt="Perfil de Vendedor" style="width:50px;" class="rounded-pill">
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link nombre_vendedor"><strong><?php echo $_SESSION['nombre'] ?></strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link nombre_vendedor" href="index.php">Inicio</a>
				</li>
				<!--li class="nav-item">
					<a class="nav-link" href="#">Levantamientos</a>
				</li-->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Ajustes</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="../../../config/permissions/add/add_user.php">Alta de Usuarios</a></li>
						<li><a class="dropdown-item" href="user_list.php">Lista de Usuarios</a></li>
						<li><a class="dropdown-item" href="change_pass.php">Cambio de Contraseñas</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Alta Clientes</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Empresas</a></li>
						<li><a class="dropdown-item" href="#">Edificios</a></li>
						<li><a class="dropdown-item" href="#">Ubicaciónes</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Lista Clientes</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Empresas</a></li>
						<li><a class="dropdown-item" href="#">Edificios</a></li>
						<li><a class="dropdown-item" href="#">Ubicaciónes</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Cuadrillas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link levantamientos" href="../../../assets/lib/reports/FV-06-8-010_formatoSGC.php" target="_blank">Formato Levantamientos SGC</a>
				</li>
				<li class="nav-item">
					<a class="nav-link levantamientos" href="../../../config/permissions/mod/change_pass.php">Cambiar contraseña privada</a>
				</li>
				<li class="nav-item">
					<a class="nav-link levantamientos" href="https://veco.lat/soporte.php" target="_blank">Soporte Técnico</a>
				</li>
				<li class="logout nav-item">
					<!--a class="logout-button nav-link" href="">Cerrar Sesión</a-->
					<a class="logout-button nav-link btn btn-sm btn-danger" href="../../../config/sessions/logout.php"><strong>Cerrar Sesión</strong> <img class="logout_img" src="../../../../comercial/assets/img/salir.png"></a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<style type="text/css">
	.nombre_vendedor {
		color: white;
	}

	.nombre_vendedor:hover {
		color: white;
		cursor: pointer;
	}

	.nav-link {
		color: white;
	}

	.nav-link:hover {
		background-color: white;
		color: black;
	}

	.logout {
		background-color: red;
		border-radius: 5px;
	}

	.logout-button:hover {
		background-color: orange;
		border-radius: 5px;
		color: red;
	}

	.logout_img {
		height: 25px;
		width: 25px;
		border-radius: 10px;
	}
</style>