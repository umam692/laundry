<?php 

include '../koneksi.php'; 

//menangkap data yang dikirim dari form
$harga = $_POST['harga'];

//update data
mysqli_query($koneksi,"update harga set harga_per_kilo='$harga'");

//mengalihkan halaman
header("location:harga.php");
?>
