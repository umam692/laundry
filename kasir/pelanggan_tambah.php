<?php include 'header.php'; ?>

<script type="text/javascript" src="../assets/validasi.js"></script>

<div class="container">
	<br/>
	<br/>
	<br/>
	<br/>
	<div class="col-md-4 col-md-offset-4">
		<div class="panel">
			<div class="panel-heading">
				<h4>Tambah Pelanggan Baru</h4>
			</div>
			<div class="panel-body">
				<form id="tambahPelanggan">
					<input type="hidden" id="aksi" name="aksi" value="tambah">
					<input type="hidden" id="id" name="id" value="">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" placeholder="masukan nama .." id="pelanggan_nama" name="pelanggan_nama">
					</div>
					<div class="form-group">
						<label>HP</label>
						<input type="number" class="form-control" placeholder="masukan no.Hp .." id="pelanggan_hp" name="pelanggan_hp">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" placeholder="masukan alamat .." id="pelanggan_alamat" name="pelanggan_alamat">
					</div>

					<input type="button" class="btn btn-primary" value="Simpan" onclick="validasiAddPelanggan()">
					<a href="pelanggan.php" class="btn btn-danger">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>