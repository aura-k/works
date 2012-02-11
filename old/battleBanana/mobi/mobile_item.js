function subChangePhoto(sid, num){
	for(var i=0;i<=5;i++){
		$('#sub_mainphoto_'+i+'_'+sid).hide();
		$('.sub_photo_num_'+i).html('<img src="./themes/jqt/img/btn_thumb.png" name="btn_thum'+i+'" id="btn_thumb'+i+'" border="0">');
	}
	//alert('#sub_mainphoto_'+num+'_'+sid);
	$('#sub_mainphoto_'+num+'_'+sid).show();
	$('.sub_photo_num_'+num).html('<img src="./themes/jqt/img/btn_thumb_o.png" border="0"/>');
}

function ClosedItemList(num, cate){
	$('#main_table').stopTime('control');
	$('#sub_table').stopTime('sub_control');
	$('#main_table').load('main_item_table.html?p='+num+'&close='+cate);
	glob_clo_main_num=num;
}
function ClosedItemList_prev(cate){
	if(glob_clo_main_num== 0) return;
	else ClosedItemList(glob_clo_main_num-1, cate);
}
function ClosedItemList_next(cate){
	ClosedItemList(glob_clo_main_num+1, cate);
}
function mainItemList(){
	var temp1 = new Array;
	var temp2 = new Array;
	var temp_eff1 = new Array;
	var temp_eff2 = new Array;
	var ins_time, J_lap, J_sid, J_exp, J_bid, J_eff;

	$('#home').everyTime(1000, 'control', function(){ 
		$.getJSON('../php/ajax/getItem.php?p_type=m&p=0&op=&cate=', function(json){
		for(var i=0; i<9; i++){
		try{
			J_lap = json.data.list[i].lap;
			J_sid = json.data.list[i].sid;
			J_exp = json.data.list[i].exp;
			J_bid = json.data.list[i].bid;
			J_eff = json.data.list[i].eff;

			if(J_exp == '경매종료'){
				ins_time = "경매종료";
			}else{
				var hour = Math.floor(J_exp/3600);
				var min = Math.floor(J_exp%3600/60);
				var sec = J_exp%3600%60;
				if(hour < 10) hour = "0" + hour;
				if(min < 10) min = "0" + min;
				if(sec < 10) sec = "0" + sec;
				ins_time = hour+':'+min+':'+sec;
			}
				if(J_exp <= '0'){
					$('.box_'+J_sid).text("경매종료");
				}else $('.box_'+J_sid).html(ins_time);
				
				$('.price_'+J_sid).html(J_lap);
				$('.bider_'+J_sid).text(J_bid);
				$('#quick_banana').text(json.data.banana);

				temp2[J_sid] = temp1[J_sid];
				temp1[J_sid] = J_lap;
				temp_eff2[J_sid] = temp_eff1[J_sid];
				temp_eff1[J_sid] = J_eff;
				//if(temp1[J_sid] != temp2[J_sid] && temp2[J_sid]){
					$('.price_'+J_sid).animate({"width": "+=50px"}, "slow");
					//$('.price_'+J_sid).animate({width: "-=20px"}, 100);
					if(temp_eff2[J_sid] == "do") highlightFor('box_'+J_sid);
				//}else{}
			}catch(e){}
		}
	})});
}
function subItemList(sid){
	var temp1 = new Array;
	var temp2 = new Array;
	var temp_eff1 = new Array;
	var temp_eff2 = new Array;
	var ins_time, J_lap, J_sid, J_exp, J_bid, J_eff;
	$('#home').everyTime(1000, 'sub_control', function(){ 
	$.getJSON('../php/ajax/getItem.php?p_type=s&sid='+sid, function(json){
		try{
			/*J_lap = json.data.list[i].lap;
			J_sid = json.data.list[i].sid;
			J_exp = json.data.list[i].exp;
			J_bid = json.data.list[i].bid;
			J_eff = json.data.list[i].eff;*/
			
			var hour = Math.floor(json.data.exp/3600);
			var min = Math.floor(json.data.exp%3600/60);
			var sec = json.data.exp%3600%60;

			if(hour < 10) hour = "0" + hour;
			if(min < 10) min = "0" + min;
			if(sec < 10) sec = "0" + sec;

			if(json.data.exp <= 0){
				$('.sub_item_expired').html("<div style='color:#969696'>00&nbsp;&nbsp;00&nbsp;&nbsp;00</div>");
			}else 
				$('.sub_item_expired').html(hour+"&nbsp;&nbsp;"+min+"&nbsp;&nbsp;"+sec);
			
			$('.sub_item_price').text(json.data.pri);
			$('.sub_item_price_rrp').text(json.data.rrp);
			$('.sub_item_bider').text(json.data.list[0].bid);

			sub_temp2 = sub_temp1;
			sub_temp1 = json.data.sid + "_" + json.data.pri;
			sub_temp_eff2 = sub_temp_eff1;
			sub_temp_eff1 = json.data.eff;
			if(sub_temp1.substr(0,6) != sub_temp2.substr(0,6) && sub_temp1 != sub_temp2 && sub_temp2 != null){
					$('.sub_item_price').animate({marginRight: "40px"}, 200);
					$('.sub_item_price').animate({marginRight: "0"}, 200);
					if(sub_temp_eff2 == 'do'){
						highlightFor('sub_item_expired_h');
						highlightFor('sub_item_expired_m');
						highlightFor('sub_item_expired_s');
					}
			}else{}
			for(var i=0;i<=5;i++){
				if(json.data.list[i].m == 'yes'){
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					
					if(i == 0) $('.sub_bid_img'+i).html('<img src="./themes/jqt/img/img_h_peo_m_y.png" style=" vertical-align:middle; padding-bottom:5px;"/>');
					else $('.sub_bid_img'+i).html('<img src="./themes/jqt/img/img_h_peo_m.png" style=" vertical-align:middle; padding-bottom:5px;"/>');
				}else{
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					$('.sub_item_bider').text(json.data.list[0].bid);
					if(i == 0) $('.sub_bid_img'+i).html('<img src="./themes/jqt/img/img_h_peo_y.png" style=" vertical-align:middle; padding-bottom:5px;"/>');
					else $('.sub_bid_img'+i).html('<img src="./themes/jqt/img/img_h_peo.png" style=" vertical-align:middle; padding-bottom:5px;"/>');
				}
			}
		}catch(e){}
	})});
}
function highlightFor(id){
	color = "red";
	seconds = 700;
    var element = document.getElementById(id);
    var origcolor = element.style.color;
    element.style.color = color;
    var t = setTimeout(function(){
       element.style.color = origcolor;
    },(seconds));
}
///////////////////////////////////////////////SUB부분시작///////////////////////////////////////////////////////////
var sub_temp1, sub_temp2, sub_temp_eff1, sub_temp_eff2;
var sub_item_temp1 = new Array; 
var sub_item_temp2 = new Array;
var sub_item_temp_eff1 = new Array;
var sub_item_temp_eff2 = new Array;
var effect;

