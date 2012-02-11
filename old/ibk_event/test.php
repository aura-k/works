<?
	$html = fsockopen("cm.gifticon.com/ncmSendCoupon.gc");

	echo fgets($html, 128);
?>