<?php include 'header.php'; ?>

<?php include '../koneksi.php'; ?>

<div class="container">
	<div class="alert alert-info text-center">
		<h4 style="margin-bottom: 0px"><b>Selamat Datang!</b> di Sistem Informasi Laundry</h4>
	</div>

	<div class="panel">
		<div class="panel-heading">
			<h4>Dashboard</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-primary" style="background-color: #337ab7; color:#fff">
					<a href="pelanggan.php?posisi=2"> 
						<div class="panel-heading" style="color:#fff">
							<h1><i class="glyphicon glyphicon-user" ></i><span class="pull-right">	
								<?php 	
									$pelanggan = mysqli_query($koneksi,"select * from pelanggan");
									echo mysqli_num_rows($pelanggan);
								 ?>						
							</span>
							</h1>
							Jumlah Pelanggan	
						</div>
					</a>
					</div>
				</div>	

				<div class="col-md-3">	
					<div class="panel panel-warning" style="background-color: #fcf8e3; color: #8a6d3b; border-color: #faebcc">
						<a href="transaksi_proses.php?posisi=3"> 
						<div class="panel-heading" style="color: #8a6d3b">
							<h1><i class="glyphicon glyphicon-retweet"></i><span class="pull-right"><?php 
								$proses=mysqli_query($koneksi,"select * from transaksi where transaksi_status = 0");
								echo mysqli_num_rows($proses);
							 ?></span></h1>
							Jumlah Cucian Di Proses
						</div>
						</a>
					</div>
				</div>

				<div class="col-md-3">	
					<div class="panel panel-info" style="color: #31708f; background-color: #d9edf7">
						<a href="transaksi_dicuci.php?posisi=3"> 
						<div class="panel-heading" style="color: #31708f;">	
							<h1><i class="glyphicon glyphicon-info-sign"></i><span class="pull-right">
								<?php 	
									$dicuci = mysqli_query($koneksi,"select * from transaksi where transaksi_status = 1");
									echo mysqli_num_rows($dicuci);
								 ?>
							</span></h1>
							Jumlah Cucian Siap Ambil
						</div>
						</a>
					</div>
				</div>

				<div class="col-md-3">	
					<div class="panel panel-success" style="color: #3c763d; background-color: #dff0d8">
						<a href="transaksi_selesai.php?posisi=3"> 
						<div class="panel-heading" style="color: #3c763d;">	
							<h1><i class="glyphicon glyphicon-ok-circle"></i><span class="pull-right">
								<?php 	
									$selesai = mysqli_query($koneksi,"select * from transaksi where transaksi_status = 2");
									echo mysqli_num_rows($selesai);
								 ?>
							</span></h1>
							Transaksi Selesai
						</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div class="panel">	
		<div class="panel-heading">	
			<h4>Riwayat Transaksi Terakhir</h4>
		</div>

		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped"  id="tableFilter">
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
					//mengambil data pelanggan dari database
					$data=mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id order by transaksi_id desc limit 7");

					$no=1;
					//Mengubah data ke array dan menampilkannya dengan perulangan while

					while ($d=mysqli_fetch_array($data)) {
					?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td>INVOICE-<?php echo $d['transaksi_id']?></td>
							<td><?php echo $d['transaksi_tgl']?></td>
							<td><?php echo $d['pelanggan_nama']?></td>
							<td><?php echo $d['transaksi_berat']?></td>
							<td><?php echo $d['transaksi_tgl_selesai']?></td>
							<td><?php echo "Rp. ".number_format($d['transaksi_harga'],0,".",".") .",-"?></td>
							<td><?php if($d['transaksi_status']==0) { 
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
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>