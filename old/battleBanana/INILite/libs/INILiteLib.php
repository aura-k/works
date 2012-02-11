<?php
/**
 * Copyright (C) 2007 INICIS Inc.
 *
 * �ش� ���̺귯���� ���� �����Ǿ�� �ȵ˴ϴ�.
 * ���Ƿ� ������ �ڵ忡 ���� å���� �������� �����ڿ��� ������ �˷��帳�ϴ�.
 */

	require_once('INILiteCls.php');

/****************************************************************************************
 **** ���Ҽ��ܺ��� PGID�� �ٸ��� ǥ���Ѵ� (2003.12.19 �븮 ������) ****
 ****************************************************************************************
 *** �ϴ��� PGID �κ��� ���Ҽ��ܺ��� TID�� ������ ǥ���ϵ��� �ϸ�,  ***
 *** ���Ƿ� �����ϴ� ��� ���� ���а� �߻� �ɼ� �����Ƿ� ����� ����  ***
 *** ���� �ʵ��� �Ͻñ� �ٶ��ϴ�.     ********************************************* 
 *** ���Ƿ� �����Ͽ� �߻��� ������ ���ؼ��� (��)�̴Ͻý��� å����    ***** 
 *** ������ ���� �Ͻñ� �ٶ��ϴ�.      ********************************************
 ***************************************************************************************/
extract($_POST);
extract($_GET);
switch($paymethod){

	case(Card): // �ſ�ī�� 
		$pgid = "CARD";
		break;
	case(Account): // ���� ���� ��ü
		$pgid = "ACCT";
		break;
	case(DirectBank): // �ǽð� ���� ��ü
		$pgid = "DBNK";
		break;
	case(OCBPoint): // OCB
		$pgid = "OCBP";
		break;
	case(VCard): // ISP ����
		$pgid = "ISP_";
		break;
	case(HPP): // �޴��� ����
		$pgid = "HPP_";
		break;
	case(ArsBill): // 700 ��ȭ����
		$pgid = "ARSB";
		break;
	case(PhoneBill): // PhoneBill ����(�޴� ��ȭ)
		$pgid = "PHNB";
		break;
	case(Ars1588Bill): // 1588 ��ȭ����
		$pgid = "1588";
		break;
	case(VBank):  // ������� ��ü
		$pgid = "VBNK";
		break;
	case(Culture):  // ��ȭ��ǰ�� ����
		$pgid = "CULT";
		break;
	case(CMS): // CMS ����
		$pgid = "CMS_";
		break;
	case(AUTH): // �ſ�ī�� ��ȿ�� �˻�
		$pgid = "AUTH";
		break;	
	case(INIcard): // ��Ƽ�Ӵ� ����
		$pgid = "INIC";
		break;
	case(MDX):  // �󵦽�ī��
		$pgid = "MDX_";
		break;
	default:        // ��� ���Ҽ��� �� �߰��Ǵ� ���Ҽ����� ��� �⺻���� paymethod�� 4�ڸ��� �Ѿ�´�.
		$pgid = $paymethod;
}

/*************************************************************************************
 *************************************************************************************
   ********************        ���κ� ���� ���� �Ұ�      ************************
 *************************************************************************************
 *************************************************************************************/
 
/*----------------------------------------------------------* 
 *������ �Һΰŷ��� ��� �Һΰ����� �ڿ� �������Һ����� ǥ��*
 *----------------------------------------------------------*/

if($quotainterest == "1")
{
	$interest = "(�������Һ�)";
}
 
/*----------------------------------------------------------*/

 
class INILite
{
	var $m_inipayHome;
    var $m_key;
	var $m_ssl;
	var $m_log;
    var $m_debug; 
	var $m_uri;
    var $m_mallencrypt;         // Encrypted
	var $m_qs = array();

	var $m_tid;					// �ŷ���ȣ
	var $m_type; 				// �ŷ� ����
	var $m_pgId; 				// ��� PG? (Inicis, SK, ...)
	var $m_resultCode; 			// ��� �ڵ� (2 digit)
	var $m_resultMsg; 			// ��� ����
	var $m_mid; 				// ���� ���̵�
	var $m_resultprice; 		// ���� �Ϸ� �ݾ�
	var $m_currency; 			// ȭ����� (WON, USD)
	var $m_pgAuthTime; 			// PG ���� �ð�
	var $m_pgAuthDate; 			// PG ���� ��¥
	var $m_payMethod; 			// ���ҹ��

