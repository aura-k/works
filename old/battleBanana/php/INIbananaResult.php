<?php
/* INIsecurepay.php
 *
 * �̴����� �÷������� ���� ��û�� ������ ó���Ѵ�.
 * ���� ��û�� ó���Ѵ�.
 * �ڵ忡 ���� �ڼ��� ������ �Ŵ����� �����Ͻʽÿ�.
 * <����> �������� ������ �ݵ�� üũ�ϵ����Ͽ� �����ŷ��� �����Ͽ� �ֽʽÿ�.
 *  
 * http://www.inicis.com
 * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
 */
include "../../php/connect.php"; //��� ���� ������ 
  /****************************
   * 0. ���� ����             *
   ****************************/
  session_start();								//����:���� �ֻ�ܿ� ��ġ�����ּ���!!

	/**************************
	 * 1. ���̺귯�� ��Ŭ��� *
	 **************************/
	require("../libs/INILib.php");
	
	
	/***************************************
	 * 2. INIpay50 Ŭ������ �ν��Ͻ� ���� *
	 ***************************************/
	$inipay = new INIpay50;

	/*********************
	 * 3. ���� ���� ���� *
	 *********************/
	$inipay->SetField("inipayhome", "/home/banana/public_html/INIpay50/"); // �̴����� Ȩ���͸�(�������� �ʿ�)
	$inipay->SetField("type", "securepay");                         // ���� (���� ���� �Ұ�)
	$inipay->SetField("pgid", "INIphp".$pgid);                      // ���� (���� ���� �Ұ�)
	$inipay->SetField("subpgip","203.238.3.10");                    // ���� (���� ���� �Ұ�)
	$inipay->SetField("admin", $HTTP_SESSION_VARS['INI_ADMIN']);    // Ű�н�����(�������̵� ���� ����)
	$inipay->SetField("debug", "true");                             // �α׸��("true"�� �����ϸ� �󼼷αװ� ������.)
	$inipay->SetField("uid", $uid);                                 // INIpay User ID (���� ���� �Ұ�)
  $inipay->SetField("goodname", $goodname);                       // ��ǰ�� 
	$inipay->SetField("currency", $currency);                       // ȭ�����

	$inipay->SetField("mid", $HTTP_SESSION_VARS['INI_MID']);        // �������̵�
	$inipay->SetField("rn", $HTTP_SESSION_VARS['INI_RN']);          // �������� �������� RN��
	$inipay->SetField("price", $HTTP_SESSION_VARS['INI_PRICE']);		// ����
	$inipay->SetField("enctype", $HTTP_SESSION_VARS['INI_ENCTYPE']);// ���� (���� ���� �Ұ�)


     /*----------------------------------------------------------------------------------------
       price ���� �߿䵥���ʹ�
       ���������� ���������θ� �ݵ�� Ȯ���ϼž� �մϴ�.

       ���� ��û���������� ��û�� �ݾװ�
       ���� ������ �̷���� �ݾ��� �ݵ�� ���Ͽ� ó���Ͻʽÿ�.

       ��ġ �޴��� 2���� ���� ó�������� �ۼ��κ��� ���Ȱ�� �κ��� Ȯ���Ͻñ� �ٶ��ϴ�.
       ������������: �̴Ͻý�Ȩ������->��������������ڷ��->��Ÿ�ڷ�� ��
                      '���� ó�� ������ �� ���� �ݾ� ���� ������ ���� üũ' ������ �����Ͻñ� �ٶ��ϴ�.
       ����)
       �� ��ǰ ���� ������ OriginalPrice �ϰ�  �� ���� ������ �����ϴ� �Լ��� Return_OrgPrice()�� �����ϸ�
       ���� ���� �����Ͽ� �����ݰ� ������������ Post�Ǿ� �Ѿ�� ������ �� �Ѵ�.

		$OriginalPrice = Return_OrgPrice();
		$PostPrice = $HTTP_SESSION_VARS['INI_PRICE']; 
		if ( $OriginalPrice != $PostPrice )
		{
			//���� ������ �ߴ��ϰ�  �ݾ� ���� ���ɼ��� ���� �޽��� ��� ó��
			//ó�� ���� 
		}

      ----------------------------------------------------------------------------------------*/
	$inipay->SetField("buyername", $buyername);       // ������ ��
	$inipay->SetField("buyertel",  $buyertel);        // ������ ����ó(�޴��� ��ȣ �Ǵ� ������ȭ��ȣ)
	$inipay->SetField("buyeremail",$buyeremail);      // ������ �̸��� �ּ�
	$inipay->SetField("paymethod", $paymethod);       // ���ҹ�� (���� ���� �Ұ�)
	$inipay->SetField("encrypted", $encrypted);       // ��ȣ��
	$inipay->SetField("sessionkey",$sessionkey);      // ��ȣ��
	$inipay->SetField("url", "http://www.battlebanana.com"); // ���� ���񽺵Ǵ� ���� SITE URL�� �����Ұ�
	$inipay->SetField("cardcode", $cardcode);         // ī���ڵ� ����
	$inipay->SetField("parentemail", $parentemail);   // ��ȣ�� �̸��� �ּ�(�ڵ��� , ��ȭ�����ÿ� 14�� �̸��� ���� �����ϸ�  �θ� �̸��Ϸ� ���� �����뺸 �ǹ�, �ٸ����� ���� ���ÿ� ���� ����)
	
	/*-----------------------------------------------------------------*
	 * ������ ���� *                                                   *
	 *-----------------------------------------------------------------*
	 * �ǹ������ �ϴ� ������ ��쿡 ���Ǵ� �ʵ���̸�               *
	 * �Ʒ��� ������ INIsecurepay.html ���������� ����Ʈ �ǵ���        *
	 * �ʵ带 ����� �ֵ��� �Ͻʽÿ�.                                  *
	 * ������ ������ü�� ��� �����ϼŵ� �����մϴ�.                   *
	 *-----------------------------------------------------------------*/
	$inipay->SetField("recvname",$recvname);	// ������ ��
	$inipay->SetField("recvtel",$recvtel);		// ������ ����ó
	$inipay->SetField("recvaddr",$recvaddr);	// ������ �ּ�
	$inipay->SetField("recvpostnum",$recvpostnum);  // ������ �����ȣ
	$inipay->SetField("recvmsg",$recvmsg);		// ���� �޼���

  $inipay->SetField("joincard",$joincard);  // ����ī���ڵ�
  $inipay->SetField("joinexpire",$joinexpire);    // ����ī����ȿ�Ⱓ
  $inipay->SetField("id_customer",$id_customer);    //user_id

	
	/****************
	 * 4. ���� ��û *
	 ****************/
	$inipay->startAction();
	
	
	$sprit_date = $inipay->GetResult('VACT_Date');
	$bank_code = $inipay->GetResult('VACT_BankCode');

	switch($bank_code){
		case "03": $get_bank_code = "�������";
			break;
		case "04": $get_bank_code = "��������";
			break;
		case "05": $get_bank_code = "��ȯ����";
			break;
		case "07": $get_bank_code = "����";
			break;
		case "11": $get_bank_code = "����";
			break;
		case "20": $get_bank_code = "�츮����";
			break;
		case "23": $get_bank_code = "SC ����";
			break;
		case "31": $get_bank_code = "�뱸����";
			break;
		case "32": $get_bank_code = "�λ�����";
			break;
		case "34": $get_bank_code = "��������";
			break;
		case "37": $get_bank_code = "��������";
			break;
		case "39": $get_bank_code = "�泲����";
			break;
		case "53": $get_bank_code = "��Ƽ����";
			break;
		case "71": $get_bank_code = "��ü��";
			break;
		case "81": $get_bank_code = "�ϳ�����";
			break;
		case "88": $get_bank_code = "����(����)";
			break;
	}
	/****************
	 * 5. DB  ����  *
	 ****************/
	$result = @mysql_query('SET AUTOCOMMIT=0'); //Ʈ�����ǽ���
	$result = @mysql_query('BEGIN');
	$cancelFlag = "false";

	/*$sql = mysql_query("SELECT * FROM  `BBanana_ships` ORDER BY no DESC LIMIT 0 , 1") or die(mysql_error()); 
	$row = mysql_fetch_array($sql);
	$last_order_num = $row['no'];*/

	if($inipay->GetResult('ResultCode') == "00" && $inipay->GetResult('PayMethod') == "VBank"){//���������� �������Ա��ϰ��
		//�ش系���� DB������ ������ �ٳ��� �ݿ��� ���� �ʴ´�.
		if($goodname){//�ߺ��� �ֹ����� ã�� �ֹ����� �������� DB�� ����
			$sql = mysql_query("
				INSERT INTO `BBanana_ships`(
					`order_num`, `item_fname`, `item_id`, `user_id`, `charged_banana`, `address`, `phone_num1`, `phone_num2`, `phone_num3`, `comment`, `item_price`, `ship_name`, `ship_created`, `ship_type`, `ship_status`, `pay_method`, `invoice_no`, `bankInfo`, `is_deposit`
				) VALUES(
					'".$inipay->GetResult('MOID')."',
					'".iconv("EUC-KR", "UTF-8", $goodname)."',
					'".$ship_sid."',
					'".$_SESSION['ID']."',
					'".($banana_sum+$banana_bonus_sum)."',
					'".iconv("EUC-KR", "UTF-8", $deli_add)."',
					'".$mobi1."',
					'".$mobi2."',
					'".$mobi3."',
					'".iconv("EUC-KR", "UTF-8", $comment)."',
					'".trim($inipay->GetResult('TotPrice'))."',
					'".iconv("EUC-KR", "UTF-8", $deli_name)."',
					'".mktime()."',
					'".$ship_type."',
					'00',
					'".$inipay->GetResult('PayMethod')."',
					'".$inipay->GetResult('TID')."',
					'".iconv("EUC-KR", "UTF-8", $get_bank_code." ".$inipay->GetResult('VACT_Num')." (������: ".$inipay->GetResult('VACT_Name').") | �����ұݾ�: ".number_format(trim($inipay->GetResult('TotPrice')))."�� | ����������: ".$inipay->GetResult('VACT_InputName'))."',
					'no'
				);"); 
			if(!$sql || @mysql_affected_rows() == 0) $cancelFlag = "true";
			
			if($cancelFlag == "true"){
				$result = @mysql_query("ROLLBACK");//�ϳ��� ������ ���� �ִٸ� RollBack�Ѵ�.
			}else{
				$result = @mysql_query("COMMIT");//��� �����ϸ� Commit.
			}
		}
	}else if($inipay->GetResult('ResultCode') == "00"){//�Ϲ����� ��������
		//�ش系���� DB����� �ٷ� �ٳ��� �ݿ��� ���ش�.
		if($goodname){//�ߺ��� �ֹ����� ã�� �ֹ����� �������� DB�� ����
			$sql = mysql_query("
				INSERT INTO `BBanana_ships`(
					`order_num`, `item_fname`, `item_id`, `user_id`, `charged_banana`, `address`, `phone_num1`, `phone_num2`, `phone_num3`, `comment`, `item_price`, `ship_name`, `ship_created`, `ship_type`, `ship_status`, `pay_method`, `invoice_no`, `is_deposit`
				) VALUES(
					'".$inipay->GetResult('MOID')."',
					'".iconv("EUC-KR", "UTF-8", $goodname)."',
					'".$ship_sid."',
					'".$_SESSION['ID']."',
					'".($banana_sum+$banana_bonus_sum)."',
					'".iconv("EUC-KR", "UTF-8", $deli_add)."',
					'".$mobi1."',
					'".$mobi2."',
					'".$mobi3."',
					'".iconv("EUC-KR", "UTF-8", $comment)."',
					'".trim($inipay->GetResult('TotPrice'))."',
					'".iconv("EUC-KR", "UTF-8", $deli_name)."',
					'".mktime()."',
					'".$ship_type."',
					'00',
					'".$inipay->GetResult('PayMethod')."',
					'".$inipay->GetResult('TID')."',
					'yes'
				);"); 
			if(!$sql || @mysql_affected_rows() == 0) $cancelFlag = "true";
			
			if($cancelFlag == "true"){
				$result = @mysql_query("ROLLBACK");//�ϳ��� ������ ���� �ִٸ� RollBack�Ѵ�.
			}else{
				$result = @mysql_query("COMMIT");//��� �����ϸ� Commit.
				
				if(substr($inipay->GetResult('MOID'),0,1) == "B"){//�ٳ������������ϰ�� �ٳ������� �ٷ� ����
					include "../../php/charge_action.php";
					$isOK = chargeAction($inipay->GetResult('MOID'));//�ٳ��� ���� ����
					if(!$isOK) $cancelFlag = "true";//������ ������ ��� ��ü������ �����
				}
			}

			
		}
	}else{//���� ����
		//�ش� ���г��� DB���� ��������??
	}
	
	/*******************************************************************
	 * 7. DB���� ���� �� �������                                      *
	 *                                                                 *
	 * ���� ����� DB � �����ϰų� ��Ÿ �۾��� �����ϴٰ� �����ϴ�  *
	 * ���, �Ʒ��� �ڵ带 �����Ͽ� �̹� ���ҵ� �ŷ��� ����ϴ� �ڵ带 *
	 * �ۼ��մϴ�.                                                     *
	 *******************************************************************/
	
	

	// $cancelFlag�� "ture"�� �����ϴ� condition �Ǵ��� ����������
	// �����Ͽ� �ֽʽÿ�.

	if($cancelFlag == "true")
	{
		$TID = $inipay->GetResult("TID");
		$inipay->SetField("type", "cancel"); // ����
		$inipay->SetField("tid", $TID); // ����
		$inipay->SetField("cancelmsg", "DB FAIL"); // ��һ���
		$inipay->startAction();
		if($inipay->GetResult('ResultCode') == "00")
		{
      $inipay->MakeTXErrMsg(MERCHANT_DB_ERR,"Merchant DB FAIL");
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>��Ʋ�ٳ��� ���� ���</title>
<script language=javascript>
	resizeTo(510,575); //���� �������� ũ�⸦ �����մϴ�.

	var openwin=window.open("childwin.html","childwin","width=299,height=149");
	openwin.close();
	
	function show_receipt(tid) // ������ ���
	{
		if("<?php echo ($inipay->GetResult('ResultCode')); ?>" == "00")
		{
			var receiptUrl = "https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" + "<?php echo($inipay->GetResult('TID')); ?>" + "&noMethod=1";
			window.open(receiptUrl,"receipt","width=430,height=700");
		}
		else
		{
			alert("�ش��ϴ� ���������� �����ϴ�");
		}
	}
		
	function errhelp() // �� �������� ���
	{
		var errhelpUrl = "http://www.inicis.com/ErrCode/Error.jsp?result_err_code=" + "<?php echo($inipay->GetResult('ResultErrorCode')); ?>" + "&mid=" + "<?php echo($inipay->GetResult('MID')); ?>" + "&tid=<?php echo($inipay->GetResult('TID')); ?>" + "&goodname=" + "<?php echo($inipay->GetResult('GoodName')); ?>" + "&price=" + "<?php echo($inipay->GetResult('TotPrice')); ?>" + "&paymethod=" + "<?php echo($inipay->GetResult('PayMethod')); ?>" + "&buyername=" + "<?php echo($inipay->GetResult('BuyerName')); ?>" + "&buyertel=" + "<?php echo($inipay->GetResult('BuyerTel')); ?>" + "&buyeremail=" + "<?php echo($inipay->GetResult('BuyerEmail')); ?>" + "&codegw=" + "<?php echo($inipay->GetResult('HPP_GWCode')); ?>";
		window.open(errhelpUrl,"errhelp","width=520,height=150, scrollbars=yes,resizable=yes");
	}
	
</script>
</head>

<body>
<style>
html, body {margin:5px; border:0;}
.al8 tr td {padding-left:5px;}
.al8 tr {background-color:#e8e8dc; height:20px;}
</style>
<table width='450' border='0' cellspacing='0' cellpadding='0' bgcolor='#e8e8dc' style="font-family:����; color:#444; font-size:12px; "> 
  <tr> 
    <td align='right'><img src='https://www.battlebanana.com/img/mail/edge.gif' alt='���'/></td> 
  </tr> 
  <tr> 
    <td style='padding:5px 15px 15px 15px; font-size:24px; line-height:24px; font-weight:bold; text-align:center'>
		<img src='../../img/tit_result.gif' border='0'/>
	</td> 
  </tr> 
  <tr>
    <td style='padding:15px;'>
    	<table width="430" border='0' cellpadding='0' cellspacing='1' bgcolor="#c6c6ba" align="center" class="al8"> 
          <tr> 
            <td width="85">�������</td> 
            <td>
<?
	switch($inipay->GetResult('PayMethod')){
		case "VCard": $i_pay_method = "�ſ�ī��(ISP)";
			break;
		case "Card": $i_pay_method = "�ſ�ī��(�Ƚ�)";
			break;
		case "OCBPoint": $i_pay_method = "OKĳ����";
			break;
		case "DirectBank": $i_pay_method = "�ǽð�����";
			break;
		case "HPP": $i_pay_method = "�ڵ���";
			break;
		case "VBank": $i_pay_method = "�������Ա�";
			break;
		case "Ars1588Bill": $i_pay_method = "1588��ȭ";
			break;
		case "PhoneBill": $i_pay_method = "������ȭ";
			break;
		case "Culture": $i_pay_method = "��ȭ��ǰ��";
			break;
		case "TEEN": $i_pay_method = "ƾĳ��";
			break;
		case "DGCL": $i_pay_method = "���ӹ�ȭ";
			break;
		case "BCSH": $i_pay_method = "������ȭ";
			break;
		case "OABK": $i_pay_method = "����Ʈ�̴�";
			break;
		default: $i_pay_method = "";
			break;
	}
	echo $i_pay_method;
?>
</td> 
          </tr> 
          <tr> 
            <td>�������</td>
            <td><?php if($inipay->GetResult('ResultCode') == "00" && $inipay->GetResult('PayMethod') == "VBank"){ echo "������ �������Ա� ��û�� �Ϸ�Ǿ����ϴ�.";}
                  	   else if($inipay->GetResult('ResultCode') == "00"){ echo "������ ������û�� �����Ǿ����ϴ�.";}
                           else{ echo "������ ������û�� ���еǾ����ϴ�.";} ?></td> 
          </tr>
          <tr> 
            <td>�ֹ���ȣ</td>
            <td><?php echo($inipay->GetResult('MOID')); ?></td> 
          </tr>
<?php           
	/*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  1.  �ſ�ī�� , ISP ���� ��� ��� (OK CASH BAG POINT ���� ���� ���� )				*
	 -------------------------------------------------------------------------------------------------------*/

	if($inipay->GetResult('PayMethod') == "Card" || $inipay->GetResult('PayMethod') == "VCard" ){
		
		echo "<tr> 
				<td>�����ݾ�</td>
				<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
			  </tr>
			  <tr>
				<td>�ſ�ī���ȣ</td>
				<td>".$inipay->GetResult('CARD_Num')."****</td>
              </tr>
			  <tr>
				<td>���γ�¥</td>
				<td>".substr($inipay->GetResult('ApplDate'),0,4)."�� ".substr($inipay->GetResult('ApplDate'),4,2)."�� ".substr($inipay->GetResult('ApplDate'),6,2)."�� ".substr($inipay->GetResult('ApplTime'),0,2).":".substr($inipay->GetResult('ApplTime'),2,2).":".substr($inipay->GetResult('ApplTime'),4,2)."</td>
              </tr>              	    
              <tr>
				<td>���ι�ȣ</td>
                <td>".$inipay->GetResult('ApplNum')."</td>
              </tr>
              <tr> 
				<td>�ҺαⰣ</td>
                <td>".$inipay->GetResult('CARD_Quota')."����&nbsp;<b><font color=red>".$interest."</font></b></td>
              </tr>
              <tr> 
				<td>ī������</td>
                <td>".$inipay->GetResult('CARD_Code')."</td>
              </tr>
              <tr>
				<td>ī��߱޻�</td>
				<td>".$inipay->GetResult('CARD_BankCode')."</td>
              </tr>
              <!-- <tr>
				<td style='padding:0 0 0 9' colspan='2'><img src='img/icon.gif' width='10' height='11'> 
        	    <strong><font color='433F37'>�޷����� ����</font></strong></td>
              </tr>
              <tr>
				<td>��ȭ�ڵ�</td>
				<td>".$inipay->GetResult('OrgCurrency')."</td>
              </tr>
              <tr> 
				<td>ȯ��</td>
                <td>".$inipay->GetResult('ExchangeRate')."</td>
              </tr>
              <tr> -->
				<td style='padding:0 0 0 9' colspan='2'><img src='img/icon.gif' width='10' height='11'> 
        	    <strong><font color='433F37'>OK CASHBAG ���� �� ��볻��</font></strong></td>
              </tr>
              <tr>
				<td>ī���ȣ</td>
                <td>".$inipay->GetResult('OCB_Num')."</td>
              </tr>
              <tr>
                <td>���� ���ι�ȣ</td>
                <td>".$inipay->GetResult('OCB_SaveApplNum')."</td>
              </tr>
              <tr>
                <td>��� ���ι�ȣ</td>
                <td>".$inipay->GetResult('OCB_PayApplNum')."</td>
              </tr>
              <tr>
                <td>�����Ͻ�</td>
                <td>".$inipay->GetResult('OCB_ApplDate')."</td>
              </tr>
              <tr>
                <td>����Ʈ���ұݾ�</td>
                <td>".$inipay->GetResult('OCB_PayPrice')."</td>
              </tr>";
          }
        
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  2.  ������°��� ��� ��� 										*
	 -------------------------------------------------------------------------------------------------------*/
	 
          else if($inipay->GetResult('PayMethod') == "DirectBank"){
          	
          	echo"<tr> 
					<td>�����ݾ�</td>
					<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
				 </tr>
				 <tr>
				<td>���γ�¥</td>
				<td>".substr($inipay->GetResult('ApplDate'),0,4)."�� ".substr($inipay->GetResult('ApplDate'),4,2)."�� ".substr($inipay->GetResult('ApplDate'),6,2)."�� ".substr($inipay->GetResult('ApplTime'),0,2).":".substr($inipay->GetResult('ApplTime'),2,2).":".substr($inipay->GetResult('ApplTime'),4,2)."</td>
              </tr>    
                 <tr>
                   <td>�����ڵ�</td>
                   <td>".$inipay->GetResult('ACCT_BankCode')."</td>
                 </tr>
                 <tr>
                   <td>���ݿ�����<br>�߱ް���ڵ�</td>
                   <td>".$inipay->GetResult('CSHR_ResultCode')."</td>
                 </tr>
				 <tr>
					<td>���ݿ�����<br>�߱ޱ����ڵ�</td>
					<td>".$inipay->GetResult('CSHR_Type')." <font color=red><b>(0 - �ҵ������, 1 - ����������)</b></font></td>
				 </tr>";
          }
          
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  3.  �������Ա� �Ա� ���� ��� ��� (���� ������ �ƴ� �Ա� ���� ���� ����)				*
	 -------------------------------------------------------------------------------------------------------*/
	 
          else if($inipay->GetResult('PayMethod') == "VBank"){
          	echo "<tr> 
					<td bgcolor='#d8d8cd'>�����ϽǱݾ�</td>
					<td bgcolor='#d8d8cd'><b>".number_format($inipay->GetResult('TotPrice'))."��</b></td> 
				  </tr>
				  <tr>
					<td bgcolor='#d8d8cd'>�����Աݰ���</td>
					<td bgcolor='#d8d8cd'><b>".$get_bank_code."&nbsp;&nbsp;".$inipay->GetResult('VACT_Num')." (������:".$inipay->GetResult('VACT_Name').")</b></td>
                  </tr>
				  <tr>
					<td>�۱ݿ�����</td>
					<td>".$inipay->GetResult('VACT_InputName')."</td> 
				  </tr>
                  <!-- <tr>
                    <td>�۱��� �ֹι�ȣ</td>
                    <td>".$inipay->GetResult('VACT_RegNum')."</td>
                  </tr> -->
                  <tr>
                    <td>�Աݱ���</td>
                    <td>".substr($sprit_date,0,4)."�� ".substr($sprit_date,4,2)."�� ".substr($sprit_date,6,2)."�� ���� �Ա� �ٶ��ϴ�.</td>
                  </tr>";
          }
          
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  4.  �ڵ��� ���� 											*
	 -------------------------------------------------------------------------------------------------------*/
	 
          else if($inipay->GetResult('PayMethod') == "HPP"){
          	
          	echo "<tr> 
					<td>�����ݾ�</td>
					<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
				  </tr>
				  <tr>
                    <td>�޴�����ȣ</td>
                    <td>".$inipay->GetResult('HPP_Num')."</td>
                  </tr>
                  <tr>
                    <td>���γ�¥</td>
                    <td>".$inipay->GetResult('ApplDate')."</td>
                  </tr>
                  <tr>
                    <td>���νð�</td>
                    <td>".$inipay->GetResult('ApplTime')."</td>
                  </tr>";
          }
          
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  5.  ��ȭ ���� 											*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "Ars1588Bill" || $inipay->GetResult('PayMethod') == "PhoneBill"){
                    	
                echo "<tr> 
						<td>�����ݾ�</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
					  </tr>
					  <tr>
						<td>��ȭ��ȣ</td>
						<td>".$inipay->GetResult('ARSB_Num')."</td>
					  </tr>
                	  <tr>
                        <td>���γ�¥</td>
                        <td>".$inipay->GetResult('ApplDate')."</td>
                      </tr>
                      <tr>
                        <td>���νð�</td>
                        <td>".$inipay->GetResult('ApplTime')."</td>
                      </tr>";
         }
         
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  6.  OK CASH BAG POINT ���� �� ���� 									*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "OCBPoint"){
         	
                echo"<tr> 
						<td>�����ݾ�</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
					  </tr>
					  <tr>
						<td>ī���ȣ</td>
						<td>".$inipay->GetResult('OCB_Num')."</td>
                     </tr>
                	 <tr>
						<td>���γ�¥</td>
						<td>".$inipay->GetResult('OCB_ApplDate')."</td>
					 </tr>
					 <tr>
						<td>���νð�</td>
						<td>".$inipay->GetResult('OCB_ApplTime')."</td>
					 </tr>
					 <tr>
						<td>���� ���ι�ȣ</td>
						<td>".$inipay->GetResult('OCB_SaveApplNum')."</td>
					 </tr>
					 <tr>
						<td>��� ���ι�ȣ</td>
						<td>".$inipay->GetResult('OCB_PayApplNum')."</td>
					 </tr>
					 <tr>
						<td>�����Ͻ�</td>
						<td>".$inipay->GetResult('OCB_ApplDate')."</td>
					 </tr>
					 <tr>
						<td>����Ʈ���ұݾ�</td>
						<td>".$inipay->GetResult('OCB_PayPrice')."</td>
					 </tr>";
         }
         
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  7.  ��ȭ ��ǰ��						                			*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "Culture"){
         	
                echo"<tr> 
						<td>�����ݾ�</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
					 </tr>
					 <tr>
						<td>���ķ��� ID</td>
                        <td>".$inipay->GetResult('CULT_UserID')."</td>
                     </tr>";
         }
         
         /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  8.  K-merce ��ǰ��						                			*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "KMC_"){
         	
                echo"<tr> 
						<td>�����ݾ�</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
					  </tr>
					  <tr>
                       <td>K-merce ID</td>
                       <td>".$inipay->GetResult('CULT_UserID')."</td>
                     </tr>";
         }
         
         /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  9.  ƾĳ�� ����						                			*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "TEEN"){
         	
                echo"<tr> 
						<td>�����ݾ�</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
					 </tr>
					 <tr>
                       <td>ƾĳ���ܾ�</td>
                       <td>".$inipay->GetResult('TEEN_Remains')."</td>
                     </tr>
					 <tr>
                       <td>ƾĳ�þ��̵�</td>
                       <td>".$inipay->GetResult('TEEN_UserID')."</td>
                     </tr>";
         }
          
         /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  �Ʒ� �κ��� ���� ���ܺ� ��� �޼��� ��� �κ��Դϴ�.    						*	
	 *													*
	 *  10.  ���ӹ�ȭ ��ǰ�� ����						                			*
	 -------------------------------------------------------------------------------------------------------*/
          else if($inipay->GetResult('PayMethod') == "DGCL"){
         	
                echo"<tr> 
						<td>�����ݾ�</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."��</td> 
					 </tr>
					 <tr>
                       <td>����� ī�� ��</td>
                       <td>".$inipay->GetResult('GAMG_Cnt')." ��</td>
                     </tr>";
                             
         /* �Ʒ��κ��� ����� ���ӹ�ȭ ��ǰ�� ��ȣ�� �ܾ��� �����ݴϴ�.(���� ���нÿ��� �ܾ״�� ������������ �����ݴϴ�.) */
         /* �ִ� 6����� ����� �����ϸ�, ������ ���� ī�常 ��µ˴ϴ�. */
                     for($i=1 ; $i <= $inipay->GetResult('GAMG_Cnt') ; $i++){                            	
                        echo"<tr>
                     			<td>����� ī���ȣ</td>
                     			<td><b>".$inipay->GetResult('GAMG_Num'.$i)."</b></td>
							 </tr>";
                     	
                     	if($inipay->GetResult('ResultCode') == "00"){
                     		echo"<tr>
									<td>ī�� �ܾ�</td>
									<td><b>".$inipay->GetResult('GAMG_Remains'.$i)." ��</b></td>
                      	         </tr>";
                      	
                      	}else{
                      		echo"<tr>
									<td>�����޼���</td>
                     	        	<td><b>".$inipay->GetResult('GAMG_ErrMsg'.$i)."</b></td>
								 </tr>";
                      	}
                     }
         }
