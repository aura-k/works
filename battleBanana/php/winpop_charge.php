<?
	include "checkLoged.php";
	extract($_POST);
/* INIsecurepaystart.php
 *
 * �̴����� �������� ������ ��������� ž��� ������û������.
 * �ڵ忡 ���� �ڼ��� ������ �Ŵ����� �����Ͻʽÿ�.
 * <����> �������� ������ �ݵ�� üũ�ϵ����Ͽ� �����ŷ��� �����Ͽ� �ֽʽÿ�.
 *
 * http://www.inicis.com
 * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
 */
    /**************************
     * 1. ���̺귯�� ��Ŭ��� *
     **************************/
    require("../INIpay50/libs/INILib.php");

    /***************************************
     * 2. INIpay50 Ŭ������ �ν��Ͻ� ����  *
     ***************************************/
    $inipay = new INIpay50;

    /**************************
     * 3. ��ȣȭ ���/�� ���� *
     **************************/
    $inipay->SetField("inipayhome", "/home/banana/public_html/INIpay50/");       // �̴����� Ȩ���͸�(�������� �ʿ�)
    $inipay->SetField("type", "chkfake");      // ���� (���� ���� �Ұ�)
    $inipay->SetField("debug", "true");        // �α׸��("true"�� �����ϸ� �󼼷αװ� ������.)
    $inipay->SetField("enctype","asym"); 			//asym:���Ī, symm:��Ī(���� asym���� ����)
    /**************************************************************************************************
     * admin �� Ű�н����� �������Դϴ�. �����Ͻø� �ȵ˴ϴ�. 1111�� �κи� �����ؼ� ����Ͻñ� �ٶ��ϴ�.
     * Ű�н������ ���������� ������(https://iniweb.inicis.com)�� ��й�ȣ�� �ƴմϴ�. ������ �ֽñ� �ٶ��ϴ�.
     * Ű�н������ ���� 4�ڸ��θ� �����˴ϴ�. �� ���� Ű���� �߱޽� �����˴ϴ�.
     * Ű�н����� ���� Ȯ���Ͻ÷��� �������� �߱޵� Ű���� ���� readme.txt ������ ������ �ֽʽÿ�.
     **************************************************************************************************/
    $inipay->SetField("admin", "1111"); 				// Ű�н�����(Ű�߱޽� ����, ���������� �н������ �������)
    $inipay->SetField("checkopt", "false"); 		//base64��:false, base64����:true(���� false�� ����)

		//�ʼ��׸� : mid, price, nointerest, quotabase
		//�߰����� : INIregno, oid
		//*����* : 	�߰������� �׸��� ��ȣȭ ����׸� �߰��� �ʵ�� �ݵ�� hidden �ʵ忡�� �����ϰ� 
		//          SESSION�̳� DB�� �̿��� ����������(INIsecureresult.php)�� ����/���õǾ�� �մϴ�.
    $inipay->SetField("mid", "battlebana");            // �������̵�
    $inipay->SetField("price", $price);                // ����
    $inipay->SetField("nointerest", "no");             //�����ڿ���(no:�Ϲ�, yes:������)
    $inipay->SetField("quotabase", "����:�Ͻú�:2����:3����:6����");//�ҺαⰣ

    /********************************
     * 4. ��ȣȭ ���/���� ��ȣȭ�� *
     ********************************/
    $inipay->startAction();

    /*********************
     * 5. ��ȣȭ ���  *
     *********************/
 		if( $inipay->GetResult("ResultCode") != "00" ) 
		{
			echo $inipay->GetResult("ResultMsg");
			exit(0);
		}
	
	if($goodtype == 'banana'){//������ �ٳ��������϶�
		$i_goodname = iconv("UTF-8", "EUC-KR", $goodname)." (".$banana_sum."��)";
		$i_oid = "B_".mktime().rand(10,99);
		$i_buyertel = "01092899889";
		$ship_sid = "000000";
	}else{//������ �Ϲ� ��۽�û�϶�
		$i_goodname = iconv("UTF-8", "EUC-KR", $goodname);
		$i_oid = "I_".mktime().rand(10,99);
		$i_buyertel = $mobi1."-".$mobi2."-".$mobi3;
	}
    /*********************
     * 6. �������� ����  *
     *********************/
		$HTTP_SESSION_VARS['INI_MID'] = "battlebana";	//����ID
		$HTTP_SESSION_VARS['INI_ADMIN'] = "1111";			// Ű�н�����(Ű�߱޽� ����, ���������� �н������ �������)
		$HTTP_SESSION_VARS['INI_PRICE'] = $price;     //���� 
		$HTTP_SESSION_VARS['INI_RN'] = $inipay->GetResult("rn"); //���� (���� ���� �Ұ�)
		$HTTP_SESSION_VARS['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //���� (���� ���� �Ұ�)
		$HTTP_SESSION_VARS['INI_ENCTYPE'] = $inipay->GetResult("enctype"); //���� (���� ���� �Ұ�)
		$HTTP_SESSION_VARS['MOID'] = $i_oid;
?>
<html>
<head>
<title>INIpay50 �÷����� üũ������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>
<link rel="stylesheet" href="css/group.css" type="text/css">
<style>
body, tr, td {font-size:9pt; font-family:����,verdana; color:#433F37; line-height:17px;}
table, img {border:none}

/* Padding ******/
.pl_01 {font-size:8pt; font-family:����; color:#4C4C4C; text-decoration:none; line-height:13px; padding:0 0 0 0;}
.pl_02 {font-size:8pt; font-family:����; color:#7C7C7C; text-decoration:none; line-height:13px; padding:0 0 0 0;}

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
                          <td class="pl_02"  style="padding:0 0 10 0">������ ������
                            ������ ���Ͽ� ��ȣȭ ���α׷��� <br>
                            ��ġ�� �ʿ��մϴ�. <br>
                        ������ ��ǻ�� ȯ���� Window XP(SP2)���μ� <br>���� �ܰ迡 ���� ���� �Ͽ� �ֽʽÿ�</td>
                    </tr>
                    <tr>
                      <td><img src="../img/ini/sp.jpg" width="250" height="200"></td>
                    </tr>
                    <tr>
                      <td class="pl_01"  style="padding:10 0 0 0"><b>��ȣȭ ����� �ڵ�����
                        ��ġ���� �ʴ� ���</b><br>
                         1. <a href=http://plugin.inicis.com/repair/INIpayWizard.exe><b><font color=red>����</font></b></a>�� ���� INIpayWizard ���α׷���<br> &nbsp &nbsp�ٿ�ε��մϴ�.<br>
                        2. �ٿ�ε��� ���α׷��� �����մϴ�.<br>
                        3. ������ �ٽ� �õ��մϴ�.
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
                          <td class="pl_02"  style="padding:0 0 10 0">������ ������
                            ������ ���Ͽ� ��ȣȭ ���α׷��� <br>
                            ��ġ�� �ʿ��մϴ�. <br>
                        ������ ��ǻ�� ȯ���� Windows Vista�μ� <br>���� �ܰ迡 ���� ���� �Ͽ� �ֽʽÿ�</td>
                    </tr>
                    <tr>
                      <td><img src="../img/ini/sp.jpg" width="250" height="200"></td>
                    </tr>
                    <tr>
                      <td class="pl_01"  style="padding:10 0 0 0"><b>��ȣȭ ����� �ڵ�����
                        ��ġ���� �ʴ� ���</b><br>
                         1. <a href=http://plugin.inicis.com/repair/INIpayWizard.exe><b><font color=red>����</font></b></a>�� ���� INIpayWizard ���α׷���<br> &nbsp &nbsp�ٿ�ε��մϴ�.<br>
                        2. �ٿ�ε��� ���α׷��� �����մϴ�.<br>
                        3. ������ �ٽ� �õ��մϴ�.
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
                      <td class="pl_02"  style="padding:0 0 10 0">�� �۾��� �� �ѹ��� ����Ǹ�, ��ȣȭ ���α׷� <br>
                        ��ġ�� ���� ���� ��� ȯ�濡 ���� �� 5�ʿ��� <br>
                        ������ �ɸ� �� �� �ֽ��ϴ�.</td>
                    </tr>
                    <tr>
                      <td><img src="../img/ini/img_01.gif" width="239" height="60"></td>
                    </tr>
                    <tr>
                      <td class="pl_01" style="padding:10 0 0 0"><b>��ȣȭ ����� �ڵ�����  ��ġ���� �ʴ� ���</b><br>
                        1. <a href=http://plugin.inicis.com/repair/INIpayWizard.exe><b><font color=red>����</font></b></a>�� ���� INIpayWizard ���α׷���<br> &nbsp &nbsp�ٿ�ε��մϴ�.<br>
                        2. �ٿ�ε��� ���α׷��� �����մϴ�.<br>
                        3. ������ �ٽ� �õ��մϴ�.
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
                                                <b>���� ���� ó�� ���Դϴ�.</b><br>
                                                ���� ������  ���� ���� ��� ȯ�濡 ���� <br>�� 5�ʿ���
                                                30�� ���� �ɸ� �� �� �ֽ��ϴ�.<br>
                                                ���� ��� ȭ���� ���� �� ���� ��� ��ٷ� �ּ���.
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
resizeTo(517,530); //���� �������� ũ�⸦ �����մϴ�.

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
<?//��Ʋ�ٳ��� ���� ��ǲ?>
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
<?//��Ʋ�ٳ��� ���� ��ǲ?>
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