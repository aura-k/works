<?
	function toolbar($menu){
		$prn_menu0 = '<a class="back" href="#">뒤로</a>';
		$prn_menu1 = '<a class="href" href="#menu1"><img src="./img/btn_01.png" border="0"></a>';
		$prn_menu2 = '<a class="href" href="#menu2"><img src="./img/btn_02.png" border="0"></a>';
		$prn_menu3 = '<a class="href" href="#menu3"><img src="./img/btn_03.png" border="0"></a>';
		$prn_menu4 = '<a class="href" href="#menu4"><img src="./img/btn_04.png" border="0"></a>';
		$prn_menu5 = '<a class="button pop" id="infoButton" href="#about2">로그인</a>';

		switch($menu){
			case 0:
				$prn_menu0 = '<a class="button_help slideup" id="infoButton" >&nbsp;?&nbsp;</a>';
				break;
			case 1:
				$prn_menu1 = '<img src="./img/btn_01_o.png" border="0">';
				break;
			case 2:
				$prn_menu2 = '<img src="./img/btn_02_o.png" border="0">';
				break;
			case 3:
				$prn_menu3 = '<img src="./img/btn_03_o.png" border="0">';
				break;
			case 4:
				$prn_menu4 = '<img src="./img/btn_04_o.png" border="0">';
			case 5:
				$prn_menu5 = '';
		}

		if($_SESSION["ID"]){ 
			echo '<div class="toolbar" style="height:138px;background: url(./img/bg_menu_ex.png) repeat-x;"><h1><a class="goback" href="#home"><img src="./img/img_logo.png"></a></h1>'.$prn_menu0.'<a class="button slideup" id="infoButton" onclick="logoutAction()">로그아웃</a><div style="margin-top:60px;padding:0"><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td align="center">'.$prn_menu1.'</td><td align="center">'.$prn_menu2.'</td><td align="center">'.$prn_menu3.'</td><td align="center">'.$prn_menu4.'</td></tr></table></div></div>';
		}else{
			echo '<div class="toolbar"><h1><a class="goback" href="#home"><img src="./img/img_logo.png"></a></h1>'.$prn_menu0.$prn_menu5.'</div>';
		}
	}
?>