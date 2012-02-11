<? 
function generateRandomPassword($length=8, $strength=4) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }

    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

session_cache_limiter(''); 
session_start(); 
include "define_battle.php";
include "connect.php"; //디비 정의 페이지 
include "sess_func.php"; //함수 정의 페이지 include 

$str = "select * from BBanana_users where user_name='".$_POST["name"]."' && regi_number='".$_POST["idnumber"]."' && email='".$_POST["email"]."'";

$sql = mysql_query($str) or die(mysql_error()); 
$row = mysql_fetch_array($sql);
if (!$row) { 
    echo("메일발송에 실패 하였습니다.\n잠시 후 다시한번 시도해 주세요.");
} 
else { 
	$pass = generateRandomPassword();
	$str2 = "update `BBanana_users` set password = old_password('".$pass."') where regi_number='".$_POST["idnumber"]."' && email='".$_POST["email"]."'";
	$sql2 = mysql_query($str2) or die(mysql_error()); 
	$result = @mysql_query($BATTLEBANANA_ACTION);
	if ($sql2) { 
		$recipient = $_POST["email"];
		$subject = "[BattleBanana] 비밀번호 안내 메일";
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
		  <p>".$_POST["name"]."(".$row["user_id"].")님의 비밀번호가</p>
          <p>&nbsp;</p>
          <p><b>".$pass."</b></p>
          <p>&nbsp;</p>
          <p>로 임시변경되었습니다.</p>
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
		if(!$email) echo("메일발송에 실패 하였습니다.\n잠시 후 다시한번 시도해 주세요.");
		echo("변경된 비밀번호가 메일로 발송되었습니다.");
	}else{
		echo("메일발송에 실패 하였습니다.\n잠시 후 다시한번 시도해 주세요.");
	}
}

mysql_close($connect);

session_destroy();
?>