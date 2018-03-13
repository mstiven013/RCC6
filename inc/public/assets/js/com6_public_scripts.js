//Modals
jQuery(function($){

	var modals = $('.com6-modal, .com6-alert');
	var close = $('.com6_btn-close, .modal-bg, .alert-bg');
	var urlClass = com6Scripts.pluginsUrl + "/comuna6/inc/public/assets/users.Class.php";

	close.on('click', function() {
		modals.removeClass('show');
	});

	$(document).keyup(function(e){
		if(e.keyCode == 27) {
			modals.removeClass('show');
		}
	});

	//Draw code without spaces
	$('#draws-form #code').on(
		'change input keyup', function(){
			this.value = this.value.replace(' ', '').trim();
		}
	);

	//Document whitout letter's, simbols, spaces
	$('.com6_form #document').on(
		'change input keyup', function(){
			this.value = this.value.replace(/\./g, '').replace(/\,/g, '').replace(/\-/g, '').replace(' ', '').replace(/[^0-9]/g,'').trim();
		}
	);

	//Document validation number of characters
	$('.com6_form #document').on('change keyup', function(){
		var v = $(this).val();
		if(v.length > 0 && v.length < 6) {
			$('.com6_form #document').addClass('error-document');
			document.getElementById('document-error').innerHTML = 'El documento debe tener al menos 6 digitos';
			$('.com6_form #document-error').css({'display': 'block'});
		} else if(v.length > 10) {
			$('.com6_form #document').addClass('error-document');
			document.getElementById('document-error').innerHTML = 'El documento no puede tener m&aacute;s de 10 digitos';
			$('.com6_form #document-error').css({'display': 'block'});
		} else {
			$('.com6_form #document-error').css({'display': 'none'});
			$('.com6_form #document').removeClass('error-document');
		}
	});

	//Onkeyup for code input from draws form
	$('#draws-form #code').on('focusout', function() {
		var c = $(this).val();
		var a = 'validate-code';
		var data = {'code': c, 'action': a};

		if(c != '' && c != ' '){
			$.ajax({
				method: 'post',
				url: urlClass,
				data: data
			}).done(function(info){
				var json_info = JSON.parse(info);

				switch(json_info.response) {
					case 'code-no-exist':
						if($('#draws-form #code').hasClass('correct')) {
							$('#draws-form #code').removeClass('correct');
						}
						if(!$('#draws-form #code').hasClass('error')) {
							$('#draws-form #code').addClass('error');
						}
						$('#draws-form #code-response').css({'display': 'block'});
						document.getElementById('code-response').innerHTML = "Este c&oacute;digo no existe";
						break;

					case 'code-registered':
						if($('#draws-form #code').hasClass('correct')) {
							$('#draws-form #code').removeClass('correct');
						}
						if(!$('#draws-form #code').hasClass('error')) {
							$('#draws-form #code').addClass('error');
						}
						$('#draws-form #code-response').css({'display': 'block'});
						document.getElementById('code-response').innerHTML = "Este c&oacute;digo fue registrado por alguien m&aacute;s.";
						break;					

					case 'code-valid':
						console.log(json_info.response);
						if($('#draws-form #code').hasClass('error')) {
							$('#draws-form #code').removeClass('error');
						}
						$('#draws-form #code').addClass('correct');
						$('#draws-form #code-response').css({'display': 'none'});
						break;
				}
			});
		}
	});

	//Validate field's form of register draw
	$('#draws-form #btn-register').on('click', function() {
		var flag = true;

		$('#draws-form input').each(function(){
			if($(this).val() == '') {
				$(this).addClass('error');
				flag = false;
			}
		});

		if(flag == false && $('.com6_form #document').hasClass('error-document')) {
			flag = 'false-and-document';
		} else if(flag == true && $('.com6_form #document').hasClass('error-document')) {
			flag = 'only-document';
		}

		if(flag == false) {
			console.log(flag);
			error = 'Todos los campos son obligatorios';
			$('#global-error').css({'display': 'block'});
			document.getElementById('global-error').innerHTML = error;

		} else if(flag == 'false-and-document') {

			console.log(flag);
			error = 'Todos los campos son obligatorios y hay un error al escribir el documento de identidad.';
			$('#global-error').css({'display': 'block'});
			document.getElementById('global-error').innerHTML = error;

		} else if(flag == 'only-document') {

			console.log(flag);
			error = 'Error al escribir el documento de identidad';
			$('#global-error').css({'display': 'block'});
			document.getElementById('global-error').innerHTML = error;

		} else {
			
			$('#global-error').css({'display': 'none'});
			
			if(!$('#draws-form #code').hasClass('error')) {
				if($('#terms-conditions:checked').is(':checked')) {

					if(!$('.important-note').hasClass('active')) {
						$('.important-note').addClass('active');
					}
					$('.com6-alert #save').addClass('active');
					$('#btn-alert').removeAttr('href');
					document.getElementById('text-alert').innerHTML = '';
					document.getElementById('btn-alert').innerHTML = 'Modificar datos';
					$('.com6-alert').addClass('show');

				} else {
					if($('#terms-response').length == 0) {
						textTerms = '<p id="terms-response" class="active">Debes aceptar los t&eacute;rminos y condiciones para continuar.</p>';
						$('#terms-response').css({'display':'block'});
						$('#draws-form #label-check').after(textTerms);
					} else {
						$('#terms-response').css({'display':'block'});
					}
					return false;
				}
			}

		}
	});

	$('#draws-form').on('submit', function(e) {

		e.preventDefault();
		var form = $(this).serialize();

		$.ajax({
			method: "POST",
			url: urlClass,
			data: form
		}).done(function(info){
			var json_info = JSON.parse(info);
			console.log(json_info);
			confirm(json_info);
		});

	});

	//Inputs validacion si estan vacios
	$('.com6_form input').each(function(){
		$(this).on('change keyup focusout', function(){
			if($(this).val() != '' && $(this).val() != ' ') {
				if($(this).hasClass('error')){
					$(this).removeClass('error');
				}
			} else {
				if(!$(this).hasClass('error')){
					$(this).addClass('error');
				}
			}
		});
	});

	//Terminos y condiciones validacion onchange
	$('.com6_form #terms-conditions').on('change', function(){
		if($('#terms-conditions:checked').is(':checked')) {
			if($('#terms-response').hasClass('active')) {
				$('#terms-response').css({'display': 'none'});
			}
		} else {
			if($('#terms-response').length == 0) {
				textTerms = '<p id="terms-response" class="active">Debes aceptar los t&eacute;rminos y condiciones para continuar.</p>';
				$('#draws-form #label-check').after(textTerms);
				$('#terms-response').css({'display': 'block'});
			} else {
				$('#terms-response').css({'display': 'block'});
			}
		}
	});

	//Reactivate form
	$('#reactivate-form, #view-draws-form, #minutes-form').on('submit', function(e){

		e.preventDefault();

		if($('#terms-conditions:checked').is(':checked')) {
			var form = $(this).serialize();

			$.ajax({
				method: "POST",
				url: urlClass,
				data: form
			}).done(function(info){
				var json_info = JSON.parse(info);

				$('.com6-alert').addClass('show');
				console.log(json_info);
				confirm(json_info);
			});			
		} else {
			if($('#terms-response').length == 0) {
				textTerms = '<p id="terms-response" class="active">Debes aceptar los t&eacute;rminos y condiciones para continuar.</p>';
				$('#draws-form #label-check').after(textTerms);
				$('#terms-response').css({'display': 'block'});
			} else {
				$('#terms-response').css({'display': 'block'});
			}
			return false;
		}

	});


	//Function to confirm json response
	var confirm = function(info) {

		switch(info.response) {

			//If user is reactivated correctly
			case 'reactivated':
				document.getElementById('text-alert').innerHTML = "El usuario con número de documento <b>" + $('#reactivate-form #document').val() + "</b> se ha reactivado correctamente.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar';

				$('#reactivate-form #document').val('')
			break;

			//If user ingresed no exists
			case 'error-activated':
				document.getElementById('text-alert').innerHTML = "El usuario con n&uacute;mero de documento <b>" + $('#reactivate-form #document').val() + "</b> no existe.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar e intentar de nuevo';
			break;

			//If code's draw eixsts
			case 'view-draws':
				document.getElementById('text-alert').innerHTML = "¡Hola, <b>" + info.name + "</b>! <br/> Usted tiene registrados los siguientes n&uacute;meros";

				$(info.numbers).each(function(){
					$('ul#numbers').append('<li>- ' + this + ' -</li>');
				});

				document.getElementById('btn-alert').innerHTML = 'Cerrar';

				$('#btn-alert, .alert-bg').on('click', function(){ 
					document.getElementById('numbers').innerHTML = "";
				});
				break;

			//If user no has codes registered
			case 'noregistered-code':
				document.getElementById('numbers').innerHTML = "";
				document.getElementById('text-alert').innerHTML = "¡Hola, <b>" + info.name + "</b>! <br/> Lo sentimos pero, usted no tiene ninguna boleta registrada.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar';
				break;

			//If user ingresed no exists
			case 'user-noexist':
				document.getElementById('numbers').innerHTML = "";
				document.getElementById('text-alert').innerHTML = "El usuario con número de documento <b>" + $('#view-draws-form #document').val() + "</b> no existe.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar e intentar de nuevo';
				break;

			//If user exists and update her state
			case 'activated':
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#minutes-form #name').val() + "</b>! <br/> Te has registrado con &eacute;xito a nuestro plan de minutos a celular a $50.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar';
				break;

			//If an error has ocurred
			case 'error-minutes':
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#minutes-form #name').val() + "</b>! <br/> Lo sentimos. Ha ocurrido un problema, por favor vuelve a intentarlo m&aacute;s tarde.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar';
				break;

			//Added correctly
			case 'document-added':
				$('.com6-alert .important-note').removeClass('active');
				$('.com6-alert #save').removeClass('active');
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> Su c&oacute;digo se ha registrado correctamente.<br/> El n&uacute;mero que le corresponde a su c&oacute;digo es el siguiente:<br/> <b>" + info.number + "</b>";
				document.getElementById('btn-alert').innerHTML = 'Cerrar e ingresar otro c&oacute;digo';
				$('#btn-alert').removeAttr('href');
				$('#draws-form #code').val('');
				break;

			//If user is inactive
			case 'user-inactive':
				$('.com6-alert .important-note').removeClass('active');
				$('.com6-alert #save').removeClass('active');
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> Lo sentimos pero, usted se encuentra Inactivo, por favor reactive su cuenta y regrese para registrar su c&oacute;digo.";
				document.getElementById('btn-alert').innerHTML = 'Reactivar mi cuenta';
				$('#btn-alert').attr('href', com6Scripts.siteUrl + '/reactivar/');
				break;

			//If an error has ocurred
			case 'error-added':
				$('.com6-alert .important-note').removeClass('active');
				$('.com6-alert #save').removeClass('active');
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> Lo sentimos. Ha ocurrido un problema, por favor vuelve a intentarlo m&aacute;s tarde.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar';
				$('#btn-alert').removeAttr('href');
				break;

		}

	}

});