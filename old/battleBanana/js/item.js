var glob_main_num=0;
var glob_clo_main_num=0;
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
function mainItemList(num, option, cate){
	var temp1 = new Array;
	var temp2 = new Array;
	var temp_eff1 = new Array;
	var temp_eff2 = new Array;
	var ins_time, J_lap, J_sid, J_exp, J_bid, J_eff;

	//카테고리 그림 처리를 위한 부분
	$('#btn_cate_0').html('<img src="../img/btn_ca_all.gif" border="0"/>');
	$('#btn_cate_1').html('<img src="../img/btn_ca_digital.gif" border="0"/>');
	$('#btn_cate_2').html('<img src="../img/btn_ca_com.gif" border="0"/>');
	$('#btn_cate_3').html('<img src="../img/btn_ca_fashion.gif" border="0"/>');
	$('#btn_cate_4').html('<img src="../img/btn_ca_life.gif" border="0"/>');

	if(cate == '') $('#btn_cate_0').html('<img src="../img/btn_ca_all_o.gif" border="0"/>');
	else if(cate == 1) $('#btn_cate_1').html('<img src="../img/btn_ca_digital_o.gif" border="0"/>');
	else if(cate == 2) $('#btn_cate_2').html('<img src="../img/btn_ca_com_o.gif" border="0"/>');
	else if(cate == 3) $('#btn_cate_3').html('<img src="../img/btn_ca_fashion_o.gif" border="0"/>');
	else if(cate == 4) $('#btn_cate_4').html('<img src="../img/btn_ca_life_o.gif" border="0"/>');
	AutoLoadTopic();
	$('#mainTopicSub').show();
	//카테고리 그림 처리를 위한 부분 끝
	
	$('#main_table').html('');
	$('#main_table').css('height', '590px');
	$('#main_table').stopTime('control');
	$('#main_table').stopTime('sub_control');
	
	$('#sub_bg_table').css('background', 'url("../img/bg_main.gif")');
	$('#sub_gray').load('sub_gray_table.html');
	$('#main_table').load('main_item_table.html?p='+num+'&op='+option+'&cate='+cate, function(){
	$(this).everyTime(1000, 'control', function(){ 
		$.getJSON('../php/ajax/getItem.php?p_type=m&p='+num+'&op='+option+'&cate='+cate, function(json){
		$('#quick_banana').text(json.data.banana);//밖으로빼줌
		for(var i=0; i<9; i++){
		try{
			J_lap = json.data.list[i].lap;
			J_sid = json.data.list[i].sid;
			J_exp = json.data.list[i].exp;
			J_bid = json.data.list[i].bid;
			J_eff = json.data.list[i].eff;

			if(J_exp == '경매종료'){
				ins_time = "<img src='../img/img_auction_end.gif'>";
			}else{
				var hour = Math.floor(J_exp/3600);
				var min = Math.floor(J_exp%3600/60);
				var sec = J_exp%3600%60;
				if(hour < 10) hour = "0" + hour;
				if(min < 10) min = "0" + min;
				if(sec < 10) sec = "0" + sec;
				ins_time = hour+':'+min+':'+sec;
			}
				/*if(ins_time == '00:00:00'){
					$('#box_'+J_sid+' .box_time').html("<img src='../img/img_auction_end.gif'>");
					$('#box_'+J_sid).css('background', 'url("../img/bg_box_closed.gif")');
				}else */
				$('#box_'+J_sid+' .box_time').html(ins_time);
				
				$('#box_'+J_sid+' .box_price_in').html(J_lap);
				$('#box_'+J_sid+' .box_id').text(J_bid);
				
				temp2[J_sid] = temp1[J_sid];
				temp1[J_sid] = J_lap;
				temp_eff2[J_sid] = temp_eff1[J_sid];
				temp_eff1[J_sid] = J_eff;
				if(temp1[J_sid] != temp2[J_sid] && temp2[J_sid] != null){// && option != 'favorite'){
					$('#price'+J_sid).animate({width: "+=20px"}, 100);
					$('#price'+J_sid).animate({width: "-=40px"}, 100);
					$('#price'+J_sid).animate({width: "+=20px"}, 100);
					if(temp_eff2[J_sid] == "do") highlightFor('time_'+J_sid);
				}else{}
			}catch(e){}
		}
	})});
	});
	glob_main_num=num;
}
function mainItemList_prev(option, cate){
	if(glob_main_num== 0) return;
	else mainItemList(glob_main_num-1, option, cate);
}
function mainItemList_next(option, cate){
	mainItemList(glob_main_num+1, option, cate);
}
function subItemList(sid){
	var temp1 = new Array;
	var temp2 = new Array;
	var temp_eff1 = new Array;
	var temp_eff2 = new Array;
	var ins_time, J_lap, J_sid, J_exp, J_bid, J_eff;

	$('#sub_table').load('sub_item_table.html?sid='+sid, function(){
	$(this).everyTime(1000, 'sub_control', function(){ 
	$.getJSON('../php/ajax/getSubItem.php?p_type=s&p=1&sid='+sid, function(json){
		for(var i=0; i<3; i++){
		try{
			J_lap = json.data.list[i].lap;
			J_sid = json.data.list[i].sid;
			J_exp = json.data.list[i].exp;
			J_bid = json.data.list[i].bid;
			J_eff = json.data.list[i].eff;

			if(J_exp == '경매종료'){
				ins_time = "<img src='../img/img_auction_end.gif'>";
			}else{
				var hour = Math.floor(J_exp/3600);
				var min = Math.floor(J_exp%3600/60);
				var sec = J_exp%3600%60;
				if(hour < 10) hour = "0" + hour;
				if(min < 10) min = "0" + min;
				if(sec < 10) sec = "0" + sec;
				ins_time = hour+':'+min+':'+sec;
			}
				$('#box_sub'+J_sid+' .box_time').html(ins_time);
				$('#box_sub'+J_sid+' .box_price_in').html(J_lap);
				$('#box_sub'+J_sid+' .box_id').text(J_bid);

				temp2[J_sid] = temp1[J_sid];
				temp1[J_sid] = J_lap;
				temp_eff2[J_sid] = temp_eff1[J_sid];
				temp_eff1[J_sid] = J_eff;
				if(temp1[J_sid] != temp2[J_sid] && temp2[J_sid] != null){
					$('#box_sub'+J_sid+' #price'+J_sid).animate({width: "+=20px"}, 100);
					$('#box_sub'+J_sid+' #price'+J_sid).animate({width: "-=40px"}, 100);
					$('#box_sub'+J_sid+' #price'+J_sid).animate({width: "+=20px"}, 100);
					if(temp_eff2[J_sid] == "do") highlightFor('time_sub_'+J_sid);
				}else{}
			}catch(e){}
		}
	})});
});
}
function goSubPage(sid){
	$(this).stopTime('control');
	$('body').load('sub.html?sid='+sid);
}

