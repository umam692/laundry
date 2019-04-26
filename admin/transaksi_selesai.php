<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4><b>Data Transaksi Laundry</b></h4>
		</div>
		<div class="panel-body">
			<a href="transaksi_tambah.php?posisi=3" class="btn btn-sm btn-info pull-right"><i class="glyphicon glyphicon-plus"></i> Transaksi Baru</a>
			<br/>
			<br/>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">NO.</th>
					<th>Invoice</th>
					<th>Tanggal</th>
					<th>Pelanggan</th>
					<th>Berat</th>
					<th>Tgl. Selesai</th>
					<th>Harga</th>
					<th>Status</th>
					<th width="20%">OPSI</th>
				</tr>

				<?php 
				//koneksi_database
				include '../koneksi.php';

				//mengambil data pelanggan dari database
				$data=mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id and transaksi_status=2 order by transaksi_id desc");

				$no=1;
				//Mengubah data ke array dan menampilkannya dengan perulangan while

				while ($d=mysqli_fetch_array($data)) {
				?>
					<tr>
						<td align="center"><?php echo $no++; ?>.</td>
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
						<td>
							<a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-warning">Invoice</a>
							<a href="transaksi_edit.php?posisi=3&&id=<?php echo $d['transaksi_id']; ?>" class="btn btn-sm btn-info">Edit</a>
							<a class="btn btn-sm btn-danger" onclick="validasiHapusTransaksi(event,<?=$d['transaksi_id']; ?>)" id="hapus">Batalkan</a>
						</td>
					</tr>
					<?php	
				}
				?>
			</table>
		</div>
	</div>
</div>

<?php include 'footer.php';?>