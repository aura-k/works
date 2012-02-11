/*----------------회원가입 스크립트(by ke2n, 2010-04-09)------------------------*/
var isName = 0;
var isidnum = 0;
var isidentity = 0;
var ispw = 0;
var isoripw = 0;
var isemail = 0;
var ischeck = 0;


function onBlurLayer(identity_id){//포커스아웃됬을때 도움말 없애는 함수
	document.getElementById(identity_id + '_layer2').innerHTML = "";
}
function checkHangleChar(expression){//한글 입력만 허용하는 함수
	var strSpecial = ".,`~!@#$%^&*()_+|\;\\/:=-<>[]{}'\"1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
	
	for(i=0;i<expression.length;i++){
		for(j=0;j<strSpecial.length;j++){
			if(expression.charAt(i) == strSpecial.charAt(j)){
			return true;
			}
		}
	}
}
function checkSpecialChar(expression){//영어, 숫자, _, - 만 허용하는 함수
	var strSpecial = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-";
	
	for(i=0;i<expression.length;i++){
		for(j=0;j<strSpecial.length;j++){
			if(expression.charAt(i) == strSpecial.charAt(j)){
			return true;
			}
		}
	}
}
function checkNumChar(expression){//숫자 만 허용하는 함수
	var strSpecial = "1234567890";
	
	for(i=0;i<expression.length;i++){
		for(j=0;j<strSpecial.length;j++){
			if(expression.charAt(i) == strSpecial.charAt(j)){
			return true;
			}
		}
	}
}
function onlyNumber(obj){  
	var str = obj.value;  
	str = new String(str);  
	var Re = /[^0-9]/g;    
	str = str.replace(Re,'');  
	obj.value = str;  
}  

function checkemail_normal(){
	var email = document.getElementById('email');
	var email_layer = document.getElementById('email_layer');
	var email_layer2 = document.getElementById('email_layer2');

	if(!checkEmail(email.value)) {
		email_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		email_layer2.innerHTML = "올바른 형식의 Email을 써주세요.";
		isemail = 0;
	}else{
		email_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		email_layer2.innerHTML = "";
		isemail = 1;
	}
}

function checkname_signup(){
	var signup_name = document.getElementById('signup_name');
	var signup_name_layer = document.getElementById('signup_name_layer');
	var signup_name_layer2 = document.getElementById('signup_name_layer2');

	if( signup_name.value.length <= 1 ) {
		signup_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		isName = 0;
	}else if(checkHangleChar(signup_name.value)){
		signup_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		signup_name_layer2.innerHTML = "한글만 입력해주세요.";
		isName = 0;
	}else{
		signup_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		signup_name_layer2.innerHTML = "";
		isName = 1;
	}
}
function changeidnum(){
	var idnumber = document.getElementById('idnumber');
	var idnumber2 = document.getElementById('idnumber2');

	if( idnumber.value.length >= 6 )
		idnumber2.focus();
}
function checkidnum_signup(){
	var idnumber = document.getElementById('idnumber');
	var idnumber2 = document.getElementById('idnumber2');
	var idnumber_layer = document.getElementById('idnumber_layer');
	var idnumber_layer2 = document.getElementById('idnumber_layer2');
	
	if(idnumber2.value.length == 7){
		if(!isValidJuminNo(idnumber.value, idnumber2.value)) {
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			idnumber_layer2.innerHTML = "잘못된 형식의 주민등록번호입니다.";
			isidnum = 0;
		}else{
			startRequest('idnumber');
		}
	}else{
		idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		idnumber_layer2.innerHTML = "";
		isidnum = 0;
	}
}
function checkidentity_signup(){
	var signup_id = document.getElementById('signup_id');
	var signup_id_layer = document.getElementById('signup_id_layer');
	var signup_id_layer2 = document.getElementById('signup_id_layer2');

	if( signup_id.value.length < 4 || signup_id.value.length > 11) {
		signup_id_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		signup_id_layer2.innerHTML = "ID는 4자 이상, 11자 이내로 써주세요";
		isidentity = 0;
	}else if(!checkSpecialChar(signup_id.value)){
		signup_id_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		signup_id_layer2.innerHTML = "한글 및 특수문자는 입력할 수 없습니다.";
		isidentity = 0;
	}else{
		startRequest('signup_id');
	}
}
function checkpw_signup(){
	var signup_pass = document.getElementById('signup_pass');
	var signup_pass2 = document.getElementById('signup_pass2');
	var signup_pass_layer = document.getElementById('signup_pass_layer');
	var signup_pass_layer2 = document.getElementById('signup_pass_layer2');

	if( signup_pass.value == signup_pass2.value && signup_pass.value.length > 3) {
		signup_pass_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		signup_pass_layer2.innerHTML = "";
		ispw = 1;
	}else if(signup_pass.value.length <= 3 || signup_pass2.value.length <= 3){
		signup_pass_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		signup_pass_layer2.innerHTML = "비밀번호는 4자이상으로 써주세요.";
		ispw = 0;
	}else{
		signup_pass_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		signup_pass_layer2.innerHTML = "입력한 PW가 불일치 합니다.";
		ispw = 0;
	}
}
function checkemail_signup(){
	var email = document.getElementById('email');
	var email_layer = document.getElementById('email_layer');
	var email_layer2 = document.getElementById('email_layer2');

	if(!checkEmail(email.value)) {
		email_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		email_layer2.innerHTML = "올바른 형식의 Email을 써주세요.";
		isemail = 0;
	}else{
		startRequest('email');
	}
}
function ischeck_signup(){
	var checkbox = document.getElementById('checkbox');
	var checkbox_layer = document.getElementById('checkbox_layer');

	if(!checkbox.checked) {
		checkbox_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		ischeck = 0;
	}else{
		checkbox_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		ischeck = 1;
	}
}
function checkEmail(email){
	if(/^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.)+([0-9a-zA-Z-]+)([\.0-9a-zA-Z-])*$/.test(email) == false) return false;
	return true;
}


