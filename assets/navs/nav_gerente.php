<?php session_start();
include 'links.php'; ?>

<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid">
		<div>
			<a class="navbar-brand">
				<img src="../../../assets/img/gerente_profile.png" title="Perfil de Gerente" alt="Perfil de Gerente" style="width:50px; border: solid;" class="rounded-pill">
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link nombre_vendedor"><strong><?php echo $_SESSION['nombre']; ?></strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link levantamientos" href="../../../admin/views/gerencia/">Inicio</a>
				</li>
				<!--li class="nav-item">
					<a class="nav-link levantamientos" href="../../../config/permissions/search/buscar_filtro.php">Buscar Filtros</a>
				</li-->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Clientes</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="../../../admin/views/gerencia/empresas_lista.php">Empresas</a></li>
						<li><a class="dropdown-item" href="../../../admin/views/gerencia/edificios_lista.php">Edificios</a></li>
						<li><a class="dropdown-item" href="../../../admin/views/gerencia/ubicaciones_lista.php">Ubicaciones</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Jefes Comerciales</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="jefes_lista.php">Ver Jefes</a></li>
						<li><a class="dropdown-item" href="jefes.php">Asignar Jefes</a></li>
					</ul>
				</li>
				<li class="nav-item">
				<a class="nav-link levantamientos" href="cuadrilla_lista.php">Cuadrillas</a></li>
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
					<a class="logout-button nav-link btn btn-sm btn-danger" href="../../../config/sessions/logout.php"><strong>Cerrar Sesión</strong> <img class="logout_img" src="../../../../comercial/assets/img/salir.png"></a>
				</ul>
			</div>
		</div>
	</nav>

	<style type="text/css">
		nav {
			background-color: #0C286F;
		}

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