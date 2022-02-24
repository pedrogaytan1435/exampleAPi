
let btnEnviar = document.getElementById('btnEnviar');
let lbtemp = document.getElementById('lbtemp');
let lbusers = document.getElementById('lbuse');
//evento del boton de enviar
btnEnviar.onclick = function(){
	getElemtsByIdAndValidation();
};
document.getElementById('user').addEventListener("focusout", inputuser);
document.getElementById('temp').addEventListener("focusout", inputtemp);

		
function inputtemp() {
	if(document.getElementById('temp').value ===''){
   		lbtemp.innerHTML = "Campo Vacio Favor de completarlo";
   		lbtemp.style.display= "block";
   		document.getElementById('temp').style.border = "1px solid red";
	}
   	else if(document.getElementById('temp').value < 30 || document.getElementById('temp').value > 40){
   		lbtemp.style.display= "block";
   		lbtemp.innerHTML = "La temperatura valida debe de estar entre 30° - 40°.";
   		document.getElementById('temp').style.border = "1px solid red";
   	}
   	else{
   		lbtemp.style.display= "none";
   		document.getElementById('temp').style.border = "1px solid #4CAF50";
   	}
}
function inputuser() {
	if(document.getElementById('user').value.trim() == ""){
   		lbusers.innerHTML = "Campo Vacio Favor de completarlo";
   		lbusers.style.display= "block";
   		document.getElementById('user').style.border = "1px solid red";
	}
   	else if(document.getElementById('user').value.length < 8 ){
   		lbusers.style.display= "block";
   		lbusers.innerHTML = "Agregar Nombre completo.";
   		document.getElementById('user').style.border = "1px solid red";
   	}
   	else{
   		lbusers.style.display= "none";
   		document.getElementById('user').style.border = "1px solid #4CAF50";

   	}
}
//funcion de validacion de campos
function getElemtsByIdAndValidation(){
	let user = document.getElementById('user');
	let temp = document.getElementById('temp');
	//let suc = document.getElementById('suc');
	if(user.value.trim() == "" || temp.value ===''){
		inputtemp();
		inputuser();
	}
	else if(user.value.length < 8 ){
		inputuser();
	}
	else if(temp.value < 30 || temp.value > 40){
		inputtemp();
	}
	else	
		sendForm(user.value, temp.value);
}
//envio de datos por el metodo Post
function sendForm(user, temp){
	let request = new XMLHttpRequest();
	var url = '../controller/app.php';
	let alerta = "";
	var params = 'user='+user+'&temp='+temp+"&suc=table";
	request.open('POST', url, true);
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');//no tomar encuenta si
	request.onreadystatechange = function() {
		/*'<div class="alert success"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
		  <strong>Guardado!</strong>*/
	    if(request.readyState == 4 && request.status == 200) {
	    	
	    	console.write("sss")

		}
	}
	request.send(params);
}