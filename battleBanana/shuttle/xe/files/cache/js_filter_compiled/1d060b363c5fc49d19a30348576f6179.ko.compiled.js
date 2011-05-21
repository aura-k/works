function insert_board(fo_obj){
	var validator = xe.getApp('validator')[0];
	if(!validator) return false;
	if(!fo_obj.elements['_filter']) jQuery(fo_obj).prepend('<input type="hidden" name="_filter" value="" />');
	fo_obj.elements['_filter'].value = 'insert_board';
	validator.cast('ADD_CALLBACK', ['insert_board', function(form){
		var params={}, responses=[], elms=form.elements, data=jQuery(form).serializeArray();
		jQuery.each(data, function(i, field){
			var val = jQuery.trim(field.value);
			if(!val) return true;
			if(/\[\]$/.test(field.name)) field.name = field.name.replace(/\[\]$/, '');
			if(params[field.name]) params[field.name] += '|@|'+val;
			else params[field.name] = field.value;
		});
		if(params['mid']) { params['board_name'] = params['mid']; delete params['mid']; }
		responses = ['error','message','module','act','page','module_srl'];
		if(!confirm('등록하시겠습니까?')) return false;
		exec_xml('board','procBoardAdminInsertBoard', params, completeInsertBoard, responses, params, form);
	}]);
	validator.cast('VALIDATE', [fo_obj,'insert_board']);
	return false;
};

(function($){
	var validator = xe.getApp('Validator')[0];
	if(!validator) return false;
	validator.cast('ADD_FILTER', ['insert_board', {
		'mid': {required:true,maxlength:40,rule:'alpha_number'},
		'browser_title': {required:true,maxlength:250},
		'list_count': {required:true,rule:'number'},
		'search_list_count': {required:true,rule:'number'},
		'page_count': {required:true,rule:'number'}
	}]);
	validator.cast('ADD_MESSAGE', ['mid', '모듈 이름']);
	validator.cast('ADD_MESSAGE', ['browser_title', '브라우저 제목']);
	validator.cast('ADD_MESSAGE', ['list_count', '목록 수']);
	validator.cast('ADD_MESSAGE', ['search_list_count', '검색 목록 수']);
	validator.cast('ADD_MESSAGE', ['page_count', '페이지 수']);
	validator.cast('ADD_MESSAGE', ['board_name', 'board_name']);
	validator.cast('ADD_MESSAGE', ['module_srl', 'module_srl']);
	validator.cast('ADD_MESSAGE', ['module_category_srl', 'module_category_srl']);
	validator.cast('ADD_MESSAGE', ['layout_srl', 'layout_srl']);
	validator.cast('ADD_MESSAGE', ['skin', '스킨']);
	validator.cast('ADD_MESSAGE', ['use_category', '분류 사용']);
	validator.cast('ADD_MESSAGE', ['order_target', '정렬대상']);
	validator.cast('ADD_MESSAGE', ['order_type', '정렬방법']);
	validator.cast('ADD_MESSAGE', ['except_notice', '공지사항 제외']);
	validator.cast('ADD_MESSAGE', ['use_anonymous', '익명 사용']);
	validator.cast('ADD_MESSAGE', ['consultation', '상담 기능']);
	validator.cast('ADD_MESSAGE', ['secret', '비밀글 기능']);
	validator.cast('ADD_MESSAGE', ['admin_mail', '관리자 메일']);
	validator.cast('ADD_MESSAGE', ['is_default', '기본']);
	validator.cast('ADD_MESSAGE', ['description', '설명']);
	validator.cast('ADD_MESSAGE', ['header_text', '상단 내용']);
	validator.cast('ADD_MESSAGE', ['footer_text', '하단 내용']);
	validator.cast('ADD_MESSAGE', ['isnull', '%s을 입력해주세요.']);
	validator.cast('ADD_MESSAGE', ['outofrange', '%s의 글자 수를 맞추어 주세요.']);
	validator.cast('ADD_MESSAGE', ['equalto', '%s이 잘못되었습니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_email', '%s의 형식이 잘못되었습니다. (예: xe@xpressengine.com)']);
	validator.cast('ADD_MESSAGE', ['invalid_userid', '%s의 형식이 잘못되었습니다.\n영문, 숫자와 _로 만드실 수 있으며, 첫 글자는 영문이어야 합니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_user_id', '%s의 형식이 잘못되었습니다.\n영문, 숫자와 _로 만드실 수 있으며, 첫 글자는 영문이어야 합니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_homepage', '%s의 형식이 잘못되었습니다. (예: http://www.xpressengine.com)']);
	validator.cast('ADD_MESSAGE', ['invalid_korean', '%s의 형식이 잘못되었습니다. 한글로만 입력하셔야 합니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_korean_number', '%s의 형식이 잘못되었습니다. 한글과 숫자로만 입력하셔야 합니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_alpha', '%s의 형식이 잘못되었습니다. 영문으로만 입력하셔야 합니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_alpha_number', '%s의 형식이 잘못되었습니다. 영문과 숫자로만 입력하셔야 합니다.']);
	validator.cast('ADD_MESSAGE', ['invalid_number', '%s의 형식이 잘못되었습니다. 숫자로만 입력하셔야 합니다.']);
})(jQuery);