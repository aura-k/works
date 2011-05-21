var temp1;
var temp2;
var effect;
function onLoad(num){
	$('#main_table').fadeOut(500);
	$('#main_table').fadeIn(700);
	$('#main_table').stopTime('control');
	$('#main_table').everyTime(1000, 'control', function(){
		$.getJSON('../php/ajax/getItem.php?p_type=m&p='+num, function(json){
			/*temp2 = temp1;
			temp1 = json.item_lastprice[0].item_0;
			
			if(temp1 != temp2){
				$('.expired_item_0').css('color','red');
				$('.lastprice_item_0').css('color','white');
				$('.lastprice_item_0').css('background','#ffa836');
				
			}else{
				$('.expired_item_0').css('color','');
				$('.lastprice_item_0').css('color','');
				$('.lastprice_item_0').css('background','');
			}*/
		$('#main_table').html('');
		for(var i=0; i<9; i++){
			try{
				$('#main_table').append(getData(json.data.list[i], i));
				//CountDown(json.data.list[i].sid, json.data.list[i].exp);
			}catch(e){}
		}
		
		var prn_img = "";
		for(var i=0; i<json.data.page; i++){
			if(i == (num-1)) prn_img += "<span><img src=\"../img/btn_page_thumb_s.gif\" border=\"0\"/></span>";
			else prn_img += "<span><a onmousedown=\"onLoad("+(i+1)+")\"><img src=\"../img/btn_page_thumb.gif\" name=\"btn_page_thumb"+i+"\" id=\"btn_page_thumb"+i+"\" onmouseover=javascript:btn_page_thumb"+i+".src='../img/btn_page_thumb_o.gif'; onmouseout=javascript:btn_page_thumb"+i+".src='../img/btn_page_thumb.gif'; border=\"0\"/></a></span>";
		}

		$('#page_num').html(prn_img);
   });
   });
}

function getData(data, num){
	var txt  = '<div class="box_bg" id="box_'+data.sid+'">';
		txt += '<div class="box_padding">';
		txt += '<div class="box_title">'+data.sna+'</div>';
		txt += '<div class="box_item_img"><a href="sub.html?sid='+data.sid+'"><img src="../'+data.img+'" / border="0"></a></div>';
		txt += '<div class="box_time" id="time_'+data.sid+'">'+data.exp+'</div>';
		txt += '<div class="box_price">'+data.lap+'<img src="../img/img_won.gif"/ align="absmiddle" /></div>';
		txt += '<div class="box_id">'+data.bid+'</div>';
		txt += '</div>';
		txt += '</div>';
	return txt;
}

function CountDown(sid, time){	
	$('#time_' + sid).countdown({until: + time, compact:true, format: 'HMS'});
}