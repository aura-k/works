<!------------------------------------------------------------------------------
 FILE NAME : INIsecurepay.html
 AUTHOR : ts@inicis.com
 DATE : 2003/07
 USE WITH : INIsecurepay.asp
 
 �̴����� �÷����� 128 V4�� �̿�, ������ ��û�Ѵ�.

                                                          http://www.inicis.com
                                                      http://support.inicis.com
                                 Copyright 2003 Inicis, Co. All rights reserved
------------------------------------------------------------------------------->
<?
include "../../../config/admin_info.php";
include "../../../config/cart_info.php";
$Unixtime = time();
$mid = "battlebana";
$oid="$cod"; /* �ֹ���ȣ */
$buyername="��������"; /* �ֹ��ڸ� */
$goodname="�׽�Ʈ"; /* ��ǰ�� */
$price=1000; /* �����ݾ� */
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

// �÷����� ��ġ(Ȯ��)
StartSmartUpdate();

function pay(frm)
{
// MakePayMessage()�� ȣ�������ν� �÷������� ȭ�鿡 ��Ÿ����, Hidden Field�� ������ ä������ �˴ϴ�. �Ϲ����� ���, �÷������� ����� �ϴ� ���� �ƴ϶�, Hidden Field�� ������ ä��� �����Ѵٴ� ��ǿ� �����Ͻʽÿ�.
	if(document.ini.clickcontrol.value == "enable")
	{
		if(document.INIpay == null || document.INIpay.object == null){
			alert("�÷����� ��ġ �� �ٽ� �õ� �Ͻʽÿ�.");
			return false;
		}else{
/******* �÷������� �����ϴ� ���� ���ҿɼ��� �̰����� ������ �� �ֽ��ϴ�.* (�ڹٽ�ũ��Ʈ�� �̿��� ���� �ɼ�ó��)*/
// 50000�� �̸��� �ҺκҰ�
			if(parseInt(frm.price.value) < 50000) frm.quotabase.value = "�Ͻú�";
				
/****<�ۼ���> 100000�� �̸��� �������Һΰ� �Ұ����ϵ��� ����if(parseInt(frm.price.value) < 100000)frm.nointerest.value = "no"; ****/
			 
			if (MakePayMessage(frm)){
				disable_click();
				document.ini.submit();
				//openwin = window.open("childwin.html","childwin","width=300,height=160");
				
				return true;
			}else{alert("���ҿ� �����Ͽ����ϴ�.");
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

<!-- pay()�� "true"�� ��ȯ�ϸ� post�ȴ� -->
<form name=ini method=post action="INIsecurepay.php">
<!-- <form name=ini method=post action=INIsecurepay.php onSubmit="return pay(this)">  -->
<!-- 
�̴����� �÷����� 128&trade;�� �̿��� ���� ����
�� �������� ������ ��û�ϴ� �������� �����ϱ� ���� �����Դϴ�. �ͻ��� �䱸�� �°� ������ �����Ͽ� ����Ͻʽÿ�. �ݵ�� �÷������� ��ġ�� �Ϸ��� �Ŀ� "����"�� �����ʽÿ�. �÷������� �ڵ����� �ٿ�ε�Ǿ� ��ġ�˴ϴ�. �ٿ�ε忡 �ټ� �ð��� �ɸ��� ���� ������ ���Ȱ��â�� ��Ÿ�� ������ ��� ��ٷ� �ֽñ� �ٶ��ϴ�.�÷������� ���� ������ �����ϰ� ��ȣȭ�ϴ� ���� �̿ܿ��� ��� �뵵�ε� ������ �ʽ��ϴ�. �÷����� ��ġ�� ���� �ʴ� ��쿡�� ��ġ������ <a href="http://support.inicis.com/archive/INIpayplugin128_v41.exe"> �ٿ�ε�</a>�Ͽ� �������� ��ġ�Ͻʽÿ�. ���� ��ġ�� ���ؼ��� �������� �ݾ��ּž� �մϴ�.����" ��ư�� ������ ���������� �����ϰ� ��ȣȭ�ϱ� ���� �÷������� ��Ÿ���ϴ�. �÷����ο� �ʿ������� ��� ������ ��, "Ȯ��" ��ư�� ������ ����ó���� ���۵˴ϴ�. �ټ� �ð��� �ɸ� ���� ������ ����� ǥ�õ� ������ "����" ��ư�� ������ ���ð� ��ø� ��ٷ� �ֽʽÿ�.
 -->
<br>

<input type = "hidden" name="gopaymethod" value="Card"><!-- ���ҹ�� : Card:�ſ�ī��,VCard:ISP����,DirectBank:�ǽð����� ������ü,OCBPoint:OK Cashbag Point,HPP:�ڵ���,NEMO:�׸� �۱ݰ���,VBank:������ �Ա� ����,ArsBill:700 ��ȭ����,PhoneBill:���� ��ȭ����,1588Bill:1588 ��ȭ���� -->	
<input type="hidden" name=goodname size=20 value="<?=$goodname?>"> <!-- ��ǰ�� -->
<input type="hidden" name=price size=20 value="<?=$price?>"><!-- ���� -->
<input type="hidden" name=buyername size=20 value="<?=$buyername?>"><!-- ���� -->
<input type="hidden" name=buyeremail size=20 value="<?=$buyeremail?>"><!-- ���ڿ��� -->
<input type="hidden" name=buyertel size=20 value="<?=$buyertel?>"><!-- �̵���ȭ -->
<!-- 
	������ ������ �ʼ� �ʵ�� �ƴ����� ī��翡 ��å�� ���� �ʼ��ʵ�� �ٲ� �� �ֽ��ϴ�.
	������ ��ü�� ������ ���� �ʵ� �ش����
-->
<input type="hidden" name=recvname size=20 value=""><!-- �����μ��� : �ִ� 30 byte ����-->
<input type="hidden" name=recvtel size=20 value=""><!-- ������ ��ȭ��ȣ : �ִ� 30 byte ����-->
<input type="hidden" name=recvaddr size=30 value=""><!-- ������ �ּ� : �ִ� 100 byte ����-->
<input type="hidden" name=recvpostnum size=6 value=""><!-- ������ �����ȣ :123-456"���� "-" �����Ͽ� �Է�-->
<!-- <input type="submit" value=" �� �� " > -->

<!-- ���ڿ���� �̵���ȭ��ȣ�� �Է¹޴� ���� ������ ���ҳ����� �̸��� �Ǵ� SMS�� �˷��帮�� �����̿��� �ݵ�� �����Ͽ� �ֽñ� �ٶ��ϴ�.  -->

<input type=hidden name=mid value="<?=$mid?>"><!-- �������̵� : �׽�Ʈ ���̵� : VonnyCo123 -->
<input type=hidden name=currency value="WON"><!--ȭ����� WON �Ǵ� CENT ���� : ��ȭ������ ���� ����� �ʿ��մϴ�. -->
<input type=hidden name=nointerest value="no"><!-- ������ �Һ� ���ڷ� �Һθ� ���� : yes �����Һδ� ���� ����� �ʿ��մϴ�. ī��纰,�Һΰ������� �������Һ� ������ �Ʒ��� ī���ҺαⰣ�� ���� �Ͻʽÿ�. �������Һ� �ɼ� ������ �ݵ�� �Ŵ����� �����Ͽ� �ֽʽÿ�. -->
<input type=hidden name=quotabase value="�Ͻú�:3����:4����:5����:6����:7����:8����:9����:10����:11����:12����"><!-- ī���ҺαⰣ �� ī��纰�� �����ϴ� �������� �ٸ��Ƿ� �����Ͻñ� �ٶ��ϴ�. value�� ������ �κп� ī����ڵ�� �ҺαⰣ�� �Է��ϸ� �ش� ī����� �ش� �Һΰ����� �������Һη� ó���˴ϴ� (�Ŵ��� ����). -->


<!-- ��Ÿ���� -->
<input type=hidden name=acceptmethod value="HPP(1):NEMO(1)"><!-- HPP : ������ �Ǵ� �ǹ� ���� ���ο� ���� HPP(1)�� HPP(2)�� ���� ����(HPP(1):������, HPP(2):�ǹ�). NEMO : ������ �Ǵ� �ǹ� ���� ���ο� ���� NEMO(1)�� NEMO(2)�� ���� ����(NEMO(1):������, NEMO(2):�ǹ�). -->
<input type=hidden name=INIregno size=13 value=""><!-- �ֹι�ȣ : �ǽð� ������ü ���� �ʼ��ʵ�� �ݵ�� �α����� ȸ���� �ֹι�ȣ��  ȸ��DB���� �����Ͽ� �������� �߰��ؾ� �մϴ�. ���� ���� �ֹι�ȣ�� ���ҿ�û �������� �Է��ϴ� ��� ���µ��� ���� ��� �߻��� ������ �Ұ����Ͽ��� �ݵ�� ȸ��DB���� �����Ͽ� �������� �����Ͻñ� �ٶ��ϴ�. �ֹι�ȣ�� ���ҿ�û �������� �Է��� �� �ֵ��� �������� �����ϴ� ��� ������ �߻��� �̴Ͻý� å���� �����ϴ� -->
<input type=hidden name=oid size=40 value="<?=$oid?>"><!-- ���� �ֹ���ȣ : �������Ա� ����(������� ��ü),��ȭ����(1588 Bill) ���� �ʼ��ʵ�� �ݵ�� ������ �ֹ���ȣ�� �������� �߰��ؾ� �մϴ�. ���Ҽ��� �߿� �ǽð� ������ü �̿� �ÿ��� �ֹ� ��ȣ�� ���Ұ���� ��ȸ�ϴ� ���� �ʵ尡 �˴ϴ�. ���� �ֹ���ȣ�� �ִ� 40 BYTE �����Դϴ�. -->

<!-- �÷����ο� ���ؼ� ���� ä�����ų�, �÷������� �����ϴ� �ʵ�� ����/���� �Ұ� -->
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
<!-- <input type="submit" value=" �� �� " > -->
</form>
<script>enable_click();</script>
<script>
pay(document.ini);
</script>
</body>
</html>
