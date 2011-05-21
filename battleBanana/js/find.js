/*----------------아이디,비밀번호 찾기 스크립트(by ke2n, 2010-04-11)------------------------*/
var isName_find = 0;
var isidnum_find = 0;
var isemail_find = 0;

function checkname_find(){
	var find_name = document.getElementById('find_name');
	var find_name_layer = document.getElementById('find_name_layer');
	var find_name_layer2 = document.getElementById('find_name_layer2');
	var idnumber2 = document.getElementById('idnumber2');

	if( find_name.value.length <= 1 ) {
		find_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		document.getElementById('get_id_layer').innerHTML = "";
		isName_find = 0;
	}else if(checkHangleChar(find_name.value)){
		find_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		find_name_layer2.innerHTML = "한글만 입력해주세요.";
		document.getElementById('get_id_layer').innerHTML = "";
		isName_find = 0;
	}else{
		if(idnumber2.value.length == 7){
			startRequest('get_id');
			find_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
			isName_find = 1;
		}else{
			find_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
			find_name_layer2.innerHTML = "";
			isName_find = 1;
		}
	}
}
function checkidnum_find(){
	var idnumber = document.getElementById('idnumber');
	var idnumber2 = document.getElementById('idnumber2');
	var idnumber_layer = document.getElementById('idnumber_layer');
	var idnumber_layer2 = document.getElementById('idnumber_layer2');
	
	if(idnumber2.value.length == 7){
		if(!isValidJuminNo(idnumber.value, idnumber2.value)) {
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			idnumber_layer2.innerHTML = "잘못된 형식의 주민등록번호입니다.";
			isidnum_find = 0;
		}
		else{
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
			isidnum_find = 1;

			if(isName_find == 1){
				startRequest('get_id');
			}
		}
	}else{
		idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		idnumber_layer2.innerHTML = "";
		document.getElementById('get_id_layer').innerHTML = "";
		isidnum_find = 0;
	}
}
function checkemail_find(){
	var email = document.getElementById('email');
	var email_layer = document.getElementById('email_layer');
	var email_layer2 = document.getElementById('email_layer2');
	var find_name = document.getElementById('find_name');
	var idnumber = document.getElementById('idnumber');
	var idnumber2 = document.getElementById('idnumber2');

	if(!checkEmail(email.value)) {
		email_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		email_layer2.innerHTML = "올바른 형식의 Email을 써주세요.";
		isemail_find = 0;
	}else{
		if(find_name.value != '' && idnumber.value != '' && idnumber2.value != ''){
			startRequest('get_pass');
		}else{
			email_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			email_layer2.innerHTML = "사용자 정보를 모두 기입하세요.";
			isemail_find = 0;
		}
	}
}

function find(){
	var find_name = document.getElementById('find_name');
	var idnumber = document.getElementById('idnumber');
	var idnumber2 = document.getElementById('idnumber2');
	var email = document.getElementById('email');

	isSubmit_find = isName_find + isidnum_find + isemail_find;

	if(isSubmit_find == 3){
			createXMLHttpRequest();
			sPrams = "name="+find_name.value+"&idnumber="+(idnumber.value+idnumber2.value)+"&email="+email.value;
			
			xmlHttp.open("post", "../php/find_action.php", false);
			xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xmlHttp.onreadystatechange = findChange;
			xmlHttp.send(sPrams);
	}
}

function findChange(){
	if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
				alert(xmlHttp.responseText);
				closeDialogByDom();
		}
	}
}