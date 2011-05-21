function insert_category(fo_obj){
	var validator = xe.getApp('validator')[0];
	if(!validator) return false;
	if(!fo_obj.elements['_filter']) jQuery(fo_obj).prepend('<input type="hidden" name="_filter" value="" />');
	fo_obj.elements['_filter'].value = 'insert_category';
	validator.cast('ADD_CALLBACK', ['insert_category', function(form){
		var params={}, responses=[], elms=form.elements, data=jQuery(form).serializeArray();
		jQuery.each(data, function(i, field){
			var val = jQuery.trim(field.value);
			if(!val) return true;
			if(/\[\]$/.test(field.name)) field.name = field.name.replace(/\[\]$/, '');
			if(params[field.name]) params[field.name] += '|@|'+val;
			else params[field.name] = field.value;
		});
		if(params['category_title']) { params['title'] = params['category_title']; delete params['category_title']; }
		if(params['category_color']) { params['color'] = params['category_color']; delete params['category_color']; }
		responses = ['error','message','module_srl','category_srl','parent_srl','xml_file'];
		if(!confirm('등록하시겠습니까?')) return false;
		exec_xml('document','procDocumentInsertCategory', params, completeInsertCategory, responses, params, form);
	}]);
	validator.cast('VALIDATE', [fo_obj,'insert_category']);
	return false;
};

(function($){
	var validator = xe.getApp('Validator')[0];
	if(!validator) return false;
	validator.cast('ADD_FILTER', ['insert_category', {
		'module_srl': {required:true},
		'category_srl': {required:true},
		'category_title': {required:true}
	}]);
	validator.cast('ADD_MESSAGE', ['module_srl', 'module_srl']);
	validator.cast('ADD_MESSAGE', ['category_srl', '분류']);
	validator.cast('ADD_MESSAGE', ['category_title', '분류 명']);
	validator.cast('ADD_MESSAGE', ['parent_srl', 'parent_srl']);
	validator.cast('ADD_MESSAGE', ['title', '제목']);
	validator.cast('ADD_MESSAGE', ['color', 'color']);
	validator.cast('ADD_MESSAGE', ['expand', '펼침']);
	validator.cast('ADD_MESSAGE', ['group_srls', 'group_srls']);
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