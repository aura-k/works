<!------------------------------------------------------------------------------
 FILE NAME : INIsecurepay.html
 AUTHOR : ts@inicis.com
 DATE : 2003/07
 USE WITH : INIsecurepay.asp
 
 이니페이 플러그인 128 V4를 이용, 지불을 요청한다.

                                                          http://www.inicis.com
                                                      http://support.inicis.com
                                 Copyright 2003 Inicis, Co. All rights reserved
------------------------------------------------------------------------------->
<?
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
$Unixtime = time();
$mid = "battlebana";
$oid="$cod"; /* 주문번호 */
$buyername="후후후후"; /* 주문자명 */
$goodname="테스트"; /* 상품명 */
$price=1000; /* 결제금액 */
$buyertel=$UserTel1;
$buyeremail=$UserEmail;
?>
<?
//$cod
//$cardmoney
//$userName
//$TOTAL_MONEY
//$UserTel1
//$UserEmail
//ECHO "\$cod=$cod
?>



<html>
<head>
<title>INIpay</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language=javascript src="http://plugin.inicis.com/pay40.js">
</script>

<script language=javascript>

var openwin;

// 플러그인 설치(확인)
StartSmartUpdate();

function pay(frm)
{
// MakePayMessage()를 호출함으로써 플러그인이 화면에 나타나며, Hidden Field에 값들이 채워지게 됩니다. 일반적인 경우, 플러그인은 통신을 하는 것이 아니라, Hidden Field의 값들을 채우고 종료한다는 사실에 유의하십시오.
	if(document.ini.clickcontrol.value == "enable")
	{
		if(document.INIpay == null || document.INIpay.object == null){
			alert("플러그인 설치 후 다시 시도 하십시오.");
			return false;
		}else{
/******* 플러그인이 참조하는 각종 지불옵션을 이곳에서 수행할 수 있습니다.* (자바스크립트를 이용한 동적 옵션처리)*/
// 50000원 미만은 할부불가
			if(parseInt(frm.price.value) < 50000) frm.quotabase.value = "일시불";
				
/****<작성예> 100000원 미만은 무이자할부가 불가능하도록 설정if(parseInt(frm.price.value) < 100000)frm.nointerest.value = "no"; ****/
			 
			if (MakePayMessage(frm)){
				disable_click();
				document.ini.submit();
				//openwin = window.open("childwin.html","childwin","width=300,height=160");
				
				return true;
			}else{alert("지불에 실패하였습니다.");
				return false;
			}
		}
	}else{return false;}
	
}


function enable_click()
{
	document.ini.clickcontrol.value = "enable"
}

function disable_click()
{
	document.ini.clickcontrol.value = "disable"
}

function focus_control()
{
	if(document.ini.clickcontrol.value == "disable")
		openwin.focus();
}
</script>	

</head>


<body onFocus="javascript:focus_control()"> 
<!--<body onload="javascript:enable_click()" onFocus="javascript:focus_control()"> -->
<script>window.resizeTo(389, 352);</script>

<!-- pay()가 "true"를 반환하면 post된다 -->
<form name=ini method=post action="INIsecurepay.php">
<!-- <form name=ini method=post action=INIsecurepay.php onSubmit="return pay(this)">  -->
<!-- 
이니페이 플러그인 128&trade;을 이용한 지불 샘플
이 페이지는 지불을 요청하는 페이지를 구성하기 위한 예시입니다. 귀사의 요구에 맞게 적절히 수정하여 사용하십시오. 반드시 플러그인의 설치를 완료한 후에 "지불"을 누르십시오. 플러그인은 자동으로 다운로드되어 설치됩니다. 다운로드에 다소 시간이 걸리는 수도 있으니 보안경고창이 나타날 때까지 잠시 기다려 주시기 바랍니다.플러그인은 지불 정보를 안전하게 암호화하는 역할 이외에는 어떠한 용도로도 사용되지 않습니다. 플러그인 설치가 되지 않는 경우에는 설치파일을 <a href="http://support.inicis.com/archive/INIpayplugin128_v41.exe"> 다운로드</a>하여 수동으로 설치하십시오. 수동 설치를 위해서는 브라우저를 닫아주셔야 합니다.지불" 버튼을 누르면 지불정보를 안전하게 암호화하기 위한 플러그인이 나타납니다. 플러그인에 필요정보를 모두 기입한 후, "확인" 버튼을 누르면 지불처리가 시작됩니다. 다소 시간이 걸릴 수도 있으니 결과가 표시될 때까지 "중지" 버튼을 누르지 마시고 잠시만 기다려 주십시오.
 -->
<br>

