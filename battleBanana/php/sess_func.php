<? //페이지 이동 함수 

function GoGo($url) { 
global $connect; echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">"; 
if($connect) @mysql_close($connect); exit; 
} //메세지 보여주는 함수 메세지창 //메세지를 보여주고 뒤로 백한다 

function message($msg) {
echo(" <html><head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><script name=javascript> window.alert('$msg'); history.go(-1); </script> </head></html> "); 
exit; 
} //메세지를 보여주고 가고자할 페이지로 이동한다... 

function GoTo($msg,$url) { 
global $connect; 
echo(" <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /><html><head> <script name=javascript> window.alert('$msg'); </script> </head></html> "); 
echo"<meta http-equiv=\"refresh\" content=\"0; url=$url\">"; if($connect) @mysql_close($connect); exit; 
} 

function checkSession(){
	if(!$_SESSION[""]) message("");
}

function _microtime(){ return array_sum(explode(' ',microtime())); }

function limitHangul($Array, $index, $limit){
	$arrcount = count($Array);//입력된 배열의 갯수를 구함
	$maxLimit = $limit*3;//utf8 에선 한글을 3바이트로 인식

	for($i=0; $i<$arrCount; $i++){
		//생각은... strlen으로 utf8 한글 한글자는 3바이트 이므로, 이것을 기준으로 해서
		//전체 limit 까지 짜르고, 마지막 문자를 아스키 코드 값과
		//비교해서 한글인지 아닌지를 구별
		if(strlen($Array[$i][$index])>$maxLimit){
			$tempString = substr($Array[$i][$index], 0, $maxLimit);
			$j=1;
			
			while(true){
				if(ord($tempString[$maxLimit-$j]) >= 0x00 && ord($tempString[$maxLimit-$j]) <= 0x7f){//한글 이외의 문자일 때..
					$Array[$i][$index] = $tempString."...";
					break;
				}else{ //한글 일 때
					$tempString[$maxLimit-$j] = '';
				}
				$j++;
			}
		}
	}
	
	return $Array;
}

function chr_cut($val,$cut_len){
	$tot_len = strlen($val);
	$cut_str = substr($val,0,$cut_len);
	$len = strlen($cut_str);
	
	for($i=0;$i<$len;$i++){
		if(ord($val[$i]) > 127){ 
			$hanlen++;
		}else{
			$englen++; 
		}
	} 
	
	$cut_gap = $hanlen % 2;
	
	if($cut_gap == 1) $hanlen--;
	$length = $hanlen + $englen;
	if($tot_len > $length){
		return substr($val,0,$length)."..";
	}else{
		return substr($val,0,$length);
	}
}
?>