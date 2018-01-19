$(function(){
	//获取随机背景图片
	var rand = Math.floor(Math.random()*5)+1;
	$('body').css({
		'background':'url('+ThinkPHP['IMG']+'/login_bg'+rand+'.jpg) no-repeat',
		'background-size':'100%'
	})

	//登录
	$('#login').validate({
		submitHandler:function(form){
			$('#verify_register').attr('form-click','login');
			$('#verify_register').dialog('open');
		},
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:20,
			},
			password:{
				required:true,
				minlength:6,
			},
		},
		messages:{
			username:{
				required:'必填',
				minlength:'不能小于{0}位',
				maxlength:'不能大于{0}位',
			},
			password:{
				required:'必填',
				minlength:'不能小于{0}位',
			},
		}
	})
	//注册
	$('#register').dialog({
		autoOpen:false,
		width:430,
		heigh:370,
		title:'注册',
		modal:true,
		resizable:false,
		closeText:'关闭',
		buttons:[{
			text:'提交',
			click:(function() {
				$(this).submit();
			})
		}]
	}).validate({
		submitHandler:function(form){
			$('#verify_register').attr('form-click','register');
			$('#verify_register').dialog('open');
		},
		errorLabelContainer:'ol.register_error',
		wrapper:'li',
		showErrors:function(errorMap,errorList){
			var errors=this.numberOfInvalids();
			if(errors>0)
			{
				$('#register').dialog('option','height',errors*20+370);
			}else
			{
				$('#register').dialog('option','height',370);
			}
			this.defaultShowErrors();
		},
		highlight:function(element,errorClass){
			$(element).css('border','1px solid red');
			$(element).parent().find('span').html('*').removeClass('succ');
		},
		unhighlight:function(element,errorClass)
		{
			$(element).css('border','1px solid #ccc');
			$(element).parent().find('span').html('&nbsp;').addClass('succ');
		},
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:20,
				remote:{
					url : ThinkPHP['MODULE']+'/User/checkUsername',
					type : 'POST',
					beforeSend:function(){
						$('#username').next().html('&nbsp;').removeClass('succ').addClass('loading');
					},
					complete:function(jqXHR){
						if(jqXHR.responseText=='true'){
							$('#username').next().html('&nbsp;').removeClass('loading').addClass('succ');
						}else {
							$('#username').next().html('*').removeClass('loading').removeClass('succ');
						}
					}
				}
			},
			password:{
				required:true,
				minlength:6,
			},
			repassword:{
				required:true,
				equalTo:'#password',
			},
			email:{
				required:true,
				email:true,
				remote:{
					url : ThinkPHP['MODULE']+'/User/checkEmail',
					type : 'POST',
					beforeSend:function(){
						$('#email').next().html('&nbsp;').removeClass('succ').addClass('loading');
					},
					complete:function(jqXHR){
						if(jqXHR.responseText=='true'){
							$('#email').next().html('&nbsp;').removeClass('loading').addClass('succ');
						}else {
							$('#email').next().html('*').removeClass('loading').removeClass('succ');
						}
					}
				}
			}
		},
		messages:{
			username:{
				required:'用户名不得为空',
				minlength: $.format('用户名不得小于{0}位'),
				maxlength: $.format('用户名不得大于{0}位'),
				remote:'用户名已注册',
			},
			password:{
				required:'密码不得为空',
				minlength: $.format('密码不得小于{0}位'),
			},
			repassword:{
				required:'确认密码不得为空',
				equalTo: '确认密码不一致',
			},
			email:{
				required:'邮箱不得为空',
				email:'请输入正确邮箱格式',
				remote:'邮箱已注册',
			}
		}
	});
	//点击注册链接
	$('#reg_link').click(function() {
		$('#register').dialog('open')
	});
	//点击更换验证码
	var verifyimg=$('.verifyimg').attr('src');
	$('.changeimg').click(function(){
		if(verifyimg.indexOf('?')>0){
			$('.verifyimg').attr('src',verifyimg+'&random='+Math.random());
		}else{
			$('.verifyimg').attr('src',verifyimg+'?random='+Math.random());
		}
	});
	//加载页面
	$('#loading').dialog({
		autoOpen: false,
		width: 180,
		heigh: 40,
		modal: true,
		resizable: false,
		draggable:false,
		closeOnEscape:false,
	}).parent().find('.ui-widget-header').hide();

	//验证码
	$('#verify_register').dialog({
		autoOpen:false,
		width:290,
		heigh:300,
		title:'验证码',
		modal:true,
		resizable:false,
		closeText:'关闭',
		buttons:[{
			text:'完成',
			click:(function() {
				$(this).submit();
			})
		}]
	}).validate({
		submitHandler:function(form){
			if($('#verify_register').attr('form-click')=='register'){
				$('#register').ajaxSubmit({
					url : ThinkPHP['MODULE']+'/User/register',
					type : 'POST',
					beforeSubmit:function(){
						$('#loading').dialog('open');
					},
					success:function(responseText){
						$('#loading').css('background','url('+ThinkPHP['IMG']+'/success.gif) no-repeat 20px center').html('注册成功......');
						setTimeout(function(){
							if(verifyimg.indexOf('?')>0){
								$('.verifyimg').attr('src',verifyimg+'&random='+Math.random());
							}else{
								$('.verifyimg').attr('src',verifyimg+'?random='+Math.random());
							}
							$('#loading').css('background','url('+ThinkPHP['IMG']+'/loading.gif) no-repeat 20px center').html('数据交互中......');
							$('#loading').dialog('close');
							$('#register').dialog('close');
							$('#verify_register').dialog('close');
							$('#verify_register').resetForm();
							$('#register').resetForm();
							$('#register span.star').html('*').removeClass('succ');
						},1000)
					}
				})
			}else if($('#verify_register').attr('form-click')=='login'){
				$('#login').ajaxSubmit({
					url:ThinkPHP['MODULE']+'/User/login',
					type:'POST',
					beforeSubmit:function(){
						$('#loading').dialog('open');
					},
					success:function(responseText){
						if(responseText==-9){
							$('#loading').dialog('option','width',210).css('background','url('+ThinkPHP['IMG']+'/error.png) no-repeat 20px center').html('账号或密码不正确');

							setTimeout(function(){
								$('#loading').dialog('close');
								$('#verify_register').dialog('close');
								$('#loading').dialog('option','width',180).css('background','url('+ThinkPHP['IMG']+'/loading.gif) no-repeat 20px center').html('数据交互中......');
							},2000);
						}else{
							$('#loading').css('background','url('+ThinkPHP['IMG']+'/success.gif) no-repeat 20px center').html('登录成功......');
							setTimeout(function(){
								location.href=ThinkPHP['INDEX'];
							},1000);
						}

					},
				})
			}
		},
		errorLabelContainer:'ol.verify_error',
		wrapper:'li',
		showErrors:function(errorMap,errorList){
			var errors=this.numberOfInvalids();
			if(errors>0)
			{
				$('#verify_register').dialog('option','height',errors*20+300);
			}else
			{
				$('#verify_register').dialog('option','height',300);
			}
			this.defaultShowErrors();
		},
		highlight:function(element,errorClass){
			$(element).css('border','1px solid red');
			$(element).parent().find('span').html('*').removeClass('succ');
		},
		unhighlight:function(element,errorClass)
		{
			$(element).css('border','1px solid #ccc');
			$(element).parent().find('span').html('&nbsp;').addClass('succ');
		},
		rules:{
			verify:{
				required:true,
				remote:{
					url:ThinkPHP['MODULE']+'/User/checkVerify',
					type:'POST',
				}
			}
		},
		messages:{
			verify: {
				required: '验证码不能为空',
				remote:'验证码不正确',
			}
		}
	});
})