	var $m_buyerName; 			// ������ ����
	var $m_buyerTel; 			// ������ ��ȭ��ȣ (SMS ���� �ݵ�� �̵���ȭ...)
	var $m_buyerEmail; 			// ������ �̸���

	var $m_goodName; 			// ��ǰ��
	var $m_subTid; 	
	var $m_price; 				// �ݾ�
	var $m_oid; 				// �ֹ���ȣ(�������� ���޵Ǵ� ��)

	var $m_cardNumber;  		// �ſ�ī�� ��ȣ
	var $m_authCode; 			// �ſ�ī�� ���ι�ȣ
	var $m_authDate; 	
	var $m_cardCode; 			// ī��� �ڵ�
	var $m_cardIssuerCode; 		// ī�� �߱޻�(����) �ڵ�
	var $m_quotaInterest; 		// �������Һ� FLAG
	var $m_cardQuota; 			// �ҺαⰣ

	var $m_directbankcode;		// ���� ������ü ������ ��� ���� �ڵ� ��ȣ
	var $m_rcash_rslt;

	var $m_vacct; 				// ������� ��ȣ
	var $m_vcdbank; 			// ä���� ���� �����ڵ�
	var $m_nmvacct; 			// ������ ��
	var $m_nminput; 			// �۱��� ��
	var $m_perno; 				// ������� ���� ������ �ֹι�ȣ
	var $m_dtinput; 			// �Ա� ������

	var $m_nohpp;
	var $m_noars;

	var $m_ocbcardnumber; 		// OK CASH BAG ���� , ������ ��� OK CASH BAG ī�� ��ȣ
	var $m_ocbSaveAuthCode; 	// OK Cashbag ���� ���ι�ȣ
	var $m_ocbUseAuthCode; 		// OK Cashbag ��� ���ι�ȣ
	var $m_ocbAuthDate; 		// OK Cashbag ���� ��¥
	var $m_price1; 				// OK Cashbag, Netimoney ���� ����ϴ� �߰� �ݾ�����
	var $m_price2; 				// OK Cashbag, Netimoney ���� ����ϴ� �߰� �ݾ�����

	var $m_cultureid;			// ���� ���� ID

    var $m_pgCancelDate;        // PG ��� ��¥
    var $m_pgCancelTime;        // PG ��� �ð�
	var $m_rcash_cancel_noappl; //���ݿ����� ��� ���� ��ȣ ����

	var $m_cancelMsg;       // ��� ����

	var $m_resulterrcode;       // ����޼��� �����ڵ�

