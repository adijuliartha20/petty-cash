function getArea(e){
	const act = document.getElementById('act').value;
	const id = e.target.value;

	let html = "";
	document.getElementById("area").innerHTML = "<option>Silahkan menunggu...</option>";
	
	//get data
	const xhttp = new XMLHttpRequest();
	xhttp.onload = function(){
		const obj = JSON.parse(this.responseText);
		obj.forEach((e,i)=>{
			html += "<option value="+e.id_area+">"+e.area+"</option>";
			document.getElementById("area").innerHTML = html;
		})
	}
	xhttp.open("GET",act+'/area/list/'+id);
	xhttp.send();
}

function submit_form(){
	var form = document.getElementById("trigger-submit");
	form.click();
}

Dropzone.options.myGreatDropzone = { // camelized version of the `id`
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    dictDefaultMessage: 'Silahkan upload file disini',
    addRemoveLinks: true,
    createImageThumbnails: true,
   	
    removedfile: function(file) {
   		var btndelete = file.previewElement.querySelector(".dz-remove");
	    if(btndelete.hasAttribute("id")) {
	        var iddelete = btndelete.getAttribute("id").split('-').pop();
	        //delete file
	   		var act = document.getElementById("actDeleteFile").value;
	   		var xhttp = new XMLHttpRequest();
			xhttp.open("POST", act, true); 
			xhttp.setRequestHeader("Content-Type", "application/json");
			xhttp.onreadystatechange = function() {
			   if (this.readyState == 4 && this.status == 200) {
			     	//console.log(this.responseText);
			   		let _ref;
					return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;      
			   }
			};
			var data = {idFile:iddelete};
			xhttp.send(JSON.stringify(data));
	    }
   		return;
   		
	},

    init: function(){
    	//get data    	
    	const id = document.getElementById('id').value;
    	const actGetFile = document.getElementById('actGetFile').value;
    	const assetLink = document.getElementById('assetLink').value;
    	const typeAsset = document.getElementById('typeAsset').value;
		const xhttp = new XMLHttpRequest();
		myDropzone = this;
		xhttp.onload = function(){
			const obj = JSON.parse(this.responseText);
			const files = obj.listFile;
			if(typeof files === 'undefined'){
			}else{
				files.forEach((e,i)=>{
					myDropzone.emit("addedfile", e);
				    myDropzone.emit("thumbnail", e, assetLink+'/'+typeAsset+'/'+e.nama);
				    myDropzone.emit("complete", e);
				})
			}
		}
		xhttp.open("GET",actGetFile+'/'+id);
		xhttp.send();

		this.on("addedfile", function (file,response) {
			var fileuploded = file.previewElement.querySelector("[data-dz-name]");
    		fileuploded.innerHTML = file.nama;

			var btndelete = file.previewElement.querySelector(".dz-remove");
    		btndelete.setAttribute("id", 'delete-midia-id-'+file.id_asset);
		})

    	this.on("success",function(file,response){
    		var fileuploded = file.previewElement.querySelector("[data-dz-name]");
    		fileuploded.innerHTML = response.newfilename;


    		var btndelete = file.previewElement.querySelector(".dz-remove");
    		btndelete.setAttribute("id", 'delete-midia-id-'+response.newId);
    	})

    	this.on("complete",function(file,response){
    		//this.removeFile(file);
    	});

    	this.on("sendingmultiple", function() {
      // Gets triggered when the form is actually being sent.
      // Hide the success button or the complete form.
	    });
	    this.on("successmultiple", function(files, response) {
	      // Gets triggered when the files have successfully been sent.
	      // Redirect user or notify of success.
	    });
	    this.on("errormultiple", function(files, response) {
	      // Gets triggered when there was an error sending the files.
	      // Maybe show form again, and notify user of error
	    });
    }
};


function isObjectEmpty(value) {
  return (
    Object.prototype.toString.call(value) === '[object Object]' &&
    JSON.stringify(value) === '{}'
  );
}

