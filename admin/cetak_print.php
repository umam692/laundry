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
		header("location:../admin/index.php?pesan=belum_login");		
	}
	?>

	<!-- KONEKSI DATABASE -->
	<?php 	
	include '../koneksi.php';
	?>

	<div class="container">	
		<h2 align="center"> Laundry " MALAS NGODING "</h2>
		<br>	
		<br>	

		<?php 	
			if (isset($_GET['dari']) && isset($_GET['sampai'])) {
				$dari = $_GET['dari'];
				$newDari = date('d-m-Y', strtotime($dari));
				$sampai = $_GET['sampai'];
				$newSampai = date('d-m-Y', strtotime($sampai));
			}
		?>
		<h4>Data Laporan Laundry dari <b><?php echo $newDari; ?></b> sampai dengan <b><?php echo $newSampai; ?></b></h4>
		<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No.</th>
					<th>Invoice</th>
					<th>Tanggal</th>
					<th>Pelanggan</th>
					<th>Berat (Kg)</th>
					<th>Tgl. Selesai</th>
					<th>Harga</th>
					<th>Status</th>
				</tr>

				<?php 
				// koneksi database
				include '../koneksi.php';

				// mengambil data pelanggan dari database
				$data=mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id and transaksi_tgl >= '$dari' and transaksi_tgl <= '$sampai' order by transaksi_id desc");

				$no = 1;

				// mengubah data ke array dan menampilkannya dengan perulangan while
				while ($d = mysqli_fetch_array($data)) {

					$TransaksiDate = $d['transaksi_tgl'];
					$newTransaksiDate = date("d-m-Y", strtotime($TransaksiDate));
					$finishDate = $d['transaksi_tgl_selesai'];
					$newFinishDate = date("d-m-Y", strtotime($finishDate));
				?>
					<tr>
						<td><?php echo $no++;  ?></td>
						<td>INVOICE-<?php echo $d['transaksi_id'];?></td>
						<td><?php echo $newTransaksiDate;?></td>
						<td><?php echo $d['pelanggan_nama'];?></td>
						<td><?php echo $d['transaksi_berat'];?></td>
						<td><?php echo $newFinishDate;?></td>
						<td><?php echo "Rp. ".number_format($d['transaksi_harga'],0,".",".") .",-";?></td>
						<td><?php if ($d['transaksi_status']==0) {
									echo "<div class='label label-warning'>PROSES</div>";
								} elseif ($d['transaksi_status']==1) {
									echo "<div class='label label-info'>DICUCI</div>";
								} elseif ($d['transaksi_status']==2) {
									echo "<div class='label label-info'>SELESAI</div>";
								}
							?>
						</td>	
					</tr>
				<?php 
				}
				 ?>
			</table>
	</div>

	<script type="text/javascript"> window.print()	</script>
</body>
</html>