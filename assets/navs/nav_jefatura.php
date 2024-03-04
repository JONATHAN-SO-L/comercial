<?php include 'links.php'; ?>

<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid">
		<div>
			<a class="navbar-brand">
				<img src="../img/jefatura_profile.png" alt="Perfil de Vendedor" style="width:45px;" class="rounded-pill">
			</a>
		</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link nombre_vendedor"><strong>JONATHAN</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Levantamientos</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Clientes</a>
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
					<a class="logout-button nav-link" href="">Cerrar Sesión</a>
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
</style>