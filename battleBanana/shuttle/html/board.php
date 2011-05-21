<?
	include '../php/connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>쿠폰셔틀</title>
</head>
<body>
        <table width="1024" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
                <!--박스-->
                <div class="wrap">
                  <table width="920" style="margin-top:20px;" cellspacing="1" cellpadding="0" bgcolor="#d0d0d0" align="center">
                  <tr bgcolor="white">
                    <td style="padding:20px" id="container">
					<iframe id="myframe" src="../xe/?mid=board" name="myframe" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="no" onload="doResize()"></iframe>
					</td>
                  </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td class="bg_shadow">&nbsp;</td>
                  </tr>
                </table>
              </div>
                <!--박스-->
            </td>
          </tr>
        </table>
        <!--상단메뉴끝-->
        

</body>
</html>
<?
	mysql_close($connect);
?>