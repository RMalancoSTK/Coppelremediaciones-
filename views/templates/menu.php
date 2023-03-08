<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<a class="navbar-brand ps-3" href="<?= BASE_URL ?>"><?= TITLE_APP ?></a>
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!" data-target="#navbarNav">
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse justify-content-end">
			<ul class="navbar-nav">
				<li class="nav-item">
					<span class="nav-link text-white">Bienvenido <?= $_SESSION['usuario'] ?></span>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user fa-fw"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#!">Mi perfil</a>
						<a class="dropdown-item" href="#!">Cambiar contraseña</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?= BASE_URL ?>login/logout">Cerrar sesión</a>
					</div>
				</li>
			</ul>
		</div>

	</nav>

	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<a class="nav-link" href="<?= BASE_URL ?>">
							<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
							Dashboard
						</a>

						<?php foreach ($this->menu['nombre_menu'] as $i => $dato) : ?>

							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#<?= $dato ?>collapse" aria-expanded="false" aria-controls="<?= $dato ?>collapse">
								<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
								<?= $dato ?>
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
							<div class="collapse" id="<?= $dato ?>collapse" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
								<nav class="sb-sidenav-menu-nested nav">
									<?php foreach ($this->menu['submenu'][$i]['nombre'] as $j => $submenu) : ?>
										<a class="nav-link" href="<?= $this->menu['submenu'][$i]['url'][$j] ?>"><?= $submenu ?></a>
									<?php endforeach; ?>
							</div>
						<?php endforeach; ?>


					</div>
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4">