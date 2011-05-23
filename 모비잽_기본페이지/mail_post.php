<?
$recipient = "mobizap@mobizap.co.kr";

if($_POST["type"] == "1") $recipient = "mobizap@mobizap.co.kr";
else if($_POST["type"] == "2") $recipient = "anjong.kim@semanticrep.com";

$post_data = array(
	"email" => $_POST["email"],
	"recipient" => $recipient,
	"type" => $_POST["type"],
	"company" => $_POST["company"],
	"phone" => $_POST["phone"],
	"manager" => $_POST["manager"],
	"comment" => $_POST["comment"]
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://neonfly.co.kr/fva/mail_action.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_exec($ch);

?>