function toggledropdown(){
	drop = document.getElementById("Dropdown");
	if(drop.style.height == "130px")
		closedropdown();
	else
	{
		drop.style.height = "130px";
		document.getElementById("Droparrow").innerHTML = "&#9652";
		drop.style.border = "solid 1px";
		drop.style.borderRadius = "4px";
		drop.style.borderColor = "rgb(150, 150, 150)";
	}
}

function closedropdown(){
	drop = document.getElementById("Dropdown");
	drop.style.height = "0px";
	document.getElementById("Droparrow").innerHTML = "&#9662";
	drop.style.border = "none";
}

/**********************************************Login**************************************************/

function lvalidusername(){
	result = true;
	username = document.getElementById("Lusername");
	if(username.value.trim() == ""){
		username.style.borderColor ="red";
		document.getElementById("Lusernameerror").innerHTML = "Pin number/Username cannot be empty";
		result = false;
	}
	else if(username.value.trim().length<6 || username.value.trim().length>15){
		username.style.borderColor ="red";
		document.getElementById("Lusernameerror").innerHTML = "Invalid Username/Pin";		
		result = false;
	}
	else{
		username.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Lusernameerror").innerHTML = "";

	}
	return result;
}

function lvalidpassword() {
	var result = true;
	password = document.getElementById("Lpassword");
	if(password.value == ""){
		password.style.borderColor = "red";
		document.getElementById("Lpassworderror").innerHTML = "Password cannot be empty";
		result = false;
	}
	else if(password.value.length<8 || password.value.length>20){
		password.style.borderColor = "red";
		document.getElementById("Lpassworderror").innerHTML = "Invalid Password";	
		result = false;
	}
	else{
		password.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Lpassworderror").innerHTML = "";
	}
	return result;
}

function lusernamedefault(username){
	username.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Lusernameerror").innerHTML = "";
	document.getElementById("Lusernameexisterror").innerHTML = "";
}

function lpassworddefault(password){
	password.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Lpassworderror").innerHTML = "";
}

function validloginform(){
	username = document.getElementById("Lusername");
	password = document.getElementById("Luassword");
	var user = lvalidusername(username);
	var pass = lvalidpassword(password);
	if(user && pass)
		return true;
	else
		return false;
}

/*function lvalidpasswordabove(){
	username = document.getElementById("Lusername");
	lvalidusername(username);
}*/

/**********************************************Signup**************************************************/

function validsignupform(){
	var user = svalidusername();
	var name = svalidname();
	var password = svalidpassword();
	var cpasword = svalidcpassword();
	var email = svalidemail();
	var mobile = svalidmobile();
	if(user && name  && password && cpasword && email && mobile)
		return true;
	else
		return false;
}



function changetopin(){
	document.getElementById("Spin").innerHTML = "Pin number";
}

function changetousername(){
	document.getElementById("Spin").innerHTML = "Username";
}

function svalidusername(){
	var result = true;
	var username = document.getElementById("Susername");
	if(username.value.trim() == ""){
		var string = document.getElementById("Spin").innerHTML;
		username.style.borderColor = "red";
		document.getElementById("Susernameerror").innerHTML = string + " cannot be empty";
		result = false;
	}
	else if(document.getElementById("Studentradioselected").checked && (username.value.trim().length != 10)){
		document.getElementById("Susernameerror").innerHTML = "Pin number must be 10 characters long";
		username.style.borderColor = "red";
		result = false;
	}
	else if(document.getElementById("Facultyradioselected").checked && (username.value.trim().length<6 || username.value.trim().length>15)){
		document.getElementById("Susernameerror").innerHTML = "Username must be 6 to 15 characters long";
		username.style.borderColor = "red";
		result = false;
	}
	/*else{
		username.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Susernameexisterror").innerHTML = "";
	}*/
	return result;
}

function susernamedefault(username){
	username.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Susernameerror").innerHTML = "";
}

function snamedefault(name){
	name.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Snameerror").innerHTML = "";
}

function spassworddefault(password){
	password.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Spassworderror").innerHTML = "";
}

function scpassworddefault(cpassword){
	cpassword.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Scpassworderror").innerHTML = "";
}

function semaildefault(email){
	email.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Semailerror").innerHTML = "";
}

function smobiledefault(mobile){
	mobile.style.borderColor = "rgb(150, 150, 150)";
	document.getElementById("Smobileerror").innerHTML = "";
}

function svalidname(){
	var result = true;
	var name = document.getElementById("Sname");
	if(name.value.trim() == ""){
		name.style.borderColor = "red";
		document.getElementById("Snameerror").innerHTML = "Name cannot be empty";
		result = false;
	}
	else{
		name.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Snameerror").innerHTML = "";
	}
	return result;
}

function svalidpassword(){
	var password = document.getElementById("Spassword");
	if(password.value == ""){
		password.style.borderColor = "red";
		document.getElementById("Spassworderror").innerHTML = "Password cannot be empty";
		return false;
	}
	else if(password.value.length < 8 || password.value.length > 20){
		password.style.borderColor = "red";
		document.getElementById("Spassworderror").innerHTML = "Password must be 8 to 20 characters long";
		return false;
	}
	else{
		password.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Spassworderror").innerHTML = "";
	}
	return true;
}

