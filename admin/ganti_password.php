<?php include 'header.php'; ?>

<div class="container">
	<br/>
	<br/>
	<br/>

	<div class="col-md-5 col-md-offset-3">
		<?php 
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == "oke") {
				echo "<div class='alert alert-success'>Password telah diganti!</div>";
			}
		}
		?>

		<div class="panel">
			<div class="panel-heading">
				<h4>Ganti Password</h4>
			</div>
			<div class="panel-body">
				<form method="post" action="ganti_password_aksi.php">
					<div class="form-group">
						<label>Masukan Password Baru</label>
						<input type="Password" class="form-control" name="password_baru" placeholder="Masukan Password Baru Anda ...">
					</div>
					<br/>
					<input type="submit" class="btn btn-prymary" value="Ganti Password">
				</form>
			</div>
		</div>	
	</div>
</div>

<?php include 'footer.php'; ?>