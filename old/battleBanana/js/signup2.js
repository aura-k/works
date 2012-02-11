/*----------------회원가입 스크립트(by ke2n, 2010-04-09)------------------------*/
var isName = 0;
var isidnum = 0;
var isidentity = 0;
var ispw = 0;
var isemail = 0;
var ischeck = 0;
var isSubmit = 0;

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
function checkEmail(email){
	if(/^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.)+([0-9a-zA-Z-]+)([\.0-9a-zA-Z-])*$/.test(email) == false) return false;
	return true;
}

$(function(){
	$('#signup_name').keyup(
		function(){
			if($('#signup_name').val().length <= 1){
				$('#signup_name_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_name_layer2').html("");
				isName = 0;
			}else if(checkHangleChar($('#signup_name').val())){
				$('#signup_name_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_name_layer2').html("한글만 입력해 주세요.");
				isName = 0;
			}else{
				$('#signup_name_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");
				$('#signup_name_layer2').html("");
				isName = 1;
			}
		}
	);

	$('#idnumber').keyup(
		function(){
			if($('#idnumber').val().length >= 6){
				$('#idnumber2').focus();
			}else{
				$('#idnumber_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				isidnum = 0;
			}
		}
	);

	$('#idnumber2').keyup(
		function(){
			if($('#idnumber2').val().length == 7){
				if(!isValidJuminNo($('#idnumber').val(), $('#idnumber2').val())){
					$('#idnumber_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
					$('#idnumber_layer2').html("잘못된 형식의 주민등록번호 입니다.");
					isidnum = 0;
				}else{
					$.get(
						'../php/ajax/checkid.php',
						{idnumber:$('#idnumber').val()+$('#idnumber2').val()},
						function(data) {
							if(data){
								$('#idnumber_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");
								$('#idnumber_layer2').html("");
								isidnum = 1;
							}else{
								$('#idnumber_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
								$('#idnumber_layer2').html("이미 존재하는 주민등록번호입니다.");
								isidnum = 0;
							}
					});

					
				}
			}else{
				$('#idnumber_layer2').html("");
				isidnum = 0;
			}
		}
	);

	$('#signup_id').keyup(
		function(){
			if($('#signup_id').val().length <= 2){
				$('#signup_id_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_id_layer2').html("");
				isidentity = 0;
			}else if($('#signup_id').val().length < 4 || $('#signup_id').val().length > 11){
				$('#signup_id_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_id_layer2').html("ID는 4자 이상, 11자 이내로 써주세요.");
				isidentity = 0;
			}else if(!checkSpecialChar($('#signup_id').val())){
				$('#signup_id_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_id_layer2').html("한글 및 특수문자는 입력할 수 없습니다.");
				isidentity = 0;
			}else{
				$.get(
						'../php/ajax/checkid.php',
						{id:$('#signup_id').val()},
						function(data) {
							if(data){
								$('#signup_id_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");
								$('#signup_id_layer2').html("");
								isidentity = 1;
							}else{
								$('#signup_id_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
								$('#signup_id_layer2').html("이미 존재하는 아이디 입니다.");
								isidentity = 0;
							}
				});
			}
		}
	);

	$('#signup_pass').blur(
		function(){
			if($('#signup_pass').val().length == 0){
				$('#signup_pass_layer2').html("");
			}else if($('#signup_pass').val().length < 4){
				$('#signup_pass_layer2').html("비밀번호는 4자 이상으로 써주세요.");
			}else if($('#signup_pass2').val() == ""){
				$('#signup_pass_layer2').html("확인을 위해 한번 더 입력해 주세요.");
			}
		}
	);
	$('#signup_pass').keyup(
		function(){
			if(($('#signup_pass').val() == $('#signup_pass2').val()) && $('#signup_pass').val().length >= 4){
				$('#signup_pass_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");
				$('#signup_pass_layer2').html("");
				ispw = 1;
			}else{
				$('#signup_pass_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_pass_layer2').html("비밀번호가 일치하지 않습니다.");
				ispw = 0;
			}
		}
	);

	$('#signup_pass2').keyup(
		function(){
			if(($('#signup_pass').val() == $('#signup_pass2').val()) && $('#signup_pass').val().length >= 4){
				$('#signup_pass_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");
				$('#signup_pass_layer2').html("");
				ispw = 1;
			}else if(($('#signup_pass').val().length == $('#signup_pass2').val().length) && $('#signup_pass2').val().length < 4){
				$('#signup_pass_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_pass_layer2').html("비밀번호는 4자 이상으로 써주세요.");
				ispw = 0;
			}else if($('#signup_pass').val().length == $('#signup_pass2').val().length){
				$('#signup_pass_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_pass_layer2').html("비밀번호가 일치하지 않습니다.");
				ispw = 0;
			}else{
				$('#signup_pass_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#signup_pass_layer2').html("비밀번호가 일치하지 않습니다.");
				ispw = 0;
			}
		}
	);

	$('#email').keyup(
		function(){
			if($('#email').val().length < 4){
				$('#email_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#email_layer2').html("");
				isemail = 0;
			}else if(!checkEmail($('#email').val())){
				$('#email_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				$('#email_layer2').html("올바른 형식의 Email을 써주세요.");
				isemail = 0;
			}else{
				$.get(
						'../php/ajax/checkid.php',
						{email:$('#email').val()},
						function(data) {
							if(data){
								$('#email_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");
								$('#email_layer2').html("");
								isemail = 1;
							}else{
								$('#email_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
								$('#email_layer2').html("이미 존재하는 Email 입니다.");
								isemail = 0;
							}
				});
			}
		}
	);

	$('#checkbox').click(
		function(){
			if(!$('#checkbox').is(':checked')){
				$('#checkbox_layer').html("<img src=\"../img/pop/img_conf_x.gif\"/>");
				ischeck = 0;
			}else{
				$('#checkbox_layer').html("<img src=\"../img/pop/img_conf_ok.gif\"/>");;
				ischeck = 1;
			}
		}
	);

	$('#btn_ok').click(
		function(){
			isSubmit = isName + isidnum + isidentity + ispw + isemail + ischeck;
			if(isSubmit == 6){
				alert("다입력");
			}
		}
	);
});