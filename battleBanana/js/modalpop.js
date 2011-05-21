/*-----------------팝업창마다 가로세로길이 미리 정하기-------------------------*/
var dialW = new Array();
var dialH = new Array();

dialW["signup"] = 440;
dialH["signup"] = 410;

dialW["login"] = 440;
dialH["login"] = 270;

dialW["find"] = 440;
dialH["find"] = 320;

dialW["modify"] = 440;
dialH["modify"] = 390;

dialW["drop"] = 440;
dialH["drop"] = 250;

dialW["charge"] = 440;
dialH["charge"] = 420;

dialW["bananalist"] = 726;
dialH["bananalist"] = 370;

dialW["orderlist"] = 726;
dialH["orderlist"] = 320;

dialW["deli"] = 440;
dialH["deli"] = 400;

dialW["delimodi"] = 440;
dialH["delimodi"] = 320;

dialW["email"] = 440;
dialH["email"] = 320;

dialW["twitter"] = 440;
dialH["twitter"] = 320;

dialW["auto"] = 440;
dialH["auto"] = 320;

/*-----------------팝업창마다 가로세로길이 미리 정하기-------------------------*/

$(document).ready(function() {	
	
	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		var sid_layer = document.getElementById('sid_layer');
		//Get the A tag
		var fullid = $(this).attr('href');
		var id = fullid.substr(0, 7);
		var id_option = fullid.substr(8, fullid.length);
		if(id_option == "email" || id_option == "twitter") $(id).load("pop_" + id_option + ".html?sid="+sid_layer.value);
		else $(id).load("pop_" + id_option + ".html");


		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(document).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		//$('#mask').fadeIn(1000);	
		$('#mask').fadeTo(1,0.5);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-dialH[id_option]/2);
		$(id).css('left', winW/2-dialW[id_option]/2);
	
		//transition effect
		//$(id).fadeIn(2000); 
		$(id).show(); 
	});
	
	//if close button is clicked
	$('.dialog_close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
			
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
		//$('#mask').fadeOut(500);
		//$('.window').fadeOut(500);
	});		
});

function openDialogByDom(str){
	var sid_layer = document.getElementById('sid_layer');
	//$('.window').fadeOut(500);
	$('.window').hide();
	$('.window').html('');

	var fullid = str;
	var id = fullid.substr(0, 7);
	var id_option = fullid.substr(8, fullid.length);
	
	if(id == "#option"){
		id = "#dialog";
		var id_index = id_option.lastIndexOf('_');
		var get_sid = id_option.substr(id_index+1, fullid.length);
		id_option = id_option.substr(0, id_index);
	}
	
	if(id_option == "deli" || id_option == "auto") $(id).hide().load("pop_" + id_option + ".html?sid="+sid_layer.value,function(){$(this).fadeIn();});
	else if(id_option == "delimodi") $(id).hide().load("pop_" + id_option + ".html?sid="+get_sid,function(){$(this).fadeIn();});
	else $(id).hide().load("pop_" + id_option + ".html",function(){$(this).fadeIn();});
	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
	
	//Set heigth and width to mask to fill up the whole screen
	$('#mask').css({'width':maskWidth,'height':maskHeight});
		
	//transition effect		
	//$('#mask').fadeIn(1000);	
	$('#mask').fadeTo(1,0.5);	
	
	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
              
	//Set the popup window to center
	$(id).css('top',  winH/2-dialH[id_option]/2);
	$(id).css('left', winW/2-dialW[id_option]/2);
	
	//transition effect
	//$(id).fadeIn(2000); 
	$(id).show(); 
}


function closeDialogByDom(){
	//$('#mask').fadeOut(500);
	//$('.window').fadeOut(500);
	$('#mask').hide();
	$('.window').hide();
	$('.window').html('');
}


function openDialogByIE6(){
	//$('.window').fadeOut(500);
	$('.windowIE').hide();
	$('.windowIE').html('');

	$('#dialogIE').hide().load("pop_ie6.html",function(){$(this).fadeIn();});
	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
	
	//Set heigth and width to mask to fill up the whole screen
	$('#maskIE').css({'width':maskWidth,'height':maskHeight});
		
	//transition effect		
	//$('#mask').fadeIn(1000);	
	$('#maskIE').fadeTo(1,0.5);	
	
	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
              
	//Set the popup window to center
	$('#dialogIE').css('top',  winH/2-302/2);
	$('#dialogIE').css('left', winW/2-712/2);
	
	//transition effect
	//$(id).fadeIn(2000); 
	$('#dialogIE').show(); 
}