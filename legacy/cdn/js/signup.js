(function($){$(function(){
	var validator				= new Array();
	var elSubmit				= $('button[type="submit"]'	);
	var elServer				= $('#server'				);
	var elName					= $('#name'					);
	var elUsername				= $('#username'				);
	var elPassword				= $('#password'				);
	var elPasswordConfirm		= $('#passwordConfirm'		);
	var elEmail					= $('#email'				);
	var elEmailConfirm			= $('#emailConfirm'			);
	var elSex					= $('input:radio'			).parent();
	var elServerBlock			= elServer			.parent().parent();
	var	elNameBlock				= elName			.parent().parent();
	var elUsernameBlock			= elUsername		.parent().parent();
	var elPasswordBlock			= elPassword		.parent().parent();
	var elPasswordConfirmBlock	= elPasswordConfirm	.parent().parent();
	var elEmailBlock			= elEmail			.parent().parent();
	var elEmailConfirmBlock		= elEmailConfirm	.parent().parent();
	var elSexBlock				= elSex				.parent().parent();
	var elServerHelp			= elServer			.parent().next().children();
	var elNameHelp				= elName			.parent().next().children();
	var elPasswordHelp			= elPassword		.parent().next().children();
	var elPasswordConfirmHelp	= elPasswordConfirm	.parent().next().children();
	var elEmailHelp				= elEmail			.parent().next().children();
	var elEmailConfirmHelp		= elEmailConfirm	.parent().next().children();
	var elSexHelp				= elSex				.parent().next().children();
	elUsernameBlock									.hide();
	elPasswordConfirmBlock							.hide();
	elEmailConfirmBlock								.hide();
	function signupValidation(field,valid){validator[field]=valid;if(validator['server']==true && validator['name']==true && validator['password']==true && validator['email']==true && validator['sex']==true){elSubmit.removeAttr('disabled');}else{elSubmit.attr('disabled','disabled');}}
	elServer.change(function(){
		elServerBlock								.removeClass('has-error').addClass('has-success');
		elServerHelp								.html('Servidor selecionado.');
		signupValidation('server',true);
	});
	elName.focusout(function(){
		if(elName.val()!=''){
			$.ajax({
				url		:"ajax?action=signup&subject=summoner",
				type	:"POST",
				data	:{'name':elName.val()},
				dataType:"json"
			}).done(function(data){
				signupValidation('name',false);
				switch(data.signup.summoner){
					case 1:
						elNameBlock					.removeClass('has-error').addClass('has-success');
						elNameHelp					.html('Este nome de invocador esta <strong>disponível</strong> para uso.');
						elUsernameBlock				.children('div').children('span').children('strong').text(data.signup.username);
						elUsernameBlock				.slideDown('slow');
						signupValidation('name',true);
						break;
					case 2:
						elNameBlock					.removeClass('has-success').addClass('has-error');
						elNameHelp					.html('Este nome de invocador <strong>já esta em uso</strong> no sistema.');
						elUsernameBlock				.slideUp('slow');
						break;
					case 3:
						elNameBlock					.removeClass('has-success').addClass('has-error');
						elNameHelp					.html('Este nome de invocador <strong>não existe</strong> no servidor.');
						elUsernameBlock				.slideUp('slow');
						break;
					case 503:
						$('.api503'					).remove();
						$('legend'					).append('<div class="api503 alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></button><h3>Código 503 API Riot</h3><p>Caro invocador, não podemos concluir seu cadastro, pois a API RIOT esta indisponível neste momento.</p></div>');
						break;
				}
			}).fail(function(){/*alert("error");*/}).always(function(){/*alert("complete");*/}); 
		}else{
			elNameBlock								.removeClass('has-success').removeClass('has-error');
			elNameHelp								.html('Use o seu nome de invocador <strong>visível</strong> no jogo.');
			elUsernameBlock							.slideUp('slow');
			signupValidation('name',false);
		}
	});
	elPassword.keyup(function(){
		if(elPassword.val().length>=6){
			elPasswordConfirmBlock.slideDown('slow');
			elPasswordBlock							.removeClass('has-error').addClass('has-success');
			elPasswordHelp							.html('Senha contém 6 caracteres.');
		}else{
			elPasswordConfirmBlock.slideUp('slow');
			elPasswordBlock							.removeClass('has-success').addClass('has-error');
			elPasswordConfirmBlock					.removeClass('has-success').removeClass('has-error');
			elPasswordHelp							.html('Cadastre sua senha. Com no <strong>mínimo 6 caracteres</strong>.');
			elPasswordConfirmHelp					.html('Repita a senha.');
			signupValidation('password',false);
		}
	});
	elPasswordConfirm.keyup(function(){
		if(elPassword.val()==elPasswordConfirm.val()){
			elPasswordBlock							.removeClass('has-error').addClass('has-success');
			elPasswordConfirmBlock					.removeClass('has-error').addClass('has-success');
			elPasswordHelp							.html('Valores de senha <strong>correspondem</strong>.');
			elPasswordConfirmHelp					.html(elPasswordHelp.html());
			signupValidation('password',true);
		}else{
			elPasswordBlock							.removeClass('has-success').addClass('has-error');
			elPasswordConfirmBlock					.removeClass('has-success').addClass('has-error');
			elPasswordHelp							.html('Valores de senha <strong>estão diferentes</strong>.');
			elPasswordConfirmHelp					.html(elPasswordHelp.html());
			signupValidation('password',false);
		}
	});
	elEmail.keyup(function(){
		if(elEmail.val()!=''){
			if(isValidEmailAddress(elEmail.val())){
				elEmailBlock						.removeClass('has-error').addClass('has-success');
				elEmailHelp							.html('Email <strong>válido</strong>.');
				elEmailConfirmBlock					.slideDown('slow');
			}else{
				elEmailBlock						.removeClass('has-success').addClass('has-error');
				elEmailHelp							.html('Cadastre um email <strong>válido</strong>.');
				elEmailConfirmHelp					.html('Repita o email.');
				elEmailConfirmBlock					.slideUp('slow');
				signupValidation('email',false);
			}
		}else{
			elEmailConfirmBlock						.slideUp('slow');
			elEmailBlock							.removeClass('has-success').removeClass('has-error');
			elEmailConfirmBlock						.removeClass('has-success').removeClass('has-error');
			elEmailHelp								.html('Cadastre um email <strong >válido</strong>.');
			elEmailConfirmHelp						.html('Repita o email.');
			signupValidation('email',false);
		}
	});
	elEmailConfirm.keyup(function(){
		if(elEmail.val()==elEmailConfirm.val()){
			elEmailBlock							.removeClass('has-error').addClass('has-success');
			elEmailConfirmBlock						.removeClass('has-error').addClass('has-success');
			elEmailHelp								.html('Valores de email <strong>correspondem</strong>.');
			elEmailConfirmHelp						.html(elEmailHelp.html());
			signupValidation('email',true);
		}else{
			elEmailBlock							.removeClass('has-success').addClass('has-error');
			elEmailConfirmBlock						.removeClass('has-success').addClass('has-error');
			elEmailHelp								.html('Valores de email <strong>estão diferentes</strong>.');
			elEmailConfirmHelp						.html(elEmailHelp.html());
			signupValidation('email',false);
		}
	});
	elSex.click(function(){
		elSexBlock									.removeClass('has-error').addClass('has-success');
		elSexHelp									.html('Sexo <strong>selecionado</strong>.');
		signupValidation('sex',true);
	});
	$('form').submit(function(e){
		e.preventDefault();
		modalLoader(true);
		$.ajax({
			url		:"ajax?action=signup&subject=validate",
			type	:"POST",
			data	:{
				'name'				:elName						.val(),
				'server'			:elServer					.val(),
				'password'			:elPassword					.val(),
				'passwordConfirm'	:elPasswordConfirm			.val(),
				'email'				:elEmail					.val(),
				'emailConfirm'		:elEmailConfirm				.val(),
				'sex'				:$('input:radio:checked')	.val(),
			},
			dataType:"json"
		}).done(function(data){
			if(data.signup.validate.success){window.location.href=$.App.url+data.signup.validate.success;}
		}).fail(function(){/*alert("error");*/}).always(function(){/*alert("complete");*/}); 
	});
});})(jQuery);