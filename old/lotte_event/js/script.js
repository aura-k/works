var drawEvent = 0;
function isUA(name) { 
	if (navigator.userAgent.indexOf(name) != -1) { 
			return true; 
	} 
	return false; 
} 
function sendAction(){
	//var str = $("#actionForm").serialize();
	var phoneVal = $("#phone").val();
	var typeVal = $("#type").val();
	var str = "&phone="+phoneVal+"&type="+typeVal;

	if(phoneVal != ''){
		if(confirm("다음 정보가 맞습니까?\n전화번호: "+phoneVal)){
			if (drawEvent == 0) {
				drawEvent = 1;
				$.post('./php/gift_action.php', str, function(data){
					if(data == "ok"){
						//
						alert("성공");
						document.getElementById('phone').value='';
						openResultPop();
					}else if(data == "re"){
						alert("이미 참여하신 이벤트 입니다!");
						document.getElementById('name').value='';
						document.getElementById('phone').value='';
						document.getElementById('email').value='';
						closePop();
					}else alert("발송이 실패되었습니다.다시한번 시도해 주세요.");
					drawEvent = 0;
				});
			}
		}
	}
}
function openResultPop(){
	$('.popup_more').fadeOut(500);		
	$('.popup_result').fadeIn(500);			
}
function openPop(){
	$('.popup_more').fadeIn(500);			
}
function closePop(){
	$('.popup_more').fadeOut(500);
}