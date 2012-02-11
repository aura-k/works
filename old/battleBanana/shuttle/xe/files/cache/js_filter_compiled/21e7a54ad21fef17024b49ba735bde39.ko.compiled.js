function install(fo_obj){
	var validator = xe.getApp('validator')[0];
	if(!validator) return false;
	if(!fo_obj.elements['_filter']) jQuery(fo_obj).prepend('<input type="hidden" name="_filter" value="" />');
	fo_obj.elements['_filter'].value = 'install';
	validator.cast('ADD_CALLBACK', ['install', function(form){
		var params={}, responses=[], elms=form.elements, data=jQuery(form).serializeArray();
		jQuery.each(data, function(i, field){
			var val = jQuery.trim(field.value);
			if(!val) return true;
			if(/\[\]$/.test(field.name)) field.name = field.name.replace(/\[\]$/, '');
			if(params[field.name]) params[field.name] += '|@|'+val;
			else params[field.name] = field.value;
		});
		if(params['password1']) { params['password'] = params['password1']; delete params['password1']; }
		responses = ['error','message','redirect_url'];
		exec_xml('install','procInstall', params, completeInstalled, responses, params, form);
	}]);
	validator.cast('VALIDATE', [fo_obj,'install']);
	return false;
};

(function($){
	var validator = xe.getApp('Validator')[0];
	if(!validator) return false;
	validator.cast('ADD_FILTER', ['install', {
		'db_type': {required:true},
		'db_hostname': {required:true,minlength:1,maxlength:250},
		'db_port': {minlength:1,maxlength:250},
		'db_userid': {required:true,minlength:1,maxlength:250},
		'db_password': {required:true,minlength:1,maxlength:250},
		'db_database': {required:true,minlength:1,maxlength:250},
		'db_table_prefix': {required:true,minlength:2,maxlength:20,rule:'alpha'},
		'user_id': {required:true,minlength:2,maxlength:20,rule:'userid'},
		'password1': {required:true,minlength:1,maxlength:20},
		'password2': {required:true,minlength:1,equalto:'password1'},
		'user_name': {required:true,minlength:2,maxlength:20},
		'nick_name': {required:true,minlength:2,maxlength:20},
		'email_address': {required:true,minlength:1,maxlength:200,rule:'email'}
	}]);
	validator.cast('ADD_MESSAGE', ['db_type', 'DB 종류']);
	validator.cast('ADD_MESSAGE', ['db_hostname', 'DB 호스트네임']);
	validator.cast('ADD_MESSAGE', ['db_port', 'DB Port']);
	validator.cast('ADD_MESSAGE', ['db_userid', 'DB 아이디']);
	validator.cast('ADD_MESSAGE', ['db_password', 'DB 비밀번호']);
	validator.cast('ADD_MESSAGE', ['db_database', 'DB 데이터베이스']);
	validator.cast('ADD_MESSAGE', ['db_table_prefix', '테이블 머리말']);
	validator.cast('ADD_MESSAGE', ['user_id', '아이디']);
	validator.cast('ADD_MESSAGE', ['password1', '비밀번호']);
	validator.cast('ADD_MESSAGE', ['password2', '비밀번호 확인']);
	validator.cast('ADD_MESSAGE', ['user_name', '이름']);
	validator.cast('ADD_MESSAGE', ['nick_name', '닉네임']);
	validator.cast('ADD_MESSAGE', ['email_address', '이메일 주소']);
	validator.cast('ADD_MESSAGE', ['password', '비밀번호']);
	validator.cast('ADD_MESSAGE', ['use_rewrite', 'rewrite mod 사용']);
	validator.cast('ADD_MESSAGE', ['time_zone', '표준 시간대']);
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