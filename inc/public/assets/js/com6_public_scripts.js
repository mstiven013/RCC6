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

	//Reactivate form
	$('#reactivate-form, #view-draws-form, #minutes-form, #draws-form').on('submit', function(e){

		e.preventDefault();

		var form = $(this).serialize();

		$.ajax({
			method: "POST",
			url: urlClass,
			data: form
		}).done(function(info){
			var json_info = JSON.parse(info);

			$('.com6-alert').addClass('show');
			confirm(json_info);
		});

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
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> Su c&oacute;digo se ha registrado correctamente.<br/> El n&uacute;mero que le corresponde a su c&oacute;digo es el siguiente:<br/> <b>" + info.number + "</b>";
				document.getElementById('btn-alert').innerHTML = 'Cerrar e ingresar otro c&oacute;digo';
				$('#btn-alert').removeAttr('href');
				$('#draws-form #code').val('');
				break;

			//If code is registered for other person
			case 'code-invalid':
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> El c&oacute;digo <b>" + $('#draws-form #code').val() + "</b>, ya fue registrado por otra persona.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar e ingresar otro c&oacute;digo';
				$('#btn-alert').removeAttr('href');
				break;

			//If user is inactive
			case 'user-inactive':
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> Lo sentimos pero, usted se encuentra Inactivo, por favor reactive su cuenta y regrese para registrar su c&oacute;digo.";
				document.getElementById('btn-alert').innerHTML = 'Reactivar mi cuenta';
				$('#btn-alert').attr('href', com6Scripts.siteUrl + '/reactivar/');
				break;

			//If an error has ocurred
			case 'error-added':
				document.getElementById('text-alert').innerHTML = "¡Hola <b>" + $('#draws-form #name').val() + "</b>! <br/> Lo sentimos. Ha ocurrido un problema, por favor vuelve a intentarlo m&aacute;s tarde.";
				document.getElementById('btn-alert').innerHTML = 'Cerrar';
				$('#btn-alert').removeAttr('href');
				break;

		}

	}

});