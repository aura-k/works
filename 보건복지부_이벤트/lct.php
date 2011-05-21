<?
	include "logFn.php";

	$no	= $_GET['no'];

	switch($no) {
		case 1:
			$page	= "policy.html";
			$log	= "184";
			break;
		case 2:
			$page	= "index3.php";
			$log	= "247";
			break;
		case 3:
			$page	= "_blank.html";
			$log	= "186";
			break;
		case 4:
			$page	= "_blank.html";
			$log	= "174";
			break;
		case 5:
			$page	= "policy.html";
			$log	= "184";
			break;
		case 6:
			$page	= "webtoon.html";
			$log	= "185";
			break;
		case 7:
			$page	= "http://tagtv.co.kr/mom";
			$log	= "183";
			break;
	}

	writeLog($log);

?>

<script>
	location.href = "<?=$page?>";
</script>