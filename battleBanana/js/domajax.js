/*-------AJAX적용 부분-------*/
var xmlHttp;
function createXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
}

function startRequest(identity_id) {
    createXMLHttpRequest();

	if(identity_id == "signup_id"){
		document.getElementById(identity_id+'_layer').innerHTML = "<img src=\"../img/ajax_loader.gif\"/>";
	    xmlHttp.onreadystatechange = SignupIdChange;
		xmlHttp.open("GET", "../php/ajax/checkid.php?id="+ document.getElementById(identity_id).value, true);
	    xmlHttp.send(null);
	}else if(identity_id == "email"){
		document.getElementById(identity_id+'_layer').innerHTML = "<img src=\"../img/ajax_loader.gif\"/>";
		xmlHttp.onreadystatechange = SignupEmailChange;
		xmlHttp.open("GET", "../php/ajax/checkid.php?email="+ document.getElementById(identity_id).value, true);
	    xmlHttp.send(null);
	}else if(identity_id == "idnumber"){
		document.getElementById(identity_id+'_layer').innerHTML = "<img src=\"../img/ajax_loader.gif\"/>";
		xmlHttp.onreadystatechange = SignupIdnumberChange;
		xmlHttp.open("GET", "../php/ajax/checkid.php?idnumber="+ document.getElementById(identity_id).value + document.getElementById(identity_id + "2").value, true);
	    xmlHttp.send(null);
	}else if(identity_id == "get_id"){
		document.getElementById(identity_id+'_layer').innerHTML = "<img src=\"../img/ajax_loader.gif\"/>";
		xmlHttp.onreadystatechange = GetIdChange;
		var params = "name="+ document.getElementById('find_name').value +"&idnumber="+ document.getElementById('idnumber').value + document.getElementById('idnumber2').value;
		xmlHttp.open("GET", "../php/ajax/checkid.php?"+encodeURI(params), true);
		xmlHttp.send(null);
	}else if(identity_id == "get_pass"){
		document.getElementById('email_layer').innerHTML = "<img src=\"../img/ajax_loader.gif\"/>";
		xmlHttp.onreadystatechange = GetPassChange;
		var params = "name="+ document.getElementById('find_name').value +"&idnumber="+ document.getElementById('idnumber').value + document.getElementById('idnumber2').value + "&email=" + document.getElementById('email').value;
		xmlHttp.open("GET", "../php/ajax/checkid.php?"+encodeURI(params), true);
		xmlHttp.send(null);
	}
}
function SignupIdChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
			if(xmlHttp.responseText){
				document.getElementById('signup_id_layer').innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" alt=\"아이디가능\"/>";
				document.getElementById('signup_id_layer2').innerHTML = "";
				isidentity =  1;
			}else{
				document.getElementById('signup_id_layer').innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" alt=\"아이디중복\"/>";
				document.getElementById('signup_id_layer2').innerHTML = "이미 존재하는 아이디입니다.";
				isidentity = 0;
			}
        }
    }
}
function SignupEmailChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
			if(xmlHttp.responseText){
				document.getElementById('email_layer').innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" alt=\"이메일가능\"/>";
				document.getElementById('email_layer2').innerHTML = "";
				isemail =  1;
			}else{
				document.getElementById('email_layer').innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" alt=\"이메일중복\"/>";
				document.getElementById('email_layer2').innerHTML = "이미 존재하는 Email입니다.";
				isemail = 0;
			}
        }
    }
}
function SignupIdnumberChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
			if(xmlHttp.responseText){
				document.getElementById('idnumber_layer').innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\"/>";
				document.getElementById('idnumber_layer2').innerHTML = "";
				isidnum =  1;
			}else{
				document.getElementById('idnumber_layer').innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
				document.getElementById('idnumber_layer2').innerHTML = "이미 존재하는 주민등록번호입니다.";
				isidnum = 0;
			}
        }
    }
}
function GetIdChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
			if(xmlHttp.responseText == "failed"){
				document.getElementById('get_id_layer').innerHTML = "사용자 정보를 찾을 수 없습니다.";
				isidnum_find =  0;
			}else{
				document.getElementById('get_id_layer').innerHTML = xmlHttp.responseText;
				isidnum_find = 1;
			}
        }
    }
}
function GetPassChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
			if(xmlHttp.responseText == "failed"){
				document.getElementById('email_layer').innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
				document.getElementById('email_layer2').innerHTML = "가입시 입력한 Email을 써주세요.";
				isemail_find =  0;
			}else{
				document.getElementById('email_layer').innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\"/>";
				document.getElementById('email_layer2').innerHTML = "";
				isemail_find =  1;
			}
        }
    }
}