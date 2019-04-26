<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>



<div class="container">
		<div class="col-md-8 col-md-offset-2">
		<div class="panel">
			<div class="panel-heading">
				Tambah Transaksi
			</div>
			<div style="padding: 0px 15px;" id="dateNow"><?php $tgl=date('Y-m-d'); print($tgl);?></div>
			<div class="panel-body">
				<a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
				<br/>
				<br/>
				<form id="tambahTransaksi">
					<input type="hidden" id="aksi" name="aksi" value="tambah">
					<input type="hidden" id="id" name="id" value="">
					<div class="form-group">
						<label for="pelanggan">Pelanggan</label>
						<select class="form-control" name="pelanggan" id="pelanggan">
							<option value="">- Pilih Pelanggan</option>
							<?php
							//mengambil data dari pelanggan
							$data=mysqli_query($koneksi,"select * from pelanggan");

							//mengubah data ke array dan menampilkannya dengan perulangan while
							while ($d=mysqli_fetch_array($data)) {
							?>
								<option value="<?php echo $d['pelanggan_id']; ?>"><?php echo $d['pelanggan_nama']; ?></option>
							<?php 
							}
							?>
						</select>	
					</div>
					<div class="row">		
						<div class="form-group col-md-2">
							<table>
								<tr>
									<td><label for="berat">Berat</label></td>
									<td></td>
								</tr>
								<tr>
									<td><input type="number" id="berat" name="berat" class="form-control" placeholder="Masukan berat cucian ... " style="width: 60px;" min="0"></td>
									<td><label for="berat" style="padding-left: 7px; padding-top: 5px; font-weight: normal;">  KG</label></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<label>Tgl. Selesai</label>
							<input width=100px height=34px type="date" name="tgl_selesai" id="tgl_selesai" class="form-control"></input>
						</div>
					</div>
					<div class="pull-right">
						<a type="button" class="btn btn-md btn-info " onclick="addRow()"><i class="glyphicon glyphicon-plus-sign"></i> Daftar Cucian</a>
					</div>
					<br/>
					<br/>
					<table class="table table-border table-striped" id="cucian">
						<tr>
							<th width="5%" style="text-align: center;">No.</th>
							<th>Jenis Pakaian</th>
							<th width="20%">Jumlah</th>
							<th></th>
						</tr>
						<tbody id="tableCucian">
						<tr>
							<td><label name="nomor" id="nomor" align="center">1.</label></td>
							<td><input type="text" class="form-control" id="jenis_pakaian0" name="jenis_pakaian[0]"></td>
							<td><input type="number" class="form-control" min="0" id="jumlah_pakaian0" name="jumlah_pakaian[0]"></td>
							<td><button class="btn btn-sm btn-danger glyphicon glyphicon-remove" id="hapus" onclick="deleteRow(this)"></button></td>	
							<!-- <td><a class="btn-danger remove" id="remove"><i class="glyphicon glyphicon-remove" style="text-align: center;"></i></a></td> -->
						</tr>
						</tbody>
					</table>

					<input type="button" class="btn btn-primary" value="Simpan" onclick="validasiAddTransaksi()">
					<input type="reset" class="btn btn-danger" value="Batal">
				</form>
			</div>
		</div>
		</div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->



<script type="text/javascript">
	$("#pelanggan").select2();
</script>
<?php include 'footer.php'; ?>
