

/* TextEditor */
.xeTextEditor {overflow:hidden;}
.xeTextEditor textarea { display:block; margin:0; padding:5px; }
.xeTextEditor.black textarea { color:#fff; background-color:#000;}

/* Type Selector */
.xpress-editor *{margin:0; padding:0; font-style:normal; font-size:12px; }
.xpress-editor img,
.xpress-editor fieldset,
.xpress-editor button{ border:0;}
.xpress-editor button{ background:none; background-repeat:no-repeat; cursor:pointer; _cursor /**/:hand;}
.xpress-editor button *{ visibility:hidden;}
.xpress-editor legend{ position:absolute; width:0; height:0; font-size:0; line-height:0; overflow:hidden; visibility:hidden;}
.xpress-editor label{ cursor:pointer; _cursor /**/:hand;}
.xpress-editor hr{ display:none;}
.xpress-editor li{list-style:none;}

/* Layout Selector */
.xpress-editor{ position:relative; background:transparent;}
.xpress-editor #smart_content{ position:relative; clear:both; margin:0 0 10px 0; border:1px solid #c2c2c2; *zoom:1; z-index:5; background:#fff;}
.xpress-editor.black #smart_content {background:transparent;}
.xpress-editor #smart_footer{ position:relative; text-align:center; padding:10px 0;}

/* Footer */
.xpress-editor #smart_footer *{ vertical-align:top;}
.xpress-editor #smart_footer button{ position:relative; width:67px; height:25px; margin:0 5px 0 0;}
.xpress-editor #smart_footer button.save_temp{ background:url(/xe/modules/editor/skins/xpresseditor/img/btn_save_temp.gif) no-repeat;}
.xpress-editor #smart_footer button.preview{ background:url(/xe/modules/editor/skins/xpresseditor/img/btn_preview.gif) no-repeat;}
.xpress-editor #smart_footer input{ margin:0;}
.xpress-editor #smart_footer input.reset{ width:67px; height:25px; border:0; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_cancel.gif) no-repeat; cursor:pointer; margin-left:5px;}

/* Content > Input Area */
.xpress-editor a.skip{ position:relative; display:block; top:0; right:0; width:0; height:0; overflow:hidden; clear:both; zoom:1}
.xpress-editor a.skip:hover,
.xpress-editor a.skip:active,
.xpress-editor a.skip:focus{ position:relative; display:block; padding:5px; right:0; z-index:60; width:auto; height:auto; text-align:right; white-space:nowrap; color:#000; text-decoration:none; letter-spacing:-1px; _zoom:1;}

.xpress-editor .input_area{ position:relative; margin:10px; z-index:30; *zoom:1; height:400px;}
.xpress-editor .input_area iframe,
.xpress-editor .input_area textarea{ display:block; width:100%; position:relative; height:100%; border:0; overflow:auto;}
.xpress-editor .input_area iframe{}
.xpress-editor .input_area textarea{ *margin:0 -10px; _margin-bottom:-2px;}
.xpress-editor .input_area textarea.blind{ display:none;}
.xpress-editor .input_control{ position:relative; display:block; width:100%; clear:both; text-align:center; background:#fbfbfb url(/xe/modules/editor/skins/xpresseditor/img/btn_expand.gif) no-repeat center center; cursor:n-resize;}
.xpress-editor .input_control span{ display:block; height:10px; visibility:hidden; overflow:visible; font-size:0; line-height:200%; white-space:nowrap; color:#fff;}
.xpress-editor.black .input_control { background:#111 url(/xe/modules/editor/skins/xpresseditor/img/btn_expand.black.gif) no-repeat center center;}
.xpress-editor.black .input_control span{ border-top:1px solid #333;  color:#000;}

.xpress-editor .tool{ position:relative; overflow:visible; padding:5px 10px 6px 10px; *padding:5px 10px 8px 10px; z-index:40; clear:both; background:#f8f8f8 url(/xe/modules/editor/skins/xpresseditor/img/bg_tool.gif) repeat-x left bottom; border:0; *zoom:1;}
.xpress-editor .tool.disable { display:none; }
.xpress-editor.black .tool{ background:#111 url(/xe/modules/editor/skins/xpresseditor/img/bg_tool.black.gif) repeat-x left bottom; }

.xpress-editor .tool:after{ content:""; display:block; clear:both;}
.xpress-editor .tool ul{ position:relative; overflow:visible; float:left; margin:0 5px 2px 0; z-index:2;}
.xpress-editor .tool ul.action{ width:43px;}
.xpress-editor .tool ul.type{ width:auto; white-space:nowrap;}
.xpress-editor .tool ul.style{ width:169px; z-index:6;}
.xpress-editor .tool ul.paragraph{ width:169px; z-index:5;}
.xpress-editor .tool ul.extra1{ width:90px; z-index:4;}
.xpress-editor .tool ul.table{ width:85px; z-index:3;}
.xpress-editor .tool ul.extra2{ width:auto; z-index:2;}
.xpress-editor .tool ul.extra3{ float:right; width:auto; z-index:1; margin-right:1px;}
.xpress-editor .tool ul.extra3 li{ margin-right:4px;}
.xpress-editor .tool li{ position:relative; float:left;}
.xpress-editor .tool li button{ width:21px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_set.gif) no-repeat 0 0; vertical-align:top;}
.xpress-editor.black .tool li button{ width:21px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_set.black.gif) no-repeat 0 0; vertical-align:top;}
.xpress-editor .tool li button span{ position:absolute; top:0; left:0; width:0; height:0; overflow:hidden; visibility:hidden;}

.xpress-editor .tool li.extensions span.exButton,
.xpress-editor .tool li.extensions span.exButton button{ float:left; position:relative; display:inline-block; width:auto; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_extension.gif) no-repeat left top;}
.xpress-editor .tool li.extensions span.exButton{ margin-right:18px;}
.xpress-editor .tool li.extensions span.exButton button{ left:18px; height:21px; background-position:right top; padding:0 4px 0 0; font:11px/21px Tahoma, Sans-serif; text-align:left; *overflow:visible; *line-height:20px;}
.xpress-editor.black .tool li.extensions span.exButton,
.xpress-editor.black .tool li.extensions span.exButton button{ color:#fff; background-image:url(/xe/modules/editor/skins/xpresseditor/img/btn_extension.black.gif); }

.xpress-editor .tool li.html span,
.xpress-editor .tool li.html span button,
.xpress-editor .tool li.preview span,
.xpress-editor .tool li.preview span button{ float:left; position:relative; display:inline-block; width:auto; height:auto; visibility:visible; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_set_blank.gif) no-repeat 0 0; white-space:nowrap;}
.xpress-editor.black .tool li.html span,
.xpress-editor.black .tool li.html span button,
.xpress-editor.black .tool li.preview span,
.xpress-editor.black .tool li.preview span button{ color:#fff;background-image:url(/xe/modules/editor/skins/xpresseditor/img/btn_set_blank.black.gif); }

.xpress-editor .tool li.html span,
.xpress-editor .tool li.preview span{ margin-right:2px; background-position:left top;}
.xpress-editor .tool li.html span button,
.xpress-editor .tool li.preview span button{ left:2px; height:21px; background-position:right top; font:11px/21px Tahoma, Sans-serif; padding:0 4px; *overflow:visible; *line-height:20px;}

.xpress-editor .tool ul.type li{ float:none; display:inline; *top:1px;}
.xpress-editor .tool ul.type li select{ height:21px; width:62px;}
.xpress-editor.black .tool ul.type li select{ color:#fff; background-color:#000; }

/* Content > Tool > Button Default */
.xpress-editor .tool li.undo button{ width:22px; background-position:0 0;}
.xpress-editor .tool li.redo button{ background-position:-22px 0;}
.xpress-editor .tool li.bold button{ width:22px; background-position:-43px 0;}
.xpress-editor .tool li.underline button{ background-position:-65px 0;}
.xpress-editor .tool li.italic button{ background-position:-86px 0;}
.xpress-editor .tool li.del button{ background-position:-107px 0;}
.xpress-editor .tool li.fcolor button{ background-position:-128px 0;}
.xpress-editor .tool li.bcolor button{ background-position:-149px 0;}
.xpress-editor .tool li.sup button{ background-position:-170px 0;}
.xpress-editor .tool li.sub button{ background-position:-191px 0;}
.xpress-editor .tool li.left button{ width:22px; background-position:-212px 0;}
.xpress-editor .tool li.center button{ background-position:-234px 0;}
.xpress-editor .tool li.right button{ background-position:-255px 0;}
.xpress-editor .tool li.justify button{ background-position:-276px 0;}
.xpress-editor .tool li.ol button{ background-position:-297px 0;}
.xpress-editor .tool li.ul button{ background-position:-318px 0;}
.xpress-editor .tool li.outdent button{ background-position:-339px 0;}
.xpress-editor .tool li.indent button{ background-position:-360px 0;}
.xpress-editor .tool li.blockquote button{ width:22px; background-position:-381px 0;}
.xpress-editor .tool li.url button{ width:26px; background-position:-403px 0;}
.xpress-editor .tool li.character button{ background-position:-429px 0;}
.xpress-editor .tool li.find button{ background-position:-450px 0;}
.xpress-editor .tool li.table button{ width:22px; background-position:-471px 0;}
.xpress-editor .tool li.merge button{ background-position:-493px 0;}
.xpress-editor .tool li.splitCol button{ background-position:-514px 0;}
.xpress-editor .tool li.splitRow button{ background-position:-535px 0;}
.xpress-editor .tool li.extensions span{ background-position:0 0;}
.xpress-editor .tool li.extensions span button{ background-position:right 0;}
.xpress-editor .tool li.html span{ background-position:0 0;}
.xpress-editor .tool li.html span button{ background-position:right 0;}
.xpress-editor .tool li.preview span{ background-position:0 0;}
.xpress-editor .tool li.preview span button{ background-position:right 0;}

/* Content > Tool > Button Hover */
.xpress-editor .tool li.undo button.hover{ width:22px; background-position:0 -21px;}
.xpress-editor .tool li.redo button.hover{ background-position:-22px -21px;}
.xpress-editor .tool li.bold button.hover{ width:22px; background-position:-43px -21px;}
.xpress-editor .tool li.underline button.hover{ background-position:-65px -21px;}
.xpress-editor .tool li.italic button.hover{ background-position:-86px -21px;}
.xpress-editor .tool li.del button.hover{ background-position:-107px -21px;}
.xpress-editor .tool li.fcolor button.hover{ background-position:-128px -21px;}
.xpress-editor .tool li.bcolor button.hover{ background-position:-149px -21px;}
.xpress-editor .tool li.sup button.hover{ background-position:-170px -21px;}
.xpress-editor .tool li.sub button.hover{ background-position:-191px -21px;}
.xpress-editor .tool li.left button.hover{ width:22px; background-position:-212px -21px;}
.xpress-editor .tool li.center button.hover{ background-position:-234px -21px;}
.xpress-editor .tool li.right button.hover{ background-position:-255px -21px;}
.xpress-editor .tool li.justify button.hover{ background-position:-276px -21px;}
.xpress-editor .tool li.ol button.hover{ background-position:-297px -21px;}
.xpress-editor .tool li.ul button.hover{ background-position:-318px -21px;}
.xpress-editor .tool li.outdent button.hover{ background-position:-339px -21px;}
.xpress-editor .tool li.indent button.hover{ background-position:-360px -21px;}
.xpress-editor .tool li.blockquote button.hover{ width:22px; background-position:-381px -21px;}
.xpress-editor .tool li.url button.hover{ width:26px; background-position:-403px -21px;}
.xpress-editor .tool li.character button.hover{ background-position:-429px -21px;}
.xpress-editor .tool li.find button.hover{ background-position:-450px -21px;}
.xpress-editor .tool li.table button.hover{ width:22px; background-position:-471px -21px;}
.xpress-editor .tool li.merge button.hover{ background-position:-493px -21px;}
.xpress-editor .tool li.splitCol button.hover{ background-position:-514px -21px;}
.xpress-editor .tool li.splitRow button.hover{ background-position:-535px -21px;}
.xpress-editor .tool li.extensions span.hover{ background-position:0 -21px;}
.xpress-editor .tool li.extensions span.hover button{ background-position:right -21px;}
.xpress-editor .tool li.html span.hover{ background-position:0 -21px;}
.xpress-editor .tool li.html span.hover button{ background-position:right -21px;}
.xpress-editor .tool li.preview span.hover{ background-position:0 -21px;}
.xpress-editor .tool li.preview span.hover button{ background-position:right -21px;}

/* Content > Tool > Button Active */
.xpress-editor .tool li.undo button.active{ width:22px; background-position:0 -42px;}
.xpress-editor .tool li.redo button.active{ background-position:-22px -42px;}
.xpress-editor .tool li.bold button.active{ width:22px; background-position:-43px -42px;}
.xpress-editor .tool li.underline button.active{ background-position:-65px -42px;}
.xpress-editor .tool li.italic button.active{ background-position:-86px -42px;}
.xpress-editor .tool li.del button.active{ background-position:-107px -42px;}
.xpress-editor .tool li.fcolor button.active{ background-position:-128px -42px;}
.xpress-editor .tool li.bcolor button.active{ background-position:-149px -42px;}
.xpress-editor .tool li.sup button.active{ background-position:-170px -42px;}
.xpress-editor .tool li.sub button.active{ background-position:-191px -42px;}
.xpress-editor .tool li.left button.active{ width:22px; background-position:-212px -42px;}
.xpress-editor .tool li.center button.active{ background-position:-234px -42px;}
.xpress-editor .tool li.right button.active{ background-position:-255px -42px;}
.xpress-editor .tool li.justify button.active{ background-position:-276px -42px;}
.xpress-editor .tool li.ol button.active{ background-position:-297px -42px;}
.xpress-editor .tool li.ul button.active{ background-position:-318px -42px;}
.xpress-editor .tool li.outdent button.active{ background-position:-339px -42px;}
.xpress-editor .tool li.indent button.active{ background-position:-360px -42px;}
.xpress-editor .tool li.blockquote button.active{ width:22px; background-position:-381px -42px;}
.xpress-editor .tool li.url button.active{ width:26px; background-position:-403px -42px;}
.xpress-editor .tool li.character button.active{ background-position:-429px -42px;}
.xpress-editor .tool li.find button.active{ background-position:-450px -42px;}
.xpress-editor .tool li.table button.active{ width:22px; background-position:-471px -42px;}
.xpress-editor .tool li.merge button.active{ background-position:-493px -42px;}
.xpress-editor .tool li.splitCol button.active{ background-position:-514px -42px;}
.xpress-editor .tool li.splitRow button.active{ background-position:-535px -42px;}
.xpress-editor .tool li.extensions span.active{ background-position:0 -42px;}
.xpress-editor .tool li.extensions span.active button{ background-position:right -42px;}
.xpress-editor .tool li.html span.active{ background-position:0 -42px;}
.xpress-editor .tool li.html span.active button{ background-position:right -42px;}
.xpress-editor .tool li.preview span.active{ background-position:0 -42px;}
.xpress-editor .tool li.preview span.active button{ background-position:right -42px;}

/* Content > Tool > Button Off */
.xpress-editor .tool.off li.undo button,
.xpress-editor .tool li.undo button.off{ width:22px; background-position:0 -63px;}
.xpress-editor .tool.off li.redo button,
.xpress-editor .tool li.redo button.off{ background-position:-22px -63px;}
.xpress-editor .tool.off li.bold button{ width:22px; background-position:-43px -63px;}
.xpress-editor .tool.off li.underline button{ background-position:-65px -63px;}
.xpress-editor .tool.off li.italic button{ background-position:-86px -63px;}
.xpress-editor .tool.off li.del button{ background-position:-107px -63px;}
.xpress-editor .tool.off li.fcolor button{ background-position:-128px -63px;}
.xpress-editor .tool.off li.bcolor button{ background-position:-149px -63px;}
.xpress-editor .tool.off li.sup button{ background-position:-170px -63px;}
.xpress-editor .tool.off li.sub button{ background-position:-191px -63px;}
.xpress-editor .tool.off li.left button{ width:22px; background-position:-212px -63px;}
.xpress-editor .tool.off li.center button{ background-position:-234px -63px;}
.xpress-editor .tool.off li.right button{ background-position:-255px -63px;}
.xpress-editor .tool.off li.justify button{ background-position:-276px -63px;}
.xpress-editor .tool.off li.ol button{ background-position:-297px -63px;}
.xpress-editor .tool.off li.ul button{ background-position:-318px -63px;}
.xpress-editor .tool.off li.outdent button{ background-position:-339px -63px;}
.xpress-editor .tool.off li.indent button{ background-position:-360px -63px;}
.xpress-editor .tool.off li.blockquote button{ width:22px; background-position:-381px -63px;}
.xpress-editor .tool.off li.url button{ width:26px; background-position:-403px -63px;}
.xpress-editor .tool.off li.character button{ background-position:-429px -63px;}
.xpress-editor .tool.off li.find button{ background-position:-450px -63px;}
.xpress-editor .tool.off li.table button{ width:22px; background-position:-471px -63px;}
.xpress-editor .tool.off li.merge button,
.xpress-editor .tool li.merge button.off{ background-position:-493px -63px;}
.xpress-editor .tool.off li.splitCol button,
.xpress-editor .tool li.splitCol button.off{ background-position:-514px -63px;}
.xpress-editor .tool.off li.splitRow button,
.xpress-editor .tool li.splitRow button.off{ background-position:-535px -63px;}
.xpress-editor .tool.off li.extensions span{ background-position:0 -63px;}
.xpress-editor .tool.off li.extensions span button{ background-position:right -63px; color:#bcbcbc;}
.xpress-editor .tool.off li button{ cursor:default;}
.xpress-editor .tool.off ul.extra3 li button{ cursor:pointer;}

/* Content > Tool > Layer */
.xpress-editor .tool .layer{ display:none; position:absolute; left:0; top:20px; background-color:#fbfbfb; border:1px solid #c5c5c5; border-right:1px solid #9f9f9f; border-bottom:1px solid #9f9f9f;}
.xpress-editor .tool .layer li{ float:none; left:0;}
.xpress-editor .tool .layer button,
.xpress-editor.black .tool .layer button{ margin:0 !important; width:auto; height:auto; background:none;}
.xpress-editor .tool .layer button span{ position:absolute; width:0; height:0; font-size:0; line-height:0; overflow:hidden; visibility:hidden;}
.xpress-editor .tool .btn_area{ position:relative; clear:both; text-align:center !important; padding:7px 0 12px 0; width:100%; white-space:nowrap; *zoom:1;}
.xpress-editor .tool .btn_area *{ vertical-align:top;}
.xpress-editor .tool button.close{ position:absolute; top:4px; right:3px; width:21px; height:20px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_close.gif) no-repeat center center !important;}
.xpress-editor .tool button.close span{ position:absolute; width:0; height:0; overflow:hidden; visibility:hidden;}
.xpress-editor .tool .layer .btn_area button{ *margin:0 2px !important;}
.xpress-editor .tool .layer .btn_area button.confirm{ width:38px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_confirm.gif) no-repeat;}
.xpress-editor .tool .layer .btn_area button.cancel{ width:38px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_cancel.gif) no-repeat;}

.xpress-editor .tool li.fcolor .layer{ width:218px !important; height:auto !important; background-image:none !important; overflow:hidden;}
.xpress-editor .tool .layer .palette{ width:210px; position:relative; left:7px; padding:8px 0 7px 0; margin:0;}
.xpress-editor .tool .layer .palette li{ float:left; margin:0 1px 1px 0; font-size:0; line-height:0;}
.xpress-editor .tool .layer .palette button{ position:relative; overflow:hidden; width:11px; height:11px;}

.xpress-editor .tool li.bcolor .layer { width:218px; overflow:hidden;}
.xpress-editor .tool .layer .background{ width:210px; position:relative; left:7px; margin:0 0 -2px 0; padding:8px 0 0 0; *padding-bottom:8px; _padding-bottom:4px;}
.xpress-editor .tool .layer .background li{ float:left; margin:0 5px 2px 0;}
.xpress-editor .tool .layer .background button{ position:relative; overflow:hidden; width:65px; height:19px; text-align:left; padding:4px;}
.xpress-editor .tool .layer .background button span{ position:relative; visibility:visible; font-size:12px; line-height:normal; width:auto; height:auto;}

.xpress-editor .tool li.style .layer{ padding:4px 2px; _overflow:hidden; filter:progid:DXImageTransform.Microsoft.Shadow(color=#dddddd,direction=135,strength=2);}
.xpress-editor .tool li.style .layer li{ position:relative; background:#fbfbfb;}
.xpress-editor .tool li.style .layer li button{ display:block; width:134px; position:relative;}
.xpress-editor .tool li.style .layer li button span{ display:block; width:130px; text-align:left; letter-spacing:normal;}
.xpress-editor .tool li.style .layer li.h3 button span{ padding:3px 0 1px 4px; height:15px; _height /**/:19px; font-size:16px; font-weight:bold;}
.xpress-editor .tool li.style .layer li.h4 button span{ padding:3px 0 2px 4px; height:13px; _height /**/:18px; font-size:14px; font-weight:bold;}
.xpress-editor .tool li.style .layer li.h5 button span{ padding:3px 0 1px 4px; height:11px; _height /**/:15px; font-size:12px; font-weight:bold;}
.xpress-editor .tool li.style .layer li.h6 button span{ padding:3px 0 1px 4px; height:11px; _height /**/:15px; font-size:12px;}
.xpress-editor .tool li.style .layer li.p button span{ padding:3px 0 1px 4px; height:11px; _height /**/:15px; font-size:12px; color:#5d5d5d;}
.xpress-editor .tool li.style .layer li button.hover{ background:#c1f471; *height:1%;}

.xpress-editor .tool li.blockquote .layer{ padding:6px 5px 6px 7px; left:0; width:288px;}
.xpress-editor .tool li.blockquote .layer ul{ *zoom:1; margin:0;}
.xpress-editor .tool li.blockquote .layer ul:after{ content:""; display:block; clear:both;}
.xpress-editor .tool li.blockquote .layer li{ position:relative; float:left; overflow:hidden; width:32px; height:34px; margin:0 2px 0 0; border:1px solid #cdcecc; background-image:url(/xe/modules/editor/skins/xpresseditor/img/btn_qmark.gif); background-repeat:no-repeat;}
.xpress-editor .tool li.blockquote .layer li.q1{ background-position:0 0;}
.xpress-editor .tool li.blockquote .layer li.q2{ background-position:-32px 0;}
.xpress-editor .tool li.blockquote .layer li.q3{ background-position:-64px 0;}
.xpress-editor .tool li.blockquote .layer li.q4{ background-position:-96px 0;}
.xpress-editor .tool li.blockquote .layer li.q5{ background-position:-128px 0;}
.xpress-editor .tool li.blockquote .layer li.q6{ background-position:-160px 0;}
.xpress-editor .tool li.blockquote .layer li.q7{ background-position:-192px 0;}
.xpress-editor .tool li.blockquote .layer li.q8{ background-position:-224px 0;}
.xpress-editor .tool li.blockquote .layer li button{ width:32px; height:34px;}

.xpress-editor .tool li.url .layer{ width:231px; height:125px; background-image:url(/xe/modules/editor/skins/xpresseditor/img/bx_url.gif); background-repeat:no-repeat; background-position:10px 14px;}
.xpress-editor .tool li.url .layer fieldset{ position:absolute; width:212px; left:10px; top:14px;}
.xpress-editor .tool li.url .layer fieldset h3{ position:absolute; top:-4px; left:15px; color:#404040; visibility:visible; font-size:12px; line-height:normal; width:auto; height:auto; background:none; margin:0; padding:0; font-weight:normal;}
.xpress-editor .tool li.url .layer fieldset input.link{ position:absolute; left:12px; top:19px; width:179px; padding:2px 0 1px 6px; *margin:-1px 0; font-size:11px; height:13px; border:1px solid #818181; border-right:1px solid #dadada; border-bottom:1px solid #dadada;}
.xpress-editor .tool li.url .layer fieldset p{ position:absolute; left:12px; top:44px;}
.xpress-editor .tool li.url .layer fieldset p input{ width:13px; height:13px; vertical-align:middle; margin-right:3px;}
.xpress-editor .tool li.url .layer .btn_area{ position:absolute; bottom:12px; padding:0;}

.xpress-editor .tool li.table .layer{ width:242px; height:239px; background-image:url(/xe/modules/editor/skins/xpresseditor/img/bx_table.gif); background-repeat:no-repeat; background-position:10px 14px;}
.xpress-editor .tool li.table .layer fieldset{ position:absolute; width:222px; left:10px;}
.xpress-editor .tool li.table .layer fieldset h3{ position:absolute; top:-4px; left:15px; color:#404040; visibility:visible; font-size:12px; line-height:normal; width:auto; height:auto; background:none; margin:0; padding:0; font-weight:normal;}

.xpress-editor .tool li.table .layer fieldset dl{ position:absolute; left:10px;}
.xpress-editor .tool li.table .layer fieldset dt{ float:left; padding:3px 0 0 0; height:20px; white-space:nowrap; letter-spacing:-1px;}
.xpress-editor .tool li.table .layer fieldset dd{ float:right; position:relative;}
.xpress-editor .tool li.table .layer fieldset dd button.add,
.xpress-editor .tool li.table .layer fieldset dd button.del{ position:absolute; left:27px; width:15px; height:8px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_cell_adjust.gif) no-repeat;}
.xpress-editor .tool li.table .layer fieldset dd button.add{ top:1px;}
.xpress-editor .tool li.table .layer fieldset dd button.del{ top:9px; background-position:0 -8px;}
.xpress-editor .tool li.table .layer fieldset dd .preview_palette{ display:block; float:left; margin:0 3px 0 0; padding:2px; position:relative; border:1px solid #c8c9c6; width:14px; height:14px; overflow:hidden;}
.xpress-editor .tool li.table .layer fieldset dd .preview_palette button{ width:14px; height:14px; font-size:500px; line-height:0;}
.xpress-editor .tool li.table .layer fieldset dd .find_palette{ width:33px; height:20px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_search.gif) no-repeat;}

.xpress-editor .tool li.table .layer fieldset.num{ top:14px;}
.xpress-editor .tool li.table .layer fieldset.num dl{ top:18px; width:60px;}
.xpress-editor .tool li.table .layer fieldset.num dt{ height:20px;}
.xpress-editor .tool li.table .layer fieldset.num dd{ height:23px;}
.xpress-editor .tool li.table .layer fieldset.num dt label{ font-size:11px; color:#333;}
.xpress-editor .tool li.table .layer fieldset.num dd input{ padding:3px 0 0 6px; *margin:-1px 0; width:35px; height:13px; font-size:11px; border:1px solid #818181; border-right:1px solid #dadada; border-bottom:1px solid #dadada;}

.xpress-editor .tool li.table .layer fieldset.color{ top:96px;}
.xpress-editor .tool li.table .layer fieldset.color dl{ top:18px; width:210px;}
.xpress-editor .tool li.table .layer fieldset.color dt{ height:23px;}
.xpress-editor .tool li.table .layer fieldset.color dd{ height:26px; width:146px;}
.xpress-editor .tool li.table .layer fieldset.color dt label{ font-size:11px; color:#333;}
.xpress-editor .tool li.table .layer fieldset.color dd input{ padding:3px 0 0 6px; *margin:-1px 0; font-size:11px; border:1px solid #818181; border-right:1px solid #dadada; border-bottom:1px solid #dadada;}
.xpress-editor .tool li.table .layer fieldset.color dd input#table_border_width{ width:35px; height:13px;}
.xpress-editor .tool li.table .layer fieldset.color dd input#table_border_color,
.xpress-editor .tool li.table .layer fieldset.color dd input#table_bg_color{ width:70px; height:15px; *margin-right:3px;}

.xpress-editor .tool li.table .layer table{ position:absolute; top:18px; left:75px; width:137px; height:40px; table-layout:fixed;}
.xpress-editor .tool li.table .layer table *{ font-size:0; line-height:0;}
.xpress-editor .tool li.table .layer table th,
.xpress-editor .tool li.table .layer table td{ text-align:center;}
.xpress-editor .tool li.table .layer .btn_area{ position:absolute; bottom:12px; padding:0; z-index:1;}

.xpress-editor .tool li.table .layer .palette{ display:none; position:absolute; z-index:2; left:11px; width:204px; padding:8px 7px 7px 7px; _padding-right:6px; background-color:#fbfbfb; border:1px solid #c5c5c5; border-right:1px solid #9f9f9f; border-bottom:1px solid #9f9f9f;}
.xpress-editor .tool li.table .layer.p1 .palette{ display:block; top:163px;}
.xpress-editor .tool li.table .layer.p2 .palette{ display:block; top:189px;}

.xpress-editor .tool li.character .layer{ width:433px; height:242px; overflow:hidden;}
.xpress-editor .tool li.character .layer ul{ margin:0;}
.xpress-editor .tool li.character .layer h3{position:absolute; width:0; height:0; overflow:hidden; visibility:hidden;}
.xpress-editor .tool li.character .layer .nav{ position:absolute; top:11px; left:-1px; overflow:hidden; white-space:nowrap;}
.xpress-editor .tool li.character .layer .nav li{ display:inline; margin:0 -4px 0 0; padding:0 8px; background:url(/xe/modules/editor/skins/xpresseditor/img/vr_layer_character.gif) no-repeat 0 0;}
.xpress-editor .tool li.character .layer .nav li a{ color:#444; text-decoration:none; letter-spacing:-1px;}
.xpress-editor .tool li.character .layer .nav li a:hover,
.xpress-editor .tool li.character .layer .nav li a:active,
.xpress-editor .tool li.character .layer .nav li a:focus{ text-decoration:underline;}
.xpress-editor .tool li.character .layer .nav li a.on{ font-weight:bold; color:#004790; display:inline;}
.xpress-editor .tool li.character .layer .list{ position:absolute; left:7px; top:30px; width:421px; height:172px; background:url(/xe/modules/editor/skins/xpresseditor/img/bx_character.gif) no-repeat;}
.xpress-editor .tool li.character .layer .list li{ position:relative; top:1px; left:1px; float:left; width:20px; height:18px; margin:0 1px 1px 0;}
.xpress-editor .tool li.character .layer .list li button{ width:20px; height:18px;}
.xpress-editor .tool li.character .layer .list li button.hover{ border:2px solid #27c11a;}
.xpress-editor .tool li.character .layer .list li button span{ overflow:visible; font-size:12px; width:auto; height:auto; position:relative; visibility:visible; line-height:normal;}
.xpress-editor .tool li.character .layer p{ position:absolute; top:212px; left:7px;}
.xpress-editor .tool li.character .layer p *{ vertical-align:top;}
.xpress-editor .tool li.character .layer p label{ position:relative; top:4px; margin:0 7px 0 0; color:#333; letter-spacing:-1px;}
.xpress-editor .tool li.character .layer p input{ padding:3px 0 0 4px; margin:0 4px 0 0; width:300px; _width /**/:306px; height:16px; _height /**/:20px; border:1px solid #acacac; border-right:1px solid #dadada; border-bottom:1px solid #dadada;}
.xpress-editor .tool li.character .layer p button{ position:relative; *top:1px; width:38px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_confirm.gif) no-repeat;}
.xpress-editor .tool li.character .layer p button span{ position:absolute; width:0; height:0; overflow:hidden; visibility:hidden;}

.xpress-editor .tool li.find .layer{ width:242px;}
.xpress-editor .tool li.find .layer h3{ background:#f2f2f2; color:#333; height:21px; margin:0 0 11px 0; padding:7px 0 0 5px;}
.xpress-editor .tool li.find .layer .menu_tab{ position:relative; z-index:20; width:100%; *zoom:1;}
.xpress-editor .tool li.find .layer .menu_tab:after{ content:""; display:block; clear:both;}
.xpress-editor .tool li.find .layer .layer_tab{ position:relative; left:10px; padding:0; margin:0; clear:both;}
.xpress-editor .tool li.find .layer .layer_tab li{ position:relative; z-index:1; float:left; margin-right:1px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_tab.gif) no-repeat 0 0;}
.xpress-editor .tool li.find .layer .layer_tab li a{ position:relative; display:block; float:left; left:2px; height:15px; padding:4px 9px 0 5px; color:#404040; text-decoration:none; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_tab.gif) no-repeat right 0;}
.xpress-editor .tool li.find .layer.find .layer_tab li.tab1,
.xpress-editor .tool li.find .layer.replace .layer_tab li.tab2{ top:-1px; margin-bottom:-1px;}
.xpress-editor .tool li.find .layer.find .layer_tab li.tab1 a,
.xpress-editor .tool li.find .layer.replace .layer_tab li.tab2 a{ height:18px;}
.xpress-editor .tool li.find .layer .container{ position:relative; z-index:1; clear:both; top:-2px;}
.xpress-editor .tool li.find .layer .container .bx{ display:none; position:relative; width:222px; left:10px; clear:both; z-index:1; background:url(/xe/modules/editor/skins/xpresseditor/img/bx_find.gif) no-repeat;}
.xpress-editor .tool li.find .layer.find .container #find,
.xpress-editor .tool li.find .layer.replace .container #replace{ display:block;}

.xpress-editor .tool li.find .layer .bx fieldset{ position:relative; padding:13px 0 17px 11px;}
.xpress-editor .tool li.find .layer .bx fieldset *{ vertical-align:top;}
.xpress-editor .tool li.find .layer .bx label{ position:relative; top:4px; margin:0 7px 0 0; font-size:11px; letter-spacing:-1px; color:#333;}
.xpress-editor .tool li.find .layer .bx input{ padding:3px 0 0 4px; width:144px; _width /**/:150px; height:14px; _height /**/:19px; border:1px solid #acacac; border-right:1px solid #dadada; border-bottom:1px solid #dadada;}
.xpress-editor .tool li.find .layer .bx .cap{ position:absolute; left:0; bottom:0; display:block; width:222px; height:2px; _margin:0 0 -1px 0; overflow:hidden; background:#fff url(/xe/modules/editor/skins/xpresseditor/img/bx_find.gif) no-repeat left bottom; font-size:0; line-height:0;}
.xpress-editor .tool li.find .layer .bx#replace fieldset{ height:45px; _height /**/:75px;}
.xpress-editor .tool li.find .layer .bx#replace fieldset #keyword2{ margin-bottom:6px;}
.xpress-editor .tool li.find .layer .btn_area button{ display:none; *margin:0 2px !important;}
.xpress-editor .tool li.find .layer.find .btn_area .find_next{ display:inline; width:62px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_find_next_strong.gif) no-repeat;}
.xpress-editor .tool li.find .layer.replace .btn_area .find_next{ display:inline; width:55px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_find_next.gif) no-repeat;}
.xpress-editor .tool li.find .layer.replace .btn_area .replace{ display:inline; width:48px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_replace.gif) no-repeat;}
.xpress-editor .tool li.find .layer.replace .btn_area .replace_all{ display:inline; width:69px; height:21px; background:url(/xe/modules/editor/skins/xpresseditor/img/btn_layer_replace_all.gif) no-repeat;}
.xpress-editor .tool li.find .layer .btn_area .cancel{ display:inline;}

.xpress-editor .tool li.extensions .layer{ width:auto; white-space:nowrap; padding:5px 10px;}
.xpress-editor .tool li.extensions .layer li{ margin:2px 0;}
.xpress-editor .tool li.extensions .layer li a { color:#000; text-decoration:none; }
.xpress-editor .tool li.extensions .layer li a:hover { text-decoration:underline; }

/* File Uploader */
.xpress-editor .fileUploader{ clear:both; padding-top:5px; margin-bottom:10px;}
.xpress-editor .fileUploader:after{ content:""; display:block; clear:both;}
.xpress-editor .fileUploader .preview{ float:left; width:64px; height:64px; border:1px solid #ccc;; padding:2px; margin:0 10px 5px 0;}
.xpress-editor .fileUploader .preview.black { background-color:#000; border:1px solid #666;}
.xpress-editor .fileUploader .preview img{ display:block; width:64px; height:64px;}
.xpress-editor .fileUploader .fileListArea{ float:left; width:260px; margin:0 10px 5px 0;}
.xpress-editor .fileUploader .fileListArea select{ width:100%; height:70px; overflow:auto;}
.xpress-editor .fileUploader .fileListArea select option{ font-size:11px;}
.xpress-editor .fileUploader .fileListArea.black select { background-color:#000; border:1px solid #666;}
.xpress-editor .fileUploader .fileListArea.black select option { color:#aaa; }
.xpress-editor .fileUploader .fileUploadControl{ clear:right;}
.xpress-editor .fileUploader .fileUploadControl .button{ margin-bottom:5px;}
.xpress-editor .fileUploader .file_attach_info{ clear:right; margin:5px 0;}

/* Auto Save */
.xpress-editor .autosave_message { display:none; background: #f6ffdb; padding:6px 10px; margin:0; line-height:1;}
.xpress-editor.black .autosave_message { display:none; background:#222; padding:6px 10px; margin:0; line-height:1; color:#fff; }
.xpress-editor .input_syntax.black { background:transparent; color:#fff; }
