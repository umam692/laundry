<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Laundry</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<style type="text/css" src="../assets/style.css"></style>
	<script type="text/javascript" src="../assets/js/sweetalert2.all.js"></script>
	<script type="text/javascript" src="../assets/js/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="../assets/js/sweetalert2.js"></script>
	<script type="text/javascript" src="../assets/js/sweetalert2.min.js"></script>	
	<link href="../assets/select2/select2.min.css" rel="stylesheet" />
	<script type="text/javascript" src="../assets/select2/select2.min.js"></script>

</head>
<body style="background: linear-gradient(180deg,brown,#441919); background-attachment: fixed; ">
	<!-- Cek apakah sudah login-->
	<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../index.php?pesan=belum login");
	}

	$posisi = $_GET['posisi'];
	$class1 = $class2 = $class3 = $class4 = "";

	if($posisi == 1){
		$class1 = "active";

		$class2 = $class3 = $class4  = "";
	}else if($posisi == 2){
		$class2 = "active";

		$class1 = $class3 = $class4  = "";
	}else if($posisi == 3){
		$class3 = "active";

		$class1 = $class2 = $class4  = "";
	}else if($posisi == 4){
		$class4 = "active";

		$class1 = $class3 = $class2  = "";
	}else if($posisi == 5){
		$class5 = "active";

		$class1 = $class3 = $class2  = $class5 = "";
	}

	?>

	<!-- Menu Navigasi -->
	<div id="topheader">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
					data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="tes.html"><img src="../image/bunga.png" alt="" width="50" height="30" class="d-inline-block align-top"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
					<ul class="nav navbar-nav"> 
							<li class="<?=$class1?>"><a href="index.php?posisi=1"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
							<li class="<?=$class2?>"><a href="pelanggan.php?posisi=2"><i class="glyphicon glyphicon-user"></i> Pelanggan</a></li>
							<li class="<?=$class3?>"><a href="transaksi.php?posisi=3"><i class="glyphicon glyphicon-random"></i> Transaksi</a></li> 
							<li class="<?=$class4?>"><a href="laporan.php?posisi=4"><i class="glyphicon glyphicon-list-alt"></i> Laporan</a></li>
							<li class="<?=$class5?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> Pengaturan <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="harga.php?posisi=5"><i class="glyphicon glyphicon-usd"></i> Pengaturan Harga</a></li>
									<li><a href="ganti_password.php?posisi=5"><i class="glyphicon glyphicon-lock"></i> Ganti Password</a></li> 
								</ul> 
							</li>
							<li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right"> 
						<li><p class="navbar-text">Halo, <b><?php echo $_SESSION['username']; ?></b> !</p></li>
						<li><button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>
					</ul> 
				</div>
			</div>
		</nav>
		<!-- Akhir Menu Navigasi -->
	</div>


	<!-- <?php include 'footer.php';?> -->



	