function signup(){
	var signup_id = document.getElementById('signup_id');
	var signup_name = document.getElementById('signup_name');
	var idnumber = document.getElementById('idnumber');
	var idnumber2 = document.getElementById('idnumber2');
	var signup_pass = document.getElementById('signup_pass');
	var email = document.getElementById('email');

	isSubmit = isName + isidnum + isidentity + ispw + isemail + ischeck;

	if(isSubmit == 6){
		createXMLHttpRequest();
		sPrams = "signup_id="+signup_id.value+"&signup_name="+signup_name.value+"&idnumber="+(idnumber.value+idnumber2.value)+"&signup_pass="+signup_pass.value+"&email="+email.value;
			
		xmlHttp.open("post", "../php/signup_action.php", false);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = signupChange;
		xmlHttp.send(sPrams);
	}
}

function signupChange(){
	if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
				alert(xmlHttp.responseText);
				closeDialogByDom();
		}
	}
}

function toEmail(){
	var email = document.getElementById('email').value;
	var sid_layer = document.getElementById('e_sid_layer').value;
	var comment = document.getElementById('comment').value;

	if(isemail == 1){
		$.post("../php/email_action.php",
			{"email" : email,
			 "sid_layer" : sid_layer,
			 "comment" : comment
			},function(data){
				if(data == 'login'){
					alert("로그인하여 주세요.");
					return;
				}
				alert(data);
				closeDialogByDom();
			});
	}
}


////////////////////정보수정부분/////////////////////////////////
function checkOrigpw_modify(){
	var original_pass = document.getElementById('original_pass');
	var original_pass_layer = document.getElementById('original_pass_layer');
	var original_pass_layer2 = document.getElementById('original_pass_layer2');

	if( original_pass.value.length > 3) {
		original_pass_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		original_pass_layer2.innerHTML = "";
		isoripw = 1;
	}else if(original_pass.value.length <= 3){
		original_pass_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		isoripw = 0;
	}else{}
}
function checkemail_modify(){
	var email = document.getElementById('email');
	var email_layer = document.getElementById('email_layer');
	var email_layer2 = document.getElementById('email_layer2');

	if(!checkEmail(email.value)) {
		email_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		email_layer2.innerHTML = "올바른 형식의 Email을 써주세요.";
		isemail = 0;
	}else{
		startRequest('email');
	}
}
function modify(){
	var signup_pass = document.getElementById('signup_pass');
	var original_pass = document.getElementById('original_pass');
	var email = document.getElementById('email');

	isSubmit = ispw + isemail + isoripw;

	if(isSubmit == 3){
		$.post("../php/modify_action.php",
			{"original_pass" : original_pass.value,
			 "signup_pass" : signup_pass.value,
			 "email" : email.value
			},function(data){
				if(data == 'fail') alert("기존 비밀번호가 일치하지 않습니다.");
				else{
					alert(data);
					closeDialogByDom();
					location.href = "../html/main.html";
				}
		});
	}
	ispw=0;
	isemail=0;
	isoripw=0;
}

////////////////////상품주문부분/////////////////////////////////
var deli_isName = 0;
var deli_isMobi = 0;
var deli_isAdd = 0;

function checkname_deli(){
	var deli_name = document.getElementById('deli_name');
	var deli_name_layer = document.getElementById('deli_name_layer');
	var deli_name_layer2 = document.getElementById('deli_name_layer2');

	if( deli_name.value.length <= 1 ) {
		deli_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		deli_isName = 0;
	}else if(checkHangleChar(deli_name.value)){
		deli_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		deli_name_layer2.innerHTML = "한글만 입력해주세요.";
		deli_isName = 0;
	}else{
		deli_name_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		deli_name_layer2.innerHTML = "";
		deli_isName = 1;
	}
}

function checkmobi_deli(){
	var mobi1 = document.getElementById('mobi1');
	var mobi2 = document.getElementById('mobi2');
	var mobi3 = document.getElementById('mobi3');
	var deli_mobi_layer = document.getElementById('deli_mobi_layer');
	var deli_mobi_layer2 = document.getElementById('deli_mobi_layer2');

	if(mobi1.value.length <= 1 || mobi2.value.length <= 1 || mobi3.value.length <= 1) {
		deli_mobi_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		deli_isMobi = 0;
	}else{
		deli_mobi_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		deli_mobi_layer2.innerHTML = "";
		deli_isMobi = 1;
	}
}

function checkadd_deli(){
	var deli_add = document.getElementById('deli_add');
	var deli_add_layer = document.getElementById('deli_add_layer');
	var deli_add_layer2 = document.getElementById('deli_add_layer2');

	if( deli_add.value.length <= 2 ) {
		deli_add_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		deli_isAdd = 0;
	}else{
		deli_add_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		deli_add_layer2.innerHTML = "";
		deli_isAdd = 1;
	}
}

function action_ship(option){
	isSubmit = 0;
	
	isSubmit = deli_isName + deli_isMobi + deli_isAdd;
	
	if(isSubmit == 3){
		if(option == 'make'){
			make_ship();
		}else if(option == 'modi'){
			modi_ship();
		}
		deli_isName = 0;
		deli_isMobi = 0;
		deli_isAdd = 0;
	}
}