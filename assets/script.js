
function addRow() {

    var table = document.getElementById("tableCucian");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
    var b = (rowCount+1) + ".";	
	row.insertCell(0).innerHTML = "<label name=\"nomor\" id=\"nomor\" align=\"center\">"+b+"</label>";
	row.insertCell(1).innerHTML = "<input type=\"hidden\" name=\"idPakaian["+rowCount+"]\" value=\"0\" id=\"idPakaian["+rowCount+"]\"><input type=\"text\" class=\"form-control\" id=\"jenis_pakaian"+rowCount+"\" name=\"jenis_pakaian["+rowCount+"]\">";
	row.insertCell(2).innerHTML = "<input type=\"number\" class=\"form-control\" min=\"0\" id=\"jumlah_pakaian"+rowCount+"\" name=\"jumlah_pakaian["+rowCount+"]\">";	
	row.insertCell(3).innerHTML = "<button class=\"btn btn-sm btn-danger glyphicon glyphicon-remove \" id=\"hapus\" onclick=\"deleteRow(this)\"></button>";
}


function deleteRow(obj) {
   var index = obj.parentNode.parentNode.rowIndex;
   var table = document.getElementById("tableCucian");
   // var rowCount = table.rows.length;
   table.deleteRow(index-1);

    var rowCountAfterDeleting = document.getElementById("tableCucian").rows.length;
    for (var rowCount = 0; rowCount < rowCountAfterDeleting; rowCount++) {
        var indexRow = parseInt(table.rows[rowCount].cells[0].innerText) - 1;
        // var indexRow = +document.getElementById('nomor').innerText;
        // var indexRow1 = indexRow - 1;
        var jenisPakaian = document.getElementById("jenis_pakaian" + indexRow + "").value;
        var jumlahPakaian = document.getElementById("jumlah_pakaian" + indexRow + "").value;
        table.rows[rowCount].cells[0].innerHTML = "<label name=\"nomor\" id=\"nomor\" align=\"center\">"+(rowCount + 1)+ "."+"</label>";
        table.rows[rowCount].cells[1].innerHTML = "<input type=\"hidden\" name=\"idPakaian["+rowCount+"]\" value=\"0\" id=\"idPakaian["+rowCount+"]\"><input type=\"text\" id=\"jenis_pakaian"+rowCount+"\" name=\"jenis_pakaian["+rowCount+"]\" class=\"form-control\" >";
		table.rows[rowCount].cells[2].innerHTML = "<input type=\"number\" name=\"jumlah_pakaian["+rowCount+"]\" class=\"form-control\" min=\"0\" id=\"jumlah_pakaian"+rowCount+"\">";	
		$('#jenis_pakaian' + rowCount).val(jenisPakaian);
        $('#jumlah_pakaian' + rowCount).val(jumlahPakaian);
    }
};


