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

	/*
	const obj = {
					"1":"Name",
					"2":"Age",
					"3":"Gender"
				}

	for(let key in obj){
		html += "<option value="+key+">"+obj[key]+"</option>";
		document.getElementById("area").innerHTML = html;
	}*/
}