<input type = "hidden" name="gopaymethod" value="Card"><!-- 지불방법 : Card:신용카드,VCard:ISP서비스,DirectBank:실시간은행 계좌이체,OCBPoint:OK Cashbag Point,HPP:핸드폰,NEMO:네모 송금결제,VBank:무통장 입금 예약,ArsBill:700 전화결제,PhoneBill:폰빌 전화결제,1588Bill:1588 전화결제 -->	
<input type="hidden" name=goodname size=20 value="<?=$goodname?>"> <!-- 상품명 -->
<input type="hidden" name=price size=20 value="<?=$price?>"><!-- 가격 -->
<input type="hidden" name=buyername size=20 value="<?=$buyername?>"><!-- 성명 -->
<input type="hidden" name=buyeremail size=20 value="<?=$buyeremail?>"><!-- 전자우편 -->
<input type="hidden" name=buyertel size=20 value="<?=$buyertel?>"><!-- 이동전화 -->
<!-- 
	수취인 정보는 필수 필드는 아니지만 카드사에 정책에 따라 필수필드로 바뀔 수 있습니다.
	컨텐츠 업체는 수취인 관련 필드 해당없음
-->
<input type="hidden" name=recvname size=20 value=""><!-- 수취인성명 : 최대 30 byte 길이-->
<input type="hidden" name=recvtel size=20 value=""><!-- 수취인 전화번호 : 최대 30 byte 길이-->
<input type="hidden" name=recvaddr size=30 value=""><!-- 수취인 주소 : 최대 100 byte 길이-->
<input type="hidden" name=recvpostnum size=6 value=""><!-- 수취인 우편번호 :123-456"에서 "-" 삭제하여 입력-->
<!-- <input type="submit" value=" 지 불 " > -->

<!-- 전자우편과 이동전화번호를 입력받는 것은 귀하의 지불내역을 이메일 또는 SMS로 알려드리기 위함이오니 반드시 기입하여 주시기 바랍니다.  -->

<input type=hidden name=mid value="<?=$mid?>"><!-- 상점아이디 : 테스트 아이디 : VonnyCo123 -->
<input type=hidden name=currency value="WON"><!--화폐단위 WON 또는 CENT 주의 : 미화승인은 별도 계약이 필요합니다. -->
<input type=hidden name=nointerest value="no"><!-- 무이자 할부 이자로 할부를 제공 : yes 이자할부는 별도 계약이 필요합니다. 카드사별,할부개월수별 무이자할부 적용은 아래의 카드할부기간을 참조 하십시오. 무이자할부 옵션 적용은 반드시 매뉴얼을 참조하여 주십시오. -->
<input type=hidden name=quotabase value="일시불:3개월:4개월:5개월:6개월:7개월:8개월:9개월:10개월:11개월:12개월"><!-- 카드할부기간 각 카드사별로 지원하는 개월수가 다르므로 유의하시기 바랍니다. value의 마지막 부분에 카드사코드와 할부기간을 입력하면 해당 카드사의 해당 할부개월만 무이자할부로 처리됩니다 (매뉴얼 참조). -->


<!-- 기타설정 -->
<input type=hidden name=acceptmethod value="HPP(1):NEMO(1)"><!-- HPP : 컨텐츠 또는 실물 지불 여부에 따라 HPP(1)과 HPP(2)중 선택 적용(HPP(1):컨텐츠, HPP(2):실물). NEMO : 컨텐츠 또는 실물 지불 여부에 따라 NEMO(1)과 NEMO(2)중 선택 적용(NEMO(1):컨텐츠, NEMO(2):실물). -->
<input type=hidden name=INIregno size=13 value=""><!-- 주민번호 : 실시간 계좌이체 관련 필수필드로 반드시 로그인한 회원의 주민번호를  회원DB에서 추출하여 페이지에 추가해야 합니다. 고객이 직접 주민번호를 지불요청 페이지에 입력하는 경우 계좌도용 등의 사고 발생시 추적이 불가능하오니 반드시 회원DB에서 추출하여 페이지에 세팅하시기 바랍니다. 주민번호를 지불요청 페이지에 입력할 수 있도록 페이지를 수정하는 경우 도용사고 발생시 이니시스 책임이 없습니다 -->
<input type=hidden name=oid size=40 value="<?=$oid?>"><!-- 상점 주문번호 : 무통장입금 예약(가상계좌 이체),전화결재(1588 Bill) 관련 필수필드로 반드시 상점의 주문번호를 페이지에 추가해야 합니다. 지불수단 중에 실시간 계좌이체 이용 시에는 주문 번호가 지불결과를 조회하는 기준 필드가 됩니다. 상점 주문번호는 최대 40 BYTE 길이입니다. -->

<!-- 플러그인에 의해서 값이 채워지거나, 플러그인이 참조하는 필드들 삭제/수정 불가 -->
<input type=hidden name=quotainterest value="">
<input type=hidden name=paymethod value="">
<input type=hidden name=cardcode value="">
<input type=hidden name=cardquota value="">
<input type=hidden name=rbankcode value="">
<input type=hidden name=reqsign value="DONE">
<input type=hidden name=encrypted value="">
<input type=hidden name=sessionkey value="">
<input type=hidden name=uid value="">
<input type=hidden name=sid value="">
<input type=hidden name=version value=4000>
<input type=hidden name=clickcontrol value="">
<!-- <input type="submit" value=" 지 불 " > -->
</form>
<script>enable_click();</script>
<script>
pay(document.ini);
</script>
</body>
</html>
