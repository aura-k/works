<? 
	session_start();
	include "./connect.php";
	if(!$_SESSION['ID']){
		echo('login');
		return;
	}
	

	$sql=mysql_query("select * from BBanana_items where item_id = '".$_POST['sid_layer']."'") or die(mysql_error()); 
	$row=mysql_fetch_array($sql);

	$new_exp = $row['item_expired'] - mktime();
	if($new_exp <= 0) $ins_time = '경매가 종료 되었습니다.';
	
	$hour = floor($new_exp/3600);
	$min = floor($new_exp%3600/60);
	$sec = $new_exp%3600%60;
	
	if($hour < 10) $hour = "0".$hour;
	if($min < 10) $min = "0".$min;
	if($sec < 10) $sec = "0".$sec;
	
	$ins_time = '경매마감까지 '.$hour.'시간 '.$min.'분 '.$sec.'초 남았습니다. (메일 작성시간 기준)';
	
	$recipient = $_POST["email"];
	$subject = "[BattleBanana] ".$row['item_fname']."의 경매가 진행중 입니다.";
	$mail_body = 
	"<style> 
p {margin:0px; border:0;}
a:link {color: #a3a3a3;text-decoration:none;}
a:visited {color: #a3a3a3; text-decoration:none;}
a:hover {color: #6f6f6f; text-decoration:none;}
</style><table width='470' border='0' cellspacing='0' cellpadding='0' bgcolor='#e8e8dc' style='font-family:굴림;'> 
  <tr> 
    <td align='right'><img src='http://www.battlebanana.com/img/mail/edge.gif' alt='배경'/></td> 
  </tr> 
  <tr> 
    <td style='padding:0 15px 15px 15px;'><img src='http://www.battlebanana.com/img/mail/tit_share.gif' /></td> 
  </tr> 
  <tr> 
    <td style='padding:15px;'><p>현재 <span style='font-weight:bold;'>".$row['item_fname']."</span>의 경매가 진행중입니다.</p> 
    <p>".$ins_time."</p> 
    <p>&nbsp;</p> 
    <p><table width='132' border='0' cellpadding='0' cellspacing='0'> 
          <tr> 
            <td width='64'>정&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;가 :</td> 
            <td class='ar'>".number_format($row['item_rrp'])." 원</td> 
          </tr> 
          <tr> 
            <td>현재가격 :</td> 
            <td class='ar'>".number_format($row['item_price'])." 원</td> 
          </tr> 
        </table> 
    </p> 
    <p>&nbsp;</p> 
    <p>경매주소 : <a href='http://www.battlebanana.com/html/sub.html?sid=".$_POST['sid_layer']."' target='_blank'>http://www.battlebanana.com/html/sub.html?sid=".$_POST['sid_layer']."</a></p> 
   </td> 
  </tr> 
  <tr> 
    <td style='padding:15px;'><b>".$_SESSION["NAME"]."(".$_SESSION["ID"].") : </b>".$_POST['comment']."</td> 
  </tr> 
  <tr> 
    <td align='center'><a href='http://www.battlebanana.com' target='_blank'><img src='http://www.battlebanana.com/img/mail/img_mail_bb.gif' alt='배틀바나나' name='img_mail_bb' border='0' id='img_mail_bb' onmouseover=javascript:img_mail_bb.src='http://www.battlebanana.com/img/mail/img_mail_bb_o.gif'; onmouseout=javascript:img_mail_bb.src='http://www.battlebanana.com/img/mail/img_mail_bb.gif';/></a></td> 
  </tr> 
  <tr> 
    <td align='center' style='padding:15px; color:#9b9b8e;'>© 2010 몽키브라더스</td> 
  </tr> 
</table>";
	//$_POST['email']."<br/>".$_POST['comment']."<br/>".$_POST['exp_layer']."<br/>".$_POST['rrp_layer']."<br/>".$_POST['pri_layer']."<br/>";
	$header .= "From: \"BattleBanana\" <monkey@battlebanana.com>\n";
	$header .= 'MIME-Version: 1.0'."\r\n";
	$header .= 'Content-Type: text/html; charset=utf-8'."\r\n";

	$email = mail($recipient, '=?UTF-8?B?'.base64_encode($subject).'?=', $mail_body, $header);
	
	if(!$email){
		echo("메일발송에 실패 하였습니다.\n잠시 후 다시한번 시도해 주세요.");
		return;
	}
	echo("Email이 ".$_POST['email']."로 발송되었습니다.");

	mysql_close($connect);
?>