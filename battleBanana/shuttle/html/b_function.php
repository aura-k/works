<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
include './php/connect.php';
include 'xml_parser.php';


function fetch_page($url,$param,$cookies,$referer_url){//post의 매개변수로 이루어진 페이지를 가져오는 함수
    if(strlen(trim($referer_url)) == 0) $referer_url= $url; 
    $curlsession = curl_init ();
    curl_setopt ($curlsession, CURLOPT_URL, "$url");
    curl_setopt ($curlsession, CURLOPT_POST, 1);
    curl_setopt ($curlsession, CURLOPT_POSTFIELDS, "$param");
    curl_setopt ($curlsession, CURLOPT_POSTFIELDSIZE, 0);
    curl_setopt ($curlsession, CURLOPT_TIMEOUT, 60);
    if($cookies && $cookies!=""){
        curl_setopt ($curlsession, CURLOPT_COOKIE, "$cookies");
    }
    curl_setopt ($curlsession, CURLOPT_HEADER, 0);
    curl_setopt ($curlsession, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt ($curlsession, CURLOPT_REFERER, "$referer_url"); 
    ob_start();
    $res = curl_exec ($curlsession);
    $buffer = ob_get_contents();
    ob_end_clean();
    if (!$buffer) {
        $returnVal = "Curl Fetch Error : ".curl_error($curlsession);
    }else{
        $returnVal = $buffer;
    } 
    curl_close($curlsession); 
    return $returnVal;
}
function geocodingByGoogle($add){ //주소값을 위도, 경도 값으로 바꿔주는 함수(구글JSON사용)
	if($add == ""){//주소값이 없으면 한국 위도,경도를 불러온다.
		$lat = 35.907757;
		$lng = 127.766922;

		return $lat.", ".$lng;
	}
	$target ="http://maps.google.co.kr/maps/api/geocode/json?address=".urlencode(iconv('euckr', 'utf-8', $add))."&sensor=true";
	
	try{
		$url = file_get_contents($target);
	
		$location = json_decode($url);
	
		$lat = $location->results[0]->geometry->location->lat;
		$lng = $location->results[0]->geometry->location->lng;
	}catch(Exception $e){
		$lat = 35.907757;
		$lng = 127.766922;
	}
	return $lat.", ".$lng;
}
function urlutfchr($text){ 
	   return rawurldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'tostring', $text)); 
}
function tostring($text) { 
   return iconv('UTF-16LE', 'UHC', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2)))); 
}
/*
$get_html = fetch_page("http://www.182.go.kr/child/nSearchFormList.jsp", "gubun=".$_POST["option_para"]."&startCount=0", "", "");
//$get_html = iconv('euckr', 'utf-8', $get_html);//공백을없애기 전 상태. 공백이 있는 주소를 얻을 때 사용되는 변수
$get_shoted_html = preg_replace ("/\s+/","", trim($get_html));//최종적으로 가공된 html의 내용. 이곳에서 각 정보를 쉽게 빼올 수 있다.

preg_match_all('/<tdwidth=\"50%\"><b>\[([0-9].*)\]건검색되었습니다/U', $get_shoted_html, $get_mia_allnum) ;

$pages = floor($get_mia_allnum[1][0]/10);
$remains = $get_mia_allnum[1][0]%10;

echo("총 미아 검색 건수는 ".$get_mia_allnum[1][0]."명 이니라.\n그리고, 페이지는 ".$pages."번 검색해야겠고, ".$remains."개가 남겠지?");
echo("\n한 페이지당 80kb의 트래픽이 필요하다고 하면, 이번 검색은 총".($get_mia_allnum[1][0]+$pages)."건의 페이지가 필요하겠고, 이는 ".(80*($get_mia_allnum[1][0]+$pages))."kb가 필요하겠구나.....ㅎㄷㄷ\n\n");
*/

//티몬(압구정/신사/강남) xml페이지    http://ticketmonster.co.kr/html/data/mainXml.php?&p_no=186

$html = file_get_contents('http://ticketmonster.co.kr/html/?area=28');
$html = iconv('euckr', 'utf-8', urlutfchr($html));

