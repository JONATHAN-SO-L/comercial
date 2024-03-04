<?php
include 'links.php';
?>

<nav class="navbar navbar-expand-sm fixed-top">
	<div class="container-fluid">
		<div>
			<a class="navbar-brand">
				<img src="../../../assets/img/buscar.png" alt="Perfil de ajustes" style="width:45px;" class="rounded-pill">
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
					<?php
					switch ($_SESSION['tipo']) {
						case 'A':
						echo '<a class="nav-link levantamientos" href="../../../admin/views/admin/">Inicio</a>';
						break;

						case 'G':
						echo '<a class="nav-link levantamientos" href="../../../admin/views/gerencia/">Inicio</a>';
						break;

						case 'J':
						echo '<a class="nav-link levantamientos" href="../../../admin/views/jefatura/">Inicio</a>';
						break;

						case 'V':
						echo '<a class="nav-link levantamientos" href="../../../admin/views/vendedor/">Inicio</a>';
						break;
						
						default:
						echo '<meta http-equiv="refresh" content="0;../../index.php">';
						break;
					}
					?>
				</li>
				<li class="nav-item">
					<a class="nav-link nombre_vendedor" href="#">Buscar</a>
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
		background-color: #0A6F9E;
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
