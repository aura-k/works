<?php
/* INIsecurepay.php
 *
 * 이니페이 플러그인을 통해 요청된 지불을 처리한다.
 * 지불 요청을 처리한다.
 * 코드에 대한 자세한 설명은 매뉴얼을 참조하십시오.
 * <주의> 구매자의 세션을 반드시 체크하도록하여 부정거래를 방지하여 주십시요.
 *  
 * http://www.inicis.com
 * Copyright (C) 2006 Inicis Co., Ltd. All rights reserved.
 */
include "../../php/connect.php"; //디비 정의 페이지 
  /****************************
   * 0. 세션 시작             *
   ****************************/
  session_start();								//주의:파일 최상단에 위치시켜주세요!!

	/**************************
	 * 1. 라이브러리 인클루드 *
	 **************************/
	require("../libs/INILib.php");
	
	
	/***************************************
	 * 2. INIpay50 클래스의 인스턴스 생성 *
	 ***************************************/
	$inipay = new INIpay50;

	/*********************
	 * 3. 지불 정보 설정 *
	 *********************/
	$inipay->SetField("inipayhome", "/home/banana/public_html/INIpay50/"); // 이니페이 홈디렉터리(상점수정 필요)
	$inipay->SetField("type", "securepay");                         // 고정 (절대 수정 불가)
	$inipay->SetField("pgid", "INIphp".$pgid);                      // 고정 (절대 수정 불가)
	$inipay->SetField("subpgip","203.238.3.10");                    // 고정 (절대 수정 불가)
	$inipay->SetField("admin", $HTTP_SESSION_VARS['INI_ADMIN']);    // 키패스워드(상점아이디에 따라 변경)
	$inipay->SetField("debug", "true");                             // 로그모드("true"로 설정하면 상세로그가 생성됨.)
	$inipay->SetField("uid", $uid);                                 // INIpay User ID (절대 수정 불가)
  $inipay->SetField("goodname", $goodname);                       // 상품명 
	$inipay->SetField("currency", $currency);                       // 화폐단위

	$inipay->SetField("mid", $HTTP_SESSION_VARS['INI_MID']);        // 상점아이디
	$inipay->SetField("rn", $HTTP_SESSION_VARS['INI_RN']);          // 웹페이지 위변조용 RN값
	$inipay->SetField("price", $HTTP_SESSION_VARS['INI_PRICE']);		// 가격
	$inipay->SetField("enctype", $HTTP_SESSION_VARS['INI_ENCTYPE']);// 고정 (절대 수정 불가)


     /*----------------------------------------------------------------------------------------
       price 등의 중요데이터는
       브라우저상의 위변조여부를 반드시 확인하셔야 합니다.

       결제 요청페이지에서 요청된 금액과
       실제 결제가 이루어질 금액을 반드시 비교하여 처리하십시오.

       설치 메뉴얼 2장의 결제 처리페이지 작성부분의 보안경고 부분을 확인하시기 바랍니다.
       적용참조문서: 이니시스홈페이지->가맹점기술지원자료실->기타자료실 의
                      '결제 처리 페이지 상에 결제 금액 변조 유무에 대한 체크' 문서를 참조하시기 바랍니다.
       예제)
       원 상품 가격 변수를 OriginalPrice 하고  원 가격 정보를 리턴하는 함수를 Return_OrgPrice()라 가정하면
       다음 같이 적용하여 원가격과 웹브라우저에서 Post되어 넘어온 가격을 비교 한다.

		$OriginalPrice = Return_OrgPrice();
		$PostPrice = $HTTP_SESSION_VARS['INI_PRICE']; 
		if ( $OriginalPrice != $PostPrice )
		{
			//결제 진행을 중단하고  금액 변경 가능성에 대한 메시지 출력 처리
			//처리 종료 
		}

      ----------------------------------------------------------------------------------------*/
	$inipay->SetField("buyername", $buyername);       // 구매자 명
	$inipay->SetField("buyertel",  $buyertel);        // 구매자 연락처(휴대폰 번호 또는 유선전화번호)
	$inipay->SetField("buyeremail",$buyeremail);      // 구매자 이메일 주소
	$inipay->SetField("paymethod", $paymethod);       // 지불방법 (절대 수정 불가)
	$inipay->SetField("encrypted", $encrypted);       // 암호문
	$inipay->SetField("sessionkey",$sessionkey);      // 암호문
	$inipay->SetField("url", "http://www.battlebanana.com"); // 실제 서비스되는 상점 SITE URL로 변경할것
	$inipay->SetField("cardcode", $cardcode);         // 카드코드 리턴
	$inipay->SetField("parentemail", $parentemail);   // 보호자 이메일 주소(핸드폰 , 전화결제시에 14세 미만의 고객이 결제하면  부모 이메일로 결제 내용통보 의무, 다른결제 수단 사용시에 삭제 가능)
	
	/*-----------------------------------------------------------------*
	 * 수취인 정보 *                                                   *
	 *-----------------------------------------------------------------*
	 * 실물배송을 하는 상점의 경우에 사용되는 필드들이며               *
	 * 아래의 값들은 INIsecurepay.html 페이지에서 포스트 되도록        *
	 * 필드를 만들어 주도록 하십시요.                                  *
	 * 컨텐츠 제공업체의 경우 삭제하셔도 무방합니다.                   *
	 *-----------------------------------------------------------------*/
	$inipay->SetField("recvname",$recvname);	// 수취인 명
	$inipay->SetField("recvtel",$recvtel);		// 수취인 연락처
	$inipay->SetField("recvaddr",$recvaddr);	// 수취인 주소
	$inipay->SetField("recvpostnum",$recvpostnum);  // 수취인 우편번호
	$inipay->SetField("recvmsg",$recvmsg);		// 전달 메세지

  $inipay->SetField("joincard",$joincard);  // 제휴카드코드
  $inipay->SetField("joinexpire",$joinexpire);    // 제휴카드유효기간
  $inipay->SetField("id_customer",$id_customer);    //user_id

	
	/****************
	 * 4. 지불 요청 *
	 ****************/
	$inipay->startAction();
	
	
	$sprit_date = $inipay->GetResult('VACT_Date');
	$bank_code = $inipay->GetResult('VACT_BankCode');

	switch($bank_code){
		case "03": $get_bank_code = "기업은행";
			break;
		case "04": $get_bank_code = "국민은행";
			break;
		case "05": $get_bank_code = "외환은행";
			break;
		case "07": $get_bank_code = "수협";
			break;
		case "11": $get_bank_code = "농협";
			break;
		case "20": $get_bank_code = "우리은행";
			break;
		case "23": $get_bank_code = "SC 제일";
			break;
		case "31": $get_bank_code = "대구은행";
			break;
		case "32": $get_bank_code = "부산은행";
			break;
		case "34": $get_bank_code = "광주은행";
			break;
		case "37": $get_bank_code = "전북은행";
			break;
		case "39": $get_bank_code = "경남은행";
			break;
		case "53": $get_bank_code = "시티은행";
			break;
		case "71": $get_bank_code = "우체국";
			break;
		case "81": $get_bank_code = "하나은행";
			break;
		case "88": $get_bank_code = "신한(조흥)";
			break;
	}
	/****************
	 * 5. DB  저장  *
	 ****************/
	$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
	$result = @mysql_query('BEGIN');
	$cancelFlag = "false";

	/*$sql = mysql_query("SELECT * FROM  `BBanana_ships` ORDER BY no DESC LIMIT 0 , 1") or die(mysql_error()); 
	$row = mysql_fetch_array($sql);
	$last_order_num = $row['no'];*/

	if($inipay->GetResult('ResultCode') == "00" && $inipay->GetResult('PayMethod') == "VBank"){//결제성공및 무통장입금일경우
		//해당내역을 DB저장을 하지만 바나나 반영은 하지 않는다.
		if($goodname){//중복된 주문값을 찾고 주문값이 없을때만 DB에 저장
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
					'".iconv("EUC-KR", "UTF-8", $get_bank_code." ".$inipay->GetResult('VACT_Num')." (예금주: ".$inipay->GetResult('VACT_Name').") | 결제할금액: ".number_format(trim($inipay->GetResult('TotPrice')))."원 | 결제예정자: ".$inipay->GetResult('VACT_InputName'))."',
					'no'
				);"); 
			if(!$sql || @mysql_affected_rows() == 0) $cancelFlag = "true";
			
			if($cancelFlag == "true"){
				$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
			}else{
				$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
			}
		}
	}else if($inipay->GetResult('ResultCode') == "00"){//일반적인 결제성공
		//해당내역을 DB저장및 바로 바나나 반영을 해준다.
		if($goodname){//중복된 주문값을 찾고 주문값이 없을때만 DB에 저장
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
				$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
			}else{
				$result = @mysql_query("COMMIT");//모두 성공하면 Commit.
				
				if(substr($inipay->GetResult('MOID'),0,1) == "B"){//바나나충전결제일경우 바나나충전 바로 실행
					include "../../php/charge_action.php";
					$isOK = chargeAction($inipay->GetResult('MOID'));//바나나 충전 수행
					if(!$isOK) $cancelFlag = "true";//충전이 실패한 경우 전체결제를 취소함
				}
			}

			
		}
	}else{//결제 실패
		//해당 실패내역 DB저장 할지말지??
	}
	
	/*******************************************************************
	 * 7. DB연동 실패 시 강제취소                                      *
	 *                                                                 *
	 * 지불 결과를 DB 등에 저장하거나 기타 작업을 수행하다가 실패하는  *
	 * 경우, 아래의 코드를 참조하여 이미 지불된 거래를 취소하는 코드를 *
	 * 작성합니다.                                                     *
	 *******************************************************************/
	
	

	// $cancelFlag를 "ture"로 변경하는 condition 판단은 개별적으로
	// 수행하여 주십시오.

	if($cancelFlag == "true")
	{
		$TID = $inipay->GetResult("TID");
		$inipay->SetField("type", "cancel"); // 고정
		$inipay->SetField("tid", $TID); // 고정
		$inipay->SetField("cancelmsg", "DB FAIL"); // 취소사유
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
<title>배틀바나나 결제 결과</title>
<script language=javascript>
	resizeTo(510,575); //현재 브라우져의 크기를 조정합니다.

	var openwin=window.open("childwin.html","childwin","width=299,height=149");
	openwin.close();
	
	function show_receipt(tid) // 영수증 출력
	{
		if("<?php echo ($inipay->GetResult('ResultCode')); ?>" == "00")
		{
			var receiptUrl = "https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=" + "<?php echo($inipay->GetResult('TID')); ?>" + "&noMethod=1";
			window.open(receiptUrl,"receipt","width=430,height=700");
		}
		else
		{
			alert("해당하는 결제내역이 없습니다");
		}
	}
		
	function errhelp() // 상세 에러내역 출력
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
<table width='450' border='0' cellspacing='0' cellpadding='0' bgcolor='#e8e8dc' style="font-family:굴림; color:#444; font-size:12px; "> 
  <tr> 
    <td align='right'><img src='https://www.battlebanana.com/img/mail/edge.gif' alt='배경'/></td> 
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
            <td width="85">결제방법</td> 
            <td>
<?
	switch($inipay->GetResult('PayMethod')){
		case "VCard": $i_pay_method = "신용카드(ISP)";
			break;
		case "Card": $i_pay_method = "신용카드(안심)";
			break;
		case "OCBPoint": $i_pay_method = "OK캐쉬백";
			break;
		case "DirectBank": $i_pay_method = "실시간계좌";
			break;
		case "HPP": $i_pay_method = "핸드폰";
			break;
		case "VBank": $i_pay_method = "무통장입금";
			break;
		case "Ars1588Bill": $i_pay_method = "1588전화";
			break;
		case "PhoneBill": $i_pay_method = "폰빌전화";
			break;
		case "Culture": $i_pay_method = "문화상품권";
			break;
		case "TEEN": $i_pay_method = "틴캐시";
			break;
		case "DGCL": $i_pay_method = "게임문화";
			break;
		case "BCSH": $i_pay_method = "도서문화";
			break;
		case "OABK": $i_pay_method = "네이트미니";
			break;
		default: $i_pay_method = "";
			break;
	}
	echo $i_pay_method;
?>
</td> 
          </tr> 
          <tr> 
            <td>결과내용</td>
            <td><?php if($inipay->GetResult('ResultCode') == "00" && $inipay->GetResult('PayMethod') == "VBank"){ echo "고객님의 무통장입금 요청이 완료되었습니다.";}
                  	   else if($inipay->GetResult('ResultCode') == "00"){ echo "고객님의 결제요청이 성공되었습니다.";}
                           else{ echo "고객님의 결제요청이 실패되었습니다.";} ?></td> 
          </tr>
          <tr> 
            <td>주문번호</td>
            <td><?php echo($inipay->GetResult('MOID')); ?></td> 
          </tr>
<?php           
	/*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  1.  신용카드 , ISP 결제 결과 출력 (OK CASH BAG POINT 복합 결제 내역 )				*
	 -------------------------------------------------------------------------------------------------------*/

	if($inipay->GetResult('PayMethod') == "Card" || $inipay->GetResult('PayMethod') == "VCard" ){
		
		echo "<tr> 
				<td>결제금액</td>
				<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
			  </tr>
			  <tr>
				<td>신용카드번호</td>
				<td>".$inipay->GetResult('CARD_Num')."****</td>
              </tr>
			  <tr>
				<td>승인날짜</td>
				<td>".substr($inipay->GetResult('ApplDate'),0,4)."년 ".substr($inipay->GetResult('ApplDate'),4,2)."월 ".substr($inipay->GetResult('ApplDate'),6,2)."일 ".substr($inipay->GetResult('ApplTime'),0,2).":".substr($inipay->GetResult('ApplTime'),2,2).":".substr($inipay->GetResult('ApplTime'),4,2)."</td>
              </tr>              	    
              <tr>
				<td>승인번호</td>
                <td>".$inipay->GetResult('ApplNum')."</td>
              </tr>
              <tr> 
				<td>할부기간</td>
                <td>".$inipay->GetResult('CARD_Quota')."개월&nbsp;<b><font color=red>".$interest."</font></b></td>
              </tr>
              <tr> 
				<td>카드종류</td>
                <td>".$inipay->GetResult('CARD_Code')."</td>
              </tr>
              <tr>
				<td>카드발급사</td>
				<td>".$inipay->GetResult('CARD_BankCode')."</td>
              </tr>
              <!-- <tr>
				<td style='padding:0 0 0 9' colspan='2'><img src='img/icon.gif' width='10' height='11'> 
        	    <strong><font color='433F37'>달러결제 정보</font></strong></td>
              </tr>
              <tr>
				<td>통화코드</td>
				<td>".$inipay->GetResult('OrgCurrency')."</td>
              </tr>
              <tr> 
				<td>환율</td>
                <td>".$inipay->GetResult('ExchangeRate')."</td>
              </tr>
              <tr> -->
				<td style='padding:0 0 0 9' colspan='2'><img src='img/icon.gif' width='10' height='11'> 
        	    <strong><font color='433F37'>OK CASHBAG 적립 및 사용내역</font></strong></td>
              </tr>
              <tr>
				<td>카드번호</td>
                <td>".$inipay->GetResult('OCB_Num')."</td>
              </tr>
              <tr>
                <td>적립 승인번호</td>
                <td>".$inipay->GetResult('OCB_SaveApplNum')."</td>
              </tr>
              <tr>
                <td>사용 승인번호</td>
                <td>".$inipay->GetResult('OCB_PayApplNum')."</td>
              </tr>
              <tr>
                <td>승인일시</td>
                <td>".$inipay->GetResult('OCB_ApplDate')."</td>
              </tr>
              <tr>
                <td>포인트지불금액</td>
                <td>".$inipay->GetResult('OCB_PayPrice')."</td>
              </tr>";
          }
        
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  2.  은행계좌결제 결과 출력 										*
	 -------------------------------------------------------------------------------------------------------*/
	 
          else if($inipay->GetResult('PayMethod') == "DirectBank"){
          	
          	echo"<tr> 
					<td>결제금액</td>
					<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
				 </tr>
				 <tr>
				<td>승인날짜</td>
				<td>".substr($inipay->GetResult('ApplDate'),0,4)."년 ".substr($inipay->GetResult('ApplDate'),4,2)."월 ".substr($inipay->GetResult('ApplDate'),6,2)."일 ".substr($inipay->GetResult('ApplTime'),0,2).":".substr($inipay->GetResult('ApplTime'),2,2).":".substr($inipay->GetResult('ApplTime'),4,2)."</td>
              </tr>    
                 <tr>
                   <td>은행코드</td>
                   <td>".$inipay->GetResult('ACCT_BankCode')."</td>
                 </tr>
                 <tr>
                   <td>현금영수증<br>발급결과코드</td>
                   <td>".$inipay->GetResult('CSHR_ResultCode')."</td>
                 </tr>
				 <tr>
					<td>현금영수증<br>발급구분코드</td>
					<td>".$inipay->GetResult('CSHR_Type')." <font color=red><b>(0 - 소득공제용, 1 - 지출증빙용)</b></font></td>
				 </tr>";
          }
          
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  3.  무통장입금 입금 예정 결과 출력 (결제 성공이 아닌 입금 예정 성공 유무)				*
	 -------------------------------------------------------------------------------------------------------*/
	 
          else if($inipay->GetResult('PayMethod') == "VBank"){
          	echo "<tr> 
					<td bgcolor='#d8d8cd'>결제하실금액</td>
					<td bgcolor='#d8d8cd'><b>".number_format($inipay->GetResult('TotPrice'))."원</b></td> 
				  </tr>
				  <tr>
					<td bgcolor='#d8d8cd'>가상입금계좌</td>
					<td bgcolor='#d8d8cd'><b>".$get_bank_code."&nbsp;&nbsp;".$inipay->GetResult('VACT_Num')." (예금주:".$inipay->GetResult('VACT_Name').")</b></td>
                  </tr>
				  <tr>
					<td>송금예정자</td>
					<td>".$inipay->GetResult('VACT_InputName')."</td> 
				  </tr>
                  <!-- <tr>
                    <td>송금자 주민번호</td>
                    <td>".$inipay->GetResult('VACT_RegNum')."</td>
                  </tr> -->
                  <tr>
                    <td>입금기한</td>
                    <td>".substr($sprit_date,0,4)."년 ".substr($sprit_date,4,2)."월 ".substr($sprit_date,6,2)."일 까지 입금 바랍니다.</td>
                  </tr>";
          }
          
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  4.  핸드폰 결제 											*
	 -------------------------------------------------------------------------------------------------------*/
	 
          else if($inipay->GetResult('PayMethod') == "HPP"){
          	
          	echo "<tr> 
					<td>결제금액</td>
					<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
				  </tr>
				  <tr>
                    <td>휴대폰번호</td>
                    <td>".$inipay->GetResult('HPP_Num')."</td>
                  </tr>
                  <tr>
                    <td>승인날짜</td>
                    <td>".$inipay->GetResult('ApplDate')."</td>
                  </tr>
                  <tr>
                    <td>승인시각</td>
                    <td>".$inipay->GetResult('ApplTime')."</td>
                  </tr>";
          }
          
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  5.  전화 결제 											*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "Ars1588Bill" || $inipay->GetResult('PayMethod') == "PhoneBill"){
                    	
                echo "<tr> 
						<td>결제금액</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
					  </tr>
					  <tr>
						<td>전화번호</td>
						<td>".$inipay->GetResult('ARSB_Num')."</td>
					  </tr>
                	  <tr>
                        <td>승인날짜</td>
                        <td>".$inipay->GetResult('ApplDate')."</td>
                      </tr>
                      <tr>
                        <td>승인시각</td>
                        <td>".$inipay->GetResult('ApplTime')."</td>
                      </tr>";
         }
         
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  6.  OK CASH BAG POINT 적립 및 지불 									*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "OCBPoint"){
         	
                echo"<tr> 
						<td>결제금액</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
					  </tr>
					  <tr>
						<td>카드번호</td>
						<td>".$inipay->GetResult('OCB_Num')."</td>
                     </tr>
                	 <tr>
						<td>승인날짜</td>
						<td>".$inipay->GetResult('OCB_ApplDate')."</td>
					 </tr>
					 <tr>
						<td>승인시각</td>
						<td>".$inipay->GetResult('OCB_ApplTime')."</td>
					 </tr>
					 <tr>
						<td>적립 승인번호</td>
						<td>".$inipay->GetResult('OCB_SaveApplNum')."</td>
					 </tr>
					 <tr>
						<td>사용 승인번호</td>
						<td>".$inipay->GetResult('OCB_PayApplNum')."</td>
					 </tr>
					 <tr>
						<td>승인일시</td>
						<td>".$inipay->GetResult('OCB_ApplDate')."</td>
					 </tr>
					 <tr>
						<td>포인트지불금액</td>
						<td>".$inipay->GetResult('OCB_PayPrice')."</td>
					 </tr>";
         }
         
        /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  7.  문화 상품권						                			*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "Culture"){
         	
                echo"<tr> 
						<td>결제금액</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
					 </tr>
					 <tr>
						<td>컬쳐랜드 ID</td>
                        <td>".$inipay->GetResult('CULT_UserID')."</td>
                     </tr>";
         }
         
         /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  8.  K-merce 상품권						                			*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "KMC_"){
         	
                echo"<tr> 
						<td>결제금액</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
					  </tr>
					  <tr>
                       <td>K-merce ID</td>
                       <td>".$inipay->GetResult('CULT_UserID')."</td>
                     </tr>";
         }
         
         /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  9.  틴캐시 결제						                			*
	 -------------------------------------------------------------------------------------------------------*/
	 
         else if($inipay->GetResult('PayMethod') == "TEEN"){
         	
                echo"<tr> 
						<td>결제금액</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
					 </tr>
					 <tr>
                       <td>틴캐시잔액</td>
                       <td>".$inipay->GetResult('TEEN_Remains')."</td>
                     </tr>
					 <tr>
                       <td>틴캐시아이디</td>
                       <td>".$inipay->GetResult('TEEN_UserID')."</td>
                     </tr>";
         }
          
         /*-------------------------------------------------------------------------------------------------------
	 *													*
	 *  아래 부분은 결제 수단별 결과 메세지 출력 부분입니다.    						*	
	 *													*
	 *  10.  게임문화 상품권 결제						                			*
	 -------------------------------------------------------------------------------------------------------*/
          else if($inipay->GetResult('PayMethod') == "DGCL"){
         	
                echo"<tr> 
						<td>결제금액</td>
						<td>".number_format($inipay->GetResult('TotPrice'))."원</td> 
					 </tr>
					 <tr>
                       <td>사용한 카드 수</td>
                       <td>".$inipay->GetResult('GAMG_Cnt')." 장</td>
                     </tr>";
                             
         /* 아래부분은 사용한 게임문화 상품권 번호와 잔액을 보여줍니다.(결제 실패시에는 잔액대신 에러메제지를 보여줍니다.) */
         /* 최대 6장까지 사용이 가능하며, 결제에 사용된 카드만 출력됩니다. */
                     for($i=1 ; $i <= $inipay->GetResult('GAMG_Cnt') ; $i++){                            	
                        echo"<tr>
                     			<td>사용한 카드번호</td>
                     			<td><b>".$inipay->GetResult('GAMG_Num'.$i)."</b></td>
							 </tr>";
                     	
                     	if($inipay->GetResult('ResultCode') == "00"){
                     		echo"<tr>
									<td>카드 잔액</td>
									<td><b>".$inipay->GetResult('GAMG_Remains'.$i)." 원</b></td>
                      	         </tr>";
                      	
                      	}else{
                      		echo"<tr>
									<td>에러메세지</td>
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
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  1.  신용카드 						                			*
	 			--------------------------------------------------------------------------------------------------------*/
	
				case(Card): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 신용카드 청구서에 <b>\"이니시스(inicis.com)\"</b>으로 표기됩니다.<br><br>
         			* LG카드 및 BC카드의 경우 <b>\"이니시스(몽키브라더스)\"</b>으로 표기되고, 삼성카드의 경우 <b>\"이니시스(www.battlebanana.com)\"</b>로 표기됩니다.
					</td></tr></table>";
					break;
				
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  2.  ISP 						                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(VCard): // ISP
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 신용카드 청구서에 <b>\"이니시스(inicis.com)\"</b>으로 표기됩니다.<br><br>
         			* LG카드 및 BC카드의 경우 <b>\"이니시스(몽키브라더스)\"</b>으로 표기되고, 삼성카드의 경우 <b>\"이니시스(www.battlebanana.com)\"</b>로 표기됩니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  3. 핸드폰 						                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(HPP): // 휴대폰
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 핸드폰 청구서에 <b>\"소액결제\"</b> 또는 <b>\"외부정보이용료\"</b>로 청구됩니다.<br><br>
         			* 본인의 월 한도금액을 확인하시고자 할 경우 각 이동통신사의 고객센터를 이용해주십시오.
					</td></tr></table>";
					break;				
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  4. 전화 결제 (ARS1588Bill)				                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(Ars1588Bill): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 전화 청구서에 <b>\"컨텐츠 이용료\"</b>로 청구됩니다.<br><br>
					* 월 한도금액의 경우 동일한 가입자의 경우 등록된 전화번호 기준이 아닌 주민등록번호를 기준으로 책정되어 있습니다.<br><br>
					* 전화 결제취소는 당월에만 가능합니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  5. 폰빌 결제 (PhoneBill)				                				*
	 			--------------------------------------------------------------------------------------------------------*/
				
				case(PhoneBill): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 전화 청구서에 <b>\"인터넷 컨텐츠 (음성)정보이용료\"</b>로 청구됩니다.<br><br>
					* 월 한도금액의 경우 동일한 가입자의 경우 등록된 전화번호 기준이 아닌 주민등록번호를 기준으로 책정되어 있습니다.<br><br>
					* 전화 결제취소는 당월에만 가능합니다.
					</td></tr></table>";
					break;
				
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  6. OK CASH BAG POINT					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(OCBPoint): 
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* OK CASH BAG 포인트 결제취소는 당월에만 가능합니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  7. 은행계좌이체					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(DirectBank):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 고객님의 통장에는 이용하신 상점명이 표기됩니다.<br><br>
					* 결제에 대한 상세조회는 www.inicis.com의 왼쪽 상단 <b>\"사용내역 및 청구요금 조회\"</b>에서도 확인가능합니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  8. 무통장 입금 서비스					                			*
	 			--------------------------------------------------------------------------------------------------------*/		
				case(VBank):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 상기 결과는 입금예약이 완료된 것일뿐 실제 입금완료가 이루어진 것이 아닙니다.<br /><br />
					* 상기 입금계좌로 해당 상품금액을 무통장입금(창구입금)하시거나, 인터넷 뱅킹 등을 통한 온라인 송금을 하시기 바랍니다.<br /><br />
					* 반드시 입금기한 내에 입금하시기 바라며, 대금입금시 반드시 주문하신 금액만 입금하시기 바랍니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  9. 문화상품권 결제					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(Culture):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 문화상품권을 온라인에서 이용하신 경우 오프라인에서는 사용하실 수 없습니다.<br><br>
					* 컬쳐캐쉬 잔액이 남아있는 경우, 고객님의 컬쳐캐쉬 잔액을 다시 사용하시려면 컬쳐랜드 ID를 기억하시기 바랍니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  10. K-merce 상품권 결제					                			*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(KMC_):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* K-merce 상품권은 소액결제가 가능하며, 상품권의 잔여 금액에 대해 지속적으로 사용가능합니다.<br><br>
					* K-merce 상품권 충전은 K-merce 사이트(www.k-merce.com)에서만 충전이 가능합니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  11. 틴캐시 결제					                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(TEEN):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 틴캐시는 인터넷 사이트 또는 PC방에서 자유롭게 사용할 수 있는 선불 결제수단입니다.<br><br>
					* 틴캐시 카드번호 결제 : 틴캐시 카드 뒷면에 적힌 12자리 번호를 입력하여 결제하는 방식입니다.<br><br>
					* 틴캐시 아이디 결제 : 틴캐시 사이트 (www.teencash.co.kr)에 회원가입 후 틴캐시 사이트에 접속하여 구매한 틴캐시 카드를 등록하여 이용하는 방식입니다.
					</td></tr></table>";
					break;
					
			       /*--------------------------------------------------------------------------------------------------------
	 			*													*
	 			* 결제 성공시 이용안내 보여주기 			    						*	
				*													*
	 			*  12. 게임문화 상품권 결제				                				*
	 			--------------------------------------------------------------------------------------------------------*/
	 			
				case(DGCL):  
					echo "<table width='430' border='0' cellpadding='0' cellspacing='1' bgcolor='#c6c6ba' align='center' class='al8' style='margin-top:10px;'><tr><td style='color:#9b9b8e; padding:8px;'>
					* 게임문화 상품권은 상품권에 인쇄되어있는 스크래치 번호로 결제하는 방식입니다.<br><br>
					* 게임문화 상품권 결제은 문화상품권(www.cultureland.co.kr)에서 구입 하실수 있습니다.<br><br>
					* 게임문화 상품권은 최대 6장까지 사용이 가능합니다.
					</td></tr></table>";
					break;
			}
		}
		
?>
        </td> 
  </tr> 
  <tr> 
    <td align='center' style='padding:10px; color:#9b9b8e;'>ⓒ 2010 몽키브라더스</td> 
  </tr> 
</table>
</body>
</html>
<?
	mysql_close($connect);
?>