function onLayerLoad(){//sub페이지에 아이템 뿌려주는 함수를 재귀호출해주는 함수
	subChangePhoto(1);//ǰ̹ Լ .  1

	$(this).everyTime(1000, 'control1', function(){getJsonToItem(13);});
	$('#reward').hover(
		function(){
				$('#rewardlayer').fadeIn(300);
		},
		function(){
				$('#rewardlayer').fadeOut(300);
	});
	$('#battleButton').hover(
		function(){
				$('#battleButton_tooltip').fadeIn(300);
		},
		function(){
				$('#battleButton_tooltip').css('display', 'none');
	});
}

function getJsonToItem(sid){//sub페이지에 아이템 뿌려주는 함수
	$.getJSON('../php/ajax/getItem.php?p_type=s&sid='+sid, function(json){
		try{
			if(json.data.exp > 0){
				var hour = Math.floor(json.data.exp/3600);
				var min = Math.floor(json.data.exp%3600/60);
				var sec = json.data.exp%3600%60;
			}else if(json.data.exp <= 0){
				hour = 0;
				min = 0;
				sec = 0;
				$('#battleButton').html("<img src='../img/sub/btn_end.gif' border=0>");
				
				if(uid_layer.value == json.data.list[0].bid){
					$('#rewardlayer').hide();
					$('#deli').html("<a onclick=openDialogByDom('#dialog_deli') style='cursor:pointer'><img src='../img/sub/btn_deli.gif' name='btn_deli' id='btn_deli' onmousedown=javascript:btn_deli.src='../img/sub/btn_deli_c.gif'; border=0></a>");
				}
			}
			if(hour < 10) hour = "0" + hour;
			if(min < 10) min = "0" + min;
			if(sec < 10) sec = "0" + sec;
			$('.sub_item_expired_h').text(hour);
			$('.sub_item_expired_m').text(min);
			$('.sub_item_expired_s').text(sec);
			$('.sub_item_price').text(json.data.pri);
			
			$('.sub_item_price_rrp').text(json.data.rrp);
			$('.sub_item_price_bided').text(json.data.bided);
			$('.sub_item_price_reward').text(json.data.reward);
			$('#battleButton_tooltip .content').html('<b>지금 참여하면<br/>'+json.data.save+'원 절약!</b>');
			
			$('#quick_banana').text(json.data.banana);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			sub_temp2 = sub_temp1;
			sub_temp1 = json.data.pri;
			sub_temp_eff2 = sub_temp_eff1;
			sub_temp_eff1 = json.data.eff;
			if(sub_temp1 != sub_temp2 && sub_temp2 != null){
					$('.sub_item_price').animate({marginRight: "40px"}, 200);
					$('.sub_item_price').animate({marginRight: "0"}, 200);
					if(sub_temp_eff2 == 'do'){
						highlightFor('sub_item_expired_h');
						highlightFor('sub_item_expired_m');
						highlightFor('sub_item_expired_s');
					}
			}else{}
			for(var i=0;i<=13;i++){
				if(json.data.list[i].m == 'yes'){
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					$('.sub_item_bider').text(json.data.list[0].bid);
					if(i == 0) $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo_m_y.gif" align="absbottom"/>');
					else $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo_m.gif" align="absbottom"/>');
				}else{
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					$('.sub_item_bider').text(json.data.list[0].bid);
					if(i == 0) $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo_y.gif" align="absbottom"/>');
					else $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo.gif" align="absbottom"/>');
				}
			}
			
			
			
		}catch(e){}
	});
}
///////////////////////////////////////////////SUB부분끝///////////////////////////////////////////////////////////
function append_bananalist(num){
	$('.bananalist_add').html('<td colspan="4" height="30"><img src="./img/ajax_loader.gif"/></td>');
	$.getJSON("./bananalist.php?num="+(num+1)+"&json=yes",function(json){
		if(json.page <= 0)
			$('.bananalist_add').html('');
		else
			$('.bananalist_add').html('<td colspan="4" height="30" onclick="append_bananalist('+(num+1)+')">더보기('+json.page+'건)</td>');
		$('#insert_bananalist_'+num).append(json.data);
	});
}
function append_orderlist(num){
	$('.orderlist_add').html('<td colspan="4" height="30"><img src="./img/ajax_loader.gif"/></td>');
	$.getJSON("./orderlist.php?num="+(num+1)+"&json=yes",function(json){
		if(json.page <= 0)
			$('.orderlist_add').html('');
		else
			$('.orderlist_add').html('<td colspan="4" height="30" onclick="append_orderlist('+(num+1)+')">더보기('+json.page+'건)</td>');
		$('#insert_orderlist_'+num).append(json.data);
	});
}
function append_closedlist(num){
	$('.closedlist_add').html('<td colspan="4" height="30"><img src="./img/ajax_loader.gif"/></td>');
	$.getJSON("./closedlist.php?num="+(num+1)+"&json=yes",function(json){
		if(json.page <= 0)
			$('.closedlist_add').html('');
		else
			$('.closedlist_add').html('<td colspan="4" height="30" onclick="append_closedlist('+(num+1)+')">더보기('+json.page+'건)</td>');
		$('#insert_closedlist_'+num).append(json.data);
	});
}
function makeFavorite(sid){
	if(confirm("해당 경매를 관심경매로 등록하시겠습니까?")){
		$.post("./php/m_favorite_action.php",{"sid":sid, "type": "make"},function(data){
			alert(data);
		});
	}
}
function deleteFavorite(sid){
	if(confirm("해당 경매를 관심경매에서 삭제하시겠습니까?")){
		$.post("./php/m_favorite_action.php",{"sid":sid, "type": "del"},function(data){
			alert(data);
			location.reload();
		});
	}
}
function openAutoBattle(sid){
	$('.auto_layer').load('./php/m_auto.php?sid='+sid);
	$('#rewrite_auto_layer').html('<a onclick="autoBattle(\''+sid+'\')"><img src="./themes/jqt/img/btn_auto.png"></a>');
}
function okAutoBattle(sid){
	$('.auto_layer').load('./php/m_auto.php?sid='+sid);
	$('#rewrite_auto_layer').html('<a onclick="closeAutoBattle(\''+sid+'\')"><img src="./themes/jqt/img/btn_auto.png"></a>');
}
function closeAutoBattle(sid){
	$('.auto_layer').html('');
	$('#rewrite_auto_layer').html('<a onclick="openAutoBattle(\''+sid+'\')"><img src="./themes/jqt/img/btn_auto.png"></a>');
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
function autokey(e, sid){
        if(window.event){
                if( window.event.keyCode == 13 ){
                    autoBattle(sid);
                }
        }
        else{
			if(e.keyCode){
           	    if( e.keyCode == 13 ){
           	        autoBattle(sid);
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
function autoBattle(sid){
	var auto_bids = document.getElementById('auto_bids');
	if(is_auto_bids == 1){
	$.post("./php/m_autobattle_action.php",{"sid":sid, "auto_bids":auto_bids.value},function(data){
		if(data == "lack!"){
			alert("예약 바나나 갯수가 부족합니다.");
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
			okAutoBattle(sid);
		}
	});
	}
}
function cancelAutoBattle(sid){
	if(confirm("해당 상품의 오토배틀을 해제하시겠습니까?")){
	$.post("./php/m_cancelautobattle_action.php",{"sid":sid},function(data){
		if(data == "cancel"){
			alert("오토배틀을 해제하셨습니다. 해당 바나나가 자동으로 복구됩니다.");
			okAutoBattle(sid);
		}else if(data == "empty"){
			alert("이미 해제 하신 경매입니다!");
		}else if(data == "fail"){
			alert("오토배틀 해제에 실패하였습니다. 다시한번 시도해주세요");
		}else if(data == "none"){
			alert("해당 상품에 오토배틀한 내역이 없습니다.");
		}else{
			alert(data);
		}
	});
	}
}

function goBattle(sid){
	$.post("./php/m_battle_action.php",{"sid":sid},function(data){
		if(data == "lack!"){
			alert("바나나가 부족합니다. PC용 배틀바나나에서 충전해주세요.");
			return;
		}else if(data == "top"){
			alert("이미 현재 승리자 입니다.");
			return;
		}else if(data == "repeated"){
			alert("보상구매 후 해당 경매에 입찰하실 수 없습니다!");
			return;
		}else if(data == "login"){
			alert("로그인 후 이용하실 수 있습니다!");
			return;
		}else alert(data);
	});
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
			$.post("./php/m_login_action.php",{"id":login_id.value, "pass":login_pass.value},function(data){
				if(data == "ok")
					location.reload();
				else{
					alert('아이디 또는 비밀번호가 일치하지 않습니다!');
					login_id.value = '';
					login_pass.value = '';
					login_id.focus();
				}
			});
        }
}

function logoutAction(){
	$.get("./php/m_logout_action.php", function(){
		location.reload();
	});
}