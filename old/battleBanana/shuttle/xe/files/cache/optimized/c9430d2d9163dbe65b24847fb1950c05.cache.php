/* default.css - Type Selector Definition */
body { margin:0;padding:0; font-size:.75em;}

img { border:none; }
label { cursor:pointer; }
form { margin:0; padding:0; }

/* Special Class Selector */
.fr { float:right; }
.fl { float:left; }
.clear { clear:both; }
.fwB { font-weight:bold;}
.tCenter { text-align:center; }
.tRight { text-align:right; }
.tLeft { text-align:left; }
.gap1 { margin-top:.8em; }
.nowrap { white-space:nowrap; }

.iePngFix { behavior:url(./common/js/iePngFix.htc); } 
.zbxe_info { vertical-align:middle; behavior:url(./common/js/iePngFix.htc); }

/* Input Style Definition */
.inputTypeText { border:1px solid; border-color:#a6a6a6 #d8d8d8 #d8d8d8 #a6a6a6; height:1.4em; padding:.2em 0 0 .3em; background:#ffffff; font-size:1em; _font-size:9pt; }
*:first-child+html .inputTypeText { font-size:9pt; }
.inputTypeText:hover,
.inputTypeText:focus { background:#f4f4f4; }
.inputTypeTextArea { border:1px solid !important; border-color:#a6a6a6 #d8d8d8 #d8d8d8 #a6a6a6 !important; background:#ffffff; font-size:1em; _font-size:9pt; height:100px;}
*:first-child+html .inputTypeTextArea { font-size:9pt; }

.w40 { width:40px; }
.w60 { width:60px; }
.w70 { width:70px; }
.w80 { width:80px; }
.w90 { width:90px; }
.w100 { width:100px; }
.w110 { width:110px; }
.w120 { width:120px; }
.w130 { width:130px; }
.w140 { width:140px; }
.w150 { width:150px; }
.w160 { width:160px; }
.w170 { width:170px; }
.w180 { width:180px; }
.w190 { width:190px; }
.w200 { width:200px; }
.w210 { width:210px; }
.w220 { width:220px; }
.w230 { width:230px; }
.w240 { width:240px; }
.w250 { width:250px; }
.w260 { width:260px; }
.w270 { width:270px; }
.w280 { width:280px; }
.w290 { width:290px; }
.w300 { width:300px; }
.w400 { width:400px; }

/* editor style */
a.bold { font-weight:bold; }

.editor_blue_text { color: #145ff9 !important; text-decoration:underline !important; }
.editor_blue_text a { color: #145ff9 !important; text-decoration:underline !important; }
.editor_red_text { color: #f42126 !important; text-decoration:underline !important; }
.editor_red_text a { color: #f42126 !important; text-decoration:underline !important; }
.editor_yellow_text { color: #c9bd00 !important; text-decoration:underline !important; }
.editor_yellow_text a { color: #c9bd00 !important; text-decoration:underline !important; }
.editor_green_text { color: #08830B !important; text-decoration:underline !important; }
.editor_green_text a { color: #08830B !important; text-decoration:underline !important; }

.folder_opener { display: block; }
.folder_closer { display: none; }
.folder_area { display: none; }

.xe_content { line-height:1.6; overflow:hidden; }

.zbxe_widget_output { background:url(/xe/common/tpl/images/widget_text.gif) no-repeat center bottom; display:block;}

/* xe layer */
#waitingforserverresponse { border:2px solid #444444; font-weight:bold; color:#444444; padding: 7px 5px 5px 25px; background:#FFFFFF url(/xe/common/tpl/images/loading.gif) no-repeat 5px 5px; top:40px; left:40px; position:absolute; z-index:100; visibility:hidden; }

#popup_menu_area{ position:absolute; background:#fff; border:2px solid #eee; -moz-border-radius:5px; -webkit-border-radius:5px; margin:0; padding:0;}
#popup_menu_area *{ margin:0; padding:0; list-style:none; font-size:12px; line-height:normal;}
#popup_menu_area ul{ border:1px solid #ddd; -moz-border-radius:5px; -webkit-border-radius:5px; padding:10px 10px 5px 10px;}
#popup_menu_area li{ padding:2px 0 2px 20px; background-repeat:no-repeat; background-position:left center; margin-bottom:3px; white-space:nowrap;}
#popup_menu_area li a{ text-decoration:none; color:#000;}
#popup_menu_area li a:hover,
#popup_menu_area li a:active,
#popup_menu_area li a:focus{ font-weight:bold; letter-spacing:-1px;}

/* xe faceoff */
.faceOffManager { position:fixed; _position:absolute; right:3px; top:3px;  height:23px; }
