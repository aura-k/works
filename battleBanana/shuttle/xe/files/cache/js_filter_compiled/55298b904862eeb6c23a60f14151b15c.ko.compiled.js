function insert_editor_module_config(fo_obj){
	var validator = xe.getApp('validator')[0];
	if(!validator) return false;
	if(!fo_obj.elements['_filter']) jQuery(fo_obj).prepend('<input type="hidden" name="_filter" value="" />');
	fo_obj.elements['_filter'].value = 'insert_editor_module_config';
	validator.cast('ADD_CALLBACK', ['insert_editor_module_config', function(form){
		var params={}, responses=[], elms=form.elements, data=jQuery(form).serializeArray();
		jQuery.each(data, function(i, field){
			var val = jQuery.trim(field.value);
			if(!val) return true;
			if(/\[\]$/.test(field.name)) field.name = field.name.replace(/\[\]$/, '');
			if(params[field.name]) params[field.name] += '|@|'+val;
			else params[field.name] = field.value;
		});
		responses = ['error','message'];
		if(!confirm('등록하시겠습니까?')) return false;
		exec_xml('editor','procEditorInsertModuleConfig', params, filterAlertMessage, responses, params, form);
	}]);
	validator.cast('VALIDATE', [fo_obj,'insert_editor_module_config']);
	return false;
};

(function($){
	var validator = xe.getApp('Validator')[0];
	if(!validator) return false;
	validator.cast('ADD_FILTER', ['insert_editor_module_config', {

	}]);
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