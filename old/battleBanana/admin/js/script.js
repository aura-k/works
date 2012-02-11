function cacelAction(tid,id,amount){
	if(confirm("정말로 바나나충전을 취소 하시겠습니까?\n\n경매ID : "+id+"\n바나나수량 : "+amount+"개")){
		$.post("./php/cancelAction.php",{"tid":tid},function(data){
			if(data == "true"){
				alert("정상적으로 취소되었습니다.");
				location.reload();
			}else
				alert("경매번호가 없거나 잘못되었습니다!");
			
		});
	}
}
function recommendAction(uid, recid){
	if(confirm("추천적용을 하시겠습니까?\n\nID : "+uid+"가,\nID : "+recid+"를 추천합니다.")){
	$.post("./php/recommendAction.php",{"uid":uid, "recid":recid},function(data){
			if(data == "true"){
				alert("정상적으로 추천되었습니다.");
				location.reload();
			}else if(data == "repeat"){
				alert("이미 추전적용 하였습니다.");
				location.reload();
			}else if(data == "null"){
				alert("해당 ID가 존재하지 않습니다.");
				location.reload();
			}else
				alert("에러가 발생했습니다!");
			
	});
	}
}
function copy_text(txt){
    if (window.clipboardData){
        window.clipboardData.setData('Text', txt);
		alert('입금할 계좌 정보가 복사되었습니다!');
    }else{ prompt("CTRL+C키를 누르시면 복사가 됩니다.",txt); }
    return false;
}
function openBuyNow(num){
	window.open('pop_buynow.html?sid='+num,'팝업','width=570,height=500,scrollbars=yes');
}
function openHistory(num){
	window.open('pop_history.html?sid='+num+'&p=1','팝업','width=600,height=500,scrollbars=yes');
}
function openModify(num){
	window.open('pop_auction_modify.html?sid='+num,'팝업','width=870,height=500,scrollbars=yes');
}
function openShipComm(num, id){
	window.open('09_delivery_to_bb.html?sid='+num+'&id='+id+'','팝업','width=600,height=200,scrollbars=yes');
}
function openWin(name,num){
	window.open(name+'.html?sid='+num+'&p=0','팝업','width=600,height=500,scrollbars=yes');
}
function del_rec(num){
	if(confirm("정말로 진행중인 경매를 삭제 하시겠습니까?\n복구가 불가능하니 가능하면 DB백업후 이용해주세요.\n경매번호 : "+num)){
		$.post("./php/delete_record.php",{"sid":num},function(data){
			alert(data);
			location.reload();
		});
	}
}


function writeNews(){
	window.open('pop_news_write.html','팝업','width=500,height=500,scrollbars=yes');
}
function submitNews(){
var ir1 = document.getElementById('ir1');
var ir1 = document.getElementById('form1');
oEditors[0].exec("UPDATE_IR_FIELD", []);
	// 에디터의 내용에 대한 값 검증은 이곳에서 textarea 필드인 ir1의 값을 이용해서 처리하면 됩니다.

	try{
		// 이 라인은 현재 사용 중인 폼에 따라 달라질수 있습니다.
		form1.submit();
	}catch(e){}
}
function openNewsModify(num){
	window.open('pop_news_modify.html?no='+num,'팝업','width=500,height=500,scrollbars=yes');
}
function del_news(num){
	if(confirm("정말 뉴스를 하시겠습니까?\n뉴스번호 : "+num)){
		$.post("./php/delete_news.php",{"no":num},function(data){
			alert(data);
			location.reload();
		});
	}
}

function regist_answer(num){
	var qna_description = document.getElementById('qna_description_'+num);
	$.post("./php/regi_ans.php",{"no":num, "answer":qna_description.value},function(data){
		if(data == "f") alert("답변 등록 실패");
		location.reload();
	});
}
function delete_answer(num){
	if(confirm("정말 답변을 삭제 하시겠습니까?\n질문번호 : "+num)){
		$.post("./php/delete_ans.php",{"no":num},function(data){
			if(data == "f") alert("답변 삭제 실패");
			location.reload();
		});
	}
}
function load_answer(num){
	$("#answer"+num).load('./php/load_ans.php?no='+num);
}
function modify_answer(num){
	var qna_description = document.getElementById('qna_description_'+num);
	$.post("./php/modify_ans.php",{"no":num, "answer":qna_description.value},function(data){
		if(data == "f") alert("답변 등록 실패");
		location.reload();
	});
}
function delete_quest(num){
	if(confirm("사용자가 작성한 질문을 삭제 하시겠습니까?\n답변도 함께 삭제 됩니다.\n질문번호 : "+num)){
		$.post("./php/delete_quest.php",{"no":num},function(data){
			if(data == "f") alert("질문 삭제 실패");
			location.reload();
		});
	}
}