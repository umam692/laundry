<?php 
include '../koneksi.php';

$id_transaksi = $_GET['id'];

// menghapus transaksi
mysqli_query($koneksi,"delete from transaksi where transaksi_id='$id_transaksi'");

// menghapus data pakaian di dalam transaksi
mysqli_query($koneksi,"delete from pakaian where pakaian_transaksi='$id_transaksi'");

header("location:transaksi.php");
 ?>