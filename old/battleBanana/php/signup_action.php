<? 
session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 
/*
echo $_POST['signup_name']."\n";
echo $_POST['idnumber']."\n";
echo $_POST['idnumber2']."\n";
echo $_POST['signup_id']."\n";
echo $_POST['signup_pass']."\n";
echo $_POST['email']."\n";
echo "세션:".$_SESSION["access"];
*/
$currentTime = date("Y-m-d H:i:s", mktime());
$item_id = "B_signup";

$result = @mysql_query('SET AUTOCOMMIT=0'); //트랜젝션시작
$result = @mysql_query('BEGIN');
$okFlag = true; //분기플래그(RollBack하기 위한 sql구문오류 검출 플래그)

$query = "INSERT INTO `BBanana_users`(`user_id`, `user_name`, `regi_number`, `password`, `email`, `created`, `recommend_id`) VALUES('".$_POST['signup_id']."', '".$_POST['signup_name']."', '".$_POST['idnumber']."', OLD_PASSWORD('".$_POST['signup_pass']."'), '".$_POST['email']."', '".$currentTime."', '".$_POST['reco']."');";
$result = @mysql_query($query); 
if(!$result || @mysql_affected_rows() == 0) $okFlag = false;

$query = "INSERT INTO `BBanana_bananas`(`user_id`, `banana_in`, `current_banana`, `action_date`, `item_id`, `comment`) 
VALUES('".$_POST['signup_id']."', '5', '5', '".mktime()."', '".$item_id."', '무료 바나나 충전 &lt;회원가입&gt;');";
$result = @mysql_query($query); 
if(!$result || @mysql_affected_rows() == 0) $okFlag = false;


if(!$okFlag){
	$result = @mysql_query("ROLLBACK");//하나라도 실패한 값이 있다면 RollBack한다.
	echo("회원가입에 실패 하였습니다.\n잠시 후 다시한번 시도해 주세요.");
}else{
	$result = @mysql_query($BATTLEBANANA_ACTION);//모두 성공하면 Commit.
	
	$recipient = $_POST["email"];
	$subject = "[BattleBanana] ".$_POST['signup_name']."님의 회원가입을 축하합니다.";

	$mail_body = "<style> 
				p {margin:0px; border:0;}
				a:link {color: #a3a3a3;text-decoration:none;}
				a:visited {color: #a3a3a3; text-decoration:none;}
				a:hover {color: #6f6f6f; text-decoration:none;}
				</style><table width='500' border='0' cellspacing='0' cellpadding='0' bgcolor='#e8e8dc'> 
				  <tr> 
					<td align='right'><img src='http://www.battlebanana.com/img/mail/edge.gif' alt='배경'/></td> 
				  </tr> 
				  <tr> 
					<td style='padding:0 15px 15px 15px; font-size:25px; line-height:25px;'><img src='http://www.battlebanana.com/img/mail/tit_share.gif' /></td> 
				  </tr> 
				  <tr> 
					<td style='padding:15px;'>
						  <p>".$_POST['signup_name']."님 배틀바나나에 오신 것을 환영합니다.<BR><BR></p>

							<p>배틀바나나는 최신 트렌드 상품들을 저렴한 가격에 살 수 있는 기회와<BR>
							온라인 게임의 묘미를 결합한 서비스로<BR>
							세계에서 가장 혁신적인 전자상거래 서비스입니다.<BR><BR></p>

							<p>감사합니다. </p>
				   </td> 
				  </tr> 
				  <tr> 
					<td align='center'><a href='http://www.battlebanana.com' target='_blank'><img src='http://www.battlebanana.com/img/mail/img_mail_bb.gif' alt='배틀바나나' name='img_mail_bb' border='0' id='img_mail_bb' onmouseover=javascript:img_mail_bb.src='http://www.battlebanana.com/img/mail/img_mail_bb_o.gif'; onmouseout=javascript:img_mail_bb.src='http://www.battlebanana.com/img/mail/img_mail_bb.gif';/></a></td> 
				  </tr> 
				  <tr> 
					<td align='center' style='padding:15px;'>© 2010 배틀바나나</td> 
				  </tr> 
				</table>";
	
	$header .= "From: \"Battle Banana\" <monkey@battlebanana.com>\n";
	$header .= 'MIME-Version: 1.0'."\r\n";
	$header .= 'Content-Type: text/html; charset=utf-8'."\r\n";
	
	$email = mail($recipient, '=?UTF-8?B?'.base64_encode($subject).'?=', $mail_body, $header);
	
	echo("회원가입이 완료 되었습니다.\n재로그인 후 이용해 주세요.\n감사합니다.");
}

mysql_close($connect);

session_destroy();
?>