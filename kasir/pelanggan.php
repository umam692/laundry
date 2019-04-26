<?php include 'headerKasir.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Data Pelanggan</h4>
		</div>
		<div class="panel-body">
			<a href="pelanggan_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
			<br/>
			<br/>
			<table class="table table-bordered table-striped">
				<tr>
					<th width="1%">No</th>
					<th>Nama</th>
					<th>HP</th>
					<TH>Alamat</TH>
					<th width="15%">OPSI</th>
				</tr>

				<?php
				//koneksi database
				include '../koneksi.php';

				//mengambil data pelanggan dari database
				$data = mysqli_query($koneksi,"select * from pelanggan");
				$no = 1;

				//mengubah data ke array dan menampilkannya dengan perulangan while
				while ($d = mysqli_fetch_array($data)) {
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['pelanggan_nama']?></td>
						<td><?php echo $d['pelanggan_hp']?></td>
						<td><?php echo $d['pelanggan_alamat']?></td>
						<td>
							<a href="pelanggan_edit.php?id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-sm btn-info">Edit</a>
							<a class="btn btn-sm btn-danger" onclick="validasiHapusPelanggan(event,<?=$d['pelanggan_id']; ?>)" id="hapus">Hapus</a>
						</td>
					</tr>
					<?php	
				}
				?>
			</table>
		</div>
	</div>
</div>

