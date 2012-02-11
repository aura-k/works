var checkRe = false;

function goAction(){
	var emailVal = $.trim($("#emailInput1").val()) + '@' + $.trim($("#emailInput2").val());

	if(checkEmail(emailVal) == false){ alert("이메일 형식을 올바르게 적어 주세요!");return; }	
	
	if(checkRe == false){
		checkRe = true;	
		$.post("saveAction.php", {'email' : emailVal }, function(data){
			// alert(data);
			if(data == "ok"){
				alert("정상적으로 저장 되었습니다.");
				location.reload();
			}else if(data == "re"){
				alert("이미 참여하신 이메일 입니다!");
			}else{
				alert("오류가 발생하였습니다.\n다시 한번 시도하여 주세요.");
			}
			checkRe = false;
		});
	}else{
		alert("참여 버튼을 한번 이상 누르셨습니다!\n잠시만 기다려주세요!");
		return;
	}
}

function checkEmail(email){
	if(/^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.)+([0-9a-zA-Z-]+)([\.0-9a-zA-Z-])*$/.test(email) == false) return false;
	return true;
}