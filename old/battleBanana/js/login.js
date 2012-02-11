var isId = 0;
var isPw = 0;
var headline_count;
var current_headline=0;
var cntTopic = 2;
var battleEvent = 0;
var autoEvent = 0;
var autoCancelEvent = 0;
var autoCancelEvent_pop = 0;

function pageRefresh(){
	location.reload();
}
function BrowserCheck(){
	var useragent = navigator.userAgent;
	
	if ((useragent.indexOf('MSIE 6')>0) && (useragent.indexOf('MSIE 7')==-1) && (useragent.indexOf('MSIE 8')==-1)){
		openDialogByIE6();
    }
	
}
function AutoLoadTopic(){
	$(".topic").stopTime('topic_flow');
	$(".topic").everyTime(5000, 'topic_flow', function(){
		if(cntTopic == 4){
			cntTopic = 1;
			loadMainTopic(cntTopic++);
		}else{
			loadMainTopic(cntTopic++);
			cntTopic = cntTopic;
		}
	});
}
function loadMainTopic(num){
	$("#mainTopic1").html('<img src="../img/btn_event.gif" onmouseover="loadMainTopic(1)">');
	$("#mainTopic2").html('<img src="../img/btn_event.gif" onmouseover="loadMainTopic(2)">');
	$("#mainTopic3").html('<img src="../img/btn_event.gif" onmouseover="loadMainTopic(3)">');
	$("#mainTopicList1").hide();
	$("#mainTopicList2").hide();
	$("#mainTopicList3").hide();

	$("#mainTopic"+num).html('<img src="../img/btn_event_o.gif" onmouseover="loadMainTopic('+num+')">');
	$("#mainTopicList"+num).show();
}
function loadNews(){
	headline_count = $("div.headline").size();
	$("div.headline:eq("+current_headline+")").css('top', '5px');
	setInterval(headline_rotate,5000); //time in milliseconds
}
function headline_rotate() {
  old_headline = current_headline % headline_count;
  new_headline = ++current_headline % headline_count;
  $("div.headline:eq(" + old_headline + ")").css('top', '210px');
  $("div.headline:eq(" + new_headline + ")").show().animate({top: 5},"slow");     
}
function makeFavorite(){
	var sid_layer = document.getElementById('sid_layer');
	if(confirm("해당 경매를 관심경매로 등록하시겠습니까?")){
		$.post("../php/favorite_action.php",{"sid":sid_layer.value, "type": "make"},function(data){
			alert(data);
		});
	}
}