	function startAction()
	{
		/*--------------------------------------------------*/
		/* Overhead Operation								*/
    	/*--------------------------------------------------*/
		$INIUtil = new INIUtil();
		$INILog = new INILog( $this->m_log, $this->m_debug, $this->m_type );
		if(trim($this->m_mid) == "") 
		{
			$this->MakeErrorMsg( ERR_NULL_MID, "�ʼ��׸��� �����Ǿ����ϴ�.[MID]"); 
			return;
		}
		if(!$INILog->StartLog($this->m_inipayHome, $this->m_mid)) 
		{
			$this->MakeErrorMsg( ERR_OPENLOG, "�α������� ������ �����ϴ�."); 
			return;
		}

		/*--------------------------------------------------*/
		/* Http Call										*/
    	/*--------------------------------------------------*/
		switch($this->m_type)
		{
			case("securepay") :
				//Generate TID
				if(!$INIUtil->MakeTID($this->m_pgId, $this->m_mid, $this->m_tid)) 
				{
					$err_msg = "TID������ �����߽��ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg );
					$this->MakeErrorMsg( ERR_MAKETID, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}
				$INILog->WriteLog( INFO, 'Make TID OK '.$this->m_tid );

				//Field Check
				if(trim($this->m_price) == "") 
				{
					$err_msg = "[price]�ʼ��׸��� �����Ǿ����ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg);
					$this->MakeErrorMsg( ERR_NULL_PRICE, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}

				//Encrypt
				if(!$INIUtil->MakeEncrypt($this->m_oid."|".$this->m_tid."|".$this->m_price, $this->m_key, $this->m_mallencrypt)) 
				{
					$err_msg = "��ȣȭ�� �����߽��ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg );
					$this->MakeErrorMsg( ERR_MAKEENCRYPT, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}

				//Set Field
				$this->m_uri = HTTP_SECUREPAY_URI;
				$this->m_qs["mid"] = $this->m_mid;
				$this->m_qs["mallencrypt"] = $this->m_mallencrypt;
				$this->m_qs["uid"] = $this->m_uid; 
				$this->m_qs["url"] = $this->m_url;
				$this->m_qs["uip"] = $this->m_uip;
				$this->m_qs["paymethod"] = $this->m_payMethod; 
				$this->m_qs["goodname"] = $this->m_goodName; 
				$this->m_qs["currency"] = $this->m_currency; 
				$this->m_qs["buyername"] = $this->m_buyerName; 
				$this->m_qs["buyertel"] = $this->m_buyerTel; 
				$this->m_qs["buyeremail"] = $this->m_buyerEmail; 
				$this->m_qs["parentemail"] = $this->m_ParentEmail; 
				$this->m_qs["recvname"] = $this->m_recvName; 
				$this->m_qs["recvtel"] = $this->m_recvTel; 
				$this->m_qs["recvaddr"] = $this->m_recvAddr; 
				$this->m_qs["recvpostnum"] = $this->m_recvPostNum; 
				$this->m_qs["recvmsg"] = $this->m_recvMsg; 
				$this->m_qs["sessionkey"] = $this->m_sessionKey; 
				$this->m_qs["encrypted"] = $this->m_encrypted; 

				$INILog->WriteLog( DEBUG, $this->m_qs );

				//Check Field
				if(!$INIUtil->CheckField( $this->m_qs, $err_code, $err_field)) 
				{
					$err_msg = "[$err_field]�ʼ��׸��� �����Ǿ����ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg );
					$this->MakeErrorMsg( $err_code, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}
				$INILog->WriteLog( INFO, "Check Field OK" );
				break;
		
			case("cancel") :
				//Field Check
				if(trim($this->m_tid) == "") 
				{
					$err_msg = "[tid]�ʼ��׸��� �����Ǿ����ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg);
					$this->MakeErrorMsg( ERR_NULL_TID, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}
				$INILog->WriteLog( DEBUG, "TID: ". $this->m_tid );

				//Encrypt
				if(!$INIUtil->MakeEncrypt($this->m_tid, $this->m_key, $this->m_mallencrypt)) 
				{
					$err_msg = "��ȣȭ�� �����߽��ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg );
					$this->MakeErrorMsg( ERR_MAKEENCRYPT, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}

				//Set Field
				$this->m_uri = HTTP_CANCEL_URI;
				$this->m_qs["mid"] = $this->m_mid;
				$this->m_qs["mallencrypt"] = $this->m_mallencrypt;
				$this->m_qs["msg"] = $this->m_cancelMsg; 
				$INILog->WriteLog( DEBUG, $this->m_qs );

				break;

		}

		//initailize httpclient
		$httpclient = new HttpClient( $this->m_ssl );

		//connect
		if( !$httpclient->HttpConnect($INILog) )
		{
			$INILog->WriteLog( ERROR, 'Server Connect Error!!' . $httpclient->getErrorMsg() );
			$resultMsg = $httpclient->getErrorMsg()."���������� �� ���� �����ϴ�.";
			if( $this->m_ssl )
			{
				$resultMsg .= "<br>������ ������ SSL����� �������� �ʽ��ϴ�. ����ó�����Ͽ��� m_ssl=false�� �����ϰ� �õ��ϼ���.";
				$this->MakeErrorMsg( ERR_SSLCONN, $resultMsg); 
			}
			else
			{
				$this->MakeErrorMsg( ERR_CONN, $resultMsg); 
			}
			$INILog->CloseLog( $this->m_resultMsg );
			return;
		}

		//request
		if( !$httpclient->HttpRequest($this->m_uri, $this->m_qs, $INILog) )
		{
			$INILog->WriteLog( ERROR, 'POST Error!!' . $httpclient->getErrorMsg() );
			$resultMsg = $httpclient->getErrorMsg()."���������� �߻��߽��ϴ�.";
			$this->MakeErrorMsg( ERR_RESPONSE, $resultMsg); 
			//NET CANCEL Start---------------------------------
			if( $httpclient->getErrorCode() == READ_TIMEOUT_ERR )
			{
				$INILog->WriteLog( INFO, "Net Cancel Start" );
		
				//Encrypt
				if(!$INIUtil->MakeEncrypt($this->m_tid, $this->m_key, $this->m_mallencrypt)) 
				{
					$err_msg = "��ȣȭ�� �����߽��ϴ�.";
					$INILog->WriteLog( ERROR, $err_msg );
					$this->MakeErrorMsg( ERR_MAKEENCRYPT, $err_msg ); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}

				//Set Field
				$this->m_uri = HTTP_CANCEL_URI;
				unset($this->m_qs);
				$this->m_qs["mid"] = $this->m_mid;
				$this->m_qs["mallencrypt"] = $this->m_mallencrypt;
				$this->m_qs["msg"] = "Ÿ�Ӿƿ����� ���� NetCancel"; 

				if( !$httpclient->HttpConnect($INILog) )
				{
					$INILog->WriteLog( ERROR, 'Server Connect Error!!' . $httpclient->getErrorMsg() );
					$resultMsg = $httpclient->getErrorMsg()."���������� �� ���� �����ϴ�.";
					$this->MakeErrorMsg( ERR_CONN, $resultMsg); 
					$INILog->CloseLog( $this->m_resultMsg );
					return;
				}
				if( !$httpclient->HttpRequest($this->m_uri, $this->m_qs, $INILog) && 
					($httpclient->getErrorCode() == READ_TIMEOUT_ERR) )
				{
					$INILog->WriteLog( INFO, "Net Cancel FAIL" );
					if( $this->m_type == "securepay")
						$this->MakeErrorMsg( ERR_RESPONSE, "���ο��� Ȯ�ο��"); 
					else if( $this->m_type == "cancel")
						$this->MakeErrorMsg( ERR_RESPONSE, "�ּҿ��� Ȯ�ο��"); 
				}
				else
				{
					$INILog->WriteLog( INFO, "Net Cancel SUCESS" );
				}
			}
			//NET CANCEL End---------------------------------
			$INILog->CloseLog( $this->m_resultMsg );
			return;
		}

		//error check 
		if( $httpclient->getStatus() != 200 )
		{
			$INILog->WriteLog( ERROR, 'Status Error!!' . $httpclient->getStatus().$httpclient->getErrorMsg().$httpclient->getHeaders() );
			$resultMsg = $httpclient->getStatus()."���������� �߻��߽��ϴ�.";
			$this->MakeErrorMsg( ERR_RESPONSE, $resultMsg); 
			$INILog->CloseLog( $this->m_resultMsg );
			return;
		}

		/*--------------------------------------------------*/
		/* Xml Parsing										*/
        /*--------------------------------------------------*/
		// parsing 
		$xml = new XMLParser();

		$xml->xmldata = $xml->Xml2Array($httpclient->getBody());

		$INILog->WriteLog( DEBUG, "Parsing OK" );

		// get xml data 
		if($this->m_type == "securepay" && $xml->existNData('payment-result'))
		{
			$this->m_resultCode = $xml->getXMLData('resultcode');
			$this->m_resultMsg = $xml->getXMLData('resultmessage');
			$this->m_mid = $xml->getXMLData('mid');
			$this->m_tid = $xml->getXMLData('tid');

			$this->m_resultprice = $xml->getXMLData('totalprice');
			$this->m_currency = $xml->getXMLData('currency');
			$this->m_pgAuthTime = $xml->getXMLData('pgauthtime');
			$this->m_pgAuthDate = $xml->getXMLData('pgauthdate');
			$this->m_payMethod = $xml->getXMLData('paymethod');
			if($xml->existNData('payment-result','buyer'))
			{	
				$this->m_buyerName = $xml->getXMLData('buyername');
				$this->m_buyerTel = $xml->getXMLData('buyertel');
				$this->m_buyerEmail = $xml->getXMLData('buyeremail');
			}
			if($xml->existNData('payment-result','paySet'))
			{	
				$this->m_goodName = $xml->getXMLData('goodname');
				$this->m_subTid = $xml->getXMLData('subtid');
				$this->m_price = $xml->getXMLData('price');
				$this->m_oid = $xml->getXMLData('oid');

				if($xml->existNData('payment-result','paySet','cardPay'))
				{	
					$this->m_cardNumber = $xml->getXMLData('cardnumber');
					$this->m_authCode = $xml->getXMLData('authcode');
					$this->m_authDate = $xml->getXMLData('authdate');
					$this->m_cardCode = $xml->getXMLData('cardcode');
					$this->m_cardIssuerCode = $xml->getXMLData('cardissuercode');
					$this->m_quotaInterest = $xml->getXMLData('quotainterest');
					$this->m_cardQuota = $xml->getXMLData('cardquota');
				}

				if($xml->existNData('payment-result','paySet','directbankPay'))
				{	
					$this->m_directbankcode = $xml->getXMLData('directbankcode');	// �ǽð� ���������ü �����ڵ�
					$this->m_rcash_rslt = $xml->getXMLData('rcash_rslt');		// ���ݿ����� �߱��ڵ� (4�ڸ�)
				}

				if($xml->existNData('payment-result','paySet','vbankPay'))
				{	
					$this->m_vacct = $xml->getXMLData('vacct');
					$this->m_vcdbank = $xml->getXMLData('vcdbank');
					$this->m_nmvacct = $xml->getXMLData('nmvacct');
					$this->m_nminput = $xml->getXMLData('nminput');
					$this->m_perno = $xml->getXMLData('perno');
					$this->m_dtinput = $xml->getXMLData('dtinput');
				}
				if($xml->existNData('payment-result','paySet','hppPay'))
				{	
					$this->m_nohpp = $xml->getXMLData('nohpp'); 
				}
				if($xml->existNData('payment-result','paySet','ars1588billPay'))
				{	
					$this->m_noars = $xml->getXMLData('noars');
				}
				if($xml->existNData('payment-result','paySet','phonebillPay'))
				{	
					$this->m_noars = $xml->getXMLData('noars');
				}
				if($xml->existNData('payment-result','paySet','ocbpointPay'))
				{	
					$this->m_ocbcardnumber = $xml->getXMLData('ocbcardnumber'); 	// OCB ī���ȣ	
					$this->m_ocbSaveAuthCode = $xml->getXMLData('ocbsaveauthcode');
					$this->m_ocbUseAuthCode = $xml->getXMLData('ocbuseauthcode');
					$this->m_ocbAuthDate = $xml->getXMLData('ocbauthdate');
					$this->m_price1 = $xml->getXMLData('price1');
					$this->m_price2 = $xml->getXMLData('price2');
				}
				if($xml->existNData('payment-result','paySet','culturePay'))
				{	
					$this->m_cultureid = $xml->getXMLData('cultureid');		// ��ó���� ID, ƾĳ�� ID
				}
			}
		} // End Of securepay
		else if($this->m_type == "cancel" && $xml->existNData('cancel-result'))
		{
			$this->m_resultCode = $xml->getXMLData('resultcode');
			$this->m_resultMsg = $xml->getXMLData('resultmessage');
			$this->m_mid = $xml->getXMLData('mid');
			$this->m_tid = $xml->getXMLData('tid');
			$this->m_pgCancelDate = $xml->getXMLData('pgcanceldate');;        // PG ��� ��¥
			$this->m_pgCancelTime = $xml->getXMLData('pgcanceltime');;        // PG ��� �ð�
			$this->m_rcash_cancel_noappl= $xml->getXMLData('rcash_cancel_noappl');
		} // End Of cancel
		else
		{
			$this->MakeErrorMsg( ERR_XML, "����XML�� �ùٸ��� �ʽ��ϴ�."); 
			$INILog->WriteLog( ERROR, $this->m_resultMsg );
		}

		if( $this->m_resultCode != "00" )
		{
        	$arr = split("\]+", $this->m_resultMsg);
        	$this->m_resulterrcode = substr($arr[0],1); // []���� �ڵ常 ǥ��
		}

		$INILog->CloseLog( $this->m_resultMsg );

	} // End of StartAction

	function MakeErrorMsg($err_code, $err_msg)
	{
		$this->m_resultCode = "01";
		$this->m_resulterrcode = $err_code;
		$this->m_resultMsg = "[".$err_code."][".$err_msg."]";
	}
}

?>
