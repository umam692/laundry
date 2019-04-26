<?php include '../koneksi.php'; 

$aksi = $_POST['aksi'];
$id = $_POST['id'];


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
    }
}

function hapus($koneksi)
{
	$id = $_POST['id'];
    
	$sql_hapus = "DELETE FROM pelanggan AS a INNER JOIN transaksi AS b INNER JOIN pakaian AS c ON a.pelanggan_id = b.transaksi_pelanggan AND b.transaksi_id = c.pakaian_transaksi WHERE a.pelanggan_id". $id;

	$hapus = mysqli_query($koneksi, $sql_hapus);
}

function edit($koneksi){
    $sql = "update pelanggan set pelanggan_nama='".$_POST['pelanggan_nama']."', pelanggan_hp='".$_POST['pelanggan_hp']."', pelanggan_alamat='".$_POST['pelanggan_alamat']."' where pelanggan_id='".$_POST['id']."'";
    $update = mysqli_query($koneksi, $sql); 
    if($update){
         echo json_encode(array('status' => 'true'));
    }else{
         echo json_encode(array('status' => 'false'));
    }
}

function tambah($koneksi){
    $sql = "insert into pelanggan values('','".$_POST['pelanggan_nama']."','".$_POST['pelanggan_hp']."','".$_POST['pelanggan_alamat']."')";
    $tambah = mysqli_query($koneksi, $sql);
}
?>
