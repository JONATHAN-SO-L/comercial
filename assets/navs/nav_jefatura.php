<?php include 'links.php'; ?>

<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid">
		<div>
			<a class="navbar-brand">
				<img src="../../../assets/img/jefatura_profile.png" alt="Perfil de Vendedor" style="width:50px; border: solid;" class="rounded-pill">
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
					<a class="nav-link" href="levantamientos.php">Levantamientos</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Alta de Clientes</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Empresa</a></li>
						<li><a class="dropdown-item" href="#">Edificio</a></li>
						<li><a class="dropdown-item" href="#">Ubicación</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Lista de Clientes</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Empresa</a></li>
						<li><a class="dropdown-item" href="#">Edificio</a></li>
						<li><a class="dropdown-item" href="#">Ubicación</a></li>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Integrantes de Cuadrilla</a>
				</li>
				<li class="logout nav-item">
					<a class="logout-button nav-link btn btn-sm btn-danger" href="../../../config/sessions/logout.php"><strong>Cerrar Sesión</strong> <img class="logout_img" src="../../../../comercial/assets/img/salir.png"></a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<style type="text/css">
	nav {
		background-color: #2C79AF;
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
		background-color: black;
		color: white;
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