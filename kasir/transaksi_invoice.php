<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistem Informasi Laundry - WWW.MALASNGODING.COM</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>
<body>
	<!-- CEK APAKAH SUDAH LOGIN -->
	<?php 
	session_start();
	if ($_SESSION['status']!="login") {
		header("location:../index.php?pesan=belum login");
	}
	?>

	<?php 
	// koneksi database
	include '../koneksi.php';
	?>
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<?php 
			// menangkap id yang dikirim melalui url
			$id = $_GET['id'];
			
			// mengambil data pelanggan yang ber id di atas dari database
			$transaksi = mysqli_query ($koneksi, "select * from transaksi, pelanggan where transaksi_id='$id' and transaksi_pelanggan=pelanggan_id" );
				while ($t=mysqli_fetch_array($transaksi)) {
			?>
				<center><h2>LAUNDRY "Malas Ngoding"</h2></center>
				<div class="pull-right">
					<a href="transaksi.php" class="btn btn-sm btn-info "><i class="glyphicon glyphicon-repeat"></i> KEMBALI</a>
				

					<a href="transaksi_invoice_cetak.php?id=<?php echo $id; ?>" target="_blank" class="btn btn-sm btn-primary "><i class="glyphicon glyphicon-print"></i> CETAK</a>
				</div>
				

				<br/>
				<br/>
				
				<table class="table">
					<tr>
						<th width="20%">No. Invoice</th>
						<th width="5%">:</th>
						<td>INVOICE-<?php echo $t['transaksi_id'];  ?></td>
					</tr>
					<tr>
						<th width="20%">Tgl. Laundry</th>
						<th>:</th>
						<td><?php echo $t['transaksi_tgl'];  ?></td>
					</tr>
					<tr>
						<th width="20%">Nama Pelanggan</th>
						<th>:</th>
						<td><?php echo $t['pelanggan_nama'];  ?></td>
					</tr>
					<tr>
						<th width="20%">HP</th>
						<th>:</th>
						<td><?php echo $t['pelanggan_hp'];  ?></td>
					</tr>
					<tr>
						<th width="20%">Alamat</th>
						<th>:</th>
						<td><?php echo $t['pelanggan_alamat'];  ?></td>
					</tr>
					<tr>
						<th width="20%">Berat Cucian</th>
						<th>:</th>
						<td><?php echo $t['transaksi_berat'];  ?></td>
					</tr>
					<tr>
						<th width="20%">Tgl. Selesai</th>
						<th>:</th>
						<td><div class="label label-warning"><?php echo $t['transaksi_tgl_selesai'];  ?></div></td>
					</tr>
					<tr>
						<th width="20%">Status</th>
						<th>:</th>
						<td><?php if($t['transaksi_status']==0) { 
									echo "<div class='label label-warning'>PROSES</div>";
									} elseif ($t['transaksi_status']==1) { 
									echo "<div class='label label-info'>DICUCI</div>";
									} elseif ($t['transaksi_status']==2) { 
									echo "<div class='label label-info'>SELESAI</div>";
									}
							?>
						</td>
					</tr>
					<tr>
						<th width="20%">Harga</th>
						<th>:</th>
						<td><?php echo "Rp. ".number_format($t['transaksi_harga'],0,".",".") .",-"?></td>
					</tr>
				</table>

				<center><h3>"Daftar Cucian"</h3></center>
				<table class="table table-bordered table-striped">
					<th bgcolor="aqua">Jenis Pakaian</th>
					<th width="20%" bgcolor="aqua">Jumlah</th>

					<?php 
					// menyimpan id transaksi ke variabel
					$id = $t['transaksi_id'];

					// menampilkan pakaian-pakaian dari id transaksi diatas
					$pakaian = mysqli_query($koneksi,"select * from pakaian where pakaian_transaksi = '$id'");
					while ($p=mysqli_fetch_array($pakaian)) {
					?>

					<tr>
						<td><?php echo $p['pakaian_jenis']; ?></td>
						<td width="5%"><?php echo $p['pakaian_jumlah']; ?></td>
					</tr>

					<?php 
						}					
					?>	
				</table>			
				<?php 
				}	
				?>
		</div>
	</div>
</body>
</html>