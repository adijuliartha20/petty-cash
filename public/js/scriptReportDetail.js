function findReport(){
	//const sHtml = setReport('');
	

	const mulai = document.getElementById('mulai').value;
	const akhir = document.getElementById('akhir').value;
	
	var act = document.getElementById("getReport").value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", act, true); 
	xhttp.setRequestHeader("Content-Type", "application/json");
	xhttp.onload = function(){
		const res = JSON.parse(this.responseText);
		if(res.status=='success'){
			const reports = res.reports;
			let sHTML = ``;
			reports.forEach((dt,idx)=>{
				sHTML += setReport(dt,idx);
			})
			const wrapper = document.getElementById('elementWrapper');
			wrapper.innerHTML = sHTML;
		} 
	};
	var data = {'mulai':mulai, 'akhir':akhir};
	xhttp.send(JSON.stringify(data));
}

function rowDetailReport(ddt){
	const subtotal = parseInt(ddt.harga) * parseInt(ddt.jumlah);
	const sHTML = `<tr>
	                  <td>`+ddt.nama+`</td>
	                  <td class="text-center">`+formatRupiah(ddt.harga)+`</td>
	                  <td class="text-center">`+formatRupiah(ddt.jumlah)+`</td>
	                  <td class="text-right">`+formatRupiah(subtotal)+`</td>
	                </tr>`;
	return sHTML;
}

function setReport(dt,idx){
	const dtTgl = new Date(dt.tanggal);
	const tanggal= dtTgl.toLocaleDateString("id");

	//detail
	let detail = dt.data;
	let sDetail = ``;
	detail.forEach((ddt,iddx)=>{
		sDetail += rowDetailReport(ddt);
	})

	const sHTML = `	<div class="invoice-w invoice-w`+idx+`">
		                <div class="infos">
		                    <div class="info-1">
					            <div class="invoice-logo-w"><img alt="" src="img/logo2.png"></div>
					            <div class="company-name">Pondok Lensa</div>
					            <div class="company-address">Jl. Beji Ayu No.6, Seminyak,<br/> Kuta, Badung,<br/> Bali 80361</div>
					            <div class="company-extra">tel. 082.211.112.012</div>
				            </div>
				            <div class="info-2">
				            	<div class="company-name">Site</div>
				            	<div class="company-address">`+dt.site+` <br/>`+dt.alamat+`<br>`+dt.area+` `+dt.kota+` <br> </div>
				            </div>
				        </div>
		                <div class="invoice-heading">
		                    <h3>Klaim</h3>
		                    <div class="invoice-date">`+tanggal+`</div>
		                </div>
		                <div class="invoice-body">
		                    <div class="invoice-desc">
					            <div class="desc-label">Invoice #</div>
					            <div class="desc-value">KLM-`+dt.id_klaim+`</div>
		                  	</div>
		                    <div class="invoice-table inv-baru">
					            <table class="table">
					              <thead>
					                <tr>
					                  <th>Nama</th>
					                  <th class="text-center">Harga</th>
					                  <th class="text-center">Jumlah</th>
					                  <th class="text-right">Sub Total</th>
					                </tr>
					              </thead>
					              <tbody>
					              `+sDetail+`
					              </tbody>
					              <tfoot>
					                <tr>
					                  <td>Total</td>
					                  <td class="text-right" colspan="3">`+formatRupiah(dt.total,'Rp ')+`</td>
					                </tr>
					              </tfoot>
					            </table>
					            <div class="terms">
					              <div class="terms-header">
					                Pengaju Klaim
					              </div>
					              <div class="terms-content">
					                `+dt.nama+`<br/>
					                `+dt.telpon+`
					              </div>
					            </div>
		                    </div>
		                </div>
		                <div class="invoice-footer">
		                    <div class="invoice-logo">
		                      <img alt="" src="img/logo.png"><span>Pondok Lensa Head Office</span>
		                    </div>
		                    <div class="invoice-info">
		                      <span>info@pondoklensa.com</span><span>082.211.112.012</span>
		                    </div>
		                </div>
		            </div>`;

    return sHTML;
}

function formatRupiah(angka, prefix){
	var number_string = angka.toString().replace(`/[^,\d]/g`, '').toString(),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
 
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}