<?php include '../koneksi.php'; 
// <!-- menangkap data yang dikirim dari form -->

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

	// while ( $d = mysqli_fetch_array($data)) {
	// 	if ($d['transaksi_id'] == $d['pakaian_transaksi'] && $d['pakaian_jenis'] == $jenis_pakaian) {
	// 		$total_pakaian = $jumlah_pakaian + $d['pakaian jumlah'];
	// 		mysqli_query($koneksi,"insert into pakaian values('','$id_terakhir','$jenis_pakaian[$i]','$total_pakaian[$i]')");
	// 	}
	// 	else if ($d['transaksi_id'] == $d['pakaian_transaksi'] && $jenis_pakaipan != $d['pakaian_jenis']  ) {
	// 		mysqli_query($koneksi,"insert into pakaian values('','$id_terakhir','$jenis_pakaian[$i]','$jumlah_pakaian[$i]')");
	// 	}
	// }
}

header("location:transaksi.php");
?>