function svalidcpassword(){
	var password = document.getElementById("Spassword");
	var cpassword = document.getElementById("Scpassword");
	if(password.value != cpassword.value){
		cpassword.style.borderColor = "red";
		document.getElementById("Scpassworderror").innerHTML = "Password does not match";
		return false;
	}
	else{
		cpassword.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Scpassworderror").innerHTML = "";
	}
	return true;
}

function svalidemail(){
	var result = true;
	var email = document.getElementById("Semail");
	if(email.value.trim() == ""){
		email.style.borderColor = "red";
		document.getElementById("Semailerror").innerHTML = "Email cannot be empty";
		result = false;
	}
	else if(!email.value.includes('@') ||
			!email.value.includes('.', email.value.indexOf('@')+2) ||
			email.value.length - email.value.indexOf('@') < 5 ||
			email.value.lastIndexOf('.') == email.value.length-1){
		email.style.borderColor = "red";
		document.getElementById("Semailerror").innerHTML = "Invalid email";
		result = false;
	}
	else{
		email.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Semailerror").innerHTML = "";
	}
	return result;
}

function svalidmobile(){
	var result = true;
	var mobile = document.getElementById("Smobile");
	
	if(mobile.value.trim() == ""){
		mobile.style.borderColor = "red";
		document.getElementById("Smobileerror").innerHTML = "Mobile cannot be empty";
		result = false;
	}
	else if(mobile.value.trim().length != 10){
		mobile.style.borderColor = "red";
		document.getElementById("Smobileerror").innerHTML = "Invalid mobile number";
		result = false;
	}
	else{
		mobile.style.borderColor = "rgb(150, 150, 150)";
		document.getElementById("Smobileerror").innerHTML = "";
	}
	for (var i = mobile.value.trim().length - 1; i >= 0; i--) {
		var c = mobile.value.charCodeAt(i);
		if(c <48 || c > 57){
			result = false;
			break;
		}
	}
	return result;
}


/*********************************Questions**************************************/

function validpoll(){
	if(!document.getElementById("Yesradio").checked && !document.getElementById("Noradio").checked){
		document.getElementById("Pollerror").innerHTML = "You must choose one of the above option";
		return false;
	}
	document.getElementById("Pollerror").innerHTML = "";
	return true;
}

function susernameexists(msg){
	var username = document.getElementById("Susername");
	username.style.borderColor = "red";
	document.getElementById("Susernameerror").innerHTML = msg;
}

function hideiframe(){
	document.getElementById("iframe").setAttribute("src", "about:blank");
	document.getElementById("iframebackground").style.display = 'none';
}

function showiframe(button){
	document.getElementById("iframebackground").style.display = 'block';
}

function showcreatepolliframe(){

}

function createoptions(number){
	number = number.value;
	if(number>10 || number<2){
		document.getElementById("inputerror").innerHTML="Options must be 2 to 10";
	}
	else
	{
		document.getElementById("inputerror").innerHTML="";
		var inputs = document.getElementById("inputoptions");
		while(inputs.firstChild)
			inputs.removeChild(inputs.firstChild);
		for (var i = 2; i < number ; i++)
		{
			var input = document.createElement("input");
			input.setAttribute("type", "text");
			input.setAttribute("class", "Optioninput");
			input.setAttribute("placeholder", "Option " + `${i+1}`);
			input.setAttribute("name", "option"+`${i+1}`);
			input.setAttribute("oninput", "inputdefault(this)");
			inputs.appendChild(input);
			span = document.createElement("span");
			span.setAttribute("class", "errors");
			span.setAttribute("id", "Optionerror"+`${i+1}`);
			inputs.appendChild(span);
			inputs.appendChild(document.createElement("br"));
		}
	}
}

function validquestion(){
	var question = document.getElementById("Questioninput");
	if(question.value == ""){
		var question = document.getElementById("Questionerror").innerHTML = "Question cannot be empty";
		return false;
	}
	return true;
}

function validinput(){
	var input = document.getElementById("inputnumber");
	if(input>10 || input<2){
		return false;
	}
	return true;
}

function validinputs(){
	var inputs = document.getElementsByClassName("Optioninput");
	var inputnumber = document.getElementById("inputnumber").value;
	var result = true;
	for(var i=0;i<inputnumber;i++){
		if(inputs[i].value==""){
			inputs[i].nextElementSibling.innerHTML="Option cannot be empty";
			result=false;
		}
	}
	return result;
}

function inputdefault(input){
	input.nextElementSibling.innerHTML="";
}

function validcreatepoll(){
	var question = validquestion();
	var input = validinput();
	var inputs = validinputs();
	if(question && input && inputs){
		showcreatepolliframe();
		return true;
	}
	else
		return false;
}

function validanswer(){
	var radios = document.getElementsByClassName("radio");
	var l = radios.length;
	for (var i=0;i<l;i++) {
		if (radios[i].checked) {
			return true;
		}
	}
	document.getElementById("Pollsubmiterror").innerHTML = "You must select an option";
	return false;
}

function clearpollsubmiterror(){
	document.getElementById("Pollsubmiterror").innerHTML = "";
}

