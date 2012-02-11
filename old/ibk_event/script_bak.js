function allFadeOut(sec){
	document.body.scrollTop = 0;
	$('.hidden0').fadeOut(sec);
	$('.hidden1').fadeOut(sec);
	$('.hidden2').fadeOut(sec);
	$('.hidden2_1').fadeOut(sec);
	$('.hidden2_2').fadeOut(sec);
	$('.hidden3').fadeOut(sec);
	$('.hidden3_1').fadeOut(sec);
	$('.hidden3_2').fadeOut(sec);
	$('.hidden3_3').fadeOut(sec);
	$('.hidden3_4').fadeOut(sec);
	$('.hidden3_5').fadeOut(sec);
	$('.hidden3_6').fadeOut(sec);
	$('.hidden3_7').fadeOut(sec);
	$('.hidden3_8').fadeOut(sec);
	$('.hidden4').fadeOut(sec);
	$('.hidden5').fadeOut(sec);
	$('#game').attr('style', '-webkit-transform:translateY(0px);');
}
function goMain(){
	allFadeOut(500);
	$('.hidden0').fadeIn(500);
	$('.frame').attr('style', 'height:417px;');
}
function goCf(){
	allFadeOut(500);
	$('#cf').attr('style', 'background:url(\'bg_clear.png\') no-repeat;');
	$('.hidden1').fadeIn(500);
	$('.frame').attr('style', 'height:417px;');
}
function goInfo(){
	allFadeOut(500);
	$('#info').attr('style', 'background:url(\'bg_cf.png\') no-repeat;');
	$('.hidden2').fadeIn(500);
	$('.frame').attr('style', 'height:417px;');
}
function goAni(){
	allFadeOut(500);
	$('#ani').attr('style', 'background:url(\'bg_ani.png\') no-repeat;');
	$('.hidden3').fadeIn(500);
	$('.frame').attr('style', 'height:417px;');
}
function goInput(){
	allFadeOut(500);
	$('#input1').attr('style', 'background:url(\'bg_event.png\') no-repeat;');
	$('.hidden4').fadeIn(500);
	$('.frame').attr('style', 'height:417px;');
}
function goLogic(){
	allFadeOut(500);
	$('.hidden5').fadeIn(500);
	$('#game ul li .logic_st').attr('style', 'background:url(\'bg_game_st.png\') no-repeat;');
	$('#game ul li .logic').attr('style', 'background:url(\'bg_game.png\') no-repeat;');
	$('#game ul li .logic2').attr('style', 'background:url(\'bg_game2.png\') no-repeat;');
	$('#game ul li .logic3').attr('style', 'background:url(\'bg_game3.png\') no-repeat;');
	$('#game ul li .result1').attr('style', 'background:url(\'bg_result_1.png\') no-repeat;');
	$('#game ul li .result2').attr('style', 'background:url(\'bg_result_2.png\') no-repeat;');
	$('#game ul li .result3').attr('style', 'background:url(\'bg_result_3.png\') no-repeat;');
	$('#game ul li .result4').attr('style', 'background:url(\'bg_result_4.png\') no-repeat;');
	$('.frame').attr('style', 'height:417px;');
}
function showBG(){
	$('#game ul li .result1').attr('style', 'background:url(\'bg_result_1.png\') no-repeat;');
	$('#game ul li .result2').attr('style', 'background:url(\'bg_result_2.png\') no-repeat;');
	$('#game ul li .result3').attr('style', 'background:url(\'bg_result_3.png\') no-repeat;');
	$('#game ul li .result4').attr('style', 'background:url(\'bg_result_4.png\') no-repeat;');
}
function nextLogic(row, col){
	$('#game').attr('style', '-webkit-transform:translate(-' + (row * 320) + 'px, -' + ((col * 417) - 417) + 'px);');
}