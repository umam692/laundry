<?php include 'header.php'; ?>

<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<h4>Filter Laporan</h4>
		</div>
	
		<div class="panel-body">
			<form id="laporan">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Dari Tanggal</th>
						<th>Sampai Tanggal</th>
						<th width="1%"></th>
					</tr>
					<tr>
						<td>
							</br>
							<input type="date" id="tgl_dari" name="tgl_dari" class="form-control">
						</td>
						<td>
							</br>
							<input type="date" id="tgl_sampai" name="tgl_sampai" class="form-control">
						</td>
						<td>
							</br>
							<input type="button" class="btn btn-primary" value="Filter" onclick="validasiFilterLaporan()">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

	<div class="panel">
			<div class="panel-body" id="panelBody">
				<div id="heading"></div>
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

					<tbody id="isi-tabel"></tbody>
				</table>
			</div>
	</div>
</div>


<?php include 'footer.php'; ?>