function highlightFor(id){//하일라이트효과(시간과 돈)
	color = "#dd4e00";
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
	//$(this).everyTime(1000, 'control2', function(){onSubItemLoad(1);});
	$('#reward').hover(
		function(){
				$('#rewardlayer').fadeIn(300);
		},
		function(){
				$('#rewardlayer').fadeOut(300);
	});
	$('#battleButton').hover(
		function(){
				$('#battleButton_tooltip').show();
		},
		function(){
				$('#battleButton_tooltip').hide();
	});
}

function getJsonToItem(max){//sub페이지에 아이템 뿌려주는 함수
	var sid_layer = document.getElementById('sid_layer');
	var uid_layer = document.getElementById('uid_layer');
	var is_order_layer = document.getElementById('is_order_layer');
	$.getJSON('../php/ajax/getItem.php?p_type=s&sid='+sid_layer.value, function(json){
		$('#quick_banana').text(json.data.banana);//밖으로 빼줌
		try{
			if(json.data.exp >= 0){
				var hour = Math.floor(json.data.exp/3600);
				var min = Math.floor(json.data.exp%3600/60);
				var sec = json.data.exp%3600%60;
			}else if(json.data.exp == "경매종료"){
				hour = 0;
				min = 0;
				sec = 0;
				$('#battleButton').html("<img src='../img/sub/btn_end.gif' border=0 onmouseover=\"$('.tooltip_end').show();\" onmouseout=\"$('.tooltip_end').hide();\">");
				
				if(uid_layer.value == json.data.win){
					$('#rewardlayer').hide();
					if(is_order_layer.value == "yes"){
						$('#deli').html("<a onclick=openDialogByDom('#dialog_orderlist') style='cursor:pointer'><img src='../img/sub/btn_orderlist.gif' border='0'/></a>");
					}else{
						$('#deli').html("<a onclick=openDialogByDom('#dialog_deli') style='cursor:pointer'><img src='../img/sub/btn_deli.gif' name='btn_deli' id='btn_deli' onmousedown=javascript:btn_deli.src='../img/sub/btn_deli_c.gif'; border=0></a>");
					}
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
			for(var i=0;i<=max;i++){
				if(json.data.list[i].m == 'yes'){
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					$('.sub_item_bider').text(json.data.win);
					if(i == 0) $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo_m_y.gif" align="absbottom"/>');
					else $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo_m.gif" align="absbottom"/>');
				}else{
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					$('.sub_item_bider').text(json.data.win);
					if(i == 0) $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo_y.gif" align="absbottom"/>');
					else $('.sub_bid_img'+i).html('<img src="../img/sub/ico_peo.gif" align="absbottom"/>');
				}
			}
			
			
			
		}catch(e){}
	});
}

function onSubItemLoad(num){//sub페이지의 설명바로윗부분 아이템 3개의 내용을 보여주는 함수
	$.getJSON('../php/ajax/getSubItem.php?p='+num+'&sid='+sid_layer.value, function(json){
		$('#sub_table').html('');
		for(var i=0; i<3; i++){
			try{
				$('#sub_table').append(getData(json.data.list[i], i));

				sub_item_temp2[i] = sub_item_temp1[i];
				sub_item_temp1[i] = json.data.list[i].lap;
				sub_item_temp_eff2[i] = sub_item_temp_eff1[i];
				sub_item_temp_eff1[i] = json.data.list[i].eff;
				if(sub_item_temp1[i] != sub_item_temp2[i] && sub_item_temp2[i] != null){
					$('#price'+json.data.list[i].sid).animate({width: "+=20px"}, 100);
					$('#price'+json.data.list[i].sid).animate({width: "-=40px"}, 100);
					$('#price'+json.data.list[i].sid).animate({width: "+=20px"}, 100);
					//if(sub_item_temp_eff2[i] == "do")  highlightFor('time_'+json.data.list[i].sid);
				}else{}
			}catch(e){}
		}
	});
}
///////////////////////////////////////////////SUB부분끝///////////////////////////////////////////////////////////