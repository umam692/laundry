<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="container">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel">
			<div class="panel-heading">
				Edit Transaksi
			</div>
			<div style="padding: 0px 15px;"><?php $tgl=date('Y-m-d'); print($tgl);?></div>
			<div class="panel-body">
				<a href="transaksi.php?posisi=3" class="btn btn-sm btn-info pull-right"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
				<br/>
				<br/>

				<?php 
				// menangkap id yang dikirim melalui url
				// $id = $_GET['id'];
				// // $transaksi = mysqli_query($koneksi,"select * from transaksi");

				// // mengambil data transaksi yang ber id diatas dari tabel transaksi
				$data = mysqli_query($koneksi,"select a.*, b.pelanggan_id, b.pelanggan_nama 
					FROM transaksi as a join pelanggan as b ON a.transaksi_pelanggan=b.pelanggan_id
					WHERE a.transaksi_id = '".$_GET['id']."'");
				?>
	
				<form id="editTransaksi">
					<input type="hidden" id="aksi" name="aksi" value="edit">

					<?php 
					while ($d = mysqli_fetch_array($data)) {
					?>

					<div class="form-group">
						<label>Pelanggan</label>
						<input type="hidden" name="id" value="<?php echo $d['transaksi_id']; ?>" id="idPelanggan">
						<input type="text" name="pelanggan" class="form-control" value="<?php echo $d['pelanggan_nama']; ?>" id="pelanggan" disabled>	
					</div>
					<div class="row">
						<div class="form-group col-md-2">
							<table>
								<tr>
									<td><label for="berat">Berat</label></td>
									<td></td>
								</tr>
								<tr>
									<td><input type="number" name="berat" class="form-control" required="required" style="width: 60px;" min="0" value = "<?php echo $d['transaksi_berat'] ?>" id="berat"></td>
									<td><label for="berat" style="padding-left: 7px; padding-top: 5px; font-weight: normal;">  KG</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="form-group">
						<label>Tgl. Selesai</label>
						<input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="<?= $d['transaksi_tgl_selesai'] ?>">
					</div>
					<br/>
					<div class="pull-right">
						<button type="button" class="btn btn-sm btn-info" name="tambahCucian" id="tambahCucian" onclick="addRow()" style=""><i class="glyphicon glyphicon-plus-sign">Daftar Cucian</i></button>
					</div>
					<br/>
					
					<br/>

					<!-- select pakaian yang transaksi id =  -->

					<table class="table table-border table-striped">
						<tr>
							<th width="5%" style="text-align: center;">No.</th>
							<th>Jenis Pakaian</th>
							<th width="20%">Jumlah</th>
							<th></th>
						</tr>

						<tbody id="tableCucian">

						<?php 
						$data = mysqli_query($koneksi,"SELECT a.transaksi_id, a.transaksi_pelanggan, c.* FROM transaksi AS a JOIN pakaian AS c ON a.transaksi_id = c.pakaian_transaksi WHERE c.pakaian_transaksi = '".$_GET['id']."'");

						$num_rows = mysqli_num_rows($data);
						// echo $num_rows;
						$nomor = 1;

						while ($p = mysqli_fetch_array($data)) {

							$nomorIndex = ($nomor-1);
						?>					
							<tr>
								<input type="hidden" name="idPakaian[<?=$nomorIndex?>]" value="<?php echo $p['pakaian_id']; ?>" id="idPakaian[<?=$nomorIndex?>]">

								<td><label name="nomor" id="nomor" align="center" value=""><?= $nomor ?>.</label></td>
								<td><input type="text" class="form-control" id="jenis_pakaian<?=$nomorIndex?>" name="jenis_pakaian[<?=$nomorIndex?>]" value="<?= $p['pakaian_jenis'] ?>"></td>
								<td><input type="number" class="form-control" min="0" id="jumlah_pakaian<?=$nomorIndex?>" name="jumlah_pakaian[<?=$nomorIndex?>]" value="<?= $p['pakaian_jumlah'] ?>"></td>
								<td><button class="btn btn-sm btn-danger glyphicon glyphicon-remove" id="hapus" onclick="deleteRow(this)"></button></td>	
								<!-- <td><a class="btn-danger remove" id="remove"><i class="glyphicon glyphicon-remove" style="text-align: center;"></i></a></td> -->
							</tr>
						<?php 
							// }
							$nomor++;
						} 
						?>
						 
						</tbody>
					</table>

					<div class="form-group alert alert-info">
						<label>Status</label>
						<select class="form-control" name="status" required="required">
							<option <?php if($d['transaksi_status']=="0"){echo "selected='selected'";} ?> value="0">PROSES</option>
							<option <?php if($d['transaksi_status']=="1"){echo "selected='selected'";} ?> value="1">DI CUCI</option>
							<option <?php if($d['transaksi_status']=="2"){echo "selected='selected'";} ?> value="2">SELESAI</option>
						</select> 
					</div>

					<?php 
						}
				 	?>

					<input type="button" class="btn btn-primary" value="Update" onclick="validasiEditTransaksi()">
					<a href="transaksi.php?posisi=3" type="button" class="btn btn-danger">Batal</a>


				</form>
			</div>
		</div>
		</div>
</div>

<?php include 'footer.php'; ?>