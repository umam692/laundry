<?php include '../koneksi.php';


$aksi = $_POST['aksi'];



if ($aksi){
    switch($aksi){
        case "tambah":
            tambah($koneksi);
            break;
        case "edit":
            edit($koneksi);
            break;
        case "hapus":
            hapus($koneksi);
            break;
        case "filter":
            filter($koneksi);
            break;
    }
}

function tambah($koneksi){

	$pelanggan = $_POST['pelanggan'];
	$berat = $_POST['berat'];
	$tgl_selesai = $_POST['tgl_selesai'];
	$tgl_hari_ini = date('Y-m-d');
	$status = 0;

	// mengambil Harga dari database
	$h=mysqli_query($koneksi,"select harga_per_kilo from harga");
	$harga_per_kilo = mysqli_fetch_assoc($h);

	$harga = $berat * $harga_per_kilo['harga_per_kilo'];

	// menginput data ke tabel transaksi
	mysqli_query($koneksi,"insert into transaksi values('','$tgl_hari_ini','$pelanggan','$harga','$berat','$tgl_selesai','$status')");

	// menyimpan id dari data yang di simpan pada query insert data sebelumnya
	$id_terakhir = mysqli_insert_id($koneksi);

	//menangkap data form input array (jenis dan jumlah pakaian)
	$jenis_pakaian = $_POST['jenis_pakaian'];
	$jumlah_pakaian = $_POST['jumlah_pakaian']; 

	// mengambil data transaksi join pakaian yang ber id transaksi sama
	$data = mysqli_query ($koneksi,"select a.transaksi_id,a.transaksi_pelanggan, b.* from transaksi as a join pakaian as b
	ON a.transaksi_id = b.pakaian_transaksi
	WHERE a.transaksi_id = '$id_terakhir'");

	// input data cucian berdasarkan id transaksi (invoice) ke table pakaian
	for ($i=0; $i < count($jenis_pakaian) ; $i++) { 
		if ($jenis_pakaian[$i] != "") {
			 mysqli_query($koneksi,"insert into pakaian values('','$id_terakhir','$jenis_pakaian[$i]','$jumlah_pakaian[$i]')");
		}
	}

}


function hapus($koneksi){
	$idTransaksi = $_POST['id'];

	// menghapus transaksi
	mysqli_query($koneksi,"delete from transaksi where transaksi_id='".$idTransaksi."'");

	// menghapus data pakaian di dalam transaksi
	mysqli_query($koneksi,"delete from pakaian where pakaian_transaksi='".$idTransaksi."'");

}

function edit($koneksi){
	
	//menangkap data yang dikirim dari form]
	$id = $_POST['id'];
	$status = $_POST['status'];
	$pelanggan = $_POST['pelanggan'];
	$berat = $_POST['berat'];
	$tgl_selesai = $_POST['tgl_selesai'];
	// $harga = 6500;
	$jenis_pakaian = $_POST['jenis_pakaian'];
	$pakaian_id = $_POST['idPakaian'];
	$jumlah_pakaian = $_POST['jumlah_pakaian'];
	
	// mengambil harga dari database
	 $h = mysqli_query($koneksi, "select * from harga");

	 $harga_per_kilo = mysqli_fetch_array($h);

	 $harga = $berat * $harga_per_kilo['harga_per_kilo'];

	//lakukan update di table transaksi	
	mysqli_query($koneksi,"update transaksi set transaksi_harga = '".$harga."', transaksi_berat = '".$berat."', transaksi_tgl_selesai = '".$tgl_selesai."', transaksi_status= '".$status."' WHERE transaksi_id = '".$id."'");

	for ($i=0; $i < count($jenis_pakaian) ; $i++) { 
		if ($pakaian_id[$i]==0) {
			mysqli_query($koneksi,"INSERT INTO pakaian (pakaian_transaksi, pakaian_jenis, pakaian_jumlah) VALUES (".$id.",'".$jenis_pakaian[$i]."' ,'".$jumlah_pakaian[$i]."')");		
		} else {
			mysqli_query($koneksi,"UPDATE pakaian SET pakaian_jenis = '".$jenis_pakaian[$i]."', pakaian_jumlah = '".$jumlah_pakaian[$i]."' WHERE pakaian_id = '".$pakaian_id[$i]."' ");
		}
	}	
}


function filter($koneksi) {


	$isi = $_POST['isi'];

	// if($isi = array("pro","pros","prose","proses")) {
	//   $cariProses = 0;
	// } elseif ($isi = array("dic","dicu","dicuc","dicuci")) {
	//   $cariProses = 1;
	// } elseif ($isi = array("sel","sele","seles","selesai")) {
	//   $cariProses = 2;
	// } 

	// print json_encode($cariProses);

	//var_dump($isi);
	$data = mysqli_query($koneksi,"SELECT a.*, b.* FROM transaksi AS a RIGHT JOIN pelanggan AS b ON a.transaksi_pelanggan = b.pelanggan_id WHERE pelanggan_nama LIKE '%".$isi."%'");

	$no = 1;

	?>

	<!-- $filterTransaksi =  mysqli_num_rows($data); -->
	
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
	while ($d = mysqli_fetch_array($data)) {
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

	<!-- print_r($data); -->

<?php

}

 ?>