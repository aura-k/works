
/*
NHN UIT Lab. WebStandardization Team (http://html.nhndesign.com/)
Jeong, Chan Myeong 070601~070630
*/

/* Default Skin - Start */
#selectLang { margin:0; padding:0; }
#gnb { margin:0; padding:0; }
#lnb { margin:0; padding:0; }
#lnb ul { margin:0; padding:0; }

/* Site Layout - Body Wrap */
body { background:#FFFFFF url(/xe/layouts/xe_official/images/default/bgBody.gif) repeat-x left top;}
#bodyWrap { width:980px; margin:1.5em auto 0 auto; }

/* Site Layout - Header */
#header { position:relative; width:980px; height:120px; background:url(/xe/layouts/xe_official/images/default/bgHeader.jpg) no-repeat right top; margin-bottom:10px; z-index:99;}
#header h1 { margin:0; padding:0; position:absolute; top:32px; left:25px;}
#language { position:absolute; top:18px; right:19px; z-index:100;}
#language strong { color:#ffffff; font:.75em Tahoma; margin-right:3px;}
#language a img { vertical-align:-5px;}
#language ul { position:absolute; top:15px; right:0px; display:none; border:1px solid #b23628; background:#de4332;}
#language ul li { list-style:none; }
#language ul li a { display:block; width:61px; padding:3px 8px; font:9px Tahoma; color:#ffffff; text-decoration:none;}
#language ul li a:hover { background:#bc4032;}

#it_search_form { position:absolute; top:50px; right:15px;}
#it_search_form .input { border:1px solid #bc4032; height:17px; width:120px; color:#888888; font-size:.9em;} 
#it_search_form .submit_button { width:1px; height:1px; visibility:hidden; }

#gnb { position:absolute; top:82px; left:0; height:38px; overflow:hidden; white-space:nowrap; margin-bottom:10px;}
#gnb li { float:left; list-style:none; background:url(/xe/layouts/xe_official/images/default/bgGnbVr.gif) no-repeat left center; padding-left:2px; position:relative; left:-2px; white-space:nowrap;}
#gnb li a { display:block; float:left; padding:13px 15px 0 15px; height:25px; color:#e8e8e8; white-space:nowrap; text-decoration:none; }
#gnb li a:hover,
#gnb li a:focus { color:#ffffff;}
#gnb li.on a { font-weight:bold; color:#ffffff; background:url(/xe/layouts/xe_official/images/default/bgGnbOn.gif) no-repeat center top;}

#isSearch { position:absolute; top:48px; right:15px; width:214px; text-align:right;}
#isSearch .searchOrder { display:none;}
#isSearch .checked { position:absolute; left:0; top:0; text-align:left; display:block; padding:5px 0 0 5px; width:64px; height:14px; background:url(/xe/layouts/xe_official/images/default/bgSearchTerm.gif) no-repeat; font:11px "돋움", Dotum, "굴림", Gulim, AppleGothic, Sans-serif; color:#ffffff; line-height:normal;}
*:first-child+html #isSearch .checked { top:1px; }
#isSearch ul { display:none; position:absolute; left:0; top:18px; padding:2px 0 3px 0; text-align:left; border:1px solid #919898; background:#536c6d;}
#isSearch ul li { width:67px; height:18px; list-style:none; }
#isSearch ul li input { display:none;}
#isSearch ul li label { display:block; padding:4px 0 0 4px; width:63px; height:15px; font:11px "돋움", Dotum, "굴림", Gulim, AppleGothic, Sans-serif; color:#ffffff;}
#isSearch ul li label.on { background:#455a5b; }
#isSearch ul li label:hover,
#isSearch ul li label:focus { background:#455a5b;}
#isSearch .inputText { vertical-align:middle; position:relative; top:0; _top:-1px; left:1px; padding:3px 3px 1px 3px; width:94px; height:13px; color:#ffffff; border:1px solid #8E8E8D; background-color:#857C79; }
#isSearch .inputText:hover,
#isSearch .inputText:focus { border:1px solid #B0B0AF; background-color:#A9A4A3; }
*:first-child+html body#default #isSearch .inputText { position:relative; top:-1px;}
#isSearch .submit { vertical-align:middle; _position:relative; _top:-1px;}
*:first-child+html body#default #isSearch .submit { position:relative; top:-1px;}

/* Site Layout - Content Body */
#contentBody { position:relative; width:980px; padding-bottom:30px; background:url(/xe/layouts/xe_official/images/default/bgContentBody.gif) repeat-y left top; border-bottom:1px solid #dddddd; *zoom:1;}
#contentBody:after{ content:""; display:block; clear:both;}

/* Site Layout - Column Left */
#columnLeft { position:relative; width:201px; float:left;}
#columnLeft .mask { width:201px; height:5px; background:#ffffff; display:block; clear:both;}

#lnb { border-top:1px solid #dddddd; padding:4px 5px; width:190px;}
#lnb li { padding-bottom:4px; list-style:none; }
#lnb li a { padding:6px 5px 6px 13px; width:170px; display:block; border:1px solid #e8e8e8; background:url(/xe/layouts/xe_official/images/default/bgLnbOff.gif) repeat-x; color:#3e3e3e; position:relative; z-index:99; text-decoration:none;}
#lnb li a:hover,
#lnb li a:focus { color:#ffffff; background:#de4332; border:1px solid #de4332;}
#lnb li.on a { color:#ffffff; background:#de4332; border:1px solid #de4332;}
#lnb li.on a:hover,
#lnb li.on a:focus { font-weight:bold;}
#lnb li ul { display:block; position:relative; width:184px; padding:0 3px; border-top:1px solid #ffffff; overflow:hidden;}
#lnb li.on ul { display:block;}
#lnb li ul li { padding:0; border-top:1px solid #f2f2f2; position:relative; top:-1px;}
#lnb li ul li a { padding:6px 5px 6px 10px; width:169px; color:#818181 !important; border:none; background:none !important; border:none !important;}
#lnb li ul li a:hover,
#lnb li ul li a:focus { font-weight:normal !important; color:#de4332 !important;}
#lnb li.on ul li.on a { color:#ff1a00 !important; font-weight:bold !important; background:url(/xe/layouts/xe_official/images/default/bulletLnb.gif) no-repeat 175px center  !important;}

/* Site Layout - Column Right */
#columnRight { width:770px; float:right;}
#columnRight:after{ content:""; display:block; clear:both;}
#visualArea { width:770px; height:200px; background:#f5f5f5; margin-bottom:2.5em; position:relative; left:-15px; margin-right:-15px;}
#content { width:100%; overflow:hidden;}

/* Site Layout - Footer */
#footer { margin:0; padding:0; border-top:3px solid #f4f4f4; text-align:center; padding:2em 0 4em; clear:both;}
#footer li { display:inline; padding:0 .6em 0 1em; background:url(/xe/layouts/xe_official/images/default/vrType1.gif) no-repeat left center;}
#footer li.first-child { background:none;}
#footer li a { color:#999999; font:.9em "돋움", Dotum, "굴림", Gulim, AppleGothic, Sans-serif;}
#footer li address { display:inline; }

/* Default Skin - End */
