<%@ Page Language="C#" AutoEventWireup="true" CodeFile="insert_event.aspx.cs" Inherits="insert_event" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>IBK</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content='width=device-width; initial-scale=1.0; maximum-scale=3.0; user-scalable=1;' name='viewport' /> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link href="insert_style.css" rel="stylesheet" type="text/css"/> 
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script language="javascript" src="insert_script.js" type="text/javascript"></script> 
	<script type="text/javascript">
		$.get('log.aspx?p=event',function(data){ });
		
		function extractOnlyNumber(val)
		{
			replace = /[^0-9]/gi;
			return val.replace(replace, ''); 
		}
		
		function isValidPhoneNumber(val)
		{
			// 010-1111-2222
			// 010-111-2222
			
			if (val.length < 10)
			{
				return false;
			}
			else if (val.length > 11)
			{
				return false;
			}
			else if (
				val.substr(0, 3) != '010' &&
				val.substr(0, 3) != '011' &&
				val.substr(0, 3) != '016' &&
				val.substr(0, 3) != '017' &&
				val.substr(0, 3) != '018' &&
				val.substr(0, 3) != '019'
			)
			{
				return false;
			}
			
			return true;
		}
		
		function ToReadableTelNumber(val)
		{
			if (val.length == 10)
			{
				return val.substr(0, 3) + '-' + val.substr(3, 3) + '-' + val.substr(6,4);
			}
			else if (val.length == 11)
			{
				return val.substr(0, 3) + '-' + val.substr(3, 4) + '-' + val.substr(7,4);
			}
			else
			{
				return val;
			}
		}
		
		var isProcessing = 0;
		function apply(isAgree)
		{
			var my_name = $('#my_name').val().trim();
			var my_phone = extractOnlyNumber($('#my_phone').val().trim());
			var friend_1_phone = extractOnlyNumber($('#friend_1_phone').val().trim());
			var friend_2_phone = extractOnlyNumber($('#friend_2_phone').val().trim());
			var friend_3_phone = extractOnlyNumber($('#friend_3_phone').val().trim());
			
			$('#my_phone').val(my_phone);
			$('#friend_1_phone').val(friend_1_phone);
			$('#friend_2_phone').val(friend_2_phone);
			$('#friend_3_phone').val(friend_3_phone);
			
			if (my_name == '')
			{
				alert('���� �̸��� �Է��� �ּ���.');
				$('#my_name').focus();
				return;
			}
			else if (my_phone == '')
			{
				alert("���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#my_phone').focus();
				return;
			}
			else if (isValidPhoneNumber(my_phone) == false)
			{
				alert("�ùٸ��� ���� ��ȭ��ȣ�Դϴ�.\n���� ��ȭ��ȣ�� Ȯ���� �ּ���.");
				$('#my_phone').focus();
				return;
			}
			else if (friend_1_phone == '')
			{
				alert("ģ��1�� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_1_phone').focus();
				return;
			}
			else if (isValidPhoneNumber(friend_1_phone) == false)
			{
				alert("�ùٸ��� ���� ��ȭ��ȣ�Դϴ�.\nģ��1�� ��ȭ��ȣ�� Ȯ���� �ּ���.");
				$('#friend_1_phone').focus();
				return;
			}
			else if (friend_2_phone == '')
			{
				alert("ģ��2�� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_2_phone').focus();
				return;
			}
			else if (isValidPhoneNumber(friend_2_phone) == false)
			{
				alert("�ùٸ��� ���� ��ȭ��ȣ�Դϴ�.\nģ��2�� ��ȭ��ȣ�� Ȯ���� �ּ���.");
				$('#friend_2_phone').focus();
				return;
			}
			else if (friend_3_phone == '')
			{
				alert("ģ��3�� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_3_phone').focus();
				return;
			}
			else if (isValidPhoneNumber(friend_3_phone) == false)
			{
				alert("�ùٸ��� ���� ��ȭ��ȣ�Դϴ�.\nģ��3�� ��ȭ��ȣ�� Ȯ���� �ּ���.");
				$('#friend_3_phone').focus();
				return;
			}
			else if (my_phone == friend_1_phone)
			{
				alert("���� ��ȭ��ȣ�� ģ��1�� ��ȭ��ȣ�� �����մϴ�.\nģ���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_1_phone').focus();
				return;
			}
			else if (my_phone == friend_2_phone)
			{
				alert("���� ��ȭ��ȣ�� ģ��2�� ��ȭ��ȣ�� �����մϴ�.\nģ���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_2_phone').focus();
				return;
			}
			else if (my_phone == friend_3_phone)
			{
				alert("���� ��ȭ��ȣ�� ģ��3�� ��ȭ��ȣ�� �����մϴ�.\nģ���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_3_phone').focus();
				return;
			}
			else if (friend_1_phone == friend_2_phone)
			{
				alert("ģ��1�� ��ȭ��ȣ�� ģ��2�� ��ȭ��ȣ�� �����մϴ�.\n�ٸ� ģ���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_2_phone').focus();
				return;
			}
			else if (friend_1_phone == friend_3_phone)
			{
				alert("ģ��1�� ��ȭ��ȣ�� ģ��3�� ��ȭ��ȣ�� �����մϴ�.\n�ٸ� ģ���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_3_phone').focus();
				return;
			}
			else if (friend_2_phone == friend_3_phone)
			{
				alert("ģ��2�� ��ȭ��ȣ�� ģ��3�� ��ȭ��ȣ�� �����մϴ�.\n�ٸ� ģ���� ��ȭ��ȣ�� �Է��� �ּ���.");
				$('#friend_3_phone').focus();
				return;
			}
			
			/*if (isAgree == false)
			{
				if (confirm("���� �̸� : " + my_name + "\n���� ��ȭ : " + ToReadableTelNumber(my_phone) + "\nģ��1 ��ȭ :" + ToReadableTelNumber(friend_1_phone) + "\nģ��2 ��ȭ : " + ToReadableTelNumber(friend_2_phone) + "\nģ��3 ��ȭ : " + ToReadableTelNumber(friend_3_phone) + "\n\n�Է��Ͻ� ������ �½��ϱ�?"))
				{
					$('#event').css('display', 'none');
					$('#privacy').css('display', 'block');
				}
			}
			else*/
			{
				if (isProcessing == 0)
				{
					if (confirm("���� �̸� : " + my_name + "\n���� ��ȭ : " + ToReadableTelNumber(my_phone) + "\nģ��1 ��ȭ :" + ToReadableTelNumber(friend_1_phone) + "\nģ��2 ��ȭ : " + ToReadableTelNumber(friend_2_phone) + "\nģ��3 ��ȭ : " + ToReadableTelNumber(friend_3_phone) + "\n\n�Է��Ͻ� ������ �½��ϱ�?"))
					{
						isProcessing = 1;
						
						$.post("insert_event_processor.aspx", {my_name: my_name, my_phone: my_phone, friend_1_phone: friend_1_phone, friend_2_phone: friend_2_phone, friend_3_phone: friend_3_phone}, function(data){
							if (data == "SUCC")
							{
								$('#event').css('display', 'none');
								$('#finish').css('display', 'block');
								
								$('#finish_name').text(my_name);
								$('#finish_my_number').text(ToReadableTelNumber(my_phone));
								$('#finish_number').html(ToReadableTelNumber(friend_1_phone) + '<br />' + ToReadableTelNumber(friend_2_phone) + '<br />' + ToReadableTelNumber(friend_3_phone));
							}
							else
							{
								//alert(data);
								
								$('#duplicated_number').html('');
								var numbers = data.split(',');
								
								for (var i = 0; i < numbers.length; i++)
								{
									if (isValidPhoneNumber(numbers[i]) == true)
									{
										$('#duplicated_number').html(ToReadableTelNumber(numbers[i]) + "<br />" + $('#duplicated_number').html());
									}
								}
								
								$('#event').css('display', 'none');
								$('#duplicated').css('display', 'block');
							}	
						});
					}
				}
			}
		}
		
		function retry()
		{
			isProcessing = 0;
			$('#duplicated').css('display', 'none');
			$('#event').css('display', 'block');
		}
		
		function disagree()
		{
			if (confirm("�������� ������ �̺�Ʈ�� ������ �� ������, ó��ȭ������ �̵��մϴ�."))
			{
				document.location.href = "index2.aspx";
			}
		}
		
		function movie()
		{
			$.get('log.aspx?p=evtmov', function(data){
				//var vid	= document.getElementById("__videoDispatcherViewer");
				//vid.src	= "http://brightcove.vo.llnwd.net/d14/unsecured/media/88960803001/88960803001_818989279001_IBK-20-.mp4?pub-id=88960803001";
				//vid.play();
				
				document.location.href = "http://brightcove.vo.llnwd.net/d14/unsecured/media/88960803001/88960803001_818989279001_IBK-20-.mp4?pub-id=88960803001";
			});
		}
		
		function twitter()
		{
			$.get('log.aspx?p=event_twitter', function(data){
				document.location.href = 'http://twitter.com/home?status=<IBK ����Ʈ ���� �̺�Ʈ> ���� �ص� ĵĿ�ǰ� ��¥! ���� ���� ģ����� �ؿܿ����� ������ ��������! �̺�Ʈ���� http://mobizap.co.kr/tagtv/ibk';
			});
		}
	</script>
    
<script type="application/javascript">
    function init() {
      enableVideoClicks();
    }

    function enableVideoClicks() {
      var videos = document.getElementsByTagName('video') || [];
      for (var i = 0; i < videos.length; i++) {
        // TODO: use attachEvent in IE
        videos[i].addEventListener('click', function(videoNode) {
          return function() {
            videoNode.play();
          };
        }(videos[i]));
      }
    }
</script>

</HEAD>
<BODY onload="init()">
	<div id="event" style="height:1950px;">
		<div id="event_bg" style="position:absolute;">
			<img src="images/event_list_large.jpg" width="320px" />
		</div>
		<div id="twit_on_event" style="width:320px; height:85px; position:absolute; text-align:right;">

		</div>
		<div id="twit_on_event" style="width:100px; height:85px; position:absolute; text-align:left;">
			<a href="index2.aspx"><img src="images/btn_event3_back.png" /></a>
		</div>


		<!--div id="back_button" style="position:absolute; top:1945px; width:320px; height:49px; text-align:center;">
			<a href="index2.aspx"><img src="images/btn_event3_back.png" /></a>
		</div-->

	</div>
	
	<div id="duplicated" style="height:416px; background:url('images/bg_event3_dupli.png') no-repeat; display:none;">
		<div id="duplicated_number" style="position:relative; width:320px; height:130px; top:160px; text-align:center; color:#336699; font-weight:bold; font-size:14pt; font-family:vedana;">
			010-0000-0000
		</div>
		<div id="button" style="position:relative; width:320px; top:230px; text-align:center;">
			<a href="javascript:retry();"><img src="images/btn_event3_ok.png" /></a>
		</div>
	</div>
	
	<!--div id="privacy" style="height:416px; background:url('images/bg_event3_privacy.png') no-repeat; display:none;">
		<div id="button" style="position:relative; width:320px; top:360px; text-align:center;">
			<a href="javascript:apply(true);"><img src="images/btn_event3_privacy_ok.png" /></a><a href="javascript:disagree();"><img src="images/btn_event3_privacy_cancel.png" /></a>
		</div>
	</div-->
	
	<div id="finish" style="height:416px; background:url('images/bg_event3_sms_finish.png') no-repeat; display:none;">
		<div id="finish_name" style="position:relative; top:65px; width:170px; text-align:right; font-weight:bold; font-size:14pt;">
			ȫ�浿
		</div>
		<div id="finish_my_number" style="position:relative; top:67px; width:320px; text-align:center; font-weight:bold; color:#336699; font-size:14pt;">
			010-0000-0000
		</div>
		<div id="finish_number" style="position:relative; top:160px; width:320px; text-align:center; font-weight:bold; color:#336699; font-size:14pt;">
			010-0000-0000
		</div>
		<div id="button" style="position:relative; width:320px; top:250px; text-align:center;">
			<a href="insert_event.aspx"><img src="images/btn_event3_ok.png" /></a>
		</div>
	</div>
 </BODY>
</HTML>
