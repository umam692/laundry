<?php include 'header.php';?>

<div class="container">
	<br/>
	<br/>
	<br/>
	<div class="col-md-5 col-md-offset-3">
		<div class="panel">
			<div class="panel-heading">
				<h4>Edit Pelanggan</h4>
			</div>
			<div class="panel-body">
				<?php 
				//menghubungkan koneksi
				include '../koneksi.php';

				//menangkap id yang dikirim melalui url
				$id = mysqli_real_escape_string($koneksi,$_GET['id']) ;

				//mengambil data pelanggan yang ber id diatas tabel pelanggan
				$data = mysqli_query($koneksi,"select * from pelanggan where pelanggan_id='$id'");

				while ($d=mysqli_fetch_array($data)) {
				?>

				<form id="editPelanggan">
					<div class="form-group">
						<label>Nama</label>
						<!-- Form id pelanggan yang di edit, untuk dikirim ke file aksi -->
						<input type="hidden" name="aksi" value="edit" id="aksi">
						<input type="hidden" name="id" value="<?php echo $d['pelanggan_id']; ?>" id="id">
						<input type="text" class="form-control" name="pelanggan_nama" placeholder="Masukan nama .." value="<?php echo $d['pelanggan_nama']; ?>" id="pelanggan_nama">
					</div>
					<div class="form-group">
						<label>HP</label>
						<input type="number" class="form-control" name="pelanggan_hp" value="<?php echo $d['pelanggan_hp']; ?>" id="pelanggan_hp">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="pelanggan_alamat" value="<?php echo $d['pelanggan_alamat']; ?>" id="pelanggan_alamat">
					</div>
					<br/>
					<input type="button" class="btn btn-primary" value="Update" onclick="validasiEditPelanggan()">
					<a href="pelanggan.php?posisi=2&&id=<?php echo $d['pelanggan_id']; ?>" class="btn btn-danger">Batal</a>
				</form>

				<?php
				  }
				?>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php';?>