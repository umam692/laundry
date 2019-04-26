<?php include '../koneksi.php'; 

//menangkap data id yang dikirim dari url
$id=$_GET['id'];

//menghapus pelanggan 
mysqli_query($koneksi,"delete from pelanggan where pelanggan_id='$id'");
?>



