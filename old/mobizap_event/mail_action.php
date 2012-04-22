<?
	$input_tomail = $_POST["email"]; 		
	if($input_tomail != null || $input_tomail != ""){
		$recipient = $_POST["recipient"];
		$input_type = $_POST["type"];
		$input_company = $_POST["company"];
		$input_phone = $_POST["phone"];
		$input_manager = $_POST["manager"];
		$input_comment = $_POST["comment"];
		$bgImg = "ad.png";
		
		if($input_type == "1"){
			$subject = "[광고주문의] ".$input_company;
			$bgImg = "ad.png";
		}else if($input_type == "2"){
			$subject = "[매체가입문의] ".$input_company;
			$bgImg = "media.png";
		}else $subject = "[etc] ".$input_company; 

		$mail_body = '
		<div id="cont" style="width:100%; background-color:#dadada;margin:0; padding:0;">
    	<div id="content" style=" height:768px; background:url(http://mobizap.co.kr/fva/'.$bgImg.') no-repeat;width:1024px; margin:0px auto 0 auto;">
       	  <div style=" position: relative; padding-top:320px; padding-left:360px;">
           	  <div>
				<form id="form">
           	    <table width="320" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr height="40">
                    <td>'.$input_company.'</td>
                  </tr>
                  <tr height="40">
                    <td>'.$input_phone.'</td>
                  </tr>
                  <tr height="40">
                    <td>'.$input_manager.'</td>
                  </tr>
                  <tr height="40">
                    <td>'.$input_tomail.'</td>
                  </tr>
                  <tr height="40">
                    <td></td>
                  </tr>
                  <tr height="130">
                    <td valign="top"><textarea name="comment" id="comment" cols="47" rows="7">'.$input_comment.'</textarea></td>
                  </tr>
                </tbody></table>
				</form>
              </div>
       	  </div>
        </div>
	</div>';
		$header .= "From: <".$input_tomail.">\n";
		$header .= 'MIME-Version: 1.0'."\r\n";
		$header .= 'Content-Type: text/html; charset=utf-8'."\r\n";

		$email = mail($recipient, '=?UTF-8?B?'.base64_encode($subject).'?=', $mail_body, $header);
		
		if(!$email){
			echo("fail");
			return;
		}
		echo("ok");
	}
?>