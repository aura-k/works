var sub_temp1, sub_temp2, sub_temp_eff1, sub_temp_eff2;
var sub_item_temp1 = new Array; 
var sub_item_temp2 = new Array;
var sub_item_temp_eff1 = new Array;
var sub_item_temp_eff2 = new Array;
var effect;

function onLayerLoad(){
	subChangePhoto(1);//ǰ̹ Լ .  1

	$(this).everyTime(1000, 'control1', function(){getJsonToItem(13);});
	$(this).everyTime(1000, 'control2', function(){onSubItemLoad(1);});
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

function subChangePhoto(num){// ǰ̹ εԼ
	for(var i=0;i<=5;i++){
		$('#sub_mainphoto_'+i).fadeOut(300);
		$('.sub_photo_num_'+i).html('<a onmousedown="subChangePhoto('+i+')"><img src="../img/sub/btn_thumb.gif" name="btn_thumb'+i+'" id="btn_thumb'+i+'" onmouseover="javascript:btn_thumb'+i+'.src=\'../img/sub/btn_thumb_o.gif\';" onmouseout="javascript:btn_thumb'+i+'.src=\'../img/sub/btn_thumb.gif\';" border="0"/></a>');
	}

	$('#sub_mainphoto_'+num).fadeIn(300);
	$('.sub_photo_num_'+num).html('<img src="../img/sub/btn_thumb_o.gif" border="0"/>');
}

function getJsonToItem(max){
	var sid_layer = document.getElementById('sid_layer');
	var uid_layer = document.getElementById('uid_layer');
	$.getJSON('../php/ajax/getItem.php?p_type=s&sid='+sid_layer.value, function(json){
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
					$('.sub_bid_ip'+i).text('Mobile!!');
					$('.sub_item_bider').text(json.data.list[0].bid);
				}else{
					$('.sub_bid_time'+i).text(json.data.list[i].bti+"."+json.data.list[i].mti);
					$('.sub_bid_id'+i).text(json.data.list[i].bid);
					$('.sub_bid_ip'+i).text(json.data.list[i].bip);
					$('.sub_item_bider').text(json.data.list[0].bid);
				}
			}
			
			
			
		}catch(e){}
	});
}

function onSubItemLoad(num){
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
					if(sub_item_temp_eff2[i] == "do")  highlightFor('time_'+json.data.list[i].sid);
				}else{}
			}catch(e){}
		}
	});
}

function goBattle(){
	var sid_layer = document.getElementById('sid_layer');
	//alert(sid_layer.value);
	$.post("../php/battle_action.php",{"sid":sid_layer.value},function(data){
		if(data == "lack!"){
			if(confirm("바나나가 부족합니다. 충전하시겠습니까?")) openDialogByDom('#dialog_charge');
		}else alert(data);
	});
}

function makeFavorite(){
	var sid_layer = document.getElementById('sid_layer');
	if(confirm("해당 상품을 관심경매로 등록하시겠습니까?")){
		$.post("../php/favorite_action.php",{"sid":sid_layer.value, "type": "make"},function(data){
			alert(data);
		});
	}
}

function deleteFavorite(sid){
	if(confirm("해당 상품을 관심경매에서 삭제하시겠습니까?")){
		$.post("../php/favorite_action.php",{"sid":sid, "type": "del"});
	}
}

function autoBattle(){
	var sid_layer = document.getElementById('sid_layer');
	var auto_bids_layer = document.getElementById('auto_bids_layer');

	$.post("../php/autobattle_action.php",{"sid":sid_layer.value, "auto_bids":auto_bids_layer.value},function(data){
		if(data == "lack!"){
			if(confirm("예약 바나나 갯수가 현재 바나나 갯수보다 큽니다. 충전하시겠습니까?")) openDialogByDom('#dialog_charge');
		}else if(data == "fail"){
			alert("오토 배틀에 실패하였습니다. 다시한번 시도해주세요");
		}else{
			alert(data);
			closeDialogByDom();
		}
	});
}

function input_auto(){
	var auto_bids_layer = document.getElementById('auto_bids_layer');

	if(checkNumChar(auto_bids_layer.value)){
		event.returnValue = false;
	}
}

function sendMyTwit(){
	var sid_layer = document.getElementById('sid_layer');
	var sna_layer = document.getElementById('sna_layer');

	$.getJSON('http://api.bit.ly/v3/shorten?login=ke2n&apiKey=R_65156f700cdacdefd7177e8d752b2720&longUrl=http://battlebanana.com/html/sub.html?sid='+sid_layer.value+'&format=json&callback=?', function(json){
		window.open('http://twitter.com/home?status=[배틀바나나]+'+sna_layer.value+'+@Battlebanana:'+json.data.url,'팝업','width=600,height=500,scrollbars=yes');
	});
}