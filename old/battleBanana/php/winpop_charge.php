<?
	include "checkLoged.php";
	extract($_POST);
/* INIsecurepaystart.php
 *
 * 이니페이 웹페이지 위변조 방지기능이 탑재된 결제요청페이지.
 * 코드에 대한 자세한 설명은 매뉴얼을 참조하십시오.
 * <주의> 구매자의 세션을 반드시 체크하도록하여 부정거래를 방지하여 주십시요.
 *
 * http://www.inicis.com
 * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
 */
    /**************************
     * 1. 라이브러리 인클루드 *
     **************************/
    require("../INIpay50/libs/INILib.php");

    /***************************************
     * 2. INIpay50 클래스의 인스턴스 생성  *
     ***************************************/
    $inipay = new INIpay50;

    /**************************
     * 3. 암호화 대상/값 설정 *
     **************************/
    $inipay->SetField("inipayhome", "/home/banana/public_html/INIpay50/");       // 이니페이 홈디렉터리(상점수정 필요)
    $inipay->SetField("type", "chkfake");      // 고정 (절대 수정 불가)
    $inipay->SetField("debug", "true");        // 로그모드("true"로 설정하면 상세로그가 생성됨.)
    $inipay->SetField("enctype","asym"); 			//asym:비대칭, symm:대칭(현재 asym으로 고정)
    /**************************************************************************************************
     * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
     * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
     * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
     * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
     **************************************************************************************************/
    $inipay->SetField("admin", "1111"); 				// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
    $inipay->SetField("checkopt", "false"); 		//base64함:false, base64안함:true(현재 false로 고정)

		//필수항목 : mid, price, nointerest, quotabase
		//추가가능 : INIregno, oid
		//*주의* : 	추가가능한 항목중 암호화 대상항목에 추가한 필드는 반드시 hidden 필드에선 제거하고 
		//          SESSION이나 DB를 이용해 다음페이지(INIsecureresult.php)로 전달/셋팅되어야 합니다.
    $inipay->SetField("mid", "battlebana");            // 상점아이디
    $inipay->SetField("price", $price);                // 가격
    $inipay->SetField("nointerest", "no");             //무이자여부(no:일반, yes:무이자)
    $inipay->SetField("quotabase", "선택:일시불:2개월:3개월:6개월");//할부기간

    /********************************
     * 4. 암호화 대상/값을 암호화함 *
     ********************************/
    $inipay->startAction();

    /*********************
     * 5. 암호화 결과  *
     *********************/
 		if( $inipay->GetResult("ResultCode") != "00" ) 
		{
			echo $inipay->GetResult("ResultMsg");
			exit(0);
		}
	
	if($goodtype == 'banana'){//결제가 바나나충전일때
		$i_goodname = iconv("UTF-8", "EUC-KR", $goodname)." (".$banana_sum."개)";
		$i_oid = "B_".mktime().rand(10,99);
		$i_buyertel = "01092899889";
		$ship_sid = "000000";
	}else{//결제가 일반 배송신청일때
		$i_goodname = iconv("UTF-8", "EUC-KR", $goodname);
		$i_oid = "I_".mktime().rand(10,99);
		$i_buyertel = $mobi1."-".$mobi2."-".$mobi3;
	}
    /*********************
     * 6. 세션정보 저장  *
     *********************/
		$HTTP_SESSION_VARS['INI_MID'] = "battlebana";	//상점ID
		$HTTP_SESSION_VARS['INI_ADMIN'] = "1111";			// 키패스워드(키발급시 생성, 상점관리자 패스워드와 상관없음)
		$HTTP_SESSION_VARS['INI_PRICE'] = $price;     //가격 
		$HTTP_SESSION_VARS['INI_RN'] = $inipay->GetResult("rn"); //고정 (절대 수정 불가)
		$HTTP_SESSION_VARS['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //고정 (절대 수정 불가)
		$HTTP_SESSION_VARS['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //고정 (절대 수정 불가)
		$HTTP_SESSION_VARS['MOID'] = $i_oid;
?>
<html>
<head>
<title>INIpay50 플러그인 체크페이지</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>
<link rel="stylesheet" href="css/group.css" type="text/css">
<style>
body, tr, td {font-size:9pt; font-family:굴림,verdana; color:#433F37; line-height:17px;}
table, img {border:none}

/* Padding ******/
.pl_01 {font-size:8pt; font-family:돋움; color:#4C4C4C; text-decoration:none; line-height:13px; padding:0 0 0 0;}
.pl_02 {font-size:8pt; font-family:돋움; color:#7C7C7C; text-decoration:none; line-height:13px; padding:0 0 0 0;}

/* Link ******/
.a:link  {font-size:9pt; color:#333333; text-decoration:none}
.a:visited { font-size:9pt; color:#333333; text-decoration:none}
.a:hover  {font-size:9pt; color:#0174CD; text-decoration:underline}

.txt_03a:link  {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:visited {font-size: 8pt;line-height:18px;color:#333333; text-decoration:none}
.txt_03a:hover  {font-size: 8pt;line-height:18px;color:#EC5900; text-decoration:underline}
</style>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#242424" leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bottommargin=0 rightmargin=0 onLoad='javascript:BeforePost(document.forms[0])'>
<center>
<!--FORM name=pay action=https://inilite.inicis.com/bin/new/inipay.cgi method=post-->
<FORM name=pay action="../INIpay50/php/INIbananaResult.php" method=post>


<div id=xpDiv style='visibility:hidden;position:absolute;left:10px;top:10px;z-index:100;'>
<table width="500" height="480" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
    <table width="482" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="461" valign="top" background="../img/ini/bg2.gif" >
          <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                    <td width="174"style="padding:0 0 0 15"><img src="../img/ini/time_02.gif" width="124" height="123"><br>
                  <img src="../img/ini/logo.gif" width="87" height="28" hspace="19"></td>
                    <td width="308" valign="top" style="padding:50 0 0 0"><img src="../img/ini/title_01.gif" width="287" height="22">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                          <td class="pl_02"  style="padding:0 0 10 0">고객님의 안전한
                            결제를 위하여 암호화 프로그램의 <br>
                            설치가 필요합니다. <br>
                        고객님의 컴퓨터 환경은 Window XP(SP2)으로서 <br>다음 단계에 따라 진행 하여 주십시오</td>
                    </tr>
                    <tr>
                      <td><img src="../img/ini/sp.jpg" width="250" height="200"></td>
                    </tr>
                    <tr>
                      <td class="pl_01"  style="padding:10 0 0 0"><b>암호화 모듈이 자동으로
                        설치되지 않는 경우</b><br>
                         1. <a href=http://plugin.inicis.com/repair/INIpayWizard.exe><b><font color=red>여기</font></b></a>를 눌러 INIpayWizard 프로그램을<br> &nbsp &nbsp다운로드합니다.<br>
                        2. 다운로드한 프로그램을 실행합니다.<br>
                        3. 결제를 다시 시도합니다.
                        </td>

                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
     </td>
  </tr>
</table>
</DIV>

<div id=vistaDiv style='visibility:hidden;position:absolute;left:10px;top:10px;z-index:100;'>
<table width="500" height="480" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
    <table width="482" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="461" valign="top" background="../img/ini/bg2.gif" >
          <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                    <td width="174"style="padding:0 0 0 15"><img src="../img/ini/time_02.gif" width="124" height="123"><br>
                  <img src="../img/ini/logo.gif" width="87" height="28" hspace="19"></td>
                    <td width="308" valign="top" style="padding:50 0 0 0"><img src="../img/ini/title_01.gif" width="287" height="22">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                          <td class="pl_02"  style="padding:0 0 10 0">고객님의 안전한
                            결제를 위하여 암호화 프로그램의 <br>
                            설치가 필요합니다. <br>
                        고객님의 컴퓨터 환경은 Windows Vista로서 <br>다음 단계에 따라 진행 하여 주십시오</td>
                    </tr>
                    <tr>
                      <td><img src="../img/ini/sp.jpg" width="250" height="200"></td>
                    </tr>
                    <tr>
                      <td class="pl_01"  style="padding:10 0 0 0"><b>암호화 모듈이 자동으로
                        설치되지 않는 경우</b><br>
                         1. <a href=http://plugin.inicis.com/repair/INIpayWizard.exe><b><font color=red>여기</font></b></a>를 눌러 INIpayWizard 프로그램을<br> &nbsp &nbsp다운로드합니다.<br>
                        2. 다운로드한 프로그램을 실행합니다.<br>
                        3. 결제를 다시 시도합니다.
                        </td>

                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
     </td>
  </tr>
</table>
</DIV>

<div id=pluginDiv style='visibility:hidden;position:absolute;left:10px;top:10px;z-index:100;'>
<table width="500" height="480" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="482" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="461" valign="top" background="../img/ini/bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="44%"style="padding:120 0 0 15"><img src="../img/ini/time_02.gif" width="124" height="123"><br>
                  <img src="../img/ini/logo.gif" width="87" height="28" hspace="19"></td>
                    <td width="56%" valign="top" style="padding:118 0 0 0">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="pl_02"  style="padding:0 0 10 0">이 작업은 단 한번만 진행되며, 암호화 프로그램 <br>
                        설치를 위해 고객의 통신 환경에 따라 약 5초에서 <br>
                        수분이 걸릴 수 도 있습니다.</td>
                    </tr>
                    <tr>
                      <td><img src="../img/ini/img_01.gif" width="239" height="60"></td>
                    </tr>
                    <tr>
                      <td class="pl_01" style="padding:10 0 0 0"><b>암호화 모듈이 자동으로  설치되지 않는 경우</b><br>
                        1. <a href=http://plugin.inicis.com/repair/INIpayWizard.exe><b><font color=red>여기</font></b></a>를 눌러 INIpayWizard 프로그램을<br> &nbsp &nbsp다운로드합니다.<br>
                        2. 다운로드한 프로그램을 실행합니다.<br>
                        3. 결제를 다시 시도합니다.
                        </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</DIV>

<div id=payingDiv style='visibility:hidden;position:absolute;left:10px;top:10px;z-index:100;'>
<table width="500" height="480" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
    <table width="482" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="461" valign="top" background="../img/ini/bg2.gif">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                                <td width="44%"style="padding:120 0 0 15">
                                        <img src="../img/ini/time_02.gif" width="124" height="123"><br>
                                        <img src="../img/ini/logo.gif" width="87" height="28" hspace="19">
                                </td>
                                <td width="56%" valign="top" style="padding:118 0 0 0">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                                <td  class="pl_02"  style="padding:0 0 10 0">
                                                <br>
                                                <br>
                                                <br>
                                                <b>현재 결제 처리 중입니다.</b><br>
                                                결제 진행은  위해 고객의 통신 환경에 따라 <br>약 5초에서
                                                30초 정도 걸릴 수 도 있습니다.<br>
                                                결제 결과 화면이 보일 때 까지 잠시 기다려 주세요.
                                                </td>

                                        </tr>


                                </table>
                                </td>
                        </tr>
            </table>
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</DIV>
</body>

<SCRIPT language=javascript src="https://plugin.inicis.com/pay40_sec_unissl.js"></SCRIPT>
<SCRIPT language=javascript>
StartSmartUpdate();
resizeTo(517,530); //현재 브라우져의 크기를 조정합니다.

function BeforePost(form) {
        var g_fIsSP2 = false;
        //g_fIsSP2 = (window.navigator.userAgent.indexOf("SV1") != -1);
        g_fIsSP2 = (window.navigator.appMinorVersion.indexOf("SP2") != -1);
        if (g_fIsSP2)
        {
                document.all.xpDiv.style.posLeft= 8;
                document.all.xpDiv.style.posTop = 8;
                document.all.xpDiv.style.visibility = "visible";
        }
        else if(navigator.userAgent.indexOf("Windows NT 6.0") != -1) <!-- Windows VISTA -->
        {
                document.all.vistaDiv.style.posLeft= 8;
                document.all.vistaDiv.style.posTop = 8;
                document.all.vistaDiv.style.visibility = "visible";
        }
        else
        {
                document.all.pluginDiv.style.posLeft= 8;
                document.all.pluginDiv.style.posTop = 8;
                document.all.pluginDiv.style.visibility = "visible";
        }

var ret;
        ret = MakePayMessage(form);
        if (ret == true){

                if (g_fIsSP2)
                {
                        document.all.xpDiv.style.visibility = "hidden";
                }
                else if(navigator.userAgent.indexOf("Windows NT 6.0") != -1) <!-- Windows VISTA -->
                {
                        document.all.vistaDiv.style.visibility = "hidden";
                }
                else
                {
                        document.all.pluginDiv.style.visibility = "hidden";
                }
                document.all.payingDiv.style.posLeft= 8;
                document.all.payingDiv.style.posTop = 8;
                document.all.payingDiv.style.visibility = "visible";
                document.forms[0].submit();
        }
        else{
                self.close();
        }
}
</SCRIPT>
<input type=hidden name=ini_encfield value="<? echo($inipay->GetResult("encfield")); ?>">
<input type=hidden name=ini_certid value="<? echo($inipay->GetResult("certid")); ?>">
<input type=hidden value="<?=$i_goodname?>" name=goodname>
<input type=hidden value="<?=iconv("UTF-8", "EUC-KR", $_SESSION["NAME"])?>" name=buyername>
<input type=hidden value="<?=$i_buyertel?>" name=buyertel>
<input type=hidden value="<?=$_SESSION["EMAIL"]?>" name=buyeremail>
<input type=hidden value="" name=gopaymethod>
<input type=hidden name=currency value="WON">
<input type=hidden name=acceptmethod size=20 value="SKIN(ORANGE):HPP(2):Card(0):OCB:receipt:cardpoint">
<input type=hidden name=oid size=40 value="<?=$i_oid?>">
<?//배틀바나나 개별 인풋?>
<input type=hidden name="ship_sid" value="<?=$ship_sid?>">
<input type=hidden name="banana_sum" value="<?=$banana_sum?>">
<input type=hidden name="banana_bonus_sum" value="<?=$banana_bonus_sum?>">
<input type=hidden name="deli_name" value="<?=iconv("UTF-8", "EUC-KR", $deli_name)?>">
<input type=hidden name="deli_add" value="<?=iconv("UTF-8", "EUC-KR", $deli_add)?>">
<input type=hidden name="comment" value="<?=iconv("UTF-8", "EUC-KR", $deli_comm)?>">
<input type=hidden name="win_comment" value="<?=iconv("UTF-8", "EUC-KR", $deli_win)?>">
<input type=hidden name="mobi1" value="<?=$mobi1?>">
<input type=hidden name="mobi2" value="<?=$mobi2?>">
<input type=hidden name="mobi3" value="<?=$mobi3?>">
<input type=hidden name="goodtype" value="<?=$goodtype?>">
<input type=hidden name="ship_type" value="<?=$ship_type?>">
<?//배틀바나나 개별 인풋?>
<input type=hidden name=version value=4000>
<input type=hidden name=quotainterest>
<input type=hidden name=paymethod>
<input type=hidden name=cardcode>
<input type=hidden name=cardquota>
<input type=hidden name=rbankcode>
<input type=hidden name=reqsign value=DONE>
<input type=hidden name=encrypted>
<input type=hidden name=sessionkey>
<input type=hidden name=uid>
<input type=hidden name=sid>
</form>
</body>
</html>