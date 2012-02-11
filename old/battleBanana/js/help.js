function load_customer(page){
	$("#insert_customer").html('');
	$("#insert_customer").load('../php/ajax/loadCustomer.php?p='+page);
}
function scrollLink(obj){
	var position = $('#'+obj).offset();
	$('html, body').animate({scrollTop: position.top-80}, 1000);
}
function del_customer(num){
	if(confirm("해당 질문을 삭제 하시겠습니까?")){
	$.post("../php/ajax/delCustomer.php",{"no":num},function(data){
			if(data == "f") alert("질문 삭제에 실패하였습니다.");
			else if(data == "login"){
				alert("로그인 하여 주세요!");
				return;
			}else if(data == "none"){
				alert("해당 권한이 없습니다!");
				return;
			}else if(data == "ans"){
				alert("답변이 달린 질문은 삭제 할 수 없습니다!");
				return;
			}
			load_customer();
	});
	}
}
function load_news_title(page){
	$("#insert_news_title").load('../php/ajax/loadNews.php?type=t&p='+page);
}
function load_news(no){
	$("#insert_news").load('../php/ajax/loadNews.php?type=s&no='+no);
}

function regist_customer(){
	var custumer_name = document.getElementById('custumer_name');
	var custumer = document.getElementById('custumer');
	$.post("../php/ajax/registCustomer.php",{"title":custumer_name.value, "text":custumer.value},function(data){
			if(data == "f") alert("질문 등록에 실패하였습니다.");
			else if(data == "login"){
				alert("로그인 하여 주세요!");
				custumer.value ='';
				custumer_name.value ='';
				return;
			}else if(data == "title"){
				alert("제목을 입력해주세요!");
				custumer_name.focus();
				return;
			}else if(data == "text"){
				alert("내용을 입력해주세요!");
				custumer.focus();
				return;
			}
			load_customer();
			custumer_name.value = "";
			custumer.value = "";
	});
}

function regist_want(option){
	var want = document.getElementById('want_'+option);
	if(want.value.length > 0){
	if(confirm("해당 내용을 등록 하시겠습니까?\n주소 또는 아이디 : "+want.value)){
	$.post("../php/ajax/registWant.php",{"want":want.value, "option":option},function(data){
			if(data == "f") alert("등록에 실패하였습니다.");
			else if(data == "login"){
				alert("로그인 하여 주세요!");
				custumer.value ='';
				custumer_name.value ='';
				return;
			}else if(data == "want"){
				alert("URL을 입력해주세요!");
				want.focus();
				return;
			}else if(data == "ok"){
				alert("등록을 성공하였습니다.");
				want.value = "";
			}else{
				alert("등록에 실패하였습니다.");
			}
			
	});
	}
	}else{
		alert("올바른 내용을 등록하여 주세요.");
	}
}