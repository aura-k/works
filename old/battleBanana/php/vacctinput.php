<?php

//*******************************************************************************
// FILE NAME : INIpayResult.php
// DATE : 2009.07
// �̴Ͻý� ������� �Աݳ��� ó��demon���� �Ѿ���� �Ķ���͸� control �ϴ� �κ� �Դϴ�.
//*******************************************************************************

//**********************************************************************************
//�̴Ͻý��� �����ϴ� ���������ü�� ����� �����Ͽ� DB ó�� �ϴ� �κ� �Դϴ�.
//�ʿ��� �Ķ���Ϳ� ���� DB �۾��� �����Ͻʽÿ�.
//**********************************************************************************

@extract($_GET);
@extract($_POST);
@extract($_SERVER);


//**********************************************************************************
//  �̺κп� �α����� ��θ� �������ּ���.	

$INIpayHome = "/home/banana/public_html/INIpay50";      // �̴����� Ȩ���͸�

//**********************************************************************************


$TEMP_IP = getenv("REMOTE_ADDR");
$PG_IP  = substr($TEMP_IP,0, 10);

if( $PG_IP == "203.238.37" || $PG_IP == "210.98.138" )  //PG���� ���´��� IP�� üũ
{
        $msg_id = $msg_id;             //�޼��� Ÿ��
        $no_tid = $no_tid;             //�ŷ���ȣ
        $no_oid = $no_oid;             //���� �ֹ���ȣ
        $id_merchant = $id_merchant;   //���� ���̵�
        $cd_bank = $cd_bank;           //�ŷ� �߻� ��� �ڵ�
        $cd_deal = $cd_deal;           //��� ��� �ڵ�
        $dt_trans = $dt_trans;         //�ŷ� ����
        $tm_trans = $tm_trans;         //�ŷ� �ð�
        $no_msgseq = $no_msgseq;       //���� �Ϸ� ��ȣ
        $cd_joinorg = $cd_joinorg;     //���� ��� �ڵ�

        $dt_transbase = $dt_transbase; //�ŷ� ���� ����
        $no_transeq = $no_transeq;     //�ŷ� �Ϸ� ��ȣ
        $type_msg = $type_msg;         //�ŷ� ���� �ڵ�
        $cl_close = $cl_close;         //���� �����ڵ�
        $cl_kor = $cl_kor;             //�ѱ� ���� �ڵ�
        $no_msgmanage = $no_msgmanage; //���� ���� ��ȣ
        $no_vacct = $no_vacct;         //������¹�ȣ
        $amt_input = $amt_input;       //�Աݱݾ�
        $amt_check = $amt_check;       //�̰��� Ÿ���� �ݾ�
        $nm_inputbank = $nm_inputbank; //�Ա� ���������
        $nm_input = $nm_input;         //�Ա� �Ƿ���
        $dt_inputstd = $dt_inputstd;   //�Ա� ���� ����
        $dt_calculstd = $dt_calculstd; //���� ���� ����
        $flg_close = $flg_close;       //���� ��ȭ

        //�������ä���� ���ݿ����� �ڵ��߱޽�û�ÿ��� ����
        $dt_cshr      = $dt_cshr;       //���ݿ����� �߱�����
        $tm_cshr      = $tm_cshr;       //���ݿ����� �߱޽ð�
        $no_cshr_appl = $no_cshr_appl;  //���ݿ����� �߱޹�ȣ
        $no_cshr_tid  = $no_cshr_tid;   //���ݿ����� �߱�TID

        $logfile = fopen( $INIpayHome . "/log/result.log", "a+" );


        fwrite( $logfile,"************************************************");
        fwrite( $logfile,"ID_MERCHANT : ".$id_merchant."\r\n");
        fwrite( $logfile,"NO_TID : ".$no_tid."\r\n");
        fwrite( $logfile,"NO_OID : ".$no_oid."\r\n");
        fwrite( $logfile,"NO_VACCT : ".$no_vacct."\r\n");
        fwrite( $logfile,"AMT_INPUT : ".$amt_input."\r\n");
        fwrite( $logfile,"NM_INPUTBANK : ".$nm_inputbank."\r\n");
        fwrite( $logfile,"NM_INPUT : ".$nm_input."\r\n");
        fwrite( $logfile,"************************************************");

        /*
        fwrite( $logfile,"��ü �����"."\r\n");
        fwrite( $logfile, $msg_id."\r\n");
        fwrite( $logfile, $no_tid."\r\n");
        fwrite( $logfile, $no_oid."\r\n");
        fwrite( $logfile, $id_merchant."\r\n");
        fwrite( $logfile, $cd_bank."\r\n");
        fwrite( $logfile, $dt_trans."\r\n");
        fwrite( $logfile, $tm_trans."\r\n");
        fwrite( $logfile, $no_msgseq."\r\n");
        fwrite( $logfile, $type_msg."\r\n");
        fwrite( $logfile, $cl_close."\r\n");
        fwrite( $logfile, $cl_kor."\r\n");
        fwrite( $logfile, $no_msgmanage."\r\n");
        fwrite( $logfile, $no_vacct."\r\n");
        fwrite( $logfile, $amt_input."\r\n");
        fwrite( $logfile, $amt_check."\r\n");
        fwrite( $logfile, $nm_inputbank."\r\n");
        fwrite( $logfile, $nm_input."\r\n");
        fwrite( $logfile, $dt_inputstd."\r\n");
        fwrite( $logfile, $dt_calculstd."\r\n");
        fwrite( $logfile, $flg_close."\r\n");
        fwrite( $logfile, "\r\n");
        */

        fclose( $logfile );

		include "../../php/connect.php"; //��� ���� ������ 
		$sql = mysql_query("UPDATE `BBanana_ships` SET is_deposit = 'yes', deposit_date = '".$dt_trans.$tm_trans."' WHERE order_num = '".$no_oid."'");
		
		if(substr($no_oid,0,1) == "B"){//�ٳ������������ϰ�� �ٳ������� �ٷ� ����
			include "../../php/charge_action.php";
			$isOK = chargeAction($no_oid);//�ٳ��� ���� ����
			if(!$isOK) $cancelFlag = "true";//������ ������ ��� ��ü������ �����
		}
//************************************************************************************

        //������ ���� �����ͺ��̽��� ��� ���������� ���� �����ÿ��� "OK"�� �̴Ͻý���
        //�����ϼž��մϴ�. �Ʒ� ���ǿ� �����ͺ��̽� ������ �޴� FLAG ������ ��������
        //(����) OK�� �������� �����ø� �̴Ͻý� ���� ������ "OK"�� �����Ҷ����� ��� �������� �õ��մϴ�
        //��Ÿ �ٸ� ������ PRINT( echo )�� ���� �����ñ� �ٶ��ϴ�

     if ($sql = true)
      {

                echo "OK";                        // ����� ������������

      }

//*************************************************************************************
		mysql_close($connect);
}
?>
