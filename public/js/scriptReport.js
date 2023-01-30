function findReport(){
	const mulai = document.getElementById('mulai').value;
	const akhir = document.getElementById('akhir').value;
	pleaseWait();
	var act = document.getElementById("getReport").value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", act, true); 
	xhttp.setRequestHeader("Content-Type", "application/json");
	xhttp.onload = function(){
		const res = JSON.parse(this.responseText);
		if(res.status=='success'){
			clRow();
			const data = res.report.data;
			data.forEach((dt,idx)=>{
				const table = document.getElementById('tableReport').getElementsByTagName('tbody')[0];
				const lastTable = table.rows.length;
				
				const row = table.insertRow(lastTable);
				row.setAttribute('id','row'+lastTable);
				
				if(dt.type_report=='kas'){
					setKasData(row,dt);
				}else if(dt.type_report=='klaim'){
					setKlaimData(row,dt);
				}
			})
			setFooter(res.report);
		} 
	};
	var data = {'mulai':mulai, 'akhir':akhir};
	xhttp.send(JSON.stringify(data));
}


function clRow(){
	const tBody = document.getElementById('tableReport').getElementsByTagName('tbody')[0];
	const elements = tBody.getElementsByTagName('tr');
	while (elements[0]) elements[0].parentNode.removeChild(elements[0]);

	const tFooter = document.getElementById('tableReport').getElementsByTagName('tfoot')[0];
	if(tFooter){
		const eleF = tFooter.getElementsByTagName('tr');
		while (eleF[0]) eleF[0].parentNode.removeChild(eleF[0]);	
	}	
}

function setKasData(row,dt){
	const tanggal	= row.insertCell(0);
	const nama 		= row.insertCell(1);
	nama.setAttribute('colspan',3);
	nama.setAttribute('class','text-center');
	const debit 	= row.insertCell(2);
	debit.setAttribute('class','text-center');
	const kredit 	= row.insertCell(3);
	const saldo 	= row.insertCell(4);
	saldo.setAttribute('class','text-right');

	const dtTgl = new Date(dt.tanggal);
	tanggal.innerHTML 	= dtTgl.toLocaleDateString("id");
	nama.innerHTML 		= dt.nama_report;
	debit.innerHTML = formatRupiah(dt.debit);
	kredit.innerHTML = formatRupiah(dt.kredit);
	saldo.innerHTML = formatRupiah(dt.saldo);
	
}

function setKlaimData(row,dt){
	const tanggal		= row.insertCell(0);
	const site			= row.insertCell(1);
	const group_klaim	= row.insertCell(2);
	const user_klaim	= row.insertCell(3);
	const debit	= row.insertCell(4);
	const kredit	= row.insertCell(5);
	kredit.setAttribute('class','text-center');	
	const saldo	= row.insertCell(6);
	saldo.setAttribute('class','text-right');	

	const dtTgl = new Date(dt.tanggal);
	tanggal.innerHTML	= dtTgl.toLocaleDateString("id");
	site.innerHTML		= dt.site;
	group_klaim.innerHTML	= dt.group_klaim;
	user_klaim.innerHTML 	= dt.user;
	debit.innerHTML 	= formatRupiah(dt.debit);
	kredit.innerHTML 	= formatRupiah(dt.kredit);	
	saldo.innerHTML 	= formatRupiah(dt.saldo);

}

function setFooter(dt){
	const table = document.getElementById('tableReport');
	const footer = table.createTFoot();
	const row = footer.insertRow(0);

	const total 	= row.insertCell(0);
	total.setAttribute('colspan',4);
	const debit 	= row.insertCell(1);
	debit.setAttribute('class','text-center');
	const kredit	= row.insertCell(2);
	kredit.setAttribute('class','text-center');
	const saldo 	= row.insertCell(3);  
	saldo.setAttribute('class','text-right');

	total.innerHTML 	= 'Total';
	debit.innerHTML 	= formatRupiah(dt.debit);
	kredit.innerHTML 	= formatRupiah(dt.kredit);
	saldo.innerHTML 	= formatRupiah(dt.saldo);
}

function pleaseWait(){
	clRow();
	const table = document.getElementById('tableReport').getElementsByTagName('tbody')[0];
	const lastTable = table.rows.length;
	
	const row = table.insertRow(lastTable);
	row.setAttribute('id','defaultRow');
	const progress = row.insertCell(0)	
	progress.setAttribute('colspan',7);
	progress.setAttribute('class','text-center');
	progress.innerHTML = 'Mohon ditunggu...';
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