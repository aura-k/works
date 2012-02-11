var checkRe = false;

$(function(){
	window.scrollTo(0,0.9);

	$('.close').click(function(){location.href="lct.php?no=2";});
	$('#introDiv .button').click(function(){
		goStart();
		$.get("lct_non_redirect.php?no=1");
	});

	$('#QuizDiv #q1 img:eq(1)').click(function(){correctAns(1);});
	$('#QuizDiv #q1 img:eq(3), #QuizDiv #q1 img:eq(4)').click(function(){wrongAns();});

	$('#QuizDiv #q2 img:eq(2)').click(function(){correctAns(2);});
	$('#QuizDiv #q2 img:eq(1), #QuizDiv #q2 img:eq(4)').click(function(){wrongAns();});

	$('#QuizDiv #q3 img:eq(2)').click(function(){correctAns(3);});
	$('#QuizDiv #q3 img:eq(1)').click(function(){wrongAns();});

	$('#inputDiv .button').click(function(){
		goAction();
		$.get("lct_non_redirect.php?no=2");
	});
});


function goAction(){
	var url = "http://mobizap.co.kr/mom/index3.php";
	var nameVal = $.trim($('#nameInput').val());
	var phoneVal = $.trim($('#phoneInput').val());
	
	if(nameVal == "" || nameVal == null){ alert("이름을 올바르게 적어 주세요!");return; }	
	if(!phoneVal.match("^0[1|2|7][0-9]{7,9}$")){ alert("전화번호를 올바르게 적어 주세요!\n( '-' 또는 특수문자 제외 )");return; }

	//alert(nameVal + "\n" + phoneVal);
	if(checkRe == false){
		checkRe = true;	
		$.post("saveAction.php", {'name' : nameVal, 'phone' : phoneVal }, function(data){
			//alert(data);
			if(data == "ok"){
				alert("스타벅스 기프티콘에 당첨되셨습니다! 더불어 '파리크라상 커플식사권'에 응모되셨습니다. 커플식사권은 많이 참여하실수록 당첨확률이 높아집니다.");
				location.href = url;
			}else if(data == "over"){
				alert("죄송합니다. 오늘 스타벅스 기프티콘이 모두 소진되었습니다. 하지만 \"파리크라상 커플식사권\"에 응모되셨습니다. 커플식사권은 많이 참여하실수록 당첨확률이 높아집니다.");
				location.href = url;
			}else if(data == "re"){
				alert("스타벅스는 일주일에 한 번 응모 가능합니다. 하지만 \"파리크라상 커플식사권\"에 응모되셨습니다. 커플식사권은 많이 참여하실수록 당첨확률이 높아집니다.");
				location.href = url;
			}else{
				alert("오류가 발생하였습니다.\n다시 한번 시도하여 주세요.");
			}
			checkRe = false;
		});
	}else{
		alert("응모 버튼을 한번 이상 누르셨습니다!\n잠시만 기다려주세요!");
		return;
	}
}

function goStart(){
	$('#introDiv').hide();
	$('#QuizDiv').show();
}

function correctAns(num){
	$('.desc' + num).fadeIn(500);
	
	setTimeout(function(){
		if(num == 1 || num == 2){
			$('#q' + num).hide();
			$('#q' + (num + 1)).show();
		} else if(num == 3){
			$('#QuizDiv').hide();
			$('#inputDiv').show();
		}
	}, 1500 );
}

function wrongAns(){
	alert("틀렸습니다~! 다시한번 풀어주세요.");
}