preg_match_all('/javascript:goTwitter\(\'(.*)\',/U', $html, $get_title);
preg_match_all('/&amp;q=(.*)\">/U', $html, $get_map);
preg_match_all('/p_no=(.*)\">/U', $html, $get_no);

$xml = file_get_contents('http://ticketmonster.co.kr/html/data/mainXml.php?&p_no='.$get_no[1][0]);
$parser = new XMLParser(trim($xml));
$parser->Parse();

echo $get_title[1][0].'<br>';
echo '주소 : '.urlutfchr($get_map[1][0]).'<br>';
echo '원래가격 : '.$parser->document->orginal[0]->tagData.'<br>';
echo '할인율 : '.$parser->document->discount[0]->tagData.'%<br>';
echo '현재가격 : '.$parser->document->price[0]->tagData.'<br>';
echo '구입인원 : '.$parser->document->nowcnt[0]->tagData.'<br>';
echo '남은시간 : '.$parser->document->lefthour[0]->tagData.':'.$parser->document->leftminute[0]->tagData.':'.$parser->document->leftsecond[0]->tagData.'<br>';
echo '이미지 : <img src="http://ticketmonster.co.kr'.$parser->document->photo[0]->img[0]->tagData.'"/><br><br>';


$query = "INSERT INTO `C_datalist`(`c_name`, `c_url`, `c_title`, `c_ori_price`, `c_price`, `c_rate`, `c_img`, `c_people`, `c_time`, `c_comment`) 
				VALUES(
					'티켓몬스터',
					'http://ticketmonster.co.kr/html/?area=28',
					'".$get_title[1][0]."',
					'".$parser->document->orginal[0]->tagData."',
					'".$parser->document->price[0]->tagData."',
					'".$parser->document->discount[0]->tagData."',
					'http://ticketmonster.co.kr".$parser->document->photo[0]->img[0]->tagData."',
					'".$parser->document->nowcnt[0]->tagData."',
					'',
					'쭈꾸미'
				);";
$result = @mysql_query($query);

$html = file_get_contents('http://ticketmonster.co.kr/html/?area=29');
$html = iconv('euckr', 'utf-8', urlutfchr($html));

preg_match_all('/javascript:goTwitter\(\'(.*)\',/U', $html, $get_title);
preg_match_all('/&q=(.*)\">/U', $html, $get_map);
preg_match_all('/p_no=(.*)\">/U', $html, $get_no);
$xml = file_get_contents('http://ticketmonster.co.kr/html/data/mainXml.php?&p_no='.$get_no[1][0]);
$parser = new XMLParser(trim($xml));
$parser->Parse();

echo $get_title[1][0].'<br>';
echo '주소 : '.urlutfchr($get_map[1][0]).'<br>';
echo '원래가격 : '.$parser->document->orginal[0]->tagData.'<br>';
echo '할인율 : '.$parser->document->discount[0]->tagData.'%<br>';
echo '현재가격 : '.$parser->document->price[0]->tagData.'<br>';
echo '구입인원 : '.$parser->document->nowcnt[0]->tagData.'<br>';
echo '남은시간 : '.$parser->document->lefthour[0]->tagData.':'.$parser->document->leftminute[0]->tagData.':'.$parser->document->leftsecond[0]->tagData.'<br>';
echo '이미지 : <img src="http://ticketmonster.co.kr'.$parser->document->photo[0]->img[0]->tagData.'"/><br><br>';

$query = "INSERT INTO `C_datalist`(`c_name`, `c_url`, `c_title`, `c_ori_price`, `c_price`, `c_rate`, `c_img`, `c_people`, `c_time`, `c_comment`) 
				VALUES(
					'티켓몬스터',
					'http://ticketmonster.co.kr/html/?area=28',
					'".$get_title[1][0]."',
					'".$parser->document->orginal[0]->tagData."',
					'".$parser->document->price[0]->tagData."',
					'".$parser->document->discount[0]->tagData."',
					'http://ticketmonster.co.kr".$parser->document->photo[0]->img[0]->tagData."',
					'".$parser->document->nowcnt[0]->tagData."',
					'',
					'쭈꾸미'
				);";
