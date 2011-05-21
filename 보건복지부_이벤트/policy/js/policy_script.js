$(function(){
	window.scrollTo(0,0.9);

	$('#policy .layer').fadeIn(2000, function(){
		setTimeout(function(){
			$('#policy .layer').fadeOut(1000);
		}, 2000);
	});

	$('#Map .area1').click(function(){goArea("경기")});//경기도
	$('#Map .area2').click(function(){goArea("강원")});//강원도
	$('#Map .area3').click(function(){goArea("충남")});//충남
	$('#Map .area4').click(function(){goArea("충북")});//충북
	$('#Map .area5').click(function(){goArea("경북")});//경북
	$('#Map .area6').click(function(){goArea("전북")});//전북
	$('#Map .area7').click(function(){goArea("경남")});//경남
	$('#Map .area8').click(function(){goArea("전남")});//전남
	$('#Map .area9').click(function(){goArea("제주")});//제주
	
});

function goArea(area){
	$.get("./area.php", {getArea: area}, function(){
		  alert(area);
	});
}