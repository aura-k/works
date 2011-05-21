function copy_module(fo_obj){
	var validator = xe.getApp('validator')[0];
	if(!validator) return false;
	if(!fo_obj.elements['_filter']) jQuery(fo_obj).prepend('<input type="hidden" name="_filter" value="" />');
	fo_obj.elements['_filter'].value = 'copy_module';
	validator.cast('ADD_CALLBACK', ['copy_module', function(form){
		var params={}, responses=[], elms=form.elements, data=jQuery(form).serializeArray();
		jQuery.each(data, function(i, field){
			var val = jQuery.trim(field.value);
			if(!val) return true;
			if(/\[\]$/.test(field.name)) field.name = field.name.replace(/\[\]$/, '');
			if(params[field.name]) params[field.name] += '|@|'+val;
			else params[field.name] = field.value;
		});
		responses = ['error','message'];
		exec_xml('module','procModuleAdminCopyModule', params, completeCopyModule, responses, params, form);
	}]);
	validator.cast('VALIDATE', [fo_obj,'copy_module']);
	return false;
};

(function($){
	var validator = xe.getApp('Validator')[0];
	if(!validator) return false;
	validator.cast('ADD_FILTER', ['copy_module', {
		'module_srl': {required:true},
		'mid_1': {rule:'alpha_number'},
		'mid_2': {rule:'alpha_number'},
		'mid_3': {rule:'alpha_number'},
		'mid_4': {rule:'alpha_number'},
		'mid_5': {rule:'alpha_number'},
		'mid_6': {rule:'alpha_number'},
		'mid_7': {rule:'alpha_number'},
		'mid_8': {rule:'alpha_number'},
		'mid_9': {rule:'alpha_number'},
		'mid_10': {rule:'alpha_number'}
	}]);
	validator.cast('ADD_MESSAGE', ['module_srl', 'module_srl']);
	validator.cast('ADD_MESSAGE', ['mid_1', 'mid_1']);
	validator.cast('ADD_MESSAGE', ['mid_2', 'mid_2']);
	validator.cast('ADD_MESSAGE', ['mid_3', 'mid_3']);
	validator.cast('ADD_MESSAGE', ['mid_4', 'mid_4']);
	validator.cast('ADD_MESSAGE', ['mid_5', 'mid_5']);
	validator.cast('ADD_MESSAGE', ['mid_6', 'mid_6']);
	validator.cast('ADD_MESSAGE', ['mid_7', 'mid_7']);
	validator.cast('ADD_MESSAGE', ['mid_8', 'mid_8']);
	validator.cast('ADD_MESSAGE', ['mid_9', 'mid_9']);
	validator.cast('ADD_MESSAGE', ['mid_10', 'mid_10']);
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