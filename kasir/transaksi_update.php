<?php include '../koneksi.php'; 

//menangkap data yang dikirim dari form
 $pelanggan = $_POST['pelanggan'];
 $berat = $_POST['berat'];
 $tgl_selesai = $_POST['tgl_selesai'];
 $status = 0 ;

// mengambil harga dari database
 $h = mysqli_query($koneksi, "select * from harga");

 $harga_per_kilo = mysqli_fetch_array($h);

 $harga = $berat * $harga_per_kilo['harga_per_kilo'];

 // echo $harga;
 // menangkap id yang dikirim melalui url
$id = $_GET['id'];

 // menginput data ke tabel transaksi
mysqli_query($koneksi,"update transaksi set transaksi_harga = '$harga', transaksi_berat = '$berat', transaksi_tgl_selesai = '$tgl_selesai' WHERE transaksi_id = '$id'");

 // menyimpan id dari data yang di simpan pada query insert data sebelumnya
 $id_terakhir = mysqli_insert_id($koneksi);

 // menangkap data form input array (Jenis Pakaian dan Jumlah Pakaian)
 $jenisPakaian = $_POST['jenis_pakaian'];
 $jumlahPakaian = $_POST['jumlah_pakaian'];

 // menangkap id yang dikirim melalui url
 // $id = $_GET['id'];

// mengambil data transaksi join pakaian yang ber id transaksi sama
 $data = mysqli_query ($koneksi,"select a.transaksi_id, a.transaksi_pelanggan, b.* from transaksi as a join pakaian as b ON a.transaksi_id = b.pakaian_transaksi WHERE a.transaksi_id = '$id'");

 // input data cucian ke dalam tabel pakaian berdasarkan ID Tdransaksi
 for ($i=0; $i < count($jenisPakaian) ; $i++) {

 	while ( $d = mysqli_fetch_array($data)) {
		if ($d['transaksi_id'] == $d['pakaian_transaksi'] && $d['pakaian_jenis'] == $jenis_pakaian) {
			$total_pakaian = $jumlah_pakaian + $d['pakaian jumlah'];
			mysqli_query($koneksi,"UPDATE pakaian SET pakaian_jenis = '$jenisPakaian', pakaian_jumlah = '$total_pakaian' WHERE pakaian_transaksi = '$id'");
		}
		else if ($d['transaksi_id'] == $d['pakaian_transaksi'] && $d['pakaian_jenis'] != $jenis_pakaian) {
			mysqli_query($koneksi,"UPDATE pakaian SET pakaian_jenis = '$jenisPakaian', pakaian_jumlah = '$total_pakaian'
			WHERE pakaian_transaksi = '$id'");
		}
	}
 }

header("location:transaksi.php");
?>