$result = @mysql_query($query);

/*
//쇼킹온
$html = file_get_contents('http://showkingon.com/changeArea.php?Aid=07');
preg_match_all('/inVar=(.*)\"/U', $html, $get_original_price);
preg_match_all('/inVar1=(.*)\&/U', $html, $get_nowcnt);
preg_match_all('/<img src="(.*)" width="573" height="314" \/>/U', $html, $get_img);
preg_match_all('/javascript:sendTwitter\(\'(.*)\'/U', $html, $get_title);
echo $get_title[1][0].'<br>';
echo '할인율 : '.$get_original_price[1][0].'<br>';
echo '원래가격 : '.$get_original_price[1][2].'<br>';
echo '현재가격 : '.$get_original_price[1][4].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '이미지 : <img src="http://showkingon.com'.$get_img[1][0].'"/><br>';


//원데이플레이스
$html = file_get_contents('http://www.onedayplace.com/index.php?product_idx=52');
preg_match_all('/var now_value = \"(.*)\"/U', $html, $get_nowcnt);
preg_match_all('/var sale = \"(.*)\"/U', $html, $get_rate);
preg_match_all('/var price = \"(.*)\"/U', $html, $get_price);
preg_match_all('/var sale_price =\"(.*)\"/U', $html, $get_sale_price);

echo '할인율 : '.$get_rate[1][0].'<br>';
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '이미지 : <img src="http://onedayplace.com/images/contents/'.date('Ymd',mktime()).'/today0/main_1.jpg"/><br>';

$html = file_get_contents('http://www.onedayplace.com/index.php?product_idx=54');
preg_match_all('/var now_value = \"(.*)\"/U', $html, $get_nowcnt);
preg_match_all('/var sale = \"(.*)\"/U', $html, $get_rate);
preg_match_all('/var price = \"(.*)\"/U', $html, $get_price);
preg_match_all('/var sale_price =\"(.*)\"/U', $html, $get_sale_price);

echo '할인율 : '.$get_rate[1][0].'<br>';
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '이미지 : <img src="http://onedayplace.com/images/contents/'.date('Ymd',mktime()).'/today1/main_1.jpg"/><br>';


//슈가딜
$html = file_get_contents('http://www.sugardeal.co.kr/');
preg_match_all('/alt=\"현재\">(.*)</U', $html, $get_nowcnt);
preg_match_all('/var tcounter =(.*);/U', $html, $get_lefthour);
//preg_match_all('/var sale = \"(.*)\"/U', $html, $get_rate);
//preg_match_all('/var price = \"(.*)\"/U', $html, $get_price);
//preg_match_all('/var sale_price =\"(.*)\"/U', $html, $get_sale_price);
$left_hour = floor(trim($get_lefthour[1][0])/3600);
$left_min = floor(trim($get_lefthour[1][0])%3600/60);
$left_sec = floor(trim($get_lefthour[1][0])%60);
if($left_hour < 10) $left_hour='0'.$left_hour;
if($left_min < 10) $left_min='0'.$left_min;
if($left_sec < 10) $left_sec='0'.$left_sec;

echo '제목: 모름<br>';//누락
echo '할인율 : 50<br>';//누락
echo '원래가격 : 모름<br>';//누락
echo '현재가격 : 모름<br>';//누락
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : '.$left_hour.':'.$left_min.':'.$left_sec.'<br>';
echo '이미지 : <img src="http://www.sugardeal.co.kr/bbs/data/item/1281260741_l1"/><br>';//주기적인것이 필요함..


//데일리픽
$html = file_get_contents('http://www.dailypick.co.kr/');
preg_match_all('/<li class=\"buyer\"><strong>(.*)</U', $html, $get_nowcnt);
preg_match_all('/var g_remainTime =(.*);/U', $html, $get_lefthour);
preg_match_all('/javascript:share_twitter\(\'(.*)\'/U', $html, $get_title);
preg_match_all('/<img src=\"\/mall\/updir\/products\/(.*)\" style/U', $html, $get_img);
//preg_match_all('/var sale_price =\"(.*)\"/U', $html, $get_sale_price);
$left_hour = floor(trim($get_lefthour[1][0])/3600);
$left_min = floor(trim($get_lefthour[1][0])%3600/60);
$left_sec = floor(trim($get_lefthour[1][0])%60);
if($left_hour < 10) $left_hour='0'.$left_hour;
if($left_min < 10) $left_min='0'.$left_min;
if($left_sec < 10) $left_sec='0'.$left_sec;

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : 모름<br>';//누락
echo '원래가격 : 모름<br>';//누락
echo '현재가격 : 모름<br>';//누락
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : '.$left_hour.':'.$left_min.':'.$left_sec.'<br>';
echo '이미지 : <img src="http://www.dailypick.co.kr/mall/updir/products/'.$get_img[1][0].'"/><br>';//주기적인것이 필요함..


//위폰(답안나옴..다 미완성)
$html2 = file_get_contents('http://m.wipon.co.kr/wipon/wipon.php');

//preg_match_all('/<li class=\"buyer\"><strong>(.*)</U', $html, $get_nowcnt);
//preg_match_all('/var g_remainTime =(.*);/U', $html, $get_lefthour);
preg_match_all('/<title>(.*)<\/title>/U', $html2, $get_title);
preg_match_all('/<div><img src=\"..(.*)\"/U', $html2, $get_img);
preg_match_all('/<strike>(.*)<\/strike>/U', $html2, $get_price);
preg_match_all('/class=\"sale\">(.*)</U', $html2, $get_sale_price);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.((1-$get_sale_price[1][0]/$get_price[1][0])*100).'<br>';//디비전이 0일때 오류 수정필요
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : 모름<br>';
echo '남은시간 : 모름<br>';
echo '이미지 : <img src="http://m.wipon.co.kr'.$get_img[1][1].'"/><br>';


//쿠폰
$html = file_get_contents('http://www.koofun.co.kr/');
preg_match_all('/no_1.gif align=absmiddle> <b>(.*)</U', $html, $get_nowcnt);
preg_match_all('/encodeURIComponent\(\"(.*)\"/U', $html, $get_title);
preg_match_all('/style=\'padding:0px 0px 15px 0px\'><img src=\"(.*)\"/U', $html, $get_img);
preg_match_all('/<img src=\"\/mall\/images\/w2.gif\" align=absmiddle \/> <s>(.*)</U', $html, $get_price);
preg_match_all('/id=\'priceHTML\'>(.*)</U', $html, $get_sale_price);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.($get_sale_price[1][0]/$get_price[1][0]*100).'<br>';//디비전이 0일때 오류 수정필요
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : 모름<br>';//누락
echo '이미지 : <img src="http://www.koofun.co.kr'.$get_img[1][0].'"/><br>';


//키위1
$html = file_get_contents('http://www.qiwi.co.kr/coupon/details/22');
$html = preg_replace("/[\r\n\t]+/","", trim($html));
$html = preg_replace("/\s+/","", trim($html));
preg_match_all('/style=\"margin-bottom:4px;\"><\/img><imgalt="(.*)\"/U', $html, $get_nowcnt);
//preg_match_all('/encodeURIComponent\(\"(.*)\"/U', $html, $get_title);
preg_match_all('/<!--메인큰이미지--><divclass=\"mainImg\"style=\"\"><imgsrc=\"(.*)\"/U', $html, $get_img);
preg_match_all('/alt=\"정가\"\/><\/th><td><imgalt=\"(.*)\"/U', $html, $get_price);
preg_match_all('/alt=\"DC가격\"\/><\/th><td><imgalt=\"(.*)\"/U', $html, $get_sale_price);

echo '제목: 모름<br>';//누락
echo '할인율 : '.($get_sale_price[1][0]/$get_price[1][0]*100).'<br>';//디비전이 0일때 오류 수정필요
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : 모름<br>';//누락
echo '이미지 : <img src="http://www.qiwi.co.kr/'.$get_img[1][0].'"/><br>';


//키위2
$html = file_get_contents('http://www.qiwi.co.kr/coupon/details/18');
$html = preg_replace("/[\r\n\t]+/","", trim($html));
$html = preg_replace("/\s+/","", trim($html));
preg_match_all('/style=\"margin-bottom:4px;\"><\/img><imgalt="(.*)\"/U', $html, $get_nowcnt);
//preg_match_all('/encodeURIComponent\(\"(.*)\"/U', $html, $get_title);
preg_match_all('/<!--메인큰이미지--><divclass=\"mainImg\"style=\"\"><imgsrc=\"(.*)\"/U', $html, $get_img);
preg_match_all('/alt=\"정가\"\/><\/th><td><imgalt=\"(.*)\"/U', $html, $get_price);
preg_match_all('/alt=\"DC가격\"\/><\/th><td><imgalt=\"(.*)\"/U', $html, $get_sale_price);

echo '제목: 모름<br>';//누락
echo '할인율 : '.($get_sale_price[1][0]/$get_price[1][0]*100).'<br>';//디비전이 0일때 오류 수정필요
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : 모름<br>';//누락
echo '이미지 : <img src="http://www.qiwi.co.kr/'.$get_img[1][0].'"/><br>';

//파티윈
$html = file_get_contents('http://www.partywin.co.kr/new/');
$html = preg_replace("/[\r\n\t]+/","", trim($html));
$html = preg_replace("/\s+/","", trim($html));
$html = iconv('euckr', 'utf-8', urlutfchr($html));

preg_match_all('/<TDclass=\"no_t1_b\"><divalign=\"right\"><FONTCOLOR=\"black\"><B>(.*)<\/B>/U', $html, $get_nowcnt);
preg_match_all('/<FONTCOLOR=\"#0284CF\"><B>(.*)<\/B>/U', $html, $get_title);
preg_match_all('/<divalign=\"right\"><imgsrc=\"(.*)\"/U', $html, $get_img);
preg_match_all('/<TDwidth=\"65\"class=\"no_t1_b\"><divalign=\"right\"><B><s>(.*)<\/s>/U', $html, $get_price);
preg_match_all('/<TDclass=\"no_t1_b\"><divalign=\"right\"><FONTCOLOR=\"#0073A9\"><B>(.*)<\/B>/U', $html, $get_sale_price);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.($get_sale_price[1][0]/$get_price[1][0]*100).'<br>';//디비전이 0일때 오류 수정필요
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : 모름<br>';//누락
echo '이미지 : <img src="http://www.partywin.co.kr'.$get_img[1][0].'"/><br>';


//할인의 추억
$html = file_get_contents('http://www.couponmemory.com/index.php');
$html = preg_replace("/[\r\n\t]+/","", trim($html));
$html = preg_replace("/\s+/","", trim($html));
$html = iconv('euckr', 'utf-8', urlutfchr($html));
preg_match_all('/main.php\?id=(.*)\"/U', $html, $get_id);

$html = file_get_contents('http://www.couponmemory.com/main.php?id='.$get_id[1][0]);
$html = preg_replace("/[\r\n\t]+/","", trim($html));
$html = preg_replace("/\s+/","", trim($html));
$html = iconv('euckr', 'utf-8', urlutfchr($html));

preg_match_all('/&now=(.*)명/U', $html, $get_nowcnt);
preg_match_all('/javascript:share4_0\(\'(.*)\'/U', $html, $get_title);
preg_match_all('/<divalign=\"right\"><imgsrc=\"(.*)\"/U', $html, $get_img);
preg_match_all('/\?before=(.*)&/U', $html, $get_price);
preg_match_all('/&after=(.*)\"/U', $html, $get_sale_price);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.($get_sale_price[1][0]/$get_price[1][0]*100).'<br>';//디비전이 0일때 오류 수정필요
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '남은시간 : 모름<br>';//누락
echo '이미지 : <img src="http://www.couponmemory.com/cms/data/product/'.$get_id[1][0].'/1.jpg"/><br>';



//Kupon : 이미지는 파일명에 업체명이 들어가서 뽑아오기 불가능할듯..트위터에서 제목 뽑아올 수 있을듯..시간도 뽑을 수 있음..
$html_before = file_get_contents('http://www.kupon.co.kr/index.kupon?kuponNo=5');
$html = preg_replace("/[\r\n\t]+/","", trim($html_before));
$html = preg_replace("/\s+/","", trim($html));

preg_match_all('/\"description\" content=\"(.*)\"/U', $html_before, $get_title);
preg_match_all('/alt=\"현재\"\/><span>(.*)<\/span></U', $html, $get_nowcnt);
preg_match_all('/<pclass=\"rate\">(.*)%<\/p>/U', $html, $get_rate);
preg_match_all('/<pclass=\"normal\">￦(.*)<\/p>/U', $html, $get_price);
preg_match_all('/<pclass=\"discounted\">￦(.*)<\/p>/U', $html, $get_sale_price);
preg_match_all('/<linkrel=\"image_src\"href=\"(.*)\"/U', $html, $get_img);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.$get_rate[1][0].'<br>';
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '이미지 : <img src="'.$get_img[1][0].'"/><br>';


$html_before = file_get_contents('http://www.kupon.co.kr/index.kupon?kuponNo=6');
$html = preg_replace("/[\r\n\t]+/","", trim($html_before));
$html = preg_replace("/\s+/","", trim($html));

preg_match_all('/\"description\" content=\"(.*)\"/U', $html_before, $get_title);
preg_match_all('/alt=\"현재\"\/><span>(.*)<\/span></U', $html, $get_nowcnt);
preg_match_all('/<pclass=\"rate\">(.*)%<\/p>/U', $html, $get_rate);
preg_match_all('/<pclass=\"normal\">￦(.*)<\/p>/U', $html, $get_price);
preg_match_all('/<pclass=\"discounted\">￦(.*)<\/p>/U', $html, $get_sale_price);
preg_match_all('/<linkrel=\"image_src\"href=\"(.*)\"/U', $html, $get_img);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.$get_rate[1][0].'<br>';
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '이미지 : <img src="'.$get_img[1][0].'"/><br>';


$html_before = file_get_contents('http://www.kupon.co.kr/index.kupon?kuponNo=7');
$html = preg_replace("/[\r\n\t]+/","", trim($html_before));
$html = preg_replace("/\s+/","", trim($html));

preg_match_all('/\"description\" content=\"(.*)\"/U', $html_before, $get_title);
preg_match_all('/alt=\"현재\"\/><span>(.*)<\/span></U', $html, $get_nowcnt);
preg_match_all('/<pclass=\"rate\">(.*)%<\/p>/U', $html, $get_rate);
preg_match_all('/<pclass=\"normal\">￦(.*)<\/p>/U', $html, $get_price);
preg_match_all('/<pclass=\"discounted\">￦(.*)<\/p>/U', $html, $get_sale_price);
preg_match_all('/<linkrel=\"image_src\"href=\"(.*)\"/U', $html, $get_img);

echo '제목: '.$get_title[1][0].'<br>';
echo '할인율 : '.$get_rate[1][0].'<br>';
echo '원래가격 : '.$get_price[1][0].'<br>';
echo '현재가격 : '.$get_sale_price[1][0].'<br>';
echo '구입인원 : '.$get_nowcnt[1][0].'<br>';
echo '이미지 : <img src="'.$get_img[1][0].'"/><br>';
*/


function insertDBdata($what){
	$query = "INSERT INTO `C_datalist`(`c_name`, `c_url`, `c_title`, `c_ori_price`, `c_price`, `c_rate`, `c_img`, `c_people`, `c_time`, `c_comment`) 
				VALUES(
					'".$what."',
					'',
					'',
					,
					,
					,
					'',
					,
					'',
					'',
				);";
	$result = @mysql_query($query); 

	return $result;
}
?>