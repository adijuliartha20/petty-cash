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
		const xhttp = new XMLHttpRequest();
		myDropzone = this;
		xhttp.onload = function(){
			const obj = JSON.parse(this.responseText);
			const files = obj.listFile;
			files.forEach((e,i)=>{
				myDropzone.emit("addedfile", e);
			    myDropzone.emit("thumbnail", e, assetLink+'/kas/'+e.nama);
			    myDropzone.emit("complete", e);
			   
			    //myDropzone.find('.dz-remove')
			    //console.log(myDropzone)	;

			    /*myDropzone.on("success",function(file,response){
		    		var fileuploded = file.previewElement.querySelector("[data-dz-name]");
		    		fileuploded.innerHTML = response.newfilename;


		    		var btndelete = file.previewElement.querySelector(".dz-remove");
		    		btndelete.setAttribute("id", 'delete-midia-id-'+response.newId);
		    	})*/

			})
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