function addData(){
	const rowEdit = document.getElementById('rowEdit').value;
	if(rowEdit!='') return editRow();

	const nama = document.getElementById('iNama').value;
	const harga = parseInt(document.getElementById('iHarga').value);
	const jumlah = parseInt(document.getElementById('iJumlah').value);
	const subTotal = harga * jumlah;

	if(nama=='' || harga=='' || jumlah =='') return;

	const defaultRow = document.getElementById('defaultRow');
	if(defaultRow){
		defaultRow.remove();
	}

	//tambah baris
	const table = document.getElementById('tblDetail').getElementsByTagName('tbody')[0];
	const nTr = table.rows.length; // 3
	const newId = checkID(nTr,'trDetail');

	const row = table.insertRow(0);
		  row.setAttribute('id','trDetail'+newId);

	const cell1 = row.insertCell(0);
	const cell2 = row.insertCell(1);
		cell2.setAttribute('class','text-center');
	const cell3 = row.insertCell(2);
		cell3.setAttribute('class','text-center');
	const cell4 = row.insertCell(3);
		cell4.setAttribute('class','text-right');
		cell4.setAttribute('id','subTotal'+newId);
	const cell5 = row.insertCell(4);
		cell5.setAttribute('class','row-actions');

	const iNama = createInput('nama[]','text',nama,true,'plain-input','nama'+newId);
	const iHarga = createInput('harga[]','number',harga,true,'plain-input','harga'+newId);
	const iJumlah = createInput('jumlah[]','number',jumlah,true,'plain-input','jumlah'+newId);
	const iSubTotal = createInput('subTotal[]','number',subTotal,true,'plain-input','subTotal'+newId);

	cell1.appendChild(iNama);
	cell2.appendChild(iHarga);
	cell3.appendChild(iJumlah);
	cell4.innerHTML = subTotal;

	const actEdit = createLinkAction('','','os-icon os-icon-ui-49');
	actEdit.addEventListener('click',editViewRow);
	actEdit.myParam = newId;
	const actDel = createLinkAction('#','danger','os-icon os-icon-ui-15');
	actDel.addEventListener('click',deleteRow);
	actDel.myParam = newId
	cell5.appendChild(actEdit);
	cell5.appendChild(actDel);	

	resetFormInsertRow();
}

function createInput(name,type,value,readOnly,className,id){
	const i = document.createElement("INPUT");
	i.setAttribute("name",name);
	i.setAttribute("type",type);
	i.setAttribute("value",value);
	i.setAttribute("readOnly",readOnly);
	i.setAttribute("class",className);
	i.setAttribute("id",id);
	return i;
}

function createLinkAction(link,className,iClassName){
	const a = document.createElement('button');
	a.setAttribute("class",className);
	a.setAttribute("type",'button');

	const i = document.createElement('i');
	i.setAttribute("class",iClassName);
	a.appendChild(i);
	return a;
}

function checkID(id,name){
	const idExist = document.getElementById(name+id);
	if(idExist){//loop terus sampai 
		checkID((parseInt(id)+1),name);
	}else{
		return id;
	}
}

const editViewRow = function (event){
	const id = event.currentTarget.myParam;
	document.getElementById('rowEdit').value = id;
	
	const nama = document.getElementById('nama'+id).value;
	const harga = document.getElementById('harga'+id).value;
	const jumlah = document.getElementById('jumlah'+id).value;

	document.getElementById('iNama').value = nama;
	document.getElementById('iHarga').value = harga;
	document.getElementById('iJumlah').value = jumlah;
}

function editRow(){
	const id = document.getElementById('rowEdit').value;
	const nama = document.getElementById('iNama').value;
	const harga = document.getElementById('iHarga').value;
	const jumlah = document.getElementById('iJumlah').value;
	const subTotal = harga * jumlah;

	document.getElementById('nama'+id).value = nama;
	document.getElementById('harga'+id).value = harga;
	document.getElementById('jumlah'+id).value = jumlah;
	document.getElementById('subTotal'+id).innerHTML = subTotal;

	resetFormInsertRow();
}



function resetFormInsertRow(){
	document.getElementById('iNama').value = '';
	document.getElementById('iHarga').value = '';
	document.getElementById('iJumlah').value = '';
	document.getElementById('rowEdit').value = '';
	countTotal();
}

function countTotal(){
	const harga = document.getElementsByName('harga[]');
	const jumlah = document.getElementsByName('jumlah[]');
	let total = 0;
	for(let i = 0; i<harga.length; i++){
		total += (harga[i].value * jumlah[i].value);
	}
	document.getElementById('total').value = total;
}

function deleteRow(event){
	const id = event.currentTarget.myParam;
	document.getElementById('trDetail'+id).remove();
	countTotal();
}


function editRowViewHTML(id){
	document.getElementById('rowEdit').value = id;
	
	const nama = document.getElementById('nama'+id).value;
	const harga = document.getElementById('harga'+id).value;
	const jumlah = document.getElementById('jumlah'+id).value;

	document.getElementById('iNama').value = nama;
	document.getElementById('iHarga').value = harga;
	document.getElementById('iJumlah').value = jumlah;
}

function deleteRowHTML(id){
	document.getElementById('trDetail'+id).remove();
	countTotal();
}



function findReport(){
	const mulai = document.getElementById('mulai').value;
	const akhir = document.getElementById('akhir').value;

	var act = document.getElementById("getReport").value;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", act, true); 
	xhttp.setRequestHeader("Content-Type", "application/json");
	xhttp.onreadystatechange = function() {
	   if (this.readyState == 4 && this.status == 200) {
	     	//console.log(this.responseText);
	   		let _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;      
	   }
	};
	var data = {'mulai':mulai, 'akhir':akhir};
	xhttp.send(JSON.stringify(data));
}