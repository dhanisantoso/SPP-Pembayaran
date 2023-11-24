<?php
include 'koneksi.php';

if (empty($_SESSION['user'])) {
	header('location: login.php');
}

if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == 'admin') {
	$level='admin';
}elseif (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == 'petugas') {
	$level='petugas';
}else{
	$level='siswa';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>Pembayaran SPP -
		<?php
		$page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';
		$cek = preg_replace('/-/', ' ', $page);
		$title = ucwords($cek);
		echo $title;
		?>
	</title>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
					<span class="align-middle">Aplikasi Pembayaran SPP</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Halaman
					</li>

					<li class="sidebar-item 
					<?php
					if (empty($_GET['page'])) {
						echo 'active';
					}
					?>">
						<a class="sidebar-link" href="index.php">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item 
					<?php
					if ($page == 'petugas'  || $page == 'tambahpetugas' || $page == 'edit_petugas') {
						echo 'active';
					}
					?>
					" <?php if ($level == 'petugas' || $level == 'siswa') {
						echo 'hidden';
					} ?>>
						<a class="sidebar-link" href="?page=petugas">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Petugas</span>
						</a>
					</li>

					<li class="sidebar-item 
					<?php
					if ($page == 'kelas' || $page == 'tambahkelas' || $page == 'edit_kelas') {
						echo 'active';
					}
					?>
					" <?php if ($level == 'petugas' || $level == 'siswa') {
						echo 'hidden';
					} ?>>
						<a class="sidebar-link" href="?page=kelas">
							<i class="align-middle" data-feather="home"></i> <span class="align-middle">Kelas</span>
						</a>
					</li>

					<li class="sidebar-item
					<?php
					if ($page == 'siswa' || $page == 'tambahsiswa' || $page == 'edit_siswa') {
						echo 'active';
					}
					?>
					" <?php if ($level == 'siswa') {
						echo 'hidden';
					} ?>>
						<a class="sidebar-link" href="?page=siswa">
							<i class="align-middle" data-feather="user"></i> <span class="align-middle">Siswa</span>
						</a>
					</li>

					<li class="sidebar-item
					<?php
					if ($page == 'spp' || $page == 'tambahspp' || $page == 'edit_spp') {
						echo 'active';
					}
					?>
					" <?php if ($level == 'petugas' || $level == 'siswa') {
						echo 'hidden';
					} ?>>
						<a class="sidebar-link" href="?page=spp">
							<i class="align-middle" data-feather="book-open"></i> <span class="align-middle">SPP</span>
						</a>
					</li>
					
					<li class="sidebar-item
					<?php
					if ($page == 'history') {
						echo 'active';
					}
					?>
					" <?php if ($level == 'siswa') {
						echo 'hidden';
					} ?>>
						<a class="sidebar-link" href="?page=history">
							<i class="align-middle" data-feather="book-open"></i> <span class="align-middle">History Pembayaran</span>
						</a>
					</li>
					

				</ul>
				<div class="sidebar-cta" <?php if (empty($_SESSION['user']['nama_petugas'])) {
					echo 'hidden';
				}?>>
				<div class="sidebar-cta-content">
					<div class="d-grid">
						<a href="?page=pembayaran" class="btn btn-primary">+ Transaksi Pembayaran</a>
					</div>
				</div>
				</div>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								 <span class="text-dark"><i data-feather="user"></i>   <?php if ($level == 'siswa') {
									echo $_SESSION['user']['nama'];
								 }else {
									echo $_SESSION['user']['nama_petugas'];
								 }

								  ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<?php
					$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
					include $page . '.php';

					?>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin
										Template</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>