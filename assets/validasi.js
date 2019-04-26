
function validasiAddPelanggan() {
	debugger
	var pelanggan_nama = $("#pelanggan_nama").val();
	var pelanggan_hp = $("#pelanggan_hp").val();
	var pelanggan_alamat = $("#pelanggan_alamat").val();
	var tambahPelanggan = $("#tambahPelanggan").serializeArray();
	if (pelanggan_nama != "" && pelanggan_hp !="" && pelanggan_alamat != "") {
		$.ajax({
			type : "POST",
			data : tambahPelanggan,
			url	 : "action_pelanggan.php",
			success : function (data) {
				swal(
	                   'Terima kasih',
	                   'Data anda berhasil Disimpan',
	                   'success'
		             ).then(function () {
		                   location.href = "pelanggan.php?posisi=2";
		               });
			}
		});
	} 
	else {
		Swal(
		  'GAGAL',
		  'Lengkapi Seluruh Data !!!',
		  'error'
		)
		// return false;
	}
}

function validasiEditPelanggan() {
	debugger
	var id = $("#id").val();
	var editPelanggan = $("#editPelanggan").serializeArray();
	if ($("#pelanggan_nama").val() != "" && $("#pelanggan_hp").val() !="" && $("#pelanggan_alamat").val() != "") {
		$.ajax({
			type : "POST",
			// data : {id: id, aksi: $("#aksi").val(), pelanggan_nama : $("#pelanggan_nama").val(), pelanggan_hp : $("#pelanggan_hp").val(), pelanggan_alamat : $("#pelanggan_alamat").val() },
			data : editPelanggan,
			url	 : "action_pelanggan.php",
			success : function (data) {
				console.log(data)

				swal(
	                   'Terima kasih',
	                   'Data anda berhasil di perbaharui!',
	                   'success'
		             ).then(function () {
		                   location.href = "pelanggan.php?posisi=2";
		               });
			}
		});
	} 
	else {
		Swal(
		  'GAGAL',
		  'Lengkapi Seluruh Data !!!',
		  'error'
		)
		// return false;
	}
}

function validasiHapusPelanggan(e, id) {
	debugger
	Swal(
			{
			  title: 'Apakah Kamu Yakin?',
			  text: "Kamu tidak dapat mengembalikan data ini!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yakin',
			  cancelButtonText: 'Batal'
			}).then((result) => {
				debugger
			  if (result.value) {
			  	var data = {id : id, aksi:'hapus', pelanggan_nama:'', pelanggan_hp:'', pelanggan_alamat:''};
			  	$.ajax({
		            type: "POST",
		            data: data,
		            url: "action_pelanggan.php",
		            success: function(data){
		            	swal(
		                   'Terima kasih',
		                   'Data anda berhasil dihapus!',
		                   'success'
		               ).then(function () {
		                   location.href = "pelanggan.php?posisi=2";
		               });
                	}
            	});
			  }
			}	
		)
}

function validasiAddTransaksi() {
	debugger
	var transaksi_pelanggan = $("#pelanggan").val();
	var transaksi_berat = $("#berat").val();
	var today = $("#dateNow").text();
	var tgl_selesai = $("#tgl_selesai").val();

	var tambahTransaksi = $("#tambahTransaksi").serializeArray();
	if (transaksi_pelanggan != "" && transaksi_berat !="" && tgl_selesai != "") {
		$.ajax({
			type : "POST",
			data : tambahTransaksi,
			url	 : "action_transaksi.php",
			success : function (data) {
				swal(
	                   'Terima kasih',
	                   'Data anda berhasil Disimpan',
	                   'success'
		             ).then(function () {
		                   // deleteRowTransaksi(this);
		                   location.href = "transaksi.php?posisi=3";
		               });
			}
		});
	} 
	else {
		Swal(
		  'GAGAL',
		  'Lengkapi Seluruh Data !!!',
		  'error'
		)
		// return false;
	}
}


function validasiEditTransaksi() {
	var id = $("#idPelanggan").val();
	// var pelanggan_nama = $("#pelanggan_nama").val();
	// var pelanggan_hp = $("#pelanggan_hp").val();
	// var pelanggan_alamat = $("#pelanggan_alamat").val();
	var editTransaksi = $("#editTransaksi").serializeArray();
	if ($("#pelanggan").val() != "" && $("#berat").val() !="" && $("#tgl_selesai").val() != "") {
		$.ajax({
			type : "POST",
			// data : {id: id, aksi: $("#aksi").val(), pelanggan_nama : $("#pelanggan_nama").val(), pelanggan_hp : $("#pelanggan_hp").val(), pelanggan_alamat : $("#pelanggan_alamat").val() },
			data : editTransaksi,
			url	 : "action_transaksi.php",
			success : function (data) {
				console.log(data)

				swal(
	                   'Terima kasih',
	                   'Data anda berhasil di perbaharui !!',
	                   'success'
		             ).then(function () {
		                   location.href = "transaksi.php?posisi=3";
		               });
			}
		});
	} 
	else {
		Swal(
		  'GAGAL',
		  'Lengkapi Seluruh Data !!!',
		  'error'
		)
		// return false;
	}
}


function validasiHapusTransaksi(e, id) {
	Swal(
			{
			  title: 'Apakah Kamu Yakin?',
			  text: "Kamu tidak dapat mengembalikan data ini!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yakin',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.value) {
			  	var data = {id : id, 
			  				aksi:'hapus',
							// pelanggan: '',
							// berat: '',
							// tgl_selesai: '',
							// idPakaian : '',
							// jenis_pakaian : '',
							// jumlah_pakaian : ''
						}
			  	$.ajax({
		            type: "POST",
		            data: data,
		            url: "action_transaksi.php",
		            success: function(data){
		            	swal(
		                   'Terima kasih',
		                   'Data anda berhasil dihapus!',
		                   'success'
		               ).then(function () {
		                   location.href = "transaksi.php?posisi=3";
		               });
                	}
            	});
			  }
			}	
		)
}

function sortirTransaksi(e){
	var cari = document.getElementById("search").value;
	var tabel = document.getElementById("table-transaksi");
	// var data = $("#table-transaksi").serializeArray();

	// menambahkan event ketika di input
	debugger
		var data = {
					 aksi : 'filter',
					 isi : cari,
				};

		if (data != "") {
			$.ajax({
				type : "POST",
				data : data,
				url	 : "action_transaksi.php",
				success : function (html) {
					$("#table-transaksi").html(html);
				}
			});	
		}
}

function validasiFilterLaporan() {
	var tanggalDari = $("#tgl_dari").val();
	var tanggalSampai = $("#tgl_sampai").val();
	var filterTanggal = $("#laporan").serializeArray();
	if (tanggalDari != "" && tanggalSampai !="") {
		var panelBody = document.getElementById("panelBody");
		var heading = document.getElementById("heading");
		// var heading = document.createElement("h4");
		// var kalimat = document.createTextNode("Data Laporan Laundry dari ");
		var table = document.getElementById("tableFilter");
		// heading.innerHTML  = "";
    	// panelBody.innerHTML = "<div class=\"panel-heading\"> <h4>Data Laporan Laundry dari <b>"+tanggalDari+"</b> sampai dengan <b>"+tanggalSampai+"</b></h4> </div> <a target=\"_blank\" href=\"cetak_print.php?dari="+tanggalDari+"&sampai="+tanggalSampai+"\" class=\"btn btn-sm btn-primary\"><i class=\"glyphicon glyphicon-print\"></i> CETAK</a> <a target=\"_blank\" href=\"cetak_pdf.php?dari="+tanggalDari+"&sampai="+tanggalSampai+"\" class=\"btn btn-sm btn-primary\"><i class=\"glyphicon glyphicon-print\"></i> CETAK PDF</a> <br> <br> <table class=\"table table-bordered table-striped\"> <tr> <th width=\"1%\">No.</th> <th>Invoice</th> <th>Tanggal</th> <th>Pelanggan</th> <th>Berat (Kg)</th> <th>Tgl. Selesai</th> <th>Harga</th> <th>Status</th> </tr> </table>";

		$.ajax({
			type : "GET",
			// data : {id: id, aksi: $("#aksi").val(), pelanggan_nama : $("#pelanggan_nama").val(), pelanggan_hp : $("#pelanggan_hp").val(), pelanggan_alamat : $("#pelanggan_alamat").val() },
			data : filterTanggal,
			url	 : "action_laporan.php",
			success : function (html) {
				$("#panelBody").html(html);
			}
		});
	} 
	else {
		Swal(
		  'GAGAL',
		  'Pilih Filter Tanggal !!!',
		  'error'
		)
		// return false;
	}
}

