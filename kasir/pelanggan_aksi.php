<?php include '../koneksi.php'; 

//menangkap data yang dikirim dari form
$pelanggan_nama = $_POST['pelanggan_nama'];
$pelanggan_hp = $_POST['pelanggan_hp'];
$pelanggan_alamat = $_POST['pelanggan_alamat'];

//input data ke tabel pelanggan
mysqli_query($koneksi, "insert into pelanggan values('','$pelanggan_nama','$pelanggan_hp','$pelanggan_alamat')");

//header("location:pelanggan.php");

?>