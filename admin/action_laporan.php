<?php include '../koneksi.php'; ?>

<?php 
	$tanggalDari = $_GET['tgl_dari'];
	$tanggalSampai = $_GET['tgl_sampai'];
	$newDari = date("d-m-Y", strtotime($tanggalDari));
	$newSampai = date("d-m-Y", strtotime($tanggalSampai));
?>

	<div class="panel">
		<div class="panel-heading">
			<h4>Data Laporan Laundry dari <b><?php echo $newDari; ?></b> sampai dengan <b><?php echo $newSampai; ?></b></h4>
		</div>

		<div class="panel-body">
			<a target="_blank" href="cetak_print.php?dari=<?php echo $tanggalDari; ?>&sampai=<?php echo $tanggalSampai; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK</a>
			<a target="_blank" href="cetak_pdf.php?dari=<?php echo $tanggalDari; ?>&sampai=<?php echo $tanggalSampai; ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK PDF</a>
			<br>
			<br>

			<table class="table table-bordered table-striped" id="tableSortir">
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
				$data=mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id and transaksi_tgl >= '$tanggalDari' and transaksi_tgl <= '$tanggalSampai' order by transaksi_id desc");

				$no = 1;

				// mengubah data ke array dan menampilkannya dengan perulangan while
				while ($d = mysqli_fetch_array($data)) {

					$TransaksiDate = $d['transaksi_tgl'];
					$newTransaksiDate = date("d-m-Y", strtotime($TransaksiDate));
					$finishDate = $d['transaksi_tgl_selesai'];
					$newFinishDate = date("d-m-Y", strtotime($finishDate));
				?>
					<tr class="count">
						<td><?php echo $no++;  ?></td>
						<td>INVOICE-<?php echo $d['transaksi_id'];?></td>
						<td><?php echo $newTransaksiDate;?></td>
						<td><?php echo $d['pelanggan_nama'];?></td>
						<td id="berat"><?php echo $d['transaksi_berat'];?></td>
						<td><?php echo $newFinishDate;?></td>
						<td><?php echo "Rp. ".number_format($d['transaksi_harga'],0,".",".") .",-";?></td>
						<td style="display: none;"><?php echo $d['transaksi_harga'];?></td>
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
	</div>

	<script type="text/javascript">
		var table = document.getElementById("tableSortir");
	    var rowCount = table.rows.length;
	    var row = table.insertRow(rowCount);
	    var jumlahReal = rowCount - 1;
		// var berat = document.getElementById("berat");
		var totalBerat = 0;
		var sumVal = 0;
		var sumVal1 = 0;
		
		for(var i=1; i<rowCount; i++){
			debugger
			sumVal = sumVal + parseInt(table.rows[i].cells[4].innerHTML);
			sumVal1 = sumVal1 + parseInt(table.rows[i].cells[7].innerText);
		}

		row.innerHTML = "<td colspan=\"3\" align=\"center\" style=\"background-color: #f8c400\"><b>TOTAL</b></td> <td align=\"center\" style=\"background-color: #f8c400\">"+jumlahReal+"</td> <td align=\"center\" style=\"background-color: #f8c400\">"+sumVal+"   (Kg)</td> <td align=\"center\" style=\"background-color: #f8c400\">-</td> <td align=\"center\" style=\"background-color: #f8c400\">" +rupiah(sumVal1, 'Rp. ')+"</td> <td align=\"center\" style=\"background-color: #f8c400\">-</td>";

		function rupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
				// rupiah1 = rupiah.join(',-');
			}
 			debugger
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah + ',-' : '');

		}

	</script>