?>
        </table> 
        <table width="430" border='0' cellpadding='0' cellspacing='0' align="center" style="margin-top:10px;"> 
          <tr>
            <td style="text-align:right">
			<?php
			if($inipay->GetResult('ResultCode') == "00"){
				if($inipay->GetResult('PayMethod') == "VBank") echo "";
				else echo "<a href='javascript:show_receipt();'><img src='./img/btn_print.gif' border='0' /></a>";
			}else{
				echo "<a href='javascript:errhelp();'><img src='img/button_01.gif' width='142' height='24' border='0'></a>";
			}
			?></td> 
          </tr> 
        </table>
<?
            	if($inipay->GetResult('ResultCode') == "00"){
            		
            		switch($inipay->GetResult('PayMethod')){
            		       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  1.  �ſ�ī�� 						                			*
	 			--------------------------------------------------------------------------------------------------------*/
	
				case(Card): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* �ſ�ī�� û������ <b>\"�̴Ͻý�(inicis.com)\"</b>���� ǥ��˴ϴ�.<br><br>
         			* LGī�� �� BCī���� ��� <b>\"�̴Ͻý�(��Ű������)\"</b>���� ǥ��ǰ�, �Ｚī���� ��� <b>\"�̴Ͻý�(www.battlebanana.com)\"</b>�� ǥ��˴ϴ�.
					</td></tr></table>";
					break;
				
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  2.  ISP 						                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(VCard): // ISP
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* �ſ�ī�� û������ <b>\"�̴Ͻý�(inicis.com)\"</b>���� ǥ��˴ϴ�.<br><br>
         			* LGī�� �� BCī���� ��� <b>\"�̴Ͻý�(��Ű������)\"</b>���� ǥ��ǰ�, �Ｚī���� ��� <b>\"�̴Ͻý�(www.battlebanana.com)\"</b>�� ǥ��˴ϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  3. �ڵ��� 						                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(HPP): // �޴���
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* �ڵ��� û������ <b>\"�Ҿװ���\"</b> �Ǵ� <b>\"�ܺ������̿��\"</b>�� û���˴ϴ�.<br><br>
         			* ������ �� �ѵ��ݾ��� Ȯ���Ͻð��� �� ��� �� �̵���Ż��� �����͸� �̿����ֽʽÿ�.
					</td></tr></table>";
					break;				
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  4. ��ȭ ���� (ARS1588Bill)				                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(Ars1588Bill): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ��ȭ û������ <b>\"������ �̿��\"</b>�� û���˴ϴ�.<br><br>
					* �� �ѵ��ݾ��� ��� ������ �������� ��� ��ϵ� ��ȭ��ȣ ������ �ƴ� �ֹε�Ϲ�ȣ�� �������� å���Ǿ� �ֽ��ϴ�.<br><br>
					* ��ȭ ������Ҵ� ������� �����մϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  5. ���� ���� (PhoneBill)				                				*
	 			--------------------------------------------------------------------------------------------------------*/
				
				case(PhoneBill): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ��ȭ û������ <b>\"���ͳ� ������ (����)�����̿��\"</b>�� û���˴ϴ�.<br><br>
					* �� �ѵ��ݾ��� ��� ������ �������� ��� ��ϵ� ��ȭ��ȣ ������ �ƴ� �ֹε�Ϲ�ȣ�� �������� å���Ǿ� �ֽ��ϴ�.<br><br>
					* ��ȭ ������Ҵ� ������� �����մϴ�.
					</td></tr></table>";
					break;
				
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  6. OK CASH BAG POINT					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(OCBPoint): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* OK CASH BAG ����Ʈ ������Ҵ� ������� �����մϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  7. ���������ü					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(DirectBank):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ������ ���忡�� �̿��Ͻ� �������� ǥ��˴ϴ�.<br><br>
					* ������ ���� ����ȸ�� www.inicis.com�� ���� ��� <b>\"��볻�� �� û����� ��ȸ\"</b>������ Ȯ�ΰ����մϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  8. ������ �Ա� ����					                			*
	 			--------------------------------------------------------------------------------------------------------*/		
				case(VBank):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ��� ����� �Աݿ����� �Ϸ�� ���ϻ� ���� �ԱݿϷᰡ �̷���� ���� �ƴմϴ�.<br /><br />
					* ��� �Աݰ��·� �ش� ��ǰ�ݾ��� �������Ա�(â���Ա�)�Ͻðų�, ���ͳ� ��ŷ ���� ���� �¶��� �۱��� �Ͻñ� �ٶ��ϴ�.<br /><br />
					* �ݵ�� �Աݱ��� ���� �Ա��Ͻñ� �ٶ��, ����Աݽ� �ݵ�� �ֹ��Ͻ� �ݾ׸� �Ա��Ͻñ� �ٶ��ϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  9. ��ȭ��ǰ�� ����					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(Culture):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ��ȭ��ǰ���� �¶��ο��� �̿��Ͻ� ��� �������ο����� ����Ͻ� �� �����ϴ�.<br><br>
					* ����ĳ�� �ܾ��� �����ִ� ���, ������ ����ĳ�� �ܾ��� �ٽ� ����Ͻ÷��� ���ķ��� ID�� ����Ͻñ� �ٶ��ϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  10. K-merce ��ǰ�� ����					                			*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(KMC_):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* K-merce ��ǰ���� �Ҿװ����� �����ϸ�, ��ǰ���� �ܿ� �ݾ׿� ���� ���������� ��밡���մϴ�.<br><br>
					* K-merce ��ǰ�� ������ K-merce ����Ʈ(www.k-merce.com)������ ������ �����մϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  11. ƾĳ�� ����					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(TEEN):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ƾĳ�ô� ���ͳ� ����Ʈ �Ǵ� PC�濡�� �����Ӱ� ����� �� �ִ� ���� ���������Դϴ�.<br><br>
					* ƾĳ�� ī���ȣ ���� : ƾĳ�� ī�� �޸鿡 ���� 12�ڸ� ��ȣ�� �Է��Ͽ� �����ϴ� ����Դϴ�.<br><br>
					* ƾĳ�� ���̵� ���� : ƾĳ�� ����Ʈ (www.teencash.co.kr)�� ȸ������ �� ƾĳ�� ����Ʈ�� �����Ͽ� ������ ƾĳ�� ī�带 ����Ͽ� �̿��ϴ� ����Դϴ�.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* ���� ������ �̿�ȳ� �����ֱ� 			    						*	
				*													*
	 			*  12. ���ӹ�ȭ ��ǰ�� ����				                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(DGCL):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* ���ӹ�ȭ ��ǰ���� ��ǰ�ǿ� �μ�Ǿ��ִ� ��ũ��ġ ��ȣ�� �����ϴ� ����Դϴ�.<br><br>
					* ���ӹ�ȭ ��ǰ�� ������ ��ȭ��ǰ��(www.cultureland.co.kr)���� ���� �ϽǼ� �ֽ��ϴ�.<br><br>
					* ���ӹ�ȭ ��ǰ���� �ִ� 6����� ����� �����մϴ�.
					</td></tr></table>";
					break;
			}
		}
		
?>
        </td> 
  </tr> 
  <tr> 
    <td align='center' style='padding:10px; color:#9b9b8e;'>�� 2010 ��Ű������</td> 
  </tr> 
</table>
</body>
</html>
<?
	mysql_close($connect);
?>