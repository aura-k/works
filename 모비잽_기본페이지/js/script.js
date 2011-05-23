var checkRe = false;

$(function(){
	$('#submit').click(function(){goAction();});
});
function checkEmail(email){
	if(/^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.)+([0-9a-zA-Z-]+)([\.0-9a-zA-Z-])*$/.test(email) == false) return false;
	return true;
}
function goAction(){
	var companyVal = $('#company').val();
	var phoneVal = $('#phone1').val() + $('#phone2').val() + $('#phone3').val();
	var managerVal = $('#manager').val();
	var emailVal = $('#email').val();
	//var budgetVal = $('#budget').val();
	var commentVal = $('#comment').val();
	var typeVal = $('#type').val();
	
	if(companyVal == "" || companyVal == null){ alert("회사명을 올바르게 적어 주세요!");return; }	
	if(!phoneVal.match("^0[1|2|7][0-9]{7,9}$")){ alert("전화번호를 올바르게 적어 주세요!\n( '-' 또는 특수문자 제외 )");return; }
	if(managerVal == "" || managerVal == null){ alert("담당자명을 올바르게 적어 주세요!");return; }
	if(checkEmail(emailVal) == false){ alert("이메일 형식을 올바르게 적어 주세요!");return; }
	if(commentVal == "" || commentVal == null){ alert("내용을 올바르게 적어 주세요!");return; }

	var postVal = {'company' : companyVal, 'phone' : phoneVal, 'manager' : managerVal, 'email' : emailVal, 'comment' : commentVal, 'type' : typeVal }

	if(checkRe == false){
		checkRe = true;	
		$.post("mail_post.php", postVal, function(data){
			if(data == "ok"){
				alert("문의가 정상적으로 완료 되었습니다.");
				location.reload();
			}else{
				alert("오류가 발생하였습니다.\n다시 한번 시도하여 주세요.");
			}
			checkRe = false;
		});
	}else{
		alert("보내기 버튼을 이미 누르셨습니다!\n잠시만 기다려주세요!");
		return;
	}
}