function login_submit(){
	var loginForm = document.getElementById('loginForm');
	var idVal = document.getElementById('id').value;
	var pwVal = document.getElementById('pw').value;

	if(idVal != "" && pwVal != ""){
		loginForm.method = "POST";
		loginForm.action = "./php/login_action.php";
		loginForm.submit();
	}
}
function search_submit(){
	var searchForm = document.getElementById('searchForm');
	var codeVal = document.getElementById('codeVal').value;

	if(codeVal != ""){
		searchForm.submit();
	}
}
function receive_gift(){
	var searchForm = document.getElementById('searchForm');
	var code_txt = document.getElementById('code_txt').value;
	var name_txt = document.getElementById('name_txt').value;
	if(confirm("상품코드: "+code_txt+"\n상품명: "+name_txt+"\n\n해당상품을 인계 처리 하시겠습니까?")){
		$.post("./php/receive_action.php",{"sc_codeVal": code_txt},function(data){
			alert(data);
			document.getElementById('codeVal').value = code_txt;
			searchForm.submit();
		});
	}
}
function cancel_gift(){
	var searchForm = document.getElementById('searchForm');
	var code_txt = document.getElementById('code_txt').value;
	var name_txt = document.getElementById('name_txt').value;
	if(confirm("상품코드: "+code_txt+"\n상품명: "+name_txt+"\n\n해당상품을 인계 취소처리 하시겠습니까?")){
		$.post("./php/cancel_action.php",{"sc_codeVal": code_txt},function(data){
			alert(data);
			document.getElementById('codeVal').value = code_txt;
			searchForm.submit();
		});
	}
}


function loginkey(e){
	if(window.event){
			if( window.event.keyCode == 13 ){
				login_submit();
			}
	}
	else{
		if(e.keyCode){
			if( e.keyCode == 13 ){
				login_submit();
			}
		}
	}
}