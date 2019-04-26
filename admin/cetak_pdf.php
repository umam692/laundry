<?php 
// menghubungkan dengan dompdf
require_once '../assets/dompdf/dompdf_config.inc.php';

include '../koneksi.php';

$dompdf = new Dompdf();


$html =		'<head>';
// $html .=		'<link rel="stylesheet" href="../assets/css/bootstrap.css">';
$html .=		'<script type="text/javascript" src="../assets/js/jquery.js"></script>';
$html .=		'<script type="text/javascript" src="../assets/js/bootstrap.js"></script>';
$html .=	'</head>';

$html .= '	<div class="container">	
			<h2 align="center"> Laundry " MALAS NGODING "</h2>
			<br>	
			<br>';	
		if (isset($_GET['dari']) && isset($_GET['sampai'])) {
			$dari = $_GET['dari'];
			$newDari = date('d-m-Y', strtotime($dari));
			$sampai = $_GET['sampai'];
			$newSampai = date('d-m-Y', strtotime($sampai));
		}

$html .= '<h4>Data Laporan Laundry dari <b>' .$newDari. '</b> sampai dengan <b>' .$newSampai. '</b></h4>' ;	  
$html .= '<table> ';
$html .=		'<tr class="judul">';
$html .= 			'<th width="1%">No.</th>
					<th>Invoice</th>
					<th>Tanggal</th>
					<th>Pelanggan</th>
					<th>Berat (Kg)</th>
					<th>Tgl. Selesai</th>
					<th>Harga</th>
					<th>Status</th>
				</tr>
				';
 
				// koneksi database
				include '../koneksi.php';

				// mengambil data pelanggan dari database
				$data=mysqli_query($koneksi,"select * from pelanggan,transaksi where transaksi_pelanggan=pelanggan_id and transaksi_tgl >= '$dari' and transaksi_tgl <= '$sampai' order by transaksi_id desc");

				$no = 1;

				// mengubah data ke array dan menampilkannya dengan perulangan while
				while ($d = mysqli_fetch_array($data)) {

					$TransaksiDate = $d['transaksi_tgl'];
					$newTransaksiDate = date("d-m-Y", strtotime($TransaksiDate));
					$finishDate = $d['transaksi_tgl_selesai'];
					$newFinishDate = date("d-m-Y", strtotime($finishDate));
	
$html .= 		'<tr>';
$html .=			'<td align="center">'.$no++.'.</td>';
$html .=			'<td>INVOICE-'.$d['transaksi_id'].'</td>';
$html .=			'<td>' .$newTransaksiDate. '</td>';
$html .=			'<td>'.$d['pelanggan_nama'].'</td>';
$html .=			'<td align = "center">'.$d['transaksi_berat'].'</td>';
$html .=			'<td>'.$newFinishDate.'</td>';
$html .=			'<td>';
						 $harga = "Rp. ".number_format($d['transaksi_harga'],0,".",".") .",-";
$html .=				 $harga;
$html .=			'</td>';
$html .=			'<td>';
						if ($d['transaksi_status']==0) {
							$status = "<div class='label label-warning'>PROSES</div>";
						} elseif ($d['transaksi_status']==1) {
							$status = "<div class='label label-info'>DICUCI</div>";
						} elseif ($d['transaksi_status']==2) {
							$status = "<div class='label label-info'>SELESAI</div>";
						}
$html .=				$status;
$html .=			'</td>';
$html .=		'</tr>';				
		
				}
				 
$html .= '</table>
	</div>';

$html .= '<style>
	table {
	border: 1px solid black;
	border-collapse: collapse;
	width: 100%;
	}

	th, td {
	border: 1px solid black;
	text-align: left;
	padding: 8px;
	}

	tr.judul {
		background-color: #4CAF50;
		color: white;
		font-size: 15pt;
		text-align: center;
	}

	tr:nth-child(even) {background-color: #f2f2f2;}
</style>';	

$dompdf->load_Html($html);
$dompdf->set_Paper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("Laporan Data Laundry", array('Attachment' => 0));
?>