function deleteFavorite(sid){
	if(confirm("해당 경매를 관심경매에서 삭제하시겠습니까?")){
		$.post("../php/favorite_action.php",{"sid":sid, "type": "del"},function(data){
			$('#main_table').load('main_item_table.html?p=0&op=favorite');
		});
	}
}
function sendMyTwit(){
	var sid_layer = document.getElementById('sid_layer');
	var sna_layer = document.getElementById('sna_layer');
	var kor_to_url = encodeURI('[배틀바나나]+'+sna_layer.value);
	$.getJSON('http://api.bit.ly/v3/shorten?login=ke2n&apiKey=R_65156f700cdacdefd7177e8d752b2720&longUrl=http://battlebanana.com/html/sub.html?sid='+sid_layer.value+'&format=json&callback=?', function(json){
		window.open('http://twitter.com/home?status='+kor_to_url+'+@Battlebanana:'+json.data.url,'팝업','width=800,height=500,scrollbars=yes');
	});
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
function goBattle(){
	var sid_layer = document.getElementById('sid_layer');
	//alert(sid_layer.value);
	if(battleEvent == 0){
		battleEvent = 1;
		$.post("../php/battle_action.php",{"sid":sid_layer.value},function(data){
			if(data == "lack!"){
				if(confirm("바나나가 부족합니다. 충전하시겠습니까?")) openDialogByDom('#dialog_charge');
			}else if(data == "top"){
				alert("이미 현재 승리자 입니다.");
			}else if(data == "repeated"){
				alert("보상구매 후 해당 경매에 입찰하실 수 없습니다!");
			}else alert(data);
			battleEvent = 0;
		});
	}else{
		alert('이미 배틀 버튼을 누르셨습니다.\n현재 결과 처리중이오니 잠시만 기다려주세요.');
	}
}

var is_auto_bids;
function autoInputVali(){
	var auto_bids = document.getElementById('auto_bids');
	var auto_bids_layer = document.getElementById('auto_bids_layer');

	if(auto_bids.value.length <= 0 || auto_bids.value.length >= 5 || auto_bids.value == 0) {//인풋이 1자리이상 4자리이하 0이 아닌 수만 허용한다.
		auto_bids_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
		is_auto_bids = 0;
	}else{
		auto_bids_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		is_auto_bids = 1;
	}
}
function autokey(e){
        if(window.event){
                if( window.event.keyCode == 13 ){
                    autoBattle();
                }
        }
        else{
			if(e.keyCode){
           	    if( e.keyCode == 13 ){
           	        autoBattle();
           	    }
			}
        }
}
function autoBattle(){
	var sid_layer = document.getElementById('sid_layer');
	var auto_bids = document.getElementById('auto_bids');
	if(autoEvent == 0){
		autoEvent = 1;
		if(is_auto_bids == 1){
		$.post("../php/autobattle_action.php",{"sid":sid_layer.value, "auto_bids":auto_bids.value},function(data){
			if(data == "lack!"){
				if(confirm("예약 바나나 갯수가 현재 바나나 갯수보다 큽니다. 충전하시겠습니까?")) openDialogByDom('#dialog_charge');
			}else if(data == "repeat"){
				alert("이미 오토배틀에 참여중입니다.");
			}else if(data == "none"){
				alert("0개 이상의 값을 입력해주세요.");
				auto_bids.value = '';
				auto_bids.focus();
			}else if(data == "fail"){
				alert("오토 배틀에 실패하였습니다. 다시한번 시도해주세요");
			}else{
				alert(data);
				closeDialogByDom();
			}
			autoEvent = 0;
		});
		}
	}else{
		alert('이미 오토배틀 버튼을 누르셨습니다.\n현재 결과 처리중이오니 잠시만 기다려주세요.');
	}
}
function cancelAutoBattle(sid){
	if(confirm("해당 상품의 오토배틀을 해제하시겠습니까?")){
		if(autoCancelEvent == 0){
			autoCancelEvent = 1;
			$.post("../php/cancelautobattle_action.php",{"sid":sid},function(data){
				if(data == "cancel"){
					alert("오토배틀을 해제하셨습니다. 해당 바나나가 자동으로 복구됩니다.");
					openDialogByDom('#dialog_auto');
				}else if(data == "empty"){
					alert("이미 해제 하신 경매입니다!");
				}else if(data == "fail"){
					alert("오토배틀 해제에 실패하였습니다. 다시한번 시도해주세요");
				}else if(data == "none"){
					alert("해당 상품에 오토배틀한 내역이 없습니다.");
				}else{
					alert(data);
					closeDialogByDom();
				}
				autoCancelEvent = 0;
			});
		}else{
			alert('이미 오토해제 버튼을 누르셨습니다.\n현재 결과 처리중이오니 잠시만 기다려주세요.');
		}
	}
}
function cancelAutoBattle_pop(sid,title){
	if(confirm("해당 상품의 오토배틀을 해제하시겠습니까?\n\n"+title)){
		if(autoCancelEvent_pop == 0){
			autoCancelEvent_pop = 1;
			$.post("../php/cancelautobattle_action.php",{"sid":sid},function(data){
				if(data == "cancel"){
					alert("오토배틀을 해제하셨습니다. 해당 바나나가 자동으로 복구됩니다.");
					openDialogByDom('#dialog_bananalist');
				}else if(data == "empty"){
					alert("이미 해제 하신 경매입니다!");
				}else if(data == "fail"){
					alert("오토배틀 해제에 실패하였습니다. 다시한번 시도해주세요");
				}else if(data == "none"){
					alert("해당 상품에 오토배틀한 내역이 없습니다.");
				}else{
					alert(data);
				}
				autoCancelEvent_pop = 0;
			});
		}else{
			alert('이미 오토해제 버튼을 누르셨습니다.\n현재 결과 처리중이오니 잠시만 기다려주세요.');
		}
	}
}

function input_auto(){
	var auto_bids_layer = document.getElementById('auto_bids_layer');

	if(checkNumChar(auto_bids_layer.value)){
		event.returnValue = false;
	}
}

function subChangePhoto(num){// ǰ̹ εԼ
	for(var i=0;i<=5;i++){
		$('#sub_mainphoto_'+i).fadeOut(300);
		$('.sub_photo_num_'+i).html('<a onmousedown="subChangePhoto('+i+')"><img src="../img/sub/btn_thumb.gif" name="btn_thumb'+i+'" id="btn_thumb'+i+'" onmouseover="javascript:btn_thumb'+i+'.src=\'../img/sub/btn_thumb_o.gif\';" onmouseout="javascript:btn_thumb'+i+'.src=\'../img/sub/btn_thumb.gif\';" border="0"/></a>');
	}

	$('#sub_mainphoto_'+num).fadeIn(300);
	$('.sub_photo_num_'+num).html('<img src="../img/sub/btn_thumb_o.gif" border="0"/>');
}
function loadisIE(){
	if(!$.browser.msie){
		alert('현재 Internet Explorer를 제외한 \n브라우저에서는 결제시스템 지원불가로 인해 \n바나나충전, 구매신청을 지원하지 않습니다.\n이용에 불편을 드려 죄송합니다.');
		closeDialogByDom();
	}
}
function loadBananaCharge(num){
	$('#chrge_1_set').html('<img src="../img/pop/btn_5.gif" name="btn_5" id="btn_5" onmouseover=javascript:btn_5.src=\'../img/pop/btn_5_o.gif\'; onmouseout=javascript:btn_5.src=\'../img/pop/btn_5.gif\'; border="0"/>');
	//$('#chrge_2_set').html('<img src="../img/pop/btn_10.gif" name="btn_10" id="btn_10" onmouseover=javascript:btn_10.src=\'../img/pop/btn_10_o.gif\'; onmouseout=javascript:btn_10.src=\'../img/pop/btn_10.gif\'; border="0"/>');
	$('#chrge_3_set').html('<img src="../img/pop/btn_100.gif" name="btn_100" id="btn_100" onmouseover=javascript:btn_100.src=\'../img/pop/btn_100_o.gif\'; onmouseout=javascript:btn_100.src=\'../img/pop/btn_100.gif\'; border="0"/>');
	$("#slider-range-min").slider('destroy');

	if(num == 1){
		$('#chrge_1_set').html('<img src="../img/pop/btn_5_s.gif" border="0"/>');
		$("#amount").text(5);
		$("#amount_won").text(fnMoneyType(5*400));
		$("#amount_bonus").text(0);

		$("#amount_input").val(5);
		$("#amount_won_input").val(5*400);
		$("#amount_bonus_input").val(0);

		$("#slider-range-min").slider({
			range: "min",
			min: 0,
			value: 5,
			max: 100,
			step: 5,
			slide: function(event, ui) {
				$("#amount").text(ui.value);
				$("#amount_won").text(fnMoneyType(ui.value*400));

				$("#amount_input").val(ui.value);
				$("#amount_won_input").val(ui.value*400);

				$("#amount_bonus").text(0);
				$("#amount_bonus_input").val(0);
			}
		});
		$("#amount").val($("#slider-range-min").slider("value"));
	}else if(num == 2){
		$('#chrge_2_set').html('<img src="../img/pop/btn_10_s.gif" border="0"/>');
		$("#amount").text(10);
		$("#amount_won").text(fnMoneyType(10*400));
		$("#amount_bonus").text(0)

		$("#amount_input").val(10);
		$("#amount_won_input").val(10*400);
		$("#amount_bonus_input").val(0);

		$("#slider-range-min").slider({
			range: "min",
			min: 0,
			value: 10,
			max: 200,
			step: 10,
			slide: function(event, ui) {
				$("#amount").text(ui.value);
				$("#amount_won").text(fnMoneyType(ui.value*400));

				$("#amount_input").val(ui.value);
				$("#amount_won_input").val(ui.value*400);

				$("#amount_bonus").text(0);
				$("#amount_bonus_input").val(0);
			}
		});
		$("#amount").val($("#slider-range-min").slider("value"));
	}else if(num == 3){
		$('#chrge_3_set').html('<img src="../img/pop/btn_100_s.gif" border="0"/>');
		$("#amount").text(100);
		$("#amount_won").text(fnMoneyType(100*400));
		$("#amount_bonus").text(0)
		
		$("#amount_input").val(100);
		$("#amount_won_input").val(100*400);
		$("#amount_bonus_input").val(0);

		$("#slider-range-min").slider({
			range: "min",
			min: 0,
			value: 100,
			max: 2000,
			step: 100,
			slide: function(event, ui) {
				$("#amount").text(ui.value);
				$("#amount_won").text(fnMoneyType(ui.value*400));

				$("#amount_input").val(ui.value);
				$("#amount_won_input").val(ui.value*400);

				if(ui.value >= 200){
					$("#amount_bonus").text((ui.value*0.01-2)*12+8);
					$("#amount_bonus_input").val((ui.value*0.01-2)*12+8);
				}else{
					$("#amount_bonus").text(0);
					$("#amount_bonus_input").val(0);
				}
			}
		});
		$("#amount").val($("#slider-range-min").slider("value"));
	}
}

function go_bananacharge(){
	var amount = document.getElementById('amount_input');
	var amount_bonus = document.getElementById('amount_bonus_input');
	
	if(amount.value > 0){

	if(confirm("충전할 바나나 : "+amount.value+"개 \n보너스 바나나 : "+amount_bonus.value+"개 \n결제할 금액 : "+fnMoneyType(amount.value*400)+"원 \n\n 충전하고자할 바나나와 결제금액이 맞습니까?")){
		var charge_form = document.getElementById("charge_form");
		
		cw=screen.availWidth; // 화면 너비
		ch=screen.availHeight; // 화면 높이
		sw=445;// 띄울 창의 너비
		sh=420;// 띄울 창의 높이
		ml=(cw-sw)/2;// 가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;// 가운데 띄우기위한 창의 y위치
		
		//alert("오픈베타기간에는 사용하실 수 없습니다.");
		window.open("","INIpay",'width='+sw+',height='+sh+',top='+mt+',left='+ml+',toobar=no,scrollbars=yes,menubar=no,status=no ,directories=no,');
		charge_form.action = "../php/winpop_charge.php";
		charge_form.method = "POST";
		charge_form.target = "INIpay";
		charge_form.submit();

		/*alert(document.ini.price.value=1000);$.post("../php/charge_action.php",{"amount":amount.value, "amount_bonus": amount_bonus.value},function(data){
			if(data == 'login!'){
				alert("로그인이 필요합니다. 로그인을 다시해 주세요!");
				return;
			}else if(data == 'fail!'){
				alert("충전에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}else if(data == 'charged!'){
				alert("바나나 충전을 완료하였습니다!");
				closeDialogByDom();
				return;
			}else{
				alert("충전에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}
		});*/
	}

	}
}

function make_del(){
	var complain = document.getElementById('complain');
	var comp_option = document.getElementById('comp_option');
	if(confirm("탈퇴 하시겠습니까? 확인을 누르시면 사용자 계정과 남은 바나나가 모두 삭제 됩니다.")){
		$.post("../php/drop_action.php",{"complain":complain.value, "comp_option":comp_option.value},function(data){
			if(data == 'login!'){
				alert("정상적인 방법으로 접근해 주세요!");
				return;
			}else if(data == 'fail!'){
				alert("회원탈퇴에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}else if(data == 'del!'){
				alert("그동안 배틀바나나를 이용해 주셔서 진심으로 감사합니다.");
				location.href = '../php/logout_action.php';
				return;
			}else{
				alert("회원탈퇴에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}
		});
	}
}

function make_ship(option){
	var ship_name = document.getElementById('deli_name').value;
	var ship_phone1 = document.getElementById('mobi1').value;
	var ship_phone2 = document.getElementById('mobi2').value;
	var ship_phone3 = document.getElementById('mobi3').value;
	var ship_adress = document.getElementById('deli_add').value;
	var ship_sid = document.getElementById('ship_sid').value;
	var ship_title = document.getElementById('ship_title').value;
	var ship_price = document.getElementById('ship_price').value;
	var ship_type = document.getElementById('ship_type').value;
	var ship_option = document.getElementById('ship_option').value;
	var ship_comment = document.getElementById('deli_comm').value;
	
	if(option == 'win'){
		var win_comment = document.getElementById('deli_win').value;
		var str = "받는사람 : "+ship_name+"\n연락처 : "+ship_phone1+"-"+ship_phone2+"-"+ship_phone3+"\n주소 : "+ship_adress+"\n낙찰소감 : "+win_comment+"\n기타 : "+ship_comment+"\n총결제액 : "+fnMoneyType(ship_price)+"원"+"\n\n해당 정보로 낙찰경매 배송신청을 하며,\n확인을 누르시면 결제를 진행합니다."
	}else{
		var str = "받는사람 : "+ship_name+"\n연락처 : "+ship_phone1+"-"+ship_phone2+"-"+ship_phone3+"\n주소 : "+ship_adress+"\n기타 : "+ship_comment+"\n총결제액 : "+fnMoneyType(ship_price)+"원"+"\n\n해당 정보로 배송신청을 하며, \n보상구매시 신청 후 해당 경매에 입찰을 하실 수 없습니다! \n\n확인을 누르시면 결제를 진행합니다."
	}
	if(confirm(str)){
		var ship_form = document.getElementById("ship_form");
		cw=screen.availWidth; // 화면 너비
		ch=screen.availHeight; // 화면 높이
		sw=445;// 띄울 창의 너비
		sh=420;// 띄울 창의 높이
		ml=(cw-sw)/2;// 가운데 띄우기위한 창의 x위치
		mt=(ch-sh)/2;// 가운데 띄우기위한 창의 y위치
	
		//alert("오픈베타기간에는 사용하실 수 없습니다.");
		window.open("","INIpay",'width='+sw+',height='+sh+',top='+mt+',left='+ml+',toobar=no,scrollbars=yes,menubar=no,status=no ,directories=no,');
		ship_form.action = "../php/winpop_charge.php";
		ship_form.method = "POST";
		ship_form.target = "INIpay";
		ship_form.submit();

		closeDialogByDom();
		/*$.post("../php/shipment_action.php",{
			"ship_name":ship_name,
			"ship_phone1":ship_phone1,
			"ship_phone2":ship_phone2,
			"ship_phone3":ship_phone3,
			"ship_adress":ship_adress,
			"ship_comment":ship_comment,
			"ship_sid":ship_sid,
			"ship_title":ship_title,
			"ship_price":ship_price,
			"ship_type":ship_type,
			"ship_option":ship_option
		},function(data){
			if(data == 'login!'){
				alert("정상적인 방법으로 접근해 주세요!");
				return;
			}else if(data == 'fail!'){
				alert("배송신청에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}else if(data == 'one!'){
				alert("상품은 한번만 구매가 가능합니다!\n이전에 구매신청 한적이 없는지 확인해주세요.");
				closeDialogByDom();
				return;
			}else if(data == 'shipped!'){
				alert("배송신청이 완료되었습니다.\n배송정보 수정은 배송단계 전까지만 수정이 가능합니다.");
				closeDialogByDom();
				return;
			}else{
				alert("배송신청에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}
		});*/
	}
}
function delete_ship(){
	var ship_sid = document.getElementById('ship_sid').value;

	if(confirm("해당 배송요청을 취소 하시겠습니까?")){
		$.post("../php/shipdelete_action.php",{
			"ship_sid":ship_sid
		},function(data){
			if(data == 'login!'){
				alert("정상적인 방법으로 접근해 주세요!");
				return;
			}else if(data == 'exp!'){
				alert("배송중인 상품은 배송취소를 하실 수 없습니다!");
				return;
			}else if(data == 'shipdel!'){
				alert("배송요청 취소가 완료 되었습니다.");
				openDialogByDom('#dialog_orderlist');
				return;
			}else{
				alert("배송요청 취소가 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}
		});
	}
}
function modi_ship(){
	var ship_name = document.getElementById('deli_name').value;
	var ship_phone1 = document.getElementById('mobi1').value;
	var ship_phone2 = document.getElementById('mobi2').value;
	var ship_phone3 = document.getElementById('mobi3').value;
	var ship_adress = document.getElementById('deli_add').value;
	var ship_comment = document.getElementById('comment').value;
	var ship_sid = document.getElementById('ship_sid').value;
	var ship_title = document.getElementById('ship_title').value;
	var ship_option = document.getElementById('ship_option').value;

	if(confirm("받는사람 : "+ship_name+"\n연락처 : "+ship_phone1+"-"+ship_phone2+"-"+ship_phone3+"\n주소 : "+ship_adress+"\n한마디 : "+ship_comment+"\n\n해당 정보로 배송신청을 변경 하시겠습니까?")){
		$.post("../php/shipmodi_action.php",{
			"ship_name":ship_name,
			"ship_phone1":ship_phone1,
			"ship_phone2":ship_phone2,
			"ship_phone3":ship_phone3,
			"ship_adress":ship_adress,
			"ship_comment":ship_comment,
			"ship_sid":ship_sid,
			"ship_title":ship_title,
			"ship_option":ship_option
		},function(data){
			if(data == 'login!'){
				alert("정상적인 방법으로 접근해 주세요!");
				return;
			}else if(data == 'fail!'){
				alert("배송변경에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}else if(data == 'exp!'){
				alert("배송중인 상품은 배송신청 변경을 하실 수 없습니다.");
				return;
			}else if(data == 'shipmodi!'){
				alert("배송신청 변경이 완료되었습니다.\n배송정보 수정은 배송단계 전까지만 수정이 가능합니다.");
				openDialogByDom('#dialog_orderlist');
				return;
			}else{
				alert("배송변경에 실패했습니다. 다시 한번 시도해 주세요.");
				return;
			}
		});
	}
}

function onBlurLayer(identity_id){//포커스아웃됬을때 도움말 없애는 함수
	document.getElementById(identity_id + '_layer2').innerHTML = "";
}

function checkid_login(identity_id){
	if( document.getElementById(identity_id).value.length < 4 ) {
		document.getElementById(identity_id + '_layer').innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
	}else{
		document.getElementById(identity_id + '_layer').innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		isId = 1;
	}
}
function checkpw_login(identity_id){
	if( document.getElementById(identity_id).value.length < 4 ) {
		document.getElementById(identity_id + '_layer').innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
	}else{
		document.getElementById(identity_id + '_layer').innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		isPw = 1;
	}
}
function loginkey(e){
        if(window.event){
                if( window.event.keyCode == 13 ){
                    login();
                }
        }
        else{
			if(e.keyCode){
           	    if( e.keyCode == 13 ){
           	        login();
           	    }
			}
        }
}

function login() {
		var login_id  = document.getElementById('login_id');
		var login_pass  = document.getElementById('login_pass');
        if (login_id.value.length < 4) {
                login_id.focus();
                return;
        }else if (login_pass.value.length < 4 ) {
                login_pass.focus();
                return;
        }else{
			createXMLHttpRequest();
			sPrams = "id="+login_id.value+"&pass="+login_pass.value;
			
			xmlHttp.open("post", "../php/login_action.php", false);
			xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xmlHttp.onreadystatechange = loginChange;
			xmlHttp.send(sPrams);
        }
}

function loginChange(){
	var login_id  = document.getElementById('login_id');
	var login_pass  = document.getElementById('login_pass');
	var is_end_layer  = document.getElementById('is_end_layer');
	if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
			var str = xmlHttp.responseText;
			//alert(str);
			eval("var jsonData = "+str);

			if(jsonData.result == 1){
				closeDialogByDom();
					if(jsonData.relogin == "yes"){
						alert("다른 IP나 브라우저에 해당 아이디가 중복 로그인 되었습니다. 이전 연결을 마치고 새로 연결합니다.");
					}
					$('#menu1Button', document).html(jsonData.menu1Button);
					$('#menu2Button', document).html(jsonData.menu2Button);
					$('#reward', document).html(jsonData.rewardButton);
					if(is_end_layer.value > 0) $('#battleButton', document).html(jsonData.battleButton);
					else $('#battleButton', document).html(jsonData.battleEndButton);

				$('#quickMenu', document).fadeIn(300);
			}else if(jsonData.result == 0){
				alert("아이디가 없거나 비밀번호가 잘못되었습니다.\n 다시한번 확인하시고 로그인 해주세요.");
				login_id.value = '';
				login_pass.value = '';
				login_id.focus();
			}else{
				alert("잠시후 다시 시도해 주세요. 죄송합니다.");
				login_id.value = '';
				login_pass.value = '';
				login_id.focus();
			}
		}
	}
}
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
		if(isValidJuminNo(idnumber.value, idnumber2.value) == false) {
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			idnumber_layer2.innerHTML = "잘못된 형식의 주민등록번호입니다.";
			isidnum_find = 0;
		}else if(isValidJuminNo(idnumber.value, idnumber2.value) == "young") {
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			idnumber_layer2.innerHTML = "만 20세 이하는 가입하실 수 없습니다.";
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
/*----------------회원가입 스크립트(by ke2n, 2010-04-09)------------------------*/
var isName = 0;
var isidnum = 0;
var isidentity = 0;
var ispw = 0;
var isoripw = 0;
var isemail = 0;
var ischeck = 0;

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
		if(isValidJuminNo(idnumber.value, idnumber2.value) == false) {
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			idnumber_layer2.innerHTML = "잘못된 형식의 주민등록번호입니다.";
			isidnum = 0;
		}else if(isValidJuminNo(idnumber.value, idnumber2.value) == "young") {
			idnumber_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\" />";
			idnumber_layer2.innerHTML = "만 20세 이하는 가입하실 수 없습니다.";
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

function signup(){
	var signup_id = document.getElementById('signup_id').value;
	var signup_name = document.getElementById('signup_name').value;
	var idnumber = document.getElementById('idnumber').value;
	var idnumber2 = document.getElementById('idnumber2').value;
	var signup_pass = document.getElementById('signup_pass').value;
	var email = document.getElementById('email').value;
	var reco = document.getElementById('reco').value;

	isSubmit = isName + isidnum + isidentity + ispw + isemail + ischeck;
	//alert(reco);
	if(isSubmit == 6){
		createXMLHttpRequest();
		sPrams = "signup_id="+signup_id+"&signup_name="+signup_name+"&idnumber="+(idnumber+idnumber2)+"&signup_pass="+signup_pass+"&email="+email+"&reco="+reco;
			
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

	//isSubmit = ;

	if(ispw && isemail && isoripw){
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
	}else if(isemail && isoripw){
		$.post("../php/modify_action.php",
			{"original_pass" : original_pass.value,
			 "email" : email.value
			},function(data){
				if(data == 'fail') alert("기존 비밀번호가 일치하지 않습니다.");
				else{
					alert(data);
					closeDialogByDom();
					location.href = "../html/main.html";
				}
		});
	}else if(ispw && isoripw){
		$.post("../php/modify_action.php",
			{"original_pass" : original_pass.value,
			 "signup_pass" : signup_pass.value
			},function(data){
				if(data == 'fail') alert("기존 비밀번호가 일치하지 않습니다.");
				else{
					alert(data);
					closeDialogByDom();
					location.href = "../html/main.html";
				}
		});
	}else{
		alert('미입력된 부분이 있거나, 잘못입력된부분이 있습니다.\n다시확인하여 주세요.');
	}
}

////////////////////상품주문부분/////////////////////////////////
var deli_isName = 0;
var deli_isMobi = 0;
var deli_isAdd = 0;
var deli_isWin = 0;

function loadisAgain(txt){//두번구매방지
	if(txt == "yes"){
		alert("동일제품을 두번이상 주문할 수 없습니다!\n상품주문내역을 확인해 주세요.");
		openDialogByDom('#dialog_orderlist');
	}
}
function copy_text(txt){
    if (window.clipboardData){
        window.clipboardData.setData('Text', txt);
		alert('입금할 계좌 정보가 복사되었습니다!');
    }else{ prompt("CTRL+C키를 누르시면 복사가 됩니다.",txt); }
    return false;
}

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

function checkwin_deli(){
	var deli_win = document.getElementById('deli_win');
	var deli_win_layer = document.getElementById('deli_win_layer');
	var deli_win_layer2 = document.getElementById('deli_win_layer2');

	if( deli_win.value.length <= 10 ) {
		deli_win_layer.innerHTML = "<img src=\"../img/pop/img_conf_x.gif\"/>";
		deli_win_layer2.innerHTML = "낙찰소감은 10자 이상 적어주세요.";
		deli_isWin = 0;
	}else{
		deli_win_layer.innerHTML = "<img src=\"../img/pop/img_conf_ok.gif\" />";
		deli_win_layer2.innerHTML = "";
		deli_isWin = 1;
	}
}

function checkcomm_deli(){
	var deli_comm = document.getElementById('deli_comm');
	var deli_comm_layer2 = document.getElementById('deli_comm_layer2');

	deli_comm_layer2.innerHTML = "택배원에게 하실 말씀을 적어주세요.";
}

function action_ship(option){
	if(option == 'reward_make'){
		//alert('보상');
		if(deli_isName && deli_isMobi && deli_isMobi && deli_isAdd) make_ship('reward');
	}else if(option == 'win_make'){
		//alert('낙찰');
		if(deli_isName && deli_isMobi && deli_isMobi && deli_isAdd && deli_isWin) make_ship('win');
	}else if(option == 'modi'){
		modi_ship();
	}
}

function fnMoneyType(v) {//화폐단위 자동계산 함수
	v = v.toString();
	if (v.length > 3) {
		var mod = v.length % 3;
		var retval = (mod > 0 ? (v.substring(0,mod)) : "");
		
		for (i=0 ; i < Math.floor(v.length / 3); i++) {
		
		if ((mod == 0) && (i == 0)) {
			retval += v.substring(mod+ 3 * i, mod + 3 * i + 3);
		}else{
			retval+= "," + v.substring(mod + 3 * i, mod + 3 * i + 3);
		}
		}
	return retval;
	}else {
        return v;
	}
}

function setPng24(obj) {//ie6에서 png투명처리함수
        obj.width=obj.height=1;
        obj.className=obj.className.replace(/\bpng24\b/i,'');
        obj.style.filter =
        "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');"
        obj.src=''; 
        return '';
}

function openHelp(name){
	window.open('../help/'+name,'헬프','width=770,height=600,scrollbars=yes');
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

function checkEmail(email){
	if(/^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.)+([0-9a-zA-Z-]+)([\.0-9a-zA-Z-])*$/.test(email) == false) return false;
	return true;
}

function isValidJuminNo(jumin1, jumin2) {
	var date = new Date();
	var juminno =  jumin1 + jumin2;
	if(juminno=="" || juminno==null || juminno.length!=13) {
		return false;
	}
	var jumin1 = juminno.substr(0,6);
	var jumin2 = juminno.substr(6,7);
	var yy = jumin1.substr(0,2); // 년도
	var mm = jumin1.substr(2,2); // 월
	var dd = jumin1.substr(4,2); // 일
	var genda = jumin2.substr(0,1); // 성별
	var msg, ss, cc;
	// 숫자가 아닌 것을 입력한 경우
	if (!isNumeric(jumin1)) {
		return false;
	}
	// 길이가 6이 아닌 경우
	if (jumin1.length != 6) {
		return false;
	}
	// 첫번째 자료에서 연월일(YYM M DD) 형식 중 기본 구성 검사
	if (yy < "00" || yy > "99" || mm < "01" || mm > "12" || dd < "01" || dd > "31") {
		return false;
	}
	// 숫자가 아닌 것을 입력한 경우
	if (!isNumeric(jumin2)) {
		return false;
	}
	// 길이가 7이 아닌 경우
	if (jumin2.length != 7) {
		return false;
	}
	// 성별부분이 1 ~ 4 가 아닌 경우
	if (genda < "1" || genda > "4") {
		return false;
	}
	// 연도 계산 - 1 또는 2: 1900년대, 3 또는 4: 2000년대
	cc = (genda == "1" || genda == "2") ? "19" : "20";
	if ((date.getFullYear() - (cc+yy)) < 19) {
		return "young";
	}
	// 첫번째 자료에서 연월일(YYM M DD) 형식 중 날짜 형식 검사
	if (isValidDate(cc+yy+mm+dd) == false) {
		return false;
	}
	// Check Digit 검사
	if (!isSSN(jumin1, jumin2)) {
		return false;
	}

	return true;
}
function isValidDate(iDate) {
	if( iDate.length != 8 ) {
		return false;
	}
	
	oDate = new Date();
	oDate.setFullYear(iDate.substring(0, 4));
	oDate.setMonth(iDate.substring(4, 6));
	oDate.setDate(iDate.substring(6));

	if( oDate.getFullYear() != iDate.substring(0, 4) || oDate.getMonth() != iDate.substring(4, 6) || oDate.getDate() != iDate.substring(6) ){
		return false;
	}

	return true;
}

function isNumeric(s) {
	for (i=0; i<s.length; i++) {
		c = s.substr(i, 1);
		if (c < "0" || c > "9") return false;
	}

	return true;
}

function isSSN(s1, s2) {
	n = 2;
	sum = 0;
	
	for (i=0; i<s1.length; i++)
		sum += parseInt(s1.substr(i, 1)) * n++;
		
	for (i=0; i<s2.length-1; i++) {
		sum += parseInt(s2.substr(i, 1)) * n++;
		if (n == 10) n = 2;
	}
		
	c = 11 - sum % 11;
	if (c == 11) c = 1;
	if (c == 10) c = 0;
	if (c != parseInt(s2.substr(6, 1))) return false;
	else return true;
}