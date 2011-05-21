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
				if(ins_time == '00:00:00'){
					$('#box_'+J_sid+' .box_time').html("<img src='../img/img_auction_end.gif'>");
					$('#box_'+J_sid).css('background', 'url("../img/bg_box_closed.gif")');
				}else $('#box_'+J_sid+' .box_time').html(ins_time);
				
				$('#box_'+J_sid+' .box_price_in').html(J_lap);
				$('#box_'+J_sid+' .box_id').text(J_bid);
				$('#quick_banana').text(json.data.banana);

				temp2[J_sid] = temp1[J_sid];
				temp1[J_sid] = J_lap;
				temp_eff2[J_sid] = temp_eff1[J_sid];
				temp_eff1[J_sid] = J_eff;
				if(temp1[J_sid] != temp2[J_sid] && temp2[J_sid] != null && option != 'favorite'){
					$('#price'+J_sid).animate({width: "+=20px"}, 100);
					$('#price'+J_sid).animate({width: "-=40px"}, 100);
					$('#price'+J_sid).animate({width: "+=20px"}, 100);
					if(temp_eff2[J_sid] == "do") highlightFor('box_'+J_sid);
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
				$('#box_sub'+i+' .box_time').html(ins_time);
				$('#box_sub'+i+' .box_price_in').html(J_lap);
				$('#box_sub'+i+' .box_id').text(J_bid);

				temp2[J_sid] = temp1[J_sid];
				temp1[J_sid] = J_lap;
				temp_eff2[J_sid] = temp_eff1[J_sid];
				temp_eff1[J_sid] = J_eff;
				if(temp1[J_sid] != temp2[J_sid] && temp2[J_sid] != null){
					$('#box_sub'+i+' #price'+J_sid).animate({width: "+=20px"}, 100);
					$('#box_sub'+i+' #price'+J_sid).animate({width: "-=40px"}, 100);
					$('#box_sub'+i+' #price'+J_sid).animate({width: "+=20px"}, 100);
					if(temp_eff2[J_sid] == "do") highlightFor('time_'+J_sid);
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
	//var options = {color:'red'};
	//$('#' + id).effect("highlight", options, 50);
/*	$('#' + id).animate({backgroundColor:"red"}, 100);
	
setTimeout(function(){
		$('#' + id).stop().animate({width:"80px"}, 100);
	}, 500);
	*/
	color = "#dd4e00";
	seconds = 700;
    var element = document.getElementById(id);
    var origcolor = element.style.color;
    element.style.color = color;
    var t = setTimeout(function(){
       element.style.color = origcolor;
    },(seconds));
}
/*
function onLoad(num){//main페이지에 아이템 뿌려주는 함수
	var temp1 = new Array;
	var temp2 = new Array;
	var temp_eff1 = new Array;
	var temp_eff2 = new Array;

	var effect;
	var option = document.getElementById('op_layer');
	var cate = document.getElementById('cate_layer');

	//$('#main_table').fadeOut(500);
	//$('#main_table').fadeIn(700);
	$('#main_table').hide();
	$('#main_table').show();
	$('#main_table').stopTime('control');
	$('#main_table').everyTime(1000, 'control', function(){
		$.getJSON('../php/ajax/getItem.php?p_type=m&p='+num+'&op='+option.value+'&cate='+cate.value, function(json){
		$('#main_table').html('');

		if(json.data.page == 0){
			$('#main_table').html('<img src="../img/bg_box_nodata.gif" border="0">');
			$('#page_num').html('');
			$('#main_table').stopTime('control');
		}else{
		for(var i=0; i<9; i++){
			try{
				$('#main_table').append(getData(json.data.list[i], i, option.value));
				$('#quick_banana').text(json.data.banana);
				//CountDown(json.data.list[i].sid, json.data.list[i].exp);
				temp2[i] = temp1[i];
				temp1[i] = json.data.list[i].lap;
				temp_eff2[i] = temp_eff1[i];
				temp_eff1[i] = json.data.list[i].eff;
				if(temp1[i] != temp2[i] && temp2[i] != null){
					$('#price'+json.data.list[i].sid).animate({width: "+=20px"}, 100);
					$('#price'+json.data.list[i].sid).animate({width: "-=40px"}, 100);
					$('#price'+json.data.list[i].sid).animate({width: "+=20px"}, 100);
					if(temp_eff2[i] == "do") highlightFor('time_'+json.data.list[i].sid);
				}else{}
			}catch(e){}
		}
		$('#main_table').append('<div class="box_bg" id="box_"><a href="#"><img src="../img/btn_box_closed_o.gif"></a></div>');

		var nextNum = num+1;
		var prn_img = "<span><a onmousedown=\"onLoad(1)\" style=\"cursor:pointer\"><img src=\"../img/btn_page_first.gif\" name=\"btn_page_first\" id=\"btn_page_first\" onmouseover=javascript:btn_page_first.src='../img/btn_page_first_o.gif'; onmouseout=javascript:btn_page_first.src='../img/btn_page_first.gif'; border=\"0\"/></a></span>";
        prn_img += "<span><a onmousedown=\"onLoad("+(num-1)+")\" style=\"cursor:pointer\"><img src=\"../img/btn_page_prev.gif\" name=\"btn_page_prev\" id=\"btn_page_prev\" onmouseover=javascript:btn_page_prev.src='../img/btn_page_prev_o.gif'; onmouseout=javascript:btn_page_prev.src='../img/btn_page_prev.gif'; border=\"0\"/></a>&nbsp;&nbsp;</span>";
		for(var i=0; i<json.data.page; i++){
			if(i == (num-1)) prn_img += "<span><img src=\"../img/btn_page_thumb_s.gif\" border=\"0\"/></span>";
			else prn_img += "<span><a onmousedown=\"onLoad("+(i+1)+")\" style=\"cursor:pointer\"><img src=\"../img/btn_page_thumb.gif\" name=\"btn_page_thumb"+i+"\" id=\"btn_page_thumb"+i+"\" onmouseover=javascript:btn_page_thumb"+i+".src='../img/btn_page_thumb_o.gif'; onmouseout=javascript:btn_page_thumb"+i+".src='../img/btn_page_thumb.gif'; border=\"0\"/></a></span>";
		}
		if(nextNum > json.data.page) nextNum = json.data.page;
		prn_img += "<span>&nbsp;&nbsp;<a onmousedown=\"onLoad("+nextNum+")\" style=\"cursor:pointer\"><img src=\"../img/btn_page_next.gif\" name=\"btn_page_next\" id=\"btn_page_next\" onmouseover=javascript:btn_page_next.src='../img/btn_page_next_o.gif'; onmouseout=javascript:btn_page_next.src='../img/btn_page_next.gif'; border=\"0\"/></a></span>";
        prn_img += "<span><a onmousedown=\"onLoad("+json.data.page+")\" style=\"cursor:pointer\"><img src=\"../img/btn_page_last.gif\" name=\"btn_page_last\" id=\"btn_page_last\" onmouseover=javascript:btn_page_last.src='../img/btn_page_last_o.gif'; onmouseout=javascript:btn_page_last.src='../img/btn_page_last.gif'; border=\"0\"/></a></span>";

		$('#page_num').html(prn_img);
		}
   });
   });
}

function getData(data, num, type){//각아이템의 테그를 만들어주는 함수
	var ins_time;
	if(data.exp == '경매종료'){
		ins_time = "<img src='../img/img_auction_end.gif'>";
	}else{
		var hour = Math.floor(data.exp/3600);
		var min = Math.floor(data.exp%3600/60);
		var sec = data.exp%3600%60;
		if(hour < 10) hour = "0" + hour;
		if(min < 10) min = "0" + min;
		if(sec < 10) sec = "0" + sec;
		ins_time = hour+':'+min+':'+sec;
	}
	if(type == "favorite"){
	var txt  = '<div class="box_bg" id="box_'+data.sid+'">';
		txt += '<div class="box_del"><a onclick=deleteFavorite("'+data.sid+'") style="cursor:pointer"><img src="../img/btn_fav_del.gif" name=\"btn_fav_del'+data.sid+'\" id=\"btn_fav_del'+data.sid+'\" onmouseover=javascript:btn_fav_del'+data.sid+'.src="../img/btn_fav_del_o.gif"; onmouseout=javascript:btn_fav_del'+data.sid+'.src="../img/btn_fav_del.gif"; border="0"/></a></div>';
		txt += '<div class="box_padding">';
		txt += '<div class="box_title"><a href="sub.html?sid='+data.sid+'">'+data.sna+'</a></div>';
		txt += '<div class="box_item_img"><a href="sub.html?sid='+data.sid+'"><img src="../'+data.img+'" width="122" height="122" border="0"></a></div>';
		txt += '<div class="box_time" id="time_'+data.sid+'">'+ins_time+'</div>';
		txt += '<div class="box_price" id="price'+data.sid+'">'+data.lap+'<img src="../img/img_won.gif" align="absmiddle" /></div>';
		txt += '<div class="box_id">'+data.bid+'</div>';
		txt += '</div>';
		txt += '</div>';
	}else if(type == "win"){
	var txt  = '<div class="box_bg_win" id="box_'+data.sid+'">';
		txt += '<div class="box_padding">';
		txt += '<div class="box_title"><a href="sub.html?sid='+data.sid+'">'+data.sna+'</a></div>';
		txt += '<div class="box_item_img"><a href="sub.html?sid='+data.sid+'"><img src="../'+data.img+'" width="122" height="122" border="0"></a></div>';
		txt += '<div class="box_time" id="time_'+data.sid+'">'+ins_time+'</div>';
		txt += '<div class="box_price" id="price'+data.sid+'">'+data.lap+'<img src="../img/img_won.gif" align="absmiddle" /></div>';
		txt += '<div class="box_id">'+data.bid+'</div>';
		txt += '</div>';
		txt += '</div>';
	}else{
	var txt  = '<div class="box_bg" id="box_'+data.sid+'">';
		txt += '<div class="box_padding">';
		txt += '<div class="box_title"><a href="sub.html?sid='+data.sid+'">'+data.sna+'</a></div>';
		txt += '<div class="box_item_img"><a href="sub.html?sid='+data.sid+'"><img src="../'+data.img+'" width="122" height="122" border="0"></a></div>';
		txt += '<div class="box_time" id="time_'+data.sid+'">'+ins_time+'</div>';
		txt += '<div class="box_price" id="price'+data.sid+'">'+data.lap+'<img src="../img/img_won.gif" align="absmiddle" /></div>';
		txt += '<div class="box_id">'+data.bid+'</div>';
		txt += '</div>';
		txt += '</div>';
	}
	return txt;
}

function CountDown(sid, time){//카운트다운(아마안쓸듯?)
	$('#time_' + sid).countdown({until: + time, compact:true, format: 'HMS'});
}
*/
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
				$('#battleButton').html("<img src='../img/sub/btn_end.gif' border=0 onmouseover=\"$('.tooltip_end').show();\" onmouseout=\"$('.tooltip_end').hide();\">");
				
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
					if(sub_item_temp_eff2[i] == "do")  highlightFor('time_'+json.data.list[i].sid);
				}else{}
			}catch(e){}
		}
	});
}
///////////////////////////////////////////////SUB부분끝///////////////////////////////